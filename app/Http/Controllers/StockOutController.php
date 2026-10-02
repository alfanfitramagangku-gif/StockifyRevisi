<?php

namespace App\Http\Controllers;

use App\Models\StockOut;
use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $stockOuts = StockOut::with([
            'product',
            'confirmer'
        ])
            ->latest()
            ->get();

        return view(
            'stock-outs.index',
            compact('stockOuts')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $products = Product::orderBy('name')
            ->get();

        return view(
            'stock-outs.create',
            compact('products')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    |
    | Admin/Manager membuat transaksi.
    | Stok BELUM berkurang.
    | Status = pending.
    |
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'exists:products,id'
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],

            'date' => [
                'required',
                'date'
            ],

            'destination' => [
                'nullable',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK STOK
        |--------------------------------------------------------------------------
        */

        $product = Product::findOrFail(
            $validated['product_id']
        );


        if (
            $product->stock <
            $validated['quantity']
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'quantity' =>
                        'Stok produk tidak mencukupi. ' .
                        'Stok tersedia: ' .
                        $product->stock,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN TRANSAKSI
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($validated) {

            StockOut::create([
                'product_id' =>
                    $validated['product_id'],

                'quantity' =>
                    $validated['quantity'],

                'date' =>
                    $validated['date'],

                'destination' =>
                    $validated['destination'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'status' =>
                    'pending',

                'confirmed_by' =>
                    null,

                'confirmed_at' =>
                    null,
            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS
        |--------------------------------------------------------------------------
        */

        ActivityLog::record(
            'created',
            'Mencatat stok keluar: ' .
            $product->name .
            ' sebanyak ' .
            $validated['quantity'] .
            ' unit.'
        );


        return redirect()
            ->route('stock-outs.index')
            ->with(
                'success',
                'Stok keluar berhasil dicatat dan menunggu persiapan Staff.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | CONFIRM
    |--------------------------------------------------------------------------
    |
    | Staff melakukan konfirmasi pengeluaran.
    | Setelah dikonfirmasi, stok berkurang.
    |
    */

    public function confirm(
        StockOut $stockOut
    ) {

        if (
            $stockOut->status === 'confirmed'
        ) {

            return redirect()
                ->route('stock-outs.index')
                ->with(
                    'error',
                    'Stok keluar ini sudah dikonfirmasi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK STOK TERBARU
        |--------------------------------------------------------------------------
        */

        $product = Product::findOrFail(
            $stockOut->product_id
        );


        if (
            $product->stock <
            $stockOut->quantity
        ) {

            return redirect()
                ->route('stock-outs.index')
                ->with(
                    'error',
                    'Konfirmasi gagal. Stok ' .
                    $product->name .
                    ' tidak mencukupi. Stok tersedia: ' .
                    $product->stock .
                    ' unit.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | KURANGI STOK + KONFIRMASI
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($stockOut) {

            Product::where(
                'id',
                $stockOut->product_id
            )->decrement(
                'stock',
                $stockOut->quantity
            );


            $stockOut->update([
                'status' =>
                    'confirmed',

                'confirmed_by' =>
                    auth()->id(),

                'confirmed_at' =>
                    now(),
            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS
        |--------------------------------------------------------------------------
        */

        $stockOut->load('product');

        ActivityLog::record(
            'updated',
            'Mengonfirmasi stok keluar: ' .
            (
                $stockOut->product->name ??
                'Produk tidak tersedia'
            ) .
            ' sebanyak ' .
            $stockOut->quantity .
            ' unit.'
        );


        return redirect()
            ->route('stock-outs.index')
            ->with(
                'success',
                'Pengeluaran barang berhasil dikonfirmasi. Stok produk telah diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    |
    | Jika sudah confirmed:
    | stok dikembalikan.
    |
    | Jika masih pending:
    | stok tidak berubah.
    |
    */

    public function destroy(
        StockOut $stockOut
    ) {

        $stockOut->load('product');


        $productName =
            $stockOut->product->name ??
            'Produk tidak tersedia';

        $quantity =
            $stockOut->quantity;

        $status =
            $stockOut->status;


        DB::transaction(function () use ($stockOut) {

            if (
                $stockOut->status === 'confirmed'
            ) {

                Product::where(
                    'id',
                    $stockOut->product_id
                )->increment(
                    'stock',
                    $stockOut->quantity
                );
            }


            $stockOut->delete();
        });


        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS
        |--------------------------------------------------------------------------
        */

        ActivityLog::record(
            'deleted',
            'Menghapus data stok keluar: ' .
            $productName .
            ' sebanyak ' .
            $quantity .
            ' unit dengan status ' .
            $status .
            '.'
        );


        return redirect()
            ->route('stock-outs.index')
            ->with(
                'success',
                'Data stok keluar berhasil dihapus.'
            );
    }
}