<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $stockIns = StockIn::with([
            'product',
            'supplier',
            'confirmer'
        ])
            ->latest()
            ->get();

        return view(
            'stock-ins.index',
            compact('stockIns')
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

        $suppliers = Supplier::orderBy('name')
            ->get();

        return view(
            'stock-ins.create',
            compact(
                'products',
                'suppliers'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    |
    | Admin/Manager membuat transaksi.
    | Stok BELUM bertambah.
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

            'supplier_id' => [
                'nullable',
                'exists:suppliers,id'
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

            'description' => [
                'nullable',
                'string'
            ],
        ]);


        $product = Product::findOrFail(
            $validated['product_id']
        );


        DB::transaction(function () use ($validated) {

            StockIn::create([
                'product_id' =>
                    $validated['product_id'],

                'supplier_id' =>
                    $validated['supplier_id'] ?? null,

                'quantity' =>
                    $validated['quantity'],

                'date' =>
                    $validated['date'],

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
            'Mencatat stok masuk: ' .
            $product->name .
            ' sebanyak ' .
            $validated['quantity'] .
            ' unit.'
        );


        return redirect()
            ->route('stock-ins.index')
            ->with(
                'success',
                'Stok masuk berhasil dicatat dan menunggu pemeriksaan Staff.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | CONFIRM
    |--------------------------------------------------------------------------
    |
    | Hanya Staff yang melakukan konfirmasi.
    | Setelah dikonfirmasi, stok produk bertambah.
    |
    */

    public function confirm(
        StockIn $stockIn
    ) {
        if (
            $stockIn->status === 'confirmed'
        ) {

            return redirect()
                ->route('stock-ins.index')
                ->with(
                    'error',
                    'Stok masuk ini sudah dikonfirmasi.'
                );
        }


        DB::transaction(function () use ($stockIn) {

            Product::where(
                'id',
                $stockIn->product_id
            )->increment(
                'stock',
                $stockIn->quantity
            );


            $stockIn->update([
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

        $stockIn->load('product');

        ActivityLog::record(
            'updated',
            'Mengonfirmasi stok masuk: ' .
            (
                $stockIn->product->name ??
                'Produk tidak tersedia'
            ) .
            ' sebanyak ' .
            $stockIn->quantity .
            ' unit.'
        );


        return redirect()
            ->route('stock-ins.index')
            ->with(
                'success',
                'Penerimaan barang berhasil dikonfirmasi. Stok produk telah diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    |
    | Jika data sudah confirmed,
    | stok dikembalikan saat transaksi dihapus.
    |
    | Jika masih pending,
    | stok tidak perlu dikembalikan.
    |
    */

    public function destroy(
        StockIn $stockIn
    ) {
        $stockIn->load('product');


        $productName =
            $stockIn->product->name ??
            'Produk tidak tersedia';

        $quantity =
            $stockIn->quantity;

        $status =
            $stockIn->status;


        DB::transaction(function () use ($stockIn) {

            if (
                $stockIn->status === 'confirmed'
            ) {

                Product::where(
                    'id',
                    $stockIn->product_id
                )->decrement(
                    'stock',
                    $stockIn->quantity
                );
            }


            $stockIn->delete();
        });


        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS
        |--------------------------------------------------------------------------
        */

        ActivityLog::record(
            'deleted',
            'Menghapus data stok masuk: ' .
            $productName .
            ' sebanyak ' .
            $quantity .
            ' unit dengan status ' .
            $status .
            '.'
        );


        return redirect()
            ->route('stock-ins.index')
            ->with(
                'success',
                'Data stok masuk berhasil dihapus.'
            );
    }
}