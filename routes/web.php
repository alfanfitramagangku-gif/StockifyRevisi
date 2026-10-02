<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

// Controllers
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminSettingController;

// Models
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockOpname;


/*
|--------------------------------------------------------------------------
| LOGIN DAN LOGOUT
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    AuthController::class,
    'showLogin'
])
    ->middleware('guest')
    ->name('login');


Route::post('/login', [
    AuthController::class,
    'login'
])
    ->middleware('guest')
    ->name('login.process');


Route::post('/logout', [
    AuthController::class,
    'logout'
])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| APLIKASI
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/', function () {

        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $totalCategories = Category::count();

        $totalSuppliers = Supplier::count();

        $totalStock = Product::sum('stock');


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI HARI INI
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();


        $totalStockInToday = StockIn::whereDate(
            'date',
            $today
        )->sum('quantity');


        $totalStockOutToday = StockOut::whereDate(
            'date',
            $today
        )->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | FILTER PERIODE TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $startDateInput = request()->input(
            'start_date',
            now()->subDays(29)->toDateString()
        );


        $endDateInput = request()->input(
            'end_date',
            now()->toDateString()
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI TANGGAL
        |--------------------------------------------------------------------------
        */

        try {

            $startDate = Carbon::parse(
                $startDateInput
            )->startOfDay();


            $endDate = Carbon::parse(
                $endDateInput
            )->endOfDay();

        } catch (\Exception $e) {

            $startDate = now()
                ->subDays(29)
                ->startOfDay();


            $endDate = now()
                ->endOfDay();


            $startDateInput =
                $startDate->toDateString();


            $endDateInput =
                $endDate->toDateString();
        }


        /*
        |--------------------------------------------------------------------------
        | JIKA TANGGAL TERBALIK
        |--------------------------------------------------------------------------
        */

        if ($startDate->greaterThan($endDate)) {

            $temporaryDate = $startDate->copy();


            $startDate =
                $endDate->copy()->startOfDay();


            $endDate =
                $temporaryDate->copy()->endOfDay();


            $temporaryInput = $startDateInput;


            $startDateInput = $endDateInput;


            $endDateInput = $temporaryInput;
        }


        /*
        |--------------------------------------------------------------------------
        | JUMLAH TRANSAKSI STOK MASUK
        |--------------------------------------------------------------------------
        */

        $periodStockInTransactions =
            StockIn::whereBetween(
                'date',
                [
                    $startDate,
                    $endDate
                ]
            )->count();


        /*
        |--------------------------------------------------------------------------
        | JUMLAH TRANSAKSI STOK KELUAR
        |--------------------------------------------------------------------------
        */

        $periodStockOutTransactions =
            StockOut::whereBetween(
                'date',
                [
                    $startDate,
                    $endDate
                ]
            )->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL UNIT BARANG MASUK
        |--------------------------------------------------------------------------
        */

        $periodStockInQuantity =
            StockIn::whereBetween(
                'date',
                [
                    $startDate,
                    $endDate
                ]
            )->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | TOTAL UNIT BARANG KELUAR
        |--------------------------------------------------------------------------
        */

        $periodStockOutQuantity =
            StockOut::whereBetween(
                'date',
                [
                    $startDate,
                    $endDate
                ]
            )->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | PRODUK DENGAN STOK MENIPIS
        |--------------------------------------------------------------------------
        */

        $lowStockProducts =
            Product::whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )
            ->orderBy(
                'stock',
                'asc'
            )
            ->get();


        $lowStockCount =
            $lowStockProducts->count();


        /*
        |--------------------------------------------------------------------------
        | STOK MASUK TERBARU
        |--------------------------------------------------------------------------
        */

        $latestStockIns =
            StockIn::with([
                'product',
                'supplier',
                'confirmer'
            ])
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STOK KELUAR TERBARU
        |--------------------------------------------------------------------------
        */

        $latestStockOuts =
            StockOut::with([
                'product',
                'confirmer'
            ])
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STOCK OPNAME TERBARU
        |--------------------------------------------------------------------------
        */

        $latestStockOpnames =
            StockOpname::with([
                'product',
                'confirmer'
            ])
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK STOK PRODUK
        |--------------------------------------------------------------------------
        */

        $stockChartProducts =
            Product::orderBy(
                'name',
                'asc'
            )->get();


        $stockChartLabels =
            $stockChartProducts
            ->pluck('name')
            ->values();


        $stockChartData =
            $stockChartProducts
            ->pluck('stock')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | DATA TRANSAKSI PENDING
        |--------------------------------------------------------------------------
        |
        | Digunakan untuk Dashboard Manager dan Staff.
        |
        */


        // Stok Masuk yang belum dikonfirmasi Staff
        $pendingStockIns =
            StockIn::with([
                'product',
                'supplier'
            ])
            ->where('status', 'pending')
            ->latest()
            ->get();


        // Stok Keluar yang belum dikonfirmasi Staff
        $pendingStockOuts =
            StockOut::with('product')
            ->where('status', 'pending')
            ->latest()
            ->get();


        // Stock Opname yang belum dikonfirmasi Staff
        $pendingStockOpnames =
            StockOpname::with('product')
            ->where('status', 'pending')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | JUMLAH TRANSAKSI PENDING
        |--------------------------------------------------------------------------
        */

        $pendingStockInCount =
            $pendingStockIns->count();


        $pendingStockOutCount =
            $pendingStockOuts->count();


        $pendingStockOpnameCount =
            $pendingStockOpnames->count();


        /*
        |--------------------------------------------------------------------------
        | DATA DASHBOARD
        |--------------------------------------------------------------------------
        */

        $data = compact(

            // Statistik utama
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalStock',

            // Transaksi hari ini
            'totalStockInToday',
            'totalStockOutToday',

            // Filter periode
            'startDateInput',
            'endDateInput',

            // Transaksi berdasarkan periode
            'periodStockInTransactions',
            'periodStockOutTransactions',

            // Jumlah unit berdasarkan periode
            'periodStockInQuantity',
            'periodStockOutQuantity',

            // Stok menipis
            'lowStockProducts',
            'lowStockCount',

            // Aktivitas terbaru
            'latestStockIns',
            'latestStockOuts',
            'latestStockOpnames',

            // Grafik
            'stockChartLabels',
            'stockChartData',

            // Pending Stok Masuk
            'pendingStockIns',
            'pendingStockInCount',

            // Pending Stok Keluar
            'pendingStockOuts',
            'pendingStockOutCount',

            // Pending Stock Opname
            'pendingStockOpnames',
            'pendingStockOpnameCount'
        );


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */

        if (
            auth()->user()->role === 'admin'
        ) {

            return view(
                'dashboard.admin',
                $data
            );
        }


        if (
            auth()->user()->role === 'manager'
        ) {

            return view(
                'dashboard.manager',
                $data
            );
        }


        if (
            auth()->user()->role === 'staff'
        ) {

            return view(
                'dashboard.staff',
                $data
            );
        }


        abort(
            403,
            'Role pengguna tidak dikenali.'
        );

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | DATA PRODUK
    |--------------------------------------------------------------------------
    |
    | Semua role yang sudah login dapat melihat produk.
    |
    */

    Route::get('/products', [
        ProductController::class,
        'index'
    ])->name('products.index');


    /*
    |--------------------------------------------------------------------------
    | SUPPLIER
    |--------------------------------------------------------------------------
    |
    | Admin  : lihat + tambah + edit + hapus
    | Manager: hanya lihat
    | Staff  : tidak memiliki akses
    |
    */

    Route::get('/suppliers', [
        SupplierController::class,
        'index'
    ])
        ->middleware('role:admin,manager')
        ->name('suppliers.index');


    /*
    |--------------------------------------------------------------------------
    | STOK MASUK
    |--------------------------------------------------------------------------
    |
    | Admin   : lihat + tambah + hapus
    | Manager : lihat + tambah
    | Staff   : lihat + konfirmasi
    |
    */

    Route::get('/stock-ins', [
        StockInController::class,
        'index'
    ])->name('stock-ins.index');


    /*
    |--------------------------------------------------------------------------
    | TAMBAH STOK MASUK
    |--------------------------------------------------------------------------
    |
    | Hanya Admin dan Manager
    |
    */

    Route::middleware('role:admin,manager')->group(function () {

        Route::get('/stock-ins/create', [
            StockInController::class,
            'create'
        ])->name('stock-ins.create');


        Route::post('/stock-ins', [
            StockInController::class,
            'store'
        ])->name('stock-ins.store');

    });


    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI STOK MASUK
    |--------------------------------------------------------------------------
    |
    | Hanya Staff Gudang
    |
    */

    Route::post(
        '/stock-ins/{stock_in}/confirm',
        [
            StockInController::class,
            'confirm'
        ]
    )
        ->middleware('role:staff')
        ->name('stock-ins.confirm');


    /*
    |--------------------------------------------------------------------------
    | HAPUS STOK MASUK
    |--------------------------------------------------------------------------
    |
    | Hanya Admin
    |
    */

    Route::delete(
        '/stock-ins/{stock_in}',
        [
            StockInController::class,
            'destroy'
        ]
    )
        ->middleware('role:admin')
        ->name('stock-ins.destroy');


    /*
    |--------------------------------------------------------------------------
    | STOK KELUAR
    |--------------------------------------------------------------------------
    |
    | Admin   : lihat + tambah + hapus
    | Manager : lihat + tambah
    | Staff   : lihat + konfirmasi
    |
    */

    Route::get('/stock-outs', [
        StockOutController::class,
        'index'
    ])->name('stock-outs.index');


    /*
    |--------------------------------------------------------------------------
    | TAMBAH STOK KELUAR
    |--------------------------------------------------------------------------
    |
    | Hanya Admin dan Manager
    |
    */

    Route::middleware('role:admin,manager')->group(function () {

        Route::get('/stock-outs/create', [
            StockOutController::class,
            'create'
        ])->name('stock-outs.create');


        Route::post('/stock-outs', [
            StockOutController::class,
            'store'
        ])->name('stock-outs.store');

    });


    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI STOK KELUAR
    |--------------------------------------------------------------------------
    |
    | Hanya Staff Gudang
    |
    */

    Route::post(
        '/stock-outs/{stock_out}/confirm',
        [
            StockOutController::class,
            'confirm'
        ]
    )
        ->middleware('role:staff')
        ->name('stock-outs.confirm');


    /*
    |--------------------------------------------------------------------------
    | HAPUS STOK KELUAR
    |--------------------------------------------------------------------------
    |
    | Hanya Admin
    |
    */

    Route::delete(
        '/stock-outs/{stock_out}',
        [
            StockOutController::class,
            'destroy'
        ]
    )
        ->middleware('role:admin')
        ->name('stock-outs.destroy');


    /*
    |--------------------------------------------------------------------------
    | STOCK OPNAME
    |--------------------------------------------------------------------------
    |
    | Admin   : lihat + tambah
    | Manager : lihat + tambah
    | Staff   : lihat + tambah/periksa + konfirmasi
    |
    */

    /*
    |--------------------------------------------------------------------------
    | LIHAT STOCK OPNAME
    |--------------------------------------------------------------------------
    |
    | Semua role
    |
    */

    Route::get('/stock-opnames', [
        StockOpnameController::class,
        'index'
    ])->name('stock-opnames.index');


    /*
    |--------------------------------------------------------------------------
    | TAMBAH / PERIKSA STOCK OPNAME
    |--------------------------------------------------------------------------
    |
    | Admin + Manager + Staff
    |
    */

    Route::get('/stock-opnames/create', [
        StockOpnameController::class,
        'create'
    ])
        ->middleware('role:admin,manager,staff')
        ->name('stock-opnames.create');


    Route::post('/stock-opnames', [
        StockOpnameController::class,
        'store'
    ])
        ->middleware('role:admin,manager,staff')
        ->name('stock-opnames.store');


    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI STOCK OPNAME
    |--------------------------------------------------------------------------
    |
    | Hanya Staff Gudang
    |
    */

    Route::post(
        '/stock-opnames/{stockOpname}/confirm',
        [
            StockOpnameController::class,
            'confirm'
        ]
    )
        ->middleware('role:staff')
        ->name('stock-opnames.confirm');


    /*
    |--------------------------------------------------------------------------
    | HAPUS STOCK OPNAME
    |--------------------------------------------------------------------------
    |
    | Hanya Admin
    |
    */

    Route::delete(
        '/stock-opnames/{stockOpname}',
        [
            StockOpnameController::class,
            'destroy'
        ]
    )
        ->middleware('role:admin')
        ->name('stock-opnames.destroy');


    /*
    |--------------------------------------------------------------------------
    | PENGELOLAAN DATA UTAMA
    |--------------------------------------------------------------------------
    |
    | Hanya Admin
    |
    */

    Route::middleware('role:admin')->group(function () {


        /*
        |--------------------------------------------------------------------------
        | KATEGORI
        |--------------------------------------------------------------------------
        */

        Route::get('/categories', [
            CategoryController::class,
            'index'
        ])->name('categories.index');


        Route::get('/categories/create', [
            CategoryController::class,
            'create'
        ])->name('categories.create');


        Route::post('/categories', [
            CategoryController::class,
            'store'
        ])->name('categories.store');


        Route::get(
            '/categories/{category}/edit',
            [
                CategoryController::class,
                'edit'
            ]
        )->name('categories.edit');


        Route::put(
            '/categories/{category}',
            [
                CategoryController::class,
                'update'
            ]
        )->name('categories.update');


        Route::delete(
            '/categories/{category}',
            [
                CategoryController::class,
                'destroy'
            ]
        )->name('categories.destroy');


        /*
        |--------------------------------------------------------------------------
        | PRODUK - ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/products/create', [
            ProductController::class,
            'create'
        ])->name('products.create');


        Route::post('/products', [
            ProductController::class,
            'store'
        ])->name('products.store');


        Route::get(
            '/products/{product}/edit',
            [
                ProductController::class,
                'edit'
            ]
        )->name('products.edit');


        Route::put(
            '/products/{product}',
            [
                ProductController::class,
                'update'
            ]
        )->name('products.update');


        Route::patch(
            '/products/{product}',
            [
                ProductController::class,
                'update'
            ]
        )->name('products.patch');


        Route::delete(
            '/products/{product}',
            [
                ProductController::class,
                'destroy'
            ]
        )->name('products.destroy');


        /*
        |--------------------------------------------------------------------------
        | SUPPLIER - ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/suppliers/create', [
            SupplierController::class,
            'create'
        ])->name('suppliers.create');


        Route::post('/suppliers', [
            SupplierController::class,
            'store'
        ])->name('suppliers.store');


        Route::get(
            '/suppliers/{supplier}/edit',
            [
                SupplierController::class,
                'edit'
            ]
        )->name('suppliers.edit');


        Route::put(
            '/suppliers/{supplier}',
            [
                SupplierController::class,
                'update'
            ]
        )->name('suppliers.update');


        Route::delete(
            '/suppliers/{supplier}',
            [
                SupplierController::class,
                'destroy'
            ]
        )->name('suppliers.destroy');


        /*
        |--------------------------------------------------------------------------
        | MANAJEMEN PENGGUNA
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'users',
            UserController::class
        )->except([
            'show'
        ]);


        /*
        |--------------------------------------------------------------------------
        | PENGATURAN
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/settings', [
            AdminSettingController::class,
            'edit'
        ])->name('admin.settings.edit');


        Route::put('/admin/settings', [
            AdminSettingController::class,
            'update'
        ])->name('admin.settings.update');

    });


    /*
    |--------------------------------------------------------------------------
    | DETAIL PRODUK
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/products/{product}',
        [
            ProductController::class,
            'show'
        ]
    )->name('products.show');


    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    |
    | Admin dan Manager
    |
    */

    Route::middleware('role:admin,manager')->group(function () {

        Route::get('/reports', [
            ReportController::class,
            'index'
        ])->name('reports.index');


        Route::get('/reports/download', [
            ReportController::class,
            'download'
        ])->name('reports.download');

    });


    /*
    |--------------------------------------------------------------------------
    | AKTIVITAS
    |--------------------------------------------------------------------------
    |
    | Admin dan Manager
    |
    */

    Route::get('/activities', [
        ActivityController::class,
        'index'
    ])
        ->middleware('role:admin,')
        ->name('activities.index');

});


/*
|--------------------------------------------------------------------------
| IMPORT DAN EXPORT PRODUK
|--------------------------------------------------------------------------
|
| Hanya Admin
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin'
])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | EXPORT PRODUK
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/products/export/csv',
        [
            ProductController::class,
            'exportCsv'
        ]
    )->name('products.export');


    /*
    |--------------------------------------------------------------------------
    | IMPORT PRODUK
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/products/import/csv',
        [
            ProductController::class,
            'importCsv'
        ]
    )->name('products.import');

});