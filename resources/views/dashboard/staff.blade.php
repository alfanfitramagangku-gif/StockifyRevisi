@extends('layouts.app')

@section('title', 'Dashboard Staff')

@section('page-title', 'Dashboard Staff')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HEADER / HERO
    ========================================================== --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#021024] via-[#052659] to-[#5483B3] p-6 shadow-xl md:p-8">

        {{-- Decorative --}}
        <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-[#C1E8FF]/10 blur-2xl"></div>

        <div class="absolute -bottom-20 right-24 h-44 w-44 rounded-full bg-[#7DA0CA]/10 blur-2xl"></div>

        <div class="absolute -bottom-20 -left-10 h-40 w-40 rounded-full bg-[#5483B3]/20 blur-2xl"></div>


        <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

            {{-- LEFT --}}
            <div>

                {{-- Badge --}}
                <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-[#C1E8FF]/20 bg-white/10 px-3 py-1.5 text-xs font-semibold text-[#C1E8FF] backdrop-blur-sm">

                    <i data-lucide="warehouse" class="h-4 w-4"></i>

                    Dashboard Staff

                </div>


                {{-- Title --}}
                <h1 class="text-2xl font-bold tracking-tight text-white md:text-3xl">

                    Selamat Datang, {{ auth()->user()->name }} 👋

                </h1>


                {{-- Description --}}
                <p class="mt-2 max-w-2xl text-sm leading-6 text-[#C1E8FF]/80 md:text-base">

                    Pantau pekerjaan gudang, periksa transaksi persediaan,
                    dan bantu memastikan kondisi stok tetap sesuai.

                </p>

            </div>


            {{-- DATE --}}
            <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur-md">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#C1E8FF]/15">

                    <i data-lucide="calendar-days"
                       class="h-5 w-5 text-[#C1E8FF]">
                    </i>

                </div>

                <div>

                    <p class="text-xs font-medium text-[#C1E8FF]/70">
                        Hari ini
                    </p>

                    <p class="text-sm font-semibold text-white">
                        {{ now()->translatedFormat('d F Y') }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        SUMMARY
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


        {{-- TOTAL PRODUK --}}
        <div class="staff-card group">

            <div class="relative z-10 flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Produk
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-[#021024]">
                        {{ $totalProducts }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Produk yang tersedia di gudang
                    </p>

                </div>


                <div class="staff-icon">

                    <i data-lucide="package"
                       class="h-5 w-5">
                    </i>

                </div>

            </div>


            <a href="{{ route('products.index') }}"
               class="relative z-10 mt-5 inline-flex items-center gap-1 text-sm font-semibold text-[#5483B3] transition hover:text-[#052659]">

                Lihat Produk

                <i data-lucide="arrow-right"
                   class="h-4 w-4 transition group-hover:translate-x-1">
                </i>

            </a>

        </div>


        {{-- =====================================================
            STOK MENIPIS
        ====================================================== --}}
        <div class="staff-card staff-warning-card group">

            <div class="relative z-10 flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-red-500">
                        Stok Menipis
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-red-600">
                        {{ $lowStockProducts->count() }}
                    </h2>

                    <p class="mt-2 text-xs text-red-400">
                        Produk perlu diperiksa
                    </p>

                </div>


                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-red-50 transition duration-300 group-hover:bg-red-100">

                    <i data-lucide="triangle-alert"
                       class="h-5 w-5 text-red-500">
                    </i>

                </div>

            </div>


            <div class="relative z-10 mt-5 flex items-center gap-2 text-xs font-semibold text-red-500">

                <span class="h-2 w-2 animate-pulse rounded-full bg-red-500"></span>

                Perlu perhatian

            </div>

        </div>

    </div>


    {{-- =========================================================
        PEKERJAAN GUDANG
    ========================================================== --}}
    <div class="staff-card">

        <div class="relative z-10 mb-6 flex items-center justify-between">

            <div>

                <h2 class="text-lg font-bold text-[#021024]">
                    Pekerjaan Gudang
                </h2>

                <p class="mt-1 text-sm text-slate-400">
                    Periksa dan konfirmasi aktivitas persediaan yang menunggu.
                </p>

            </div>


            <div class="hidden h-10 w-10 items-center justify-center rounded-xl bg-[#C1E8FF]/60 sm:flex">

                <i data-lucide="clipboard-check"
                   class="h-5 w-5 text-[#052659]">
                </i>

            </div>

        </div>


        <div class="relative z-10 grid grid-cols-1 gap-4 md:grid-cols-3">


            {{-- =================================================
                STOK MASUK
            ================================================== --}}
            <a href="{{ route('stock-ins.index') }}"
               class="task-card group">

                <div class="flex items-center justify-between">

                    <div class="task-icon">

                        <i data-lucide="package-plus"
                           class="h-6 w-6">
                        </i>

                    </div>


                    <span class="task-number">

                        {{ $pendingStockInCount ?? 0 }}

                    </span>

                </div>


                <h3 class="mt-5 font-bold text-[#021024]">
                    Stok Masuk
                </h3>


                <p class="mt-2 text-sm leading-6 text-slate-500">

                    Barang masuk yang perlu diperiksa dan dikonfirmasi.

                </p>


                <div class="mt-5 inline-flex items-center gap-2 text-xs font-semibold text-[#5483B3]">

                    Periksa Sekarang

                    <i data-lucide="arrow-right"
                       class="h-3.5 w-3.5 transition group-hover:translate-x-1">
                    </i>

                </div>

            </a>


            {{-- =================================================
                STOK KELUAR
            ================================================== --}}
            <a href="{{ route('stock-outs.index') }}"
               class="task-card group">

                <div class="flex items-center justify-between">

                    <div class="task-icon">

                        <i data-lucide="package-minus"
                           class="h-6 w-6">
                        </i>

                    </div>


                    <span class="task-number">

                        {{ $pendingStockOutCount ?? 0 }}

                    </span>

                </div>


                <h3 class="mt-5 font-bold text-[#021024]">
                    Stok Keluar
                </h3>


                <p class="mt-2 text-sm leading-6 text-slate-500">

                    Barang keluar yang perlu diperiksa dan dikonfirmasi.

                </p>


                <div class="mt-5 inline-flex items-center gap-2 text-xs font-semibold text-[#5483B3]">

                    Periksa Sekarang

                    <i data-lucide="arrow-right"
                       class="h-3.5 w-3.5 transition group-hover:translate-x-1">
                    </i>

                </div>

            </a>


            {{-- =================================================
                STOCK OPNAME
            ================================================== --}}
            <a href="{{ route('stock-opnames.index') }}"
               class="task-card group">

                <div class="flex items-center justify-between">

                    <div class="task-icon">

                        <i data-lucide="clipboard-check"
                           class="h-6 w-6">
                        </i>

                    </div>


                    <span class="task-number">

                        {{ $pendingStockOpnameCount ?? 0 }}

                    </span>

                </div>


                <h3 class="mt-5 font-bold text-[#021024]">
                    Stock Opname
                </h3>


                <p class="mt-2 text-sm leading-6 text-slate-500">

                    Hasil pemeriksaan stok yang perlu dikonfirmasi.

                </p>


                <div class="mt-5 inline-flex items-center gap-2 text-xs font-semibold text-[#5483B3]">

                    Periksa Sekarang

                    <i data-lucide="arrow-right"
                       class="h-3.5 w-3.5 transition group-hover:translate-x-1">
                    </i>

                </div>

            </a>

        </div>

    </div>


    {{-- =========================================================
        DAFTAR STOK MENIPIS
    ========================================================== --}}
    <div class="staff-card">

        <div class="relative z-10 mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50">

                    <i data-lucide="triangle-alert"
                       class="h-5 w-5 text-red-500">
                    </i>

                </div>


                <div>

                    <h2 class="text-lg font-bold text-[#021024]">
                        Daftar Stok Menipis
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Produk yang perlu diperiksa oleh staff.
                    </p>

                </div>

            </div>


            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600">

                <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-red-500"></span>

                {{ $lowStockProducts->count() }} Produk

            </span>

        </div>


        @if ($lowStockProducts->count() > 0)

            <div class="relative z-10 overflow-hidden rounded-2xl border border-red-100">

                <div class="overflow-x-auto">

                    <table class="min-w-full text-left text-sm">

                        <thead class="bg-red-50/70">

                            <tr>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                    No
                                </th>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                    Nama Produk
                                </th>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                    Stok Saat Ini
                                </th>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                    Minimum Stok
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-red-50 bg-white">

                            @foreach ($lowStockProducts as $product)

                                <tr class="transition hover:bg-red-50/40">

                                    <td class="px-5 py-4 text-slate-500">
                                        {{ $loop->iteration }}
                                    </td>


                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-50">

                                                <i data-lucide="package"
                                                   class="h-4 w-4 text-red-500">
                                                </i>

                                            </div>


                                            <span class="font-semibold text-[#021024]">
                                                {{ $product->name }}
                                            </span>

                                        </div>

                                    </td>


                                    <td class="px-5 py-4">

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1.5 font-bold text-red-600">

                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                            {{ $product->stock }}

                                        </span>

                                    </td>


                                    <td class="px-5 py-4 font-medium text-slate-600">

                                        {{ $product->minimum_stock }}

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @else

            <div class="relative z-10 rounded-2xl border border-slate-100 bg-slate-50 p-8 text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#C1E8FF]/60">

                    <i data-lucide="package-check"
                       class="h-7 w-7 text-[#5483B3]">
                    </i>

                </div>


                <h3 class="mt-4 font-semibold text-[#021024]">
                    Semua stok masih aman
                </h3>


                <p class="mt-1 text-sm text-slate-400">
                    Tidak ada produk yang berada di bawah minimum stok.
                </p>

            </div>

        @endif

    </div>


    {{-- =========================================================
        AKTIVITAS STOK TERBARU
    ========================================================== --}}
    <div>

        <div class="mb-5">

            <h2 class="text-lg font-bold text-[#021024]">
                Aktivitas Stok Terbaru
            </h2>

            <p class="mt-1 text-sm text-slate-400">
                Pantau aktivitas persediaan yang baru dilakukan.
            </p>

        </div>


        <div class="grid grid-cols-1 gap-5 xl:grid-cols-2">


            {{-- =================================================
                STOK MASUK
            ================================================== --}}
            <div class="staff-card">

                <div class="relative z-10 mb-5 flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#C1E8FF]/60">

                            <i data-lucide="arrow-down-to-line"
                               class="h-5 w-5 text-[#052659]">
                            </i>

                        </div>


                        <div>

                            <h3 class="font-bold text-[#021024]">
                                Stok Masuk Terbaru
                            </h3>

                            <p class="text-xs text-slate-400">
                                Penerimaan barang terakhir
                            </p>

                        </div>

                    </div>


                    <span class="rounded-full bg-[#C1E8FF]/60 px-2.5 py-1 text-xs font-bold text-[#052659]">

                        Masuk

                    </span>

                </div>


                <div class="relative z-10 space-y-1">

                    @forelse ($latestStockIns as $stockIn)

                        <div class="activity-item">

                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-[#C1E8FF]/50">

                                    <i data-lucide="package-plus"
                                       class="h-4 w-4 text-[#052659]">
                                    </i>

                                </div>


                                <div class="min-w-0">

                                    <p class="truncate text-sm font-semibold text-[#021024]">

                                        {{ $stockIn->product->name ?? 'Produk tidak tersedia' }}

                                    </p>


                                    <p class="mt-1 text-xs text-slate-400">

                                        {{ $stockIn->date }}

                                    </p>

                                </div>

                            </div>


                            <span class="flex-shrink-0 rounded-full bg-[#C1E8FF]/60 px-3 py-1 text-xs font-bold text-[#052659]">

                                +{{ $stockIn->quantity }}

                            </span>

                        </div>

                    @empty

                        <div class="py-8 text-center">

                            <i data-lucide="inbox"
                               class="mx-auto h-8 w-8 text-slate-300">
                            </i>

                            <p class="mt-2 text-sm text-slate-400">
                                Belum ada data stok masuk.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- =================================================
                STOK KELUAR
            ================================================== --}}
            <div class="staff-card">

                <div class="relative z-10 mb-5 flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#C1E8FF]/60">

                            <i data-lucide="arrow-up-from-line"
                               class="h-5 w-5 text-[#052659]">
                            </i>

                        </div>


                        <div>

                            <h3 class="font-bold text-[#021024]">
                                Stok Keluar Terbaru
                            </h3>

                            <p class="text-xs text-slate-400">
                                Pengeluaran barang terakhir
                            </p>

                        </div>

                    </div>


                    <span class="rounded-full bg-[#C1E8FF]/60 px-2.5 py-1 text-xs font-bold text-[#052659]">

                        Keluar

                    </span>

                </div>


                <div class="relative z-10 space-y-1">

                    @forelse ($latestStockOuts as $stockOut)

                        <div class="activity-item">

                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-[#C1E8FF]/50">

                                    <i data-lucide="package-minus"
                                       class="h-4 w-4 text-[#052659]">
                                    </i>

                                </div>


                                <div class="min-w-0">

                                    <p class="truncate text-sm font-semibold text-[#021024]">

                                        {{ $stockOut->product->name ?? 'Produk tidak tersedia' }}

                                    </p>


                                    <p class="mt-1 text-xs text-slate-400">

                                        {{ $stockOut->date }}

                                    </p>

                                </div>

                            </div>


                            <span class="flex-shrink-0 rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-[#052659]">

                                -{{ $stockOut->quantity }}

                            </span>

                        </div>

                    @empty

                        <div class="py-8 text-center">

                            <i data-lucide="inbox"
                               class="mx-auto h-8 w-8 text-slate-300">
                            </i>

                            <p class="mt-2 text-sm text-slate-400">
                                Belum ada data stok keluar.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    CUSTOM STYLE
============================================================= --}}
<style>

    /* =========================================================
       MAIN CARD
    ========================================================= */

    .staff-card {

        position: relative;

        overflow: hidden;

        border-radius: 24px;

        border: 1px solid rgba(84, 131, 179, 0.12);

        background: #ffffff;

        padding: 24px;

        box-shadow:
            0 8px 30px rgba(2, 16, 36, 0.05);

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease,
            border-color 0.3s ease;
    }


    .staff-card::after {

        content: "";

        position: absolute;

        right: -40px;

        top: -40px;

        width: 120px;

        height: 120px;

        border-radius: 9999px;

        background: rgba(193, 232, 255, 0.16);

        pointer-events: none;
    }


    .staff-card:hover {

        transform: translateY(-4px);

        border-color: rgba(84, 131, 179, 0.20);

        box-shadow:
            0 16px 35px rgba(2, 16, 36, 0.08);
    }


    /* =========================================================
       SUMMARY ICON
    ========================================================= */

    .staff-icon {

        position: relative;

        z-index: 2;

        display: flex;

        height: 44px;

        width: 44px;

        align-items: center;

        justify-content: center;

        border-radius: 16px;

        background: rgba(193, 232, 255, 0.65);

        color: #052659;

        transition:
            transform 0.3s ease,
            background 0.3s ease;
    }


    .staff-card:hover .staff-icon {

        transform: scale(1.08);

        background: rgba(125, 160, 202, 0.30);
    }


    /* =========================================================
       WARNING
    ========================================================= */

    .staff-warning-card {

        border-color: rgba(239, 68, 68, 0.15);

        background:
            linear-gradient(
                145deg,
                #ffffff 0%,
                #fffafa 100%
            );
    }


    .staff-warning-card::after {

        background: rgba(254, 226, 226, 0.45);
    }


    .staff-warning-card:hover {

        border-color: rgba(239, 68, 68, 0.30);

        box-shadow:
            0 16px 35px rgba(239, 68, 68, 0.08);
    }


    /* =========================================================
       TASK CARD
    ========================================================= */

    .task-card {

        position: relative;

        overflow: hidden;

        border-radius: 20px;

        border: 1px solid #e2e8f0;

        background: #ffffff;

        padding: 22px;

        transition:
            transform 0.3s ease,
            border-color 0.3s ease,
            box-shadow 0.3s ease;
    }


    .task-card::before {

        content: "";

        position: absolute;

        left: 0;

        top: 0;

        height: 3px;

        width: 0;

        background: #5483B3;

        transition: width 0.3s ease;
    }


    .task-card:hover {

        transform: translateY(-4px);

        border-color: rgba(84, 131, 179, 0.35);

        box-shadow:
            0 14px 30px rgba(2, 16, 36, 0.07);
    }


    .task-card:hover::before {

        width: 100%;
    }


    /* =========================================================
       TASK ICON
    ========================================================= */

    .task-icon {

        display: flex;

        height: 52px;

        width: 52px;

        align-items: center;

        justify-content: center;

        border-radius: 17px;

        background: rgba(193, 232, 255, 0.65);

        color: #052659;

        transition:
            transform 0.3s ease,
            background 0.3s ease;
    }


    .task-card:hover .task-icon {

        transform: scale(1.08);

        background: rgba(125, 160, 202, 0.30);
    }


    /* =========================================================
       TASK NUMBER
    ========================================================= */

    .task-number {

        display: flex;

        min-width: 42px;

        height: 42px;

        align-items: center;

        justify-content: center;

        border-radius: 14px;

        background: #f1f8fc;

        color: #052659;

        font-size: 18px;

        font-weight: 800;

    }


    .task-card:hover .task-number {

        background: #C1E8FF;

    }


    /* =========================================================
       ACTIVITY ITEM
    ========================================================= */

    .activity-item {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 12px;

        border-bottom: 1px solid #f1f5f9;

        padding: 14px 4px;

        transition:
            background 0.2s ease,
            padding 0.2s ease;
    }


    .activity-item:last-child {

        border-bottom: none;
    }


    .activity-item:hover {

        border-radius: 12px;

        background: rgba(193, 232, 255, 0.15);

        padding-left: 10px;

        padding-right: 10px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 640px) {

        .staff-card {

            border-radius: 20px;

            padding: 18px;
        }


        .task-card {

            border-radius: 18px;

            padding: 18px;
        }

    }

</style>

@endsection