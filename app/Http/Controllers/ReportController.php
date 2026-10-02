<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan inventaris.
     */
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        /*
        |--------------------------------------------------------------------------
        | DATA PRODUK
        |--------------------------------------------------------------------------
        */

        $products = Product::with('category')->get();

        $totalProducts = $products->count();

        $totalStock = $products->sum('stock');

        /*
        |--------------------------------------------------------------------------
        | REKAP STOK BERDASARKAN KATEGORI
        |--------------------------------------------------------------------------
        */

        $categoryReports = Category::withCount('products')
            ->withSum('products', 'stock')
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DATA BARANG MASUK
        |--------------------------------------------------------------------------
        */

        $stockInQuery = StockIn::with('product');

        if ($startDate) {
            $stockInQuery->whereDate('date', '>=', $startDate);
        }

        if ($endDate) {
            $stockInQuery->whereDate('date', '<=', $endDate);
        }

        $stockIns = $stockInQuery
            ->orderBy('date', 'desc')
            ->get();

        $totalStockIn = $stockIns->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | DATA BARANG KELUAR
        |--------------------------------------------------------------------------
        */

        $stockOutQuery = StockOut::with('product');

        if ($startDate) {
            $stockOutQuery->whereDate('date', '>=', $startDate);
        }

        if ($endDate) {
            $stockOutQuery->whereDate('date', '<=', $endDate);
        }

        $stockOuts = $stockOutQuery
            ->orderBy('date', 'desc')
            ->get();

        $totalStockOut = $stockOuts->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | PRODUK DENGAN STOK MENIPIS
        |--------------------------------------------------------------------------
        */

        $lowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS PENGGUNA
        |--------------------------------------------------------------------------
        */

        $activityQuery = ActivityLog::with('user')
            ->orderBy('created_at', 'desc');

        if ($startDate) {
            $activityQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $activityQuery->whereDate('created_at', '<=', $endDate);
        }

        $activities = $activityQuery->get();

        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN VIEW
        |--------------------------------------------------------------------------
        */

        return view('reports.index', compact(
            'products',
            'totalProducts',
            'totalStock',
            'totalStockIn',
            'totalStockOut',
            'stockIns',
            'stockOuts',
            'lowStockProducts',
            'categoryReports',
            'activities',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Download laporan dalam format CSV.
     */
    public function download(Request $request): StreamedResponse
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        /*
        |--------------------------------------------------------------------------
        | NAMA FILE
        |--------------------------------------------------------------------------
        */

        $fileName = 'laporan-inventaris-stockify';

        if ($startDate || $endDate) {
            $fileName .= '-';

            if ($startDate) {
                $fileName .= $startDate;
            } else {
                $fileName .= 'awal';
            }

            $fileName .= '-sampai-';

            if ($endDate) {
                $fileName .= $endDate;
            } else {
                $fileName .= 'sekarang';
            }
        } else {
            $fileName .= '-semua-data';
        }

        $fileName .= '.csv';

        /*
        |--------------------------------------------------------------------------
        | QUERY DATA
        |--------------------------------------------------------------------------
        */

        $products = Product::with('category')
            ->orderBy('name')
            ->get();

        $categoryReports = Category::withCount('products')
            ->withSum('products', 'stock')
            ->orderBy('name')
            ->get();

        $stockInQuery = StockIn::with('product');

        if ($startDate) {
            $stockInQuery->whereDate('date', '>=', $startDate);
        }

        if ($endDate) {
            $stockInQuery->whereDate('date', '<=', $endDate);
        }

        $stockIns = $stockInQuery
            ->orderBy('date', 'desc')
            ->get();

        $stockOutQuery = StockOut::with('product');

        if ($startDate) {
            $stockOutQuery->whereDate('date', '>=', $startDate);
        }

        if ($endDate) {
            $stockOutQuery->whereDate('date', '<=', $endDate);
        }

        $stockOuts = $stockOutQuery
            ->orderBy('date', 'desc')
            ->get();

        $lowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock', 'asc')
            ->get();

        $activityQuery = ActivityLog::with('user')
            ->orderBy('created_at', 'desc');

        if ($startDate) {
            $activityQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $activityQuery->whereDate('created_at', '<=', $endDate);
        }

        $activities = $activityQuery->get();

        /*
        |--------------------------------------------------------------------------
        | DATA RINGKASAN
        |--------------------------------------------------------------------------
        */

        $totalProducts = $products->count();

        $totalStock = $products->sum('stock');

        $totalStockIn = $stockIns->sum('quantity');

        $totalStockOut = $stockOuts->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | PROSES DOWNLOAD CSV
        |--------------------------------------------------------------------------
        */

        return response()->streamDownload(function () use (
            $products,
            $categoryReports,
            $stockIns,
            $stockOuts,
            $lowStockProducts,
            $activities,
            $totalProducts,
            $totalStock,
            $totalStockIn,
            $totalStockOut,
            $startDate,
            $endDate
        ) {
            $file = fopen('php://output', 'w');

            /*
            |--------------------------------------------------------------------------
            | BOM AGAR KARAKTER INDONESIA TERBACA DI EXCEL
            |--------------------------------------------------------------------------
            */

            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            /*
            |--------------------------------------------------------------------------
            | JUDUL LAPORAN
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [
                'LAPORAN INVENTARIS STOCKIFY'
            ], ';');

            fputcsv($file, [
                'Sistem Informasi Manajemen Inventaris'
            ], ';');

            fputcsv($file, [
                'Periode',
                $startDate ?: 'Awal',
                'sampai',
                $endDate ?: 'Sekarang'
            ], ';');

            fputcsv($file, [], ';');

            /*
            |--------------------------------------------------------------------------
            | RINGKASAN LAPORAN
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [
                'RINGKASAN LAPORAN'
            ], ';');

            fputcsv($file, [
                'Keterangan',
                'Jumlah'
            ], ';');

            fputcsv($file, [
                'Total Produk',
                $totalProducts
            ], ';');

            fputcsv($file, [
                'Total Stok',
                $totalStock
            ], ';');

            fputcsv($file, [
                'Total Barang Masuk',
                $totalStockIn
            ], ';');

            fputcsv($file, [
                'Total Barang Keluar',
                $totalStockOut
            ], ';');

            fputcsv($file, [], ';');

            /*
            |--------------------------------------------------------------------------
            | REKAP STOK BERDASARKAN KATEGORI
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [
                'REKAP STOK BERDASARKAN KATEGORI'
            ], ';');

            fputcsv($file, [
                'No',
                'Kategori',
                'Jumlah Produk',
                'Total Stok',
                'Status'
            ], ';');

            foreach ($categoryReports as $index => $category) {
                $categoryStock = $category->products_sum_stock ?? 0;

                fputcsv($file, [
                    $index + 1,
                    $category->name,
                    $category->products_count ?? 0,
                    $categoryStock,
                    $categoryStock > 0
                        ? 'Tersedia'
                        : 'Stok Habis'
                ], ';');
            }

            fputcsv($file, [], ';');

            /*
            |--------------------------------------------------------------------------
            | DATA PRODUK
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [
                'DAFTAR PRODUK'
            ], ';');

            fputcsv($file, [
                'No',
                'Nama Produk',
                'SKU',
                'Kategori',
                'Stok',
                'Stok Minimum'
            ], ';');

            foreach ($products as $index => $product) {
                fputcsv($file, [
                    $index + 1,
                    $product->name,
                    $product->sku ?? '-',
                    $product->category->name ?? '-',
                    $product->stock ?? 0,
                    $product->minimum_stock ?? 0
                ], ';');
            }

            fputcsv($file, [], ';');

            /*
            |--------------------------------------------------------------------------
            | PRODUK DENGAN STOK MENIPIS
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [
                'DAFTAR STOK MENIPIS'
            ], ';');

            fputcsv($file, [
                'No',
                'Nama Produk',
                'Kategori',
                'SKU',
                'Stok',
                'Stok Minimum'
            ], ';');

            foreach ($lowStockProducts as $index => $product) {
                fputcsv($file, [
                    $index + 1,
                    $product->name,
                    $product->category->name ?? '-',
                    $product->sku ?? '-',
                    $product->stock ?? 0,
                    $product->minimum_stock ?? 0
                ], ';');
            }

            fputcsv($file, [], ';');

            /*
            |--------------------------------------------------------------------------
            | BARANG MASUK
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [
                'RIWAYAT BARANG MASUK'
            ], ';');

            fputcsv($file, [
                'No',
                'Tanggal',
                'Produk',
                'Jumlah',
                'Keterangan'
            ], ';');

            foreach ($stockIns as $index => $stockIn) {
                fputcsv($file, [
                    $index + 1,
                    $stockIn->date ?? '-',
                    $stockIn->product->name ?? '-',
                    $stockIn->quantity ?? 0,
                    $stockIn->description ?? '-'
                ], ';');
            }

            fputcsv($file, [], ';');

            /*
            |--------------------------------------------------------------------------
            | BARANG KELUAR
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [
                'RIWAYAT BARANG KELUAR'
            ], ';');

            fputcsv($file, [
                'No',
                'Tanggal',
                'Produk',
                'Jumlah',
                'Tujuan',
                'Keterangan'
            ], ';');

            foreach ($stockOuts as $index => $stockOut) {
                fputcsv($file, [
                    $index + 1,
                    $stockOut->date ?? '-',
                    $stockOut->product->name ?? '-',
                    $stockOut->quantity ?? 0,
                    $stockOut->destination ?? '-',
                    $stockOut->description ?? '-'
                ], ';');
            }

            fputcsv($file, [], ';');

            /*
            |--------------------------------------------------------------------------
            | AKTIVITAS PENGGUNA
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [
                'RIWAYAT AKTIVITAS PENGGUNA'
            ], ';');

            fputcsv($file, [
                'No',
                'Tanggal',
                'Pengguna',
                'Aktivitas',
                'Keterangan',
                'Alamat IP'
            ], ';');

            foreach ($activities as $index => $activity) {
                fputcsv($file, [
                    $index + 1,
                    $activity->created_at
                        ? $activity->created_at->format('d-m-Y H:i')
                        : '-',
                    $activity->user->name ?? 'Pengguna tidak tersedia',
                    $activity->action ?? '-',
                    $activity->description ?? '-',
                    $activity->ip_address ?? '-'
                ], ';');
            }

            fputcsv($file, [], ';');

            fputcsv($file, [
                'Laporan dibuat pada',
                now()->format('d-m-Y H:i:s')
            ], ';');

            fclose($file);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}