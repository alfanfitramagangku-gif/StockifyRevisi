@extends('layouts.app')

@section('title', 'Laporan Inventaris')
@section('page-title', 'Laporan Inventaris')

@section('content')

@php

    $categoryReportsData = $categoryReports ?? collect();
    $lowStockProductsData = $lowStockProducts ?? collect();
    $stockInsData = $stockIns ?? collect();
    $stockOutsData = $stockOuts ?? collect();

    $totalCategory = $categoryReportsData->count();
    $totalLowStock = $lowStockProductsData->count();

@endphp


<div
    id="report-page"
    class="min-h-screen bg-[#F5F9FC] px-4 py-6 sm:px-6 lg:px-8"
>


    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between print:hidden">

        {{-- Header kiri --}}
        <div class="min-w-0">

            {{-- Breadcrumb --}}
            <div class="mb-2 flex items-center gap-2 text-sm">

                <span class="flex items-center gap-1.5 text-[#5483B3]">

                    <i
                        data-lucide="layout-dashboard"
                        class="h-4 w-4">
                    </i>

                    Dashboard

                </span>


                <i
                    data-lucide="chevron-right"
                    class="h-4 w-4 text-[#7DA0CA]">
                </i>


                <span class="font-semibold text-[#052659]">

                    Laporan

                </span>

            </div>


            <h1 class="text-2xl font-extrabold tracking-tight text-[#021024] sm:text-3xl">

                Laporan Inventaris

            </h1>


            <p class="mt-1 text-sm text-[#5483B3]">

                Pantau dan cetak data inventaris Stockify.

            </p>

        </div>


        {{-- Download --}}
        <a
            href="{{ route('reports.download', request()->query()) }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#021024] via-[#052659] to-[#5483B3] px-5 py-3 text-sm font-bold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-lg active:scale-95"
        >

            <i
                data-lucide="file-down"
                class="h-5 w-5">
            </i>

            <span>
                Download Laporan
            </span>

        </a>

    </div>



    {{-- =========================================================
        AREA LAPORAN
    ========================================================== --}}

    <div id="printable-report">


        {{-- =====================================================
            KOP LAPORAN
        ====================================================== --}}

        <div class="mb-6 hidden text-center print:block">

            <h1 class="text-2xl font-bold text-black">

                LAPORAN INVENTARIS STOCKIFY

            </h1>


            <p class="mt-1 text-sm text-black">

                Sistem Informasi Manajemen Inventaris

            </p>


            @if(request('start_date') || request('end_date'))

                <p class="mt-2 text-sm text-black">

                    Periode:

                    {{ request('start_date') ?: 'Awal' }}

                    sampai

                    {{ request('end_date') ?: 'Sekarang' }}

                </p>

            @else

                <p class="mt-2 text-sm text-black">

                    Periode: Semua Data

                </p>

            @endif


            <hr class="my-4 border-black">

        </div>



        {{-- =====================================================
            FILTER PERIODE
        ====================================================== --}}

        <div
            class="report-card mb-6 rounded-2xl border border-[#C1E8FF] bg-white p-5 shadow-sm print:hidden"
        >

            <div class="mb-5 flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#E8F7FF]">

                    <i
                        data-lucide="calendar-days"
                        class="h-5 w-5 text-[#5483B3]">
                    </i>

                </div>


                <div>

                    <h2 class="font-bold text-[#021024]">

                        Filter Periode Laporan

                    </h2>


                    <p class="text-sm text-[#7DA0CA]">

                        Pilih tanggal untuk menampilkan data tertentu.

                    </p>

                </div>

            </div>


            <form
                action="{{ route('reports.index') }}"
                method="GET"
                class="grid grid-cols-1 gap-4 md:grid-cols-3 md:items-end"
            >

                {{-- Tanggal mulai --}}
                <div>

                    <label
                        for="start_date"
                        class="mb-2 block text-sm font-semibold text-[#052659]"
                    >

                        Tanggal Mulai

                    </label>


                    <div class="relative">

                        <i
                            data-lucide="calendar"
                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]"
                        ></i>


                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            value="{{ request('start_date') }}"
                            class="w-full rounded-xl border border-[#C1E8FF] bg-[#F8FCFF] py-3 pl-11 pr-4 text-sm text-[#021024] outline-none transition focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/40"
                        >

                    </div>

                </div>


                {{-- Tanggal selesai --}}
                <div>

                    <label
                        for="end_date"
                        class="mb-2 block text-sm font-semibold text-[#052659]"
                    >

                        Tanggal Selesai

                    </label>


                    <div class="relative">

                        <i
                            data-lucide="calendar-check"
                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]"
                        ></i>


                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            value="{{ request('end_date') }}"
                            class="w-full rounded-xl border border-[#C1E8FF] bg-[#F8FCFF] py-3 pl-11 pr-4 text-sm text-[#021024] outline-none transition focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/40"
                        >

                    </div>

                </div>


                {{-- Tombol --}}
                <div class="flex gap-2">

                    <button
                        type="submit"
                        class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#021024] to-[#5483B3] px-4 py-3 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:shadow-md"
                    >

                        <i
                            data-lucide="search"
                            class="h-4 w-4">
                        </i>

                        Terapkan

                    </button>


                    <a
                        href="{{ route('reports.index') }}"
                        class="flex items-center justify-center gap-2 rounded-xl border border-[#C1E8FF] bg-white px-4 py-3 text-sm font-semibold text-[#5483B3] transition hover:bg-[#F1FAFF]"
                    >

                        <i
                            data-lucide="rotate-ccw"
                            class="h-4 w-4">
                        </i>

                        <span class="hidden sm:inline">
                            Reset
                        </span>

                    </a>

                </div>

            </form>

        </div>



        {{-- =====================================================
            RINGKASAN
        ====================================================== --}}

        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- Total Produk --}}
            <div class="report-stat-card group relative overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white p-5 shadow-sm">

                <div class="relative z-10 flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-[#5483B3]">

                            Total Produk

                        </p>


                        <h3 class="mt-2 text-3xl font-extrabold tracking-tight text-[#021024]">

                            {{ number_format($totalProducts ?? 0, 0, ',', '.') }}

                        </h3>


                        <p class="mt-2 text-xs text-[#7DA0CA]">

                            Produk terdaftar

                        </p>

                    </div>


                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                        <i
                            data-lucide="package"
                            class="h-6 w-6 text-[#5483B3]">
                        </i>

                    </div>

                </div>


                <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-[#C1E8FF]/40"></div>

            </div>



            {{-- Total Stok --}}
            <div class="report-stat-card group relative overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white p-5 shadow-sm">

                <div class="relative z-10 flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-[#5483B3]">

                            Total Stok

                        </p>


                        <h3 class="mt-2 text-3xl font-extrabold tracking-tight text-[#021024]">

                            {{ number_format($totalStock ?? 0, 0, ',', '.') }}

                        </h3>


                        <p class="mt-2 text-xs text-[#7DA0CA]">

                            Seluruh stok barang

                        </p>

                    </div>


                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                        <i
                            data-lucide="boxes"
                            class="h-6 w-6 text-[#5483B3]">
                        </i>

                    </div>

                </div>


                <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-[#C1E8FF]/40"></div>

            </div>



            {{-- Barang Masuk --}}
            <div class="report-stat-card group relative overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white p-5 shadow-sm">

                <div class="relative z-10 flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-[#5483B3]">

                            Barang Masuk

                        </p>


                        <h3 class="mt-2 text-3xl font-extrabold tracking-tight text-[#021024]">

                            {{ number_format($totalStockIn ?? 0, 0, ',', '.') }}

                        </h3>


                        <p class="mt-2 text-xs text-[#7DA0CA]">

                            Jumlah barang masuk

                        </p>

                    </div>


                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                        <i
                            data-lucide="arrow-down-left"
                            class="h-6 w-6 text-[#5483B3]">
                        </i>

                    </div>

                </div>


                <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-[#C1E8FF]/40"></div>

            </div>



            {{-- Barang Keluar --}}
            <div class="report-stat-card group relative overflow-hidden rounded-2xl border border-red-100 bg-white p-5 shadow-sm">

                <div class="relative z-10 flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-red-500">

                            Barang Keluar

                        </p>


                        <h3 class="mt-2 text-3xl font-extrabold tracking-tight text-[#021024]">

                            {{ number_format($totalStockOut ?? 0, 0, ',', '.') }}

                        </h3>


                        <p class="mt-2 text-xs text-red-400">

                            Jumlah barang keluar

                        </p>

                    </div>


                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-50">

                        <i
                            data-lucide="arrow-up-right"
                            class="h-6 w-6 text-red-500">
                        </i>

                    </div>

                </div>


                <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-red-50"></div>

            </div>

        </div>



        {{-- =====================================================
            REKAP KATEGORI
        ====================================================== --}}

        <div class="report-section mb-6 overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white shadow-sm">

            <div class="flex flex-col gap-3 border-b border-[#E8F7FF] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#E8F7FF]">

                        <i
                            data-lucide="layers"
                            class="h-5 w-5 text-[#5483B3]">
                        </i>

                    </div>


                    <div>

                        <h2 class="font-bold text-[#021024]">

                            Rekap Stok Berdasarkan Kategori

                        </h2>


                        <p class="text-sm text-[#7DA0CA]">

                            Jumlah produk dan stok setiap kategori.

                        </p>

                    </div>

                </div>


                <span class="w-fit rounded-lg bg-[#F1FAFF] px-3 py-2 text-xs font-bold text-[#5483B3]">

                    {{ $totalCategory }} Kategori

                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full text-left text-sm">

                    <thead class="bg-[#F8FCFF]">

                        <tr class="border-b border-[#E8F7FF]">

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                No
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                Kategori
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                Jumlah Produk
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                Total Stok
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#E8F7FF]">

                        @forelse($categoryReportsData as $category)

                            @php

                                $categoryStock =
                                    $category->products_sum_stock ?? 0;

                            @endphp


                            <tr class="transition hover:bg-[#F8FCFF]">

                                <td class="px-5 py-4 text-[#7DA0CA]">

                                    {{ $loop->iteration }}

                                </td>


                                <td class="px-5 py-4 font-semibold text-[#021024]">

                                    {{ $category->name }}

                                </td>


                                <td class="px-5 py-4 text-[#5483B3]">

                                    {{ number_format($category->products_count ?? 0, 0, ',', '.') }}

                                    Produk

                                </td>


                                <td class="px-5 py-4">

                                    <span class="inline-flex rounded-lg bg-[#E8F7FF] px-3 py-2 font-semibold text-[#052659]">

                                        {{ number_format($categoryStock, 0, ',', '.') }}

                                        Unit

                                    </span>

                                </td>


                                <td class="px-5 py-4">

                                    @if($categoryStock <= 0)

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-600">

                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                            Stok Habis

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#E8F7FF] px-3 py-1 text-xs font-semibold text-[#052659]">

                                            <span class="h-1.5 w-1.5 rounded-full bg-[#5483B3]"></span>

                                            Tersedia

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-5 py-12 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                                            <i
                                                data-lucide="layers-2"
                                                class="h-7 w-7 text-[#5483B3]">
                                            </i>

                                        </div>


                                        <p class="font-semibold text-[#021024]">

                                            Belum ada data kategori

                                        </p>


                                        <p class="mt-1 text-sm text-[#7DA0CA]">

                                            Data kategori akan tampil di sini.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>



        {{-- =====================================================
            STOK MENIPIS
        ====================================================== --}}

        <div class="report-warning-section mb-6 overflow-hidden rounded-2xl border border-red-100 bg-white shadow-sm">

            <div class="flex flex-col gap-3 border-b border-red-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-50">

                        <i
                            data-lucide="triangle-alert"
                            class="h-5 w-5 text-red-500">
                        </i>

                    </div>


                    <div>

                        <h2 class="font-bold text-[#021024]">

                            Daftar Stok Menipis

                        </h2>


                        <p class="text-sm text-[#7DA0CA]">

                            Produk yang perlu segera ditambah stoknya.

                        </p>

                    </div>

                </div>


                <span class="w-fit rounded-full bg-red-50 px-3 py-2 text-sm font-bold text-red-600">

                    {{ $totalLowStock }} Produk

                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full text-left text-sm">

                    <thead class="bg-red-50/50">

                        <tr class="border-b border-red-100">

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                No
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                Nama Produk
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                Kategori
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                SKU
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                Stok
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-red-50">

                        @forelse($lowStockProductsData as $product)

                            <tr class="transition hover:bg-red-50/30">

                                <td class="px-5 py-4 text-[#7DA0CA]">

                                    {{ $loop->iteration }}

                                </td>


                                <td class="px-5 py-4 font-semibold text-[#021024]">

                                    {{ $product->name }}

                                </td>


                                <td class="px-5 py-4 text-[#5483B3]">

                                    {{ $product->category->name ?? '-' }}

                                </td>


                                <td class="px-5 py-4 font-mono text-xs text-[#5483B3]">

                                    {{ $product->sku ?? '-' }}

                                </td>


                                <td class="px-5 py-4">

                                    <span class="inline-flex rounded-lg bg-red-50 px-3 py-2 font-bold text-red-600">

                                        {{ number_format($product->stock ?? 0, 0, ',', '.') }}

                                    </span>

                                </td>


                                <td class="px-5 py-4">

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-600">

                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                        Stok Menipis

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-5 py-12 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                                            <i
                                                data-lucide="circle-check"
                                                class="h-7 w-7 text-[#5483B3]">
                                            </i>

                                        </div>


                                        <p class="font-semibold text-[#021024]">

                                            Stok dalam kondisi aman

                                        </p>


                                        <p class="mt-1 text-sm text-[#7DA0CA]">

                                            Tidak ada produk dengan stok menipis.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>



        {{-- =====================================================
            BARANG MASUK
        ====================================================== --}}

        <div class="report-section mb-6 overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white shadow-sm">

            <div class="border-b border-[#E8F7FF] px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#E8F7FF]">

                        <i
                            data-lucide="arrow-down-left"
                            class="h-5 w-5 text-[#5483B3]">
                        </i>

                    </div>


                    <div>

                        <h2 class="font-bold text-[#021024]">

                            Riwayat Barang Masuk

                        </h2>


                        <p class="text-sm text-[#7DA0CA]">

                            Daftar transaksi barang masuk.

                        </p>

                    </div>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full text-left text-sm">

                    <thead class="bg-[#F8FCFF]">

                        <tr class="border-b border-[#E8F7FF]">

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                No
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                Tanggal
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                Produk
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                Jumlah
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-[#5483B3]">
                                Keterangan
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#E8F7FF]">

                        @forelse($stockInsData as $stockIn)

                            <tr class="transition hover:bg-[#F8FCFF]">

                                <td class="px-5 py-4 text-[#7DA0CA]">

                                    {{ $loop->iteration }}

                                </td>


                                <td class="whitespace-nowrap px-5 py-4 text-[#5483B3]">

                                    {{ $stockIn->date
                                        ? \Carbon\Carbon::parse($stockIn->date)->format('d-m-Y')
                                        : '-'
                                    }}

                                </td>


                                <td class="px-5 py-4 font-semibold text-[#021024]">

                                    {{ $stockIn->product->name ?? '-' }}

                                </td>


                                <td class="px-5 py-4">

                                    <span class="inline-flex items-center gap-1 rounded-lg bg-[#E8F7FF] px-3 py-2 font-bold text-[#052659]">

                                        <i
                                            data-lucide="plus"
                                            class="h-3.5 w-3.5">
                                        </i>

                                        {{ number_format($stockIn->quantity ?? 0, 0, ',', '.') }}

                                    </span>

                                </td>


                                <td class="max-w-md px-5 py-4 leading-6 text-[#5483B3]">

                                    {{ $stockIn->description ?? '-' }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-5 py-12 text-center"
                                >

                                    <div class="text-[#7DA0CA]">

                                        Belum ada data barang masuk.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>



        {{-- =====================================================
            BARANG KELUAR
        ====================================================== --}}

        <div class="report-section mb-6 overflow-hidden rounded-2xl border border-red-100 bg-white shadow-sm">

            <div class="border-b border-red-100 bg-gradient-to-r from-red-50/30 to-white px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-50">

                        <i
                            data-lucide="arrow-up-right"
                            class="h-5 w-5 text-red-500">
                        </i>

                    </div>


                    <div>

                        <h2 class="font-bold text-[#021024]">

                            Riwayat Barang Keluar

                        </h2>


                        <p class="text-sm text-[#7DA0CA]">

                            Daftar transaksi barang keluar.

                        </p>

                    </div>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full text-left text-sm">

                    <thead class="bg-red-50/50">

                        <tr class="border-b border-red-100">

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                No
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                Tanggal
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                Produk
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                Jumlah
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                Tujuan
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-red-500">
                                Keterangan
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-red-50">

                        @forelse($stockOutsData as $stockOut)

                            <tr class="transition hover:bg-red-50/20">

                                <td class="px-5 py-4 text-[#7DA0CA]">

                                    {{ $loop->iteration }}

                                </td>


                                <td class="whitespace-nowrap px-5 py-4 text-[#5483B3]">

                                    {{ $stockOut->date
                                        ? \Carbon\Carbon::parse($stockOut->date)->format('d-m-Y')
                                        : '-'
                                    }}

                                </td>


                                <td class="px-5 py-4 font-semibold text-[#021024]">

                                    {{ $stockOut->product->name ?? '-' }}

                                </td>


                                <td class="px-5 py-4">

                                    <span class="inline-flex items-center gap-1 rounded-lg bg-red-50 px-3 py-2 font-bold text-red-600">

                                        <i
                                            data-lucide="minus"
                                            class="h-3.5 w-3.5">
                                        </i>

                                        {{ number_format($stockOut->quantity ?? 0, 0, ',', '.') }}

                                    </span>

                                </td>


                                <td class="px-5 py-4 text-[#5483B3]">

                                    {{ $stockOut->destination ?? '-' }}

                                </td>


                                <td class="max-w-md px-5 py-4 leading-6 text-[#5483B3]">

                                    {{ $stockOut->description ?? '-' }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-5 py-12 text-center"
                                >

                                    <div class="text-[#7DA0CA]">

                                        Belum ada data barang keluar.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>



        {{-- =====================================================
            FOOTER PRINT
        ====================================================== --}}

        <div class="hidden border-t border-slate-300 pt-4 text-sm text-black print:block">

            <div class="flex justify-between gap-4">

                <span>

                    Dicetak pada:
                    {{ now()->format('d-m-Y H:i') }}

                </span>


                <span>

                    Stockify Inventory System

                </span>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
    CUSTOM STYLE
========================================================= --}}

<style>

    /*
    |--------------------------------------------------------------------------
    | Card Animation
    |--------------------------------------------------------------------------
    */

    .report-stat-card,
    .report-card,
    .report-section,
    .report-warning-section {

        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            border-color 0.25s ease;

    }


    /*
    |--------------------------------------------------------------------------
    | Summary Card
    |--------------------------------------------------------------------------
    */

    .report-stat-card:hover {

        transform: translateY(-4px);

        box-shadow:
            0 14px 30px rgba(2, 16, 36, 0.08);

        border-color: #7DA0CA;

    }


    /*
    |--------------------------------------------------------------------------
    | Section
    |--------------------------------------------------------------------------
    */

    .report-section:hover {

        box-shadow:
            0 12px 28px rgba(2, 16, 36, 0.055);

    }


    /*
    |--------------------------------------------------------------------------
    | Warning
    |--------------------------------------------------------------------------
    */

    .report-warning-section:hover {

        border-color: #fca5a5;

        box-shadow:
            0 12px 28px rgba(239, 68, 68, 0.06);

    }


    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    .report-section table tbody tr,
    .report-warning-section table tbody tr {

        transition:
            background-color 0.2s ease;

    }


    /*
    |--------------------------------------------------------------------------
    | Mobile
    |--------------------------------------------------------------------------
    */

    @media (max-width: 767px) {

        .report-stat-card:hover {

            transform: none;

        }

        .report-section:hover,
        .report-warning-section:hover {

            box-shadow:
                0 8px 20px rgba(2, 16, 36, 0.04);

        }

    }


    /*
    |--------------------------------------------------------------------------
    | PRINT
    |--------------------------------------------------------------------------
    */

    @media print {

        @page {

            size: A4;

            margin: 10mm;

        }


        html,
        body {

            background: white !important;

            margin: 0 !important;

            padding: 0 !important;

        }


        body {

            min-height: auto !important;

        }


        /*
        | Hide application layout
        */

        nav,
        aside,
        header,
        footer,
        .sidebar,
        .navbar {

            display: none !important;

        }


        #report-page {

            width: 100% !important;

            min-height: auto !important;

            margin: 0 !important;

            padding: 0 !important;

            background: white !important;

        }


        #printable-report {

            width: 100% !important;

            display: block !important;

        }


        /*
        | Hide elements
        */

        .print\:hidden {

            display: none !important;

        }


        /*
        | Show print elements
        */

        .print\:block {

            display: block !important;

        }


        /*
        | Remove shadows
        */

        .shadow,
        .shadow-sm,
        .shadow-md,
        .shadow-lg {

            box-shadow: none !important;

        }


        /*
        | Remove rounded corners
        */

        .rounded-xl,
        .rounded-2xl,
        .rounded-3xl {

            border-radius: 0 !important;

        }


        /*
        | White background
        */

        .bg-white,
        .bg-red-50,
        .bg-red-50\/50,
        .bg-\[\#F8FCFF\] {

            background: white !important;

        }


        /*
        | Table
        */

        table {

            width: 100% !important;

            border-collapse: collapse !important;

            page-break-inside: auto;

        }


        thead {

            display: table-header-group !important;

        }


        tr {

            page-break-inside: avoid !important;

            page-break-after: auto !important;

        }


        th,
        td {

            border: 1px solid #999 !important;

            padding: 5px !important;

            color: black !important;

            font-size: 9px !important;

            vertical-align: top !important;

        }


        th {

            background: #e5e7eb !important;

            font-weight: bold !important;

        }


        /*
        | Text
        */

        h1,
        h2,
        h3,
        p,
        span {

            color: black;

        }


        /*
        | Overflow
        */

        .overflow-x-auto {

            overflow: visible !important;

        }


        /*
        | Spacing
        */

        .mb-6 {

            margin-bottom: 12px !important;

        }


        /*
        | Prevent card split
        */

        .report-stat-card {

            break-inside: avoid;

        }


        .report-section,
        .report-warning-section {

            break-inside: auto;

        }

    }

</style>



{{-- =========================================================
    LUCIDE
========================================================= --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {

            lucide.createIcons();

        }

    });

</script>

@endsection