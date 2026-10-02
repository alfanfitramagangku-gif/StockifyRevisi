<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockOpname;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Menampilkan halaman aktivitas
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */

        $search = $request->search;
        $date = $request->date;


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS PENGGUNA
        |--------------------------------------------------------------------------
        |
        | Mengambil data dari tabel activity_logs.
        |
        */

        $activities = ActivityLog::with('user')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('action', 'like', '%' . $search . '%')
                        ->orWhere(
                            'description',
                            'like',
                            '%' . $search . '%'
                        );

                });

            })
            ->when($date, function ($query) use ($date) {

                $query->whereDate(
                    'created_at',
                    $date
                );

            })
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STOK MASUK
        |--------------------------------------------------------------------------
        */

        $stockIns = StockIn::with('product')
            ->when($search, function ($query) use ($search) {

                $query->whereHas('product', function ($q) use ($search) {

                    $q->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                });

            })
            ->when($date, function ($query) use ($date) {

                $query->whereDate(
                    'date',
                    $date
                );

            })
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STOK KELUAR
        |--------------------------------------------------------------------------
        */

        $stockOuts = StockOut::with('product')
            ->when($search, function ($query) use ($search) {

                $query->whereHas('product', function ($q) use ($search) {

                    $q->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                });

            })
            ->when($date, function ($query) use ($date) {

                $query->whereDate(
                    'date',
                    $date
                );

            })
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STOCK OPNAME
        |--------------------------------------------------------------------------
        */

        $stockOpnames = StockOpname::with('product')
            ->when($search, function ($query) use ($search) {

                $query->whereHas('product', function ($q) use ($search) {

                    $q->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                });

            })
            ->when($date, function ($query) use ($date) {

                $query->whereDate(
                    'date',
                    $date
                );

            })
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'activities.index',
            compact(
                'activities',
                'stockIns',
                'stockOuts',
                'stockOpnames',
                'search',
                'date'
            )
        );
    }
}