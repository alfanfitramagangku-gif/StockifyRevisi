@extends('layouts.app')

@section('content')

<div class="space-y-7">

    {{-- =========================================================
         HEADER DASHBOARD
    ========================================================== --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#021024] via-[#052659] to-[#5483B3] p-6 shadow-xl md:p-8">

        {{-- Dekorasi --}}
        <div class="pointer-events-none absolute -right-20 -top-24 h-64 w-64 rounded-full bg-[#C1E8FF]/10 blur-2xl"></div>

        <div class="pointer-events-none absolute -bottom-32 right-40 h-72 w-72 rounded-full bg-[#7DA0CA]/10 blur-3xl"></div>


        <div class="relative z-10 flex flex-col justify-between gap-6 md:flex-row md:items-center">

            <div>

                <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-[#C1E8FF]/20 bg-white/10 px-3 py-1.5 backdrop-blur-sm">

                    <span class="h-2 w-2 rounded-full bg-[#C1E8FF] shadow-[0_0_10px_#C1E8FF]"></span>

                    <span class="text-xs font-medium text-[#C1E8FF]">
                        Dashboard Admin
                    </span>

                </div>


                <h1 class="text-2xl font-bold tracking-tight text-white md:text-3xl">
                    Selamat Datang, {{ auth()->user()->name }} 👋
                </h1>


                <p class="mt-2 max-w-xl text-sm leading-6 text-[#C1E8FF]/75">
                    Pantau dan kelola persediaan barang Stockify
                    dengan lebih mudah melalui dashboard admin.
                </p>

            </div>


            {{-- TANGGAL --}}
            <div class="flex flex-shrink-0 items-center gap-3 rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur-md">

                <div class="rounded-xl bg-[#C1E8FF]/15 p-3 text-[#C1E8FF]">

                    <i
                        data-lucide="calendar-days"
                        class="h-5 w-5">
                    </i>

                </div>


                <div>

                    <p class="text-xs text-[#C1E8FF]/60">
                        Hari ini
                    </p>

                    <p class="text-sm font-semibold text-white">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         STATISTIK UTAMA
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


        {{-- TOTAL PRODUK --}}
        <div class="dashboard-card group">

            <div class="flex items-start justify-between">

                <div>

                    <p class="dashboard-label">
                        Total Produk
                    </p>

                    <h3 class="dashboard-value">
                        {{ number_format($totalProducts ?? 0) }}
                    </h3>

                    <p class="dashboard-description">
                        Produk terdaftar
                    </p>

                </div>


                <div class="dashboard-icon bg-[#C1E8FF] text-[#052659]">

                    <i
                        data-lucide="package"
                        class="h-6 w-6 transition-transform duration-300 group-hover:scale-110">
                    </i>

                </div>

            </div>


            <div class="mt-5 flex items-center gap-2">

                <div class="flex items-center gap-1.5 rounded-lg bg-[#C1E8FF]/60 px-2.5 py-1 text-xs font-medium text-[#052659]">

                    <i data-lucide="boxes" class="h-3.5 w-3.5"></i>

                    Data inventaris

                </div>

            </div>

        </div>


        {{-- TOTAL KATEGORI --}}
        <div class="dashboard-card group">

            <div class="flex items-start justify-between">

                <div>

                    <p class="dashboard-label">
                        Total Kategori
                    </p>

                    <h3 class="dashboard-value">
                        {{ number_format($totalCategories ?? 0) }}
                    </h3>

                    <p class="dashboard-description">
                        Kategori produk
                    </p>

                </div>


                <div class="dashboard-icon bg-[#7DA0CA]/25 text-[#052659]">

                    <i
                        data-lucide="layers"
                        class="h-6 w-6 transition-transform duration-300 group-hover:scale-110">
                    </i>

                </div>

            </div>


            <div class="mt-5 flex items-center gap-2">

                <div class="flex items-center gap-1.5 rounded-lg bg-[#7DA0CA]/20 px-2.5 py-1 text-xs font-medium text-[#052659]">

                    <i data-lucide="folder" class="h-3.5 w-3.5"></i>

                    Pengelompokan produk

                </div>

            </div>

        </div>


        {{-- TOTAL STOK --}}
        <div class="dashboard-card group">

            <div class="flex items-start justify-between">

                <div>

                    <p class="dashboard-label">
                        Total Stok
                    </p>

                    <h3 class="dashboard-value text-[#052659]">
                        {{ number_format($totalStock ?? 0) }}
                    </h3>

                    <p class="dashboard-description">
                        Unit barang tersedia
                    </p>

                </div>


                <div class="dashboard-icon bg-[#5483B3]/15 text-[#052659]">

                    <i
                        data-lucide="warehouse"
                        class="h-6 w-6 transition-transform duration-300 group-hover:scale-110">
                    </i>

                </div>

            </div>


            <div class="mt-5 flex items-center gap-2">

                <div class="flex items-center gap-1.5 rounded-lg bg-[#5483B3]/10 px-2.5 py-1 text-xs font-medium text-[#052659]">

                    <i data-lucide="check-circle" class="h-3.5 w-3.5"></i>

                    Persediaan saat ini

                </div>

            </div>

        </div>


        {{-- STOK MENIPIS --}}
        <div class="dashboard-card stock-warning-card group">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-[13px] font-semibold text-red-500">
                        Stok Menipis
                    </p>

                    <h3 class="mt-2 text-[32px] font-extrabold leading-none tracking-tight text-red-600">
                        {{ number_format($lowStockCount ?? 0) }}
                    </h3>

                    <p class="mt-2 text-xs text-red-400">
                        Produk perlu diperiksa
                    </p>

                </div>


                <div class="dashboard-icon bg-red-50 text-red-500">

                    <i
                        data-lucide="alert-triangle"
                        class="h-6 w-6 transition-transform duration-300 group-hover:scale-110">
                    </i>

                </div>

            </div>


            <div class="mt-5 flex items-center gap-2">

                <div class="flex items-center gap-1.5 rounded-lg bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-600">

                    <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-red-500"></span>

                    <i data-lucide="alert-circle" class="h-3.5 w-3.5"></i>

                    Perlu perhatian

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTER + JUMLAH TRANSAKSI PERIODE
    ========================================================== --}}
    <div class="overflow-hidden rounded-3xl border border-[#7DA0CA]/25 bg-white shadow-sm">

        {{-- HEADER --}}
        <div class="border-b border-[#7DA0CA]/15 px-5 py-5 md:px-6">

            <div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-center">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#C1E8FF] text-[#052659]">

                            <i
                                data-lucide="arrow-left-right"
                                class="h-5 w-5">
                            </i>

                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-[#021024]">
                                Transaksi Persediaan
                            </h2>

                            <p class="mt-0.5 text-sm text-[#5483B3]">
                                Jumlah transaksi berdasarkan periode
                            </p>

                        </div>

                    </div>

                </div>


                {{-- LABEL PERIODE --}}
                <div class="rounded-xl bg-[#F1FAFF] px-4 py-2 text-sm font-semibold text-[#052659]">

                    {{ \Carbon\Carbon::parse($startDateInput)->translatedFormat('d M Y') }}

                    <span class="mx-1 text-[#7DA0CA]">s/d</span>

                    {{ \Carbon\Carbon::parse($endDateInput)->translatedFormat('d M Y') }}

                </div>

            </div>

        </div>


        {{-- FILTER --}}
        <div class="border-b border-[#7DA0CA]/15 bg-[#F8FBFD] px-5 py-5 md:px-6">

            <form
                action="{{ route('dashboard') }}"
                method="GET"
                class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5 lg:items-end"
            >

                {{-- TANGGAL MULAI --}}
                <div>

                    <label
                        for="start_date"
                        class="mb-2 block text-xs font-semibold text-[#052659]"
                    >
                        Tanggal Mulai
                    </label>

                    <div class="relative">

                        <i
                            data-lucide="calendar"
                            class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]"
                        ></i>

                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            value="{{ $startDateInput }}"
                            class="h-11 w-full rounded-xl border border-[#7DA0CA]/30 bg-white pl-10 pr-3 text-sm text-[#021024] outline-none transition focus:border-[#5483B3] focus:ring-2 focus:ring-[#C1E8FF]"
                        >

                    </div>

                </div>


                {{-- TANGGAL AKHIR --}}
                <div>

                    <label
                        for="end_date"
                        class="mb-2 block text-xs font-semibold text-[#052659]"
                    >
                        Tanggal Akhir
                    </label>

                    <div class="relative">

                        <i
                            data-lucide="calendar-check"
                            class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]"
                        ></i>

                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            value="{{ $endDateInput }}"
                            class="h-11 w-full rounded-xl border border-[#7DA0CA]/30 bg-white pl-10 pr-3 text-sm text-[#021024] outline-none transition focus:border-[#5483B3] focus:ring-2 focus:ring-[#C1E8FF]"
                        >

                    </div>

                </div>


                {{-- PRESET --}}
                <div>

                    <label
                        for="periodPreset"
                        class="mb-2 block text-xs font-semibold text-[#052659]"
                    >
                        Pilih Periode
                    </label>

                    <select
                        id="periodPreset"
                        class="h-11 w-full rounded-xl border border-[#7DA0CA]/30 bg-white px-3 text-sm text-[#021024] outline-none transition focus:border-[#5483B3] focus:ring-2 focus:ring-[#C1E8FF]"
                    >

                        <option value="">
                            Custom
                        </option>

                        <option value="7">
                            7 Hari Terakhir
                        </option>

                        <option value="30">
                            30 Hari Terakhir
                        </option>

                        <option value="month">
                            Bulan Ini
                        </option>

                    </select>

                </div>


                {{-- BUTTON TERAPKAN --}}
                <div>

                    <button
                        type="submit"
                        class="flex h-11 w-full items-center justify-center gap-2 rounded-xl bg-[#052659] px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-[#021024]"
                    >

                        <i
                            data-lucide="filter"
                            class="h-4 w-4">
                        </i>

                        Terapkan

                    </button>

                </div>


                {{-- RESET --}}
                <div>

                    <a
                        href="{{ route('dashboard') }}"
                        class="flex h-11 w-full items-center justify-center gap-2 rounded-xl border border-[#7DA0CA]/30 bg-white px-4 text-sm font-semibold text-[#052659] transition hover:bg-[#F1FAFF]"
                    >

                        <i
                            data-lucide="rotate-ccw"
                            class="h-4 w-4">
                        </i>

                        Reset

                    </a>

                </div>

            </form>

        </div>


        {{-- HASIL TRANSAKSI --}}
        <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2 lg:grid-cols-4 md:p-6">

            {{-- TRANSAKSI MASUK --}}
            <div class="rounded-2xl border border-[#7DA0CA]/20 bg-[#F8FBFD] p-4">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold text-[#5483B3]">
                            Transaksi Masuk
                        </p>

                        <h3 class="mt-2 text-3xl font-extrabold text-[#052659]">
                            {{ number_format($periodStockInTransactions ?? 0) }}
                        </h3>

                        <p class="mt-1 text-xs text-[#7DA0CA]">
                            Transaksi
                        </p>

                    </div>


                    <div class="rounded-xl bg-[#C1E8FF] p-3 text-[#052659]">

                        <i
                            data-lucide="arrow-down-left"
                            class="h-5 w-5">
                        </i>

                    </div>

                </div>

            </div>


            {{-- TRANSAKSI KELUAR --}}
            <div class="rounded-2xl border border-red-100 bg-red-50/40 p-4">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold text-red-500">
                            Transaksi Keluar
                        </p>

                        <h3 class="mt-2 text-3xl font-extrabold text-red-600">
                            {{ number_format($periodStockOutTransactions ?? 0) }}
                        </h3>

                        <p class="mt-1 text-xs text-red-400">
                            Transaksi
                        </p>

                    </div>


                    <div class="rounded-xl bg-red-100 p-3 text-red-500">

                        <i
                            data-lucide="arrow-up-right"
                            class="h-5 w-5">
                        </i>

                    </div>

                </div>

            </div>


            {{-- TOTAL UNIT MASUK --}}
            <div class="rounded-2xl border border-[#7DA0CA]/20 bg-[#F8FBFD] p-4">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold text-[#5483B3]">
                            Unit Barang Masuk
                        </p>

                        <h3 class="mt-2 text-3xl font-extrabold text-[#052659]">
                            {{ number_format($periodStockInQuantity ?? 0) }}
                        </h3>

                        <p class="mt-1 text-xs text-[#7DA0CA]">
                            Total unit
                        </p>

                    </div>


                    <div class="rounded-xl bg-[#C1E8FF] p-3 text-[#052659]">

                        <i
                            data-lucide="package-plus"
                            class="h-5 w-5">
                        </i>

                    </div>

                </div>

            </div>


            {{-- TOTAL UNIT KELUAR --}}
            <div class="rounded-2xl border border-red-100 bg-red-50/40 p-4">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold text-red-500">
                            Unit Barang Keluar
                        </p>

                        <h3 class="mt-2 text-3xl font-extrabold text-red-600">
                            {{ number_format($periodStockOutQuantity ?? 0) }}
                        </h3>

                        <p class="mt-1 text-xs text-red-400">
                            Total unit
                        </p>

                    </div>


                    <div class="rounded-xl bg-red-100 p-3 text-red-500">

                        <i
                            data-lucide="package-minus"
                            class="h-5 w-5">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         GRAFIK + STOK MENIPIS
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- GRAFIK --}}
        <div class="rounded-3xl border border-[#7DA0CA]/25 bg-white p-5 shadow-sm md:p-6 xl:col-span-2">

            <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="h-2 w-2 rounded-full bg-[#5483B3]"></div>

                        <h2 class="text-lg font-bold text-[#021024]">
                            Statistik Persediaan
                        </h2>

                    </div>

                    <p class="mt-1 text-sm text-[#5483B3]">
                        Jumlah stok berdasarkan produk
                    </p>

                </div>


                <div class="flex items-center gap-2 rounded-xl border border-[#7DA0CA]/20 bg-[#C1E8FF]/40 px-3 py-2 text-xs font-semibold text-[#052659]">

                    <i data-lucide="bar-chart-3" class="h-4 w-4"></i>

                    Grafik Stok

                </div>

            </div>


            <div class="relative h-80">

                <canvas id="stockChart"></canvas>

            </div>

        </div>


        {{-- STOK MENIPIS --}}
        <div class="stock-list-card rounded-3xl border border-red-100 bg-white p-5 shadow-sm md:p-6">

            <div class="mb-5 flex items-start justify-between">

                <div>

                    <h2 class="text-lg font-bold text-[#021024]">
                        Stok Menipis
                    </h2>

                    <p class="mt-1 text-sm text-red-400">
                        Produk yang perlu diperhatikan
                    </p>

                </div>


                <div class="rounded-xl bg-red-50 p-2.5 text-red-500">

                    <i
                        data-lucide="alert-triangle"
                        class="h-5 w-5">
                    </i>

                </div>

            </div>


            <div class="space-y-3">

                @forelse($lowStockProducts ?? [] as $product)

                    <div
                        class="group flex items-center gap-3 rounded-2xl border border-red-100 bg-red-50/50 p-3 transition-all duration-200 hover:border-red-200 hover:bg-red-50">

                        <div
                            class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-500">

                            <i
                                data-lucide="package"
                                class="h-5 w-5 transition-transform group-hover:scale-110">
                            </i>

                        </div>


                        <div class="min-w-0 flex-1">

                            <p class="truncate text-sm font-semibold text-[#021024]">
                                {{ $product->name }}
                            </p>

                            <p class="text-xs text-red-400">
                                SKU: {{ $product->sku }}
                            </p>

                        </div>


                        <div class="text-right">

                            <p class="text-sm font-bold text-red-600">
                                {{ $product->stock }}
                            </p>

                            <p class="text-[10px] font-medium uppercase tracking-wide text-red-400">
                                Unit
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="rounded-2xl bg-[#C1E8FF]/30 py-10 text-center">

                        <i
                            data-lucide="check-circle"
                            class="mx-auto mb-3 h-10 w-10 text-[#5483B3]">
                        </i>

                        <p class="text-sm font-semibold text-[#052659]">
                            Semua stok aman
                        </p>

                        <p class="mt-1 text-xs text-[#7DA0CA]">
                            Tidak ada stok yang menipis.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- =========================================================
         AKTIVITAS TERBARU
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">


        {{-- STOK MASUK --}}
        <div class="rounded-3xl border border-[#7DA0CA]/25 bg-white p-5 shadow-sm md:p-6">

            <div class="mb-5 flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-[#021024]">
                        Stok Masuk Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-[#5483B3]">
                        Riwayat penambahan persediaan
                    </p>

                </div>


                <div class="rounded-xl bg-[#C1E8FF] p-2.5 text-[#052659]">

                    <i
                        data-lucide="arrow-down-left"
                        class="h-5 w-5">
                    </i>

                </div>

            </div>


            <div class="space-y-3">

                @forelse($latestStockIns ?? [] as $stockIn)

                    <div
                        class="flex items-center gap-3 rounded-2xl border border-[#7DA0CA]/15 bg-[#F8FBFD] p-3 transition-all duration-200 hover:border-[#7DA0CA]/35 hover:bg-[#C1E8FF]/25">

                        <div
                            class="rounded-xl bg-[#C1E8FF] p-3 text-[#052659]">

                            <i
                                data-lucide="plus"
                                class="h-5 w-5">
                            </i>

                        </div>


                        <div class="min-w-0 flex-1">

                            <p class="truncate text-sm font-semibold text-[#021024]">
                                {{ $stockIn->product->name ?? 'Produk dihapus' }}
                            </p>

                            <p class="text-xs text-[#7DA0CA]">
                                {{ $stockIn->date }}
                            </p>

                        </div>


                        <span
                            class="rounded-lg bg-[#C1E8FF] px-3 py-1 text-sm font-bold text-[#052659]">

                            +{{ $stockIn->quantity }}

                        </span>

                    </div>

                @empty

                    <div class="rounded-2xl bg-[#F8FBFD] py-8 text-center">

                        <p class="text-sm text-[#7DA0CA]">
                            Belum ada data stok masuk.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- STOK KELUAR --}}
        <div class="rounded-3xl border border-red-100 bg-white p-5 shadow-sm md:p-6">

            <div class="mb-5 flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-[#021024]">
                        Stok Keluar Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-red-400">
                        Riwayat pengurangan persediaan
                    </p>

                </div>


                <div class="rounded-xl bg-red-50 p-2.5 text-red-500">

                    <i
                        data-lucide="arrow-up-right"
                        class="h-5 w-5">
                    </i>

                </div>

            </div>


            <div class="space-y-3">

                @forelse($latestStockOuts ?? [] as $stockOut)

                    <div
                        class="flex items-center gap-3 rounded-2xl border border-red-100 bg-red-50/40 p-3 transition-all duration-200 hover:border-red-200 hover:bg-red-50">

                        <div
                            class="rounded-xl bg-red-100 p-3 text-red-500">

                            <i
                                data-lucide="minus"
                                class="h-5 w-5">
                            </i>

                        </div>


                        <div class="min-w-0 flex-1">

                            <p class="truncate text-sm font-semibold text-[#021024]">
                                {{ $stockOut->product->name ?? 'Produk dihapus' }}
                            </p>

                            <p class="text-xs text-red-400">
                                {{ $stockOut->date }}
                            </p>

                        </div>


                        <span
                            class="rounded-lg bg-red-100 px-3 py-1 text-sm font-bold text-red-600">

                            -{{ $stockOut->quantity }}

                        </span>

                    </div>

                @empty

                    <div class="rounded-2xl bg-[#F8FBFD] py-8 text-center">

                        <p class="text-sm text-[#7DA0CA]">
                            Belum ada data stok keluar.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     CHART.JS
