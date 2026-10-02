<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockOpnameController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $stockOpnames = StockOpname::with([
            'product',
            'confirmer'
        ])
            ->latest()
            ->get();

        return view(
            'stock-opnames.index',
            compact('stockOpnames')
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
            'stock-opnames.create',
            compact('products')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    |
    | Menyimpan hasil pemeriksaan.
    |
    | Stok produk BELUM diubah di sini.
    | Stok baru disesuaikan ketika Stock Opname
    | dikonfirmasi oleh Staff.
    |
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'exists:products,id'
            ],

            'physical_stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'date' => [
                'required',
                'date',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL PRODUK
        |--------------------------------------------------------------------------
        */

        $product = Product::findOrFail(
            $validated['product_id']
        );


        /*
        |--------------------------------------------------------------------------
        | HITUNG STOK
        |--------------------------------------------------------------------------
        */

        $systemStock =
            $product->stock;

        $physicalStock =
            $validated['physical_stock'];

        $difference =
            $physicalStock -
            $systemStock;


        /*
        |--------------------------------------------------------------------------
        | SIMPAN STOCK OPNAME
        |--------------------------------------------------------------------------
        */

        StockOpname::create([
            'product_id' =>
                $validated['product_id'],

            'system_stock' =>
                $systemStock,

            'physical_stock' =>
                $physicalStock,

            'difference' =>
                $difference,

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


        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS
        |--------------------------------------------------------------------------
        */

        ActivityLog::record(
            'created',
            'Membuat Stock Opname untuk produk ' .
            $product->name .
            '. Stok sistem: ' .
            $systemStock .
            ', stok fisik: ' .
            $physicalStock .
            ', selisih: ' .
            $difference .
            '.'
        );


        return redirect()
            ->route('stock-opnames.index')
            ->with(
                'success',
                'Hasil stock opname berhasil disimpan dan menunggu konfirmasi Staff Gudang.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | CONFIRM
    |--------------------------------------------------------------------------
    |
    | Hanya Staff Gudang yang dapat melakukan konfirmasi.
    |
    | Setelah dikonfirmasi:
    | - status menjadi confirmed
    | - nama Staff dicatat
    | - waktu konfirmasi dicatat
    | - stok produk disesuaikan dengan stok fisik
    |
    */

    public function confirm(
        StockOpname $stockOpname
    ) {

        /*
        |--------------------------------------------------------------------------
        | CEK STATUS
        |--------------------------------------------------------------------------
        */

        if (
            $stockOpname->status ===
            'confirmed'
        ) {

            return redirect()
                ->route('stock-opnames.index')
                ->withErrors([
                    'stock_opname' =>
                        'Stock Opname ini sudah dikonfirmasi sebelumnya.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use ($stockOpname) {

                /*
                |--------------------------------------------------------------------------
                | LOCK PRODUK
                |--------------------------------------------------------------------------
                */

                $product =
                    Product::lockForUpdate()
                        ->findOrFail(
                            $stockOpname->product_id
                        );


                /*
                |--------------------------------------------------------------------------
                | SESUAIKAN STOK
                |--------------------------------------------------------------------------
                */

                $product->update([
                    'stock' =>
                        $stockOpname->physical_stock,
                ]);


                /*
                |--------------------------------------------------------------------------
                | UPDATE STATUS
                |--------------------------------------------------------------------------
                */

                $stockOpname->update([
                    'status' =>
                        'confirmed',

                    'confirmed_by' =>
                        Auth::id(),

                    'confirmed_at' =>
                        now(),
                ]);
            }
        );


        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS
        |--------------------------------------------------------------------------
        */

        $stockOpname->load('product');

        ActivityLog::record(
            'updated',
            'Mengonfirmasi Stock Opname untuk produk ' .
            (
                $stockOpname->product->name ??
                'Produk tidak tersedia'
            ) .
            '. Stok disesuaikan menjadi ' .
            $stockOpname->physical_stock .
            ' unit.'
        );


        return redirect()
            ->route('stock-opnames.index')
            ->with(
                'success',
                'Stock Opname berhasil dikonfirmasi. Stok produk telah disesuaikan dengan hasil pengecekan fisik.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    |
    | Hanya Admin yang dapat menghapus.
    |
    */

    public function destroy(
        StockOpname $stockOpname
    ) {

        $stockOpname->load('product');


        $productName =
            $stockOpname->product->name ??
            'Produk tidak tersedia';


        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA
        |--------------------------------------------------------------------------
        */

        $stockOpname->delete();


        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS
        |--------------------------------------------------------------------------
        */

        ActivityLog::record(
            'deleted',
            'Menghapus data Stock Opname untuk produk: ' .
            $productName .
            '.'
        );


        return redirect()
            ->route('stock-opnames.index')
            ->with(
                'success',
                'Data Stock Opname berhasil dihapus.'
            );
    }
}