========================================================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | CHART STOK
    |--------------------------------------------------------------------------
    */

    const chartElement =
        document.getElementById('stockChart');

    if (chartElement) {

        const labels =
            @json($stockChartLabels ?? []);

        const data =
            @json($stockChartData ?? []);


        new Chart(chartElement, {

            type: 'bar',

            data: {

                labels: labels,

                datasets: [{

                    label: 'Jumlah Stok',

                    data: data,

                    backgroundColor: '#5483B3',

                    hoverBackgroundColor: '#052659',

                    borderColor: '#052659',

                    borderWidth: 1,

                    borderRadius: 10,

                    borderSkipped: false,

                    barPercentage: 0.65,

                    categoryPercentage: 0.75

                }]

            },


            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {

                    intersect: false,

                    mode: 'index'

                },


                plugins: {

                    legend: {

                        display: false

                    },


                    tooltip: {

                        backgroundColor: '#021024',

                        titleColor: '#C1E8FF',

                        bodyColor: '#ffffff',

                        padding: 12,

                        cornerRadius: 10,

                        displayColors: false

                    }

                },


                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            precision: 0,

                            color: '#5483B3',

                            font: {
                                size: 11
                            }

                        },

                        grid: {

                            color: 'rgba(125, 160, 202, 0.16)',

                            drawBorder: false

                        }

                    },


                    x: {

                        ticks: {

                            color: '#5483B3',

                            font: {
                                size: 11
                            },

                            maxRotation: 45,

                            minRotation: 0

                        },

                        grid: {

                            display: false

                        }

                    }

                }

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | PRESET PERIODE
    |--------------------------------------------------------------------------
    */

    const periodPreset =
        document.getElementById('periodPreset');

    const startDate =
        document.getElementById('start_date');

    const endDate =
        document.getElementById('end_date');


    if (
        periodPreset &&
        startDate &&
        endDate
    ) {

        periodPreset.addEventListener('change', function () {

            const value = this.value;

            const today =
                new Date();

            let start =
                new Date();


            /*
            | 7 HARI
            */

            if (value === '7') {

                start.setDate(
                    today.getDate() - 6
                );

            }


            /*
            | 30 HARI
            */

            else if (value === '30') {

                start.setDate(
                    today.getDate() - 29
                );

            }


            /*
            | BULAN INI
            */

            else if (value === 'month') {

                start =
                    new Date(
                        today.getFullYear(),
                        today.getMonth(),
                        1
                    );

            }


            /*
            | CUSTOM
            */

            else {

                return;

            }


            /*
            | FORMAT YYYY-MM-DD
            */

            const formatDate = function (date) {

                const year =
                    date.getFullYear();

                const month =
                    String(
                        date.getMonth() + 1
                    ).padStart(2, '0');

                const day =
                    String(
                        date.getDate()
                    ).padStart(2, '0');

                return `${year}-${month}-${day}`;

            };


            startDate.value =
                formatDate(start);

            endDate.value =
                formatDate(today);

        });

    }

});

</script>


{{-- =========================================================
     DASHBOARD STYLE
========================================================= --}}
<style>

.dashboard-card {

    position: relative;

    overflow: hidden;

    border-radius: 24px;

    border: 1px solid rgba(125, 160, 202, 0.22);

    background: #ffffff;

    padding: 24px;

    box-shadow:
        0 4px 18px rgba(2, 16, 36, 0.035);

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        border-color 0.25s ease;
}


.dashboard-card::after {

    content: "";

    position: absolute;

    right: -45px;

    top: -45px;

    width: 120px;

    height: 120px;

    border-radius: 999px;

    background:
        rgba(193, 232, 255, 0.20);

    pointer-events: none;
}


.dashboard-card:hover {

    transform: translateY(-5px);

    border-color:
        rgba(84, 131, 179, 0.35);

    box-shadow:
        0 16px 35px rgba(2, 16, 36, 0.09);
}


.dashboard-label {

    font-size: 13px;

    font-weight: 600;

    color: #5483B3;
}


.dashboard-value {

    margin-top: 8px;

    font-size: 32px;

    font-weight: 800;

    line-height: 1;

    letter-spacing: -1px;

    color: #021024;
}


.dashboard-description {

    margin-top: 7px;

    font-size: 12px;

    color: #7DA0CA;
}


.dashboard-icon {

    position: relative;

    z-index: 1;

    display: flex;

    height: 54px;

    width: 54px;

    align-items: center;

    justify-content: center;

    border-radius: 18px;

    box-shadow:
        0 8px 18px rgba(2, 16, 36, 0.06);
}


/* =========================================================
   STOK MENIPIS - WARNING MERAH
========================================================= */

.stock-warning-card {

    border-color: rgba(239, 68, 68, 0.18);

    background:
        linear-gradient(
            145deg,
            #ffffff 0%,
            #fffafa 100%
        );
}


.stock-warning-card::after {

    background:
        rgba(254, 226, 226, 0.40);
}


.stock-warning-card:hover {

    border-color: rgba(239, 68, 68, 0.35);

    box-shadow:
        0 16px 35px rgba(239, 68, 68, 0.08);
}


/* =========================================================
   STOK MENIPIS LIST
========================================================= */

.stock-list-card {

    border-color: rgba(239, 68, 68, 0.15);
}


.stock-list-card:hover {

    border-color: rgba(239, 68, 68, 0.20);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 640px) {

    .dashboard-card {

        border-radius: 20px;

        padding: 18px;
    }

}

</style>

@endsection