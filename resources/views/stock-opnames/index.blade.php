@extends('layouts.app')

@section('title', 'Stock Opname')
@section('page-title', 'Stock Opname')

@section('content')

@php
    $totalTransactions = $stockOpnames->count();

    $positiveDifference = $stockOpnames
        ->where('difference', '>', 0)
        ->sum('difference');

    $negativeDifference = abs(
        $stockOpnames
            ->where('difference', '<', 0)
            ->sum('difference')
    );

    $pendingTransactions = $stockOpnames
        ->where('status', 'pending')
        ->count();

    $confirmedTransactions = $stockOpnames
        ->where('status', 'confirmed')
        ->count();

    $isAdmin = auth()->user()->role === 'admin';
    $isManager = auth()->user()->role === 'manager';
    $isStaff = auth()->user()->role === 'staff';
@endphp


<div class="min-h-screen bg-[#F5F9FC] px-4 py-6 sm:px-6 lg:px-8">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            {{-- Breadcrumb --}}
            <div class="mb-2 flex items-center gap-2 text-sm">

                <span class="flex items-center gap-1 text-[#5483B3]">
                    <i data-lucide="clipboard-check" class="h-4 w-4"></i>
                    Persediaan
                </span>

                <i data-lucide="chevron-right"
                   class="h-4 w-4 text-[#7DA0CA]"></i>

                <span class="text-[#052659]">
                    Stock Opname
                </span>

            </div>


            <h1 class="text-2xl font-bold tracking-tight text-[#021024] sm:text-3xl">
                Stock Opname
            </h1>


            <p class="mt-1 text-sm text-[#5483B3]">
                Pengecekan stok fisik dan penyesuaian stok barang.
            </p>

        </div>


        {{-- =====================================================
            TOMBOL TAMBAH
        ====================================================== --}}

        @if(in_array(auth()->user()->role, ['admin', 'manager', 'staff']))

            <a href="{{ route('stock-opnames.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#052659] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#021024] hover:shadow-md">

                <i data-lucide="clipboard-plus" class="h-5 w-5"></i>

                <span>
                    {{ $isStaff ? 'Periksa Stock Opname' : 'Tambah Stock Opname' }}
                </span>

            </a>

        @endif

    </div>


    {{-- =========================================================
        ALERT SUCCESS
    ========================================================== --}}

    @if (session('success'))

        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-[#C1E8FF] bg-[#E8F7FF] p-4 text-sm text-[#052659] shadow-sm">

            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#C1E8FF]">

                <i data-lucide="check-circle-2"
                   class="h-5 w-5 text-[#052659]">
                </i>

            </div>

            <div>

                <p class="font-semibold">
                    Berhasil
                </p>

                <p class="mt-0.5 text-[#5483B3]">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- =========================================================
        ALERT ERROR
    ========================================================== --}}

    @if ($errors->any())

        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">

            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100">

                <i data-lucide="circle-alert"
                   class="h-5 w-5 text-red-600">
                </i>

            </div>

            <div>

                <p class="font-semibold">
                    Terjadi kesalahan
                </p>

                <ul class="mt-1 space-y-1 text-xs">

                    @foreach ($errors->all() as $error)

                        <li>
                            • {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- =========================================================
        SUMMARY
    ========================================================== --}}

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">


        {{-- TOTAL --}}
        <div class="opname-card relative overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white p-5 shadow-sm">

            <div class="relative z-10 flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-[#5483B3]">
                        Total Opname
                    </p>

                    <p class="mt-2 text-3xl font-bold text-[#021024]">
                        {{ $totalTransactions }}
                    </p>

                    <p class="mt-1 text-xs text-[#7DA0CA]">
                        Seluruh data pemeriksaan
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                    <i data-lucide="clipboard-check"
                       class="h-6 w-6 text-[#5483B3]">
                    </i>

                </div>

            </div>

        </div>


        {{-- PENDING --}}
        <div class="opname-card relative overflow-hidden rounded-2xl border border-amber-100 bg-white p-5 shadow-sm">

            <div class="relative z-10 flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-amber-500">
                        Menunggu Pemeriksaan
                    </p>

                    <p class="mt-2 text-3xl font-bold text-amber-600">
                        {{ $pendingTransactions }}
                    </p>

                    <p class="mt-1 text-xs text-amber-400">
                        Belum dikonfirmasi
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50">

                    <i data-lucide="clock-3"
                       class="h-6 w-6 text-amber-500">
                    </i>

                </div>

            </div>

        </div>


        {{-- POSITIVE --}}
        <div class="opname-card relative overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white p-5 shadow-sm">

            <div class="relative z-10 flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-[#5483B3]">
                        Selisih Bertambah
                    </p>

                    <p class="mt-2 text-3xl font-bold text-[#052659]">
                        +{{ $positiveDifference }}
                    </p>

                    <p class="mt-1 text-xs text-[#7DA0CA]">
                        Stok fisik lebih banyak
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                    <i data-lucide="trending-up"
                       class="h-6 w-6 text-[#5483B3]">
                    </i>

                </div>

            </div>

        </div>


        {{-- NEGATIVE --}}
        <div class="opname-card relative overflow-hidden rounded-2xl border border-red-100 bg-white p-5 shadow-sm">

            <div class="relative z-10 flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-red-500">
                        Selisih Berkurang
                    </p>

                    <p class="mt-2 text-3xl font-bold text-red-600">
                        -{{ $negativeDifference }}
                    </p>

                    <p class="mt-1 text-xs text-red-400">
                        Stok fisik lebih sedikit
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50">

                    <i data-lucide="trending-down"
                       class="h-6 w-6 text-red-500">
                    </i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        TABLE
    ========================================================== --}}

    <div class="overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white shadow-sm">


        {{-- TABLE HEADER --}}
        <div class="flex flex-col gap-3 border-b border-[#E8F7FF] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#E8F7FF]">

                    <i data-lucide="clipboard-list"
                       class="h-5 w-5 text-[#5483B3]">
                    </i>

                </div>

                <div>

                    <h2 class="font-semibold text-[#021024]">
                        Riwayat Stock Opname
                    </h2>

                    <p class="text-xs text-[#7DA0CA]">
                        Daftar hasil pengecekan stok
                    </p>

                </div>

            </div>


            <div class="rounded-lg bg-[#F1FAFF] px-3 py-2 text-xs font-medium text-[#5483B3]">

                {{ $totalTransactions }} transaksi

            </div>

        </div>


        {{-- =====================================================
            DESKTOP
        ====================================================== --}}

        <div class="hidden overflow-x-auto md:block">

            <table class="w-full text-left text-sm">

                <thead class="bg-[#F8FCFF] text-xs uppercase tracking-wider text-[#5483B3]">

                    <tr>

                        <th class="px-5 py-4 font-semibold">
                            No
                        </th>

                        <th class="px-5 py-4 font-semibold">
                            Tanggal
                        </th>

                        <th class="px-5 py-4 font-semibold">
                            Produk
                        </th>

                        <th class="px-5 py-4 font-semibold">
                            Stok Sistem
                        </th>

                        <th class="px-5 py-4 font-semibold">
                            Stok Fisik
                        </th>

                        <th class="px-5 py-4 font-semibold">
                            Selisih
                        </th>

                        <th class="px-5 py-4 font-semibold">
                            Status
                        </th>

                        <th class="px-5 py-4 font-semibold">
                            Keterangan
                        </th>

                        <th class="px-5 py-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-[#E8F7FF]">

                    @forelse ($stockOpnames as $stockOpname)

                        <tr class="group transition hover:bg-[#F8FCFF]">


                            {{-- NO --}}
                            <td class="whitespace-nowrap px-5 py-4 text-[#7DA0CA]">

                                {{ $loop->iteration }}

                            </td>


                            {{-- TANGGAL --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="flex items-center gap-2">

                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#E8F7FF]">

                                        <i data-lucide="calendar-days"
                                           class="h-4 w-4 text-[#5483B3]">
                                        </i>

                                    </div>

                                    <span class="font-medium text-[#052659]">

                                        {{ $stockOpname->date->format('d-m-Y') }}

                                    </span>

                                </div>

                            </td>


                            {{-- PRODUK --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#5483B3] to-[#052659] text-sm font-bold text-white">

                                        {{ strtoupper(substr($stockOpname->product->name ?? '-', 0, 1)) }}

                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate font-semibold text-[#021024]">

                                            {{ $stockOpname->product->name ?? '-' }}

                                        </p>

                                        <p class="text-xs text-[#7DA0CA]">

                                            Pemeriksaan stok fisik

                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- STOK SISTEM --}}
                            <td class="px-5 py-4">

                                <span class="inline-flex min-w-[70px] justify-center rounded-lg bg-[#F1FAFF] px-3 py-2 font-semibold text-[#052659]">

                                    {{ $stockOpname->system_stock }}

                                </span>

                            </td>


                            {{-- STOK FISIK --}}
                            <td class="px-5 py-4">

                                <span class="inline-flex min-w-[70px] justify-center rounded-lg bg-[#E8F7FF] px-3 py-2 font-semibold text-[#5483B3]">

                                    {{ $stockOpname->physical_stock }}

                                </span>

                            </td>


                            {{-- SELISIH --}}
                            <td class="px-5 py-4">

                                @if($stockOpname->difference > 0)

                                    <span class="inline-flex items-center gap-1 rounded-lg bg-[#E8F7FF] px-3 py-2 font-semibold text-[#052659]">

                                        <i data-lucide="arrow-up"
                                           class="h-4 w-4"></i>

                                        +{{ $stockOpname->difference }}

                                    </span>

                                @elseif($stockOpname->difference < 0)

                                    <span class="inline-flex items-center gap-1 rounded-lg bg-red-50 px-3 py-2 font-semibold text-red-600">

                                        <i data-lucide="arrow-down"
                                           class="h-4 w-4"></i>

                                        {{ $stockOpname->difference }}

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-2 font-semibold text-slate-500">

                                        <i data-lucide="minus"
                                           class="h-4 w-4"></i>

                                        0

                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td class="px-5 py-4">

                                @if($stockOpname->status === 'pending')

                                    <div class="flex flex-col gap-1">

                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-600">

                                            <i data-lucide="clock-3"
                                               class="h-3.5 w-3.5"></i>

                                            Menunggu Pemeriksaan

                                        </span>

                                        @if($isStaff)

                                            <span class="text-[11px] text-amber-500">
                                                Perlu diperiksa
                                            </span>

                                        @endif

                                    </div>

                                @else

                                    <div class="flex flex-col gap-1">

                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-[#E8F7FF] px-3 py-2 text-xs font-semibold text-[#052659]">

                                            <i data-lucide="circle-check"
                                               class="h-3.5 w-3.5"></i>

                                            Sudah Dikonfirmasi

                                        </span>

                                        @if($stockOpname->confirmer)

                                            <span class="text-[11px] text-[#7DA0CA]">

                                                oleh {{ $stockOpname->confirmer->name }}

                                            </span>

                                        @endif

                                    </div>

                                @endif

                            </td>


                            {{-- KETERANGAN --}}
                            <td class="max-w-xs px-5 py-4">

                                <p class="truncate text-sm text-[#5483B3]"
                                   title="{{ $stockOpname->description ?? '-' }}">

                                    {{ $stockOpname->description ?? '-' }}

                                </p>

                            </td>


                            {{-- AKSI --}}
                            <td class="px-5 py-4">

                                <div class="flex justify-center gap-2">


                                    {{-- STAFF: PERIKSA / KONFIRMASI --}}
                                    @if($isStaff && $stockOpname->status === 'pending')

                                        <form action="{{ route('stock-opnames.confirm', $stockOpname->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hasil pengecekan stok fisik sudah sesuai?')">

                                            @csrf

                                            <button type="submit"
                                                    title="Konfirmasi Stock Opname"
                                                    class="flex h-9 items-center justify-center gap-1.5 rounded-lg bg-[#E8F7FF] px-3 text-xs font-semibold text-[#052659] transition hover:bg-[#052659] hover:text-white">

                                                <i data-lucide="check"
                                                   class="h-4 w-4"></i>

                                                Konfirmasi

                                            </button>

                                        </form>

                                    @endif


                                    {{-- ADMIN: HAPUS --}}
                                    @if($isAdmin)

                                        <form action="{{ route('stock-opnames.destroy', $stockOpname->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data stock opname ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Hapus"
                                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-500 transition hover:bg-red-500 hover:text-white">

                                                <i data-lucide="trash-2"
                                                   class="h-4 w-4"></i>

                                            </button>

                                        </form>

                                    @endif


                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="px-6 py-16 text-center">

                                <div class="mx-auto flex max-w-sm flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                                        <i data-lucide="clipboard-x"
                                           class="h-8 w-8 text-[#5483B3]">
                                        </i>

                                    </div>

                                    <h3 class="font-semibold text-[#021024]">
                                        Belum ada data Stock Opname
                                    </h3>

                                    <p class="mt-1 text-sm text-[#7DA0CA]">
                                        Data hasil pengecekan stok akan muncul di halaman ini.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
            MOBILE
        ====================================================== --}}

        <div class="space-y-3 p-4 md:hidden">

            @forelse ($stockOpnames as $stockOpname)

                <div class="rounded-2xl border border-[#C1E8FF] bg-white p-4 shadow-sm">


                    {{-- HEADER --}}
                    <div class="flex items-start justify-between gap-3">

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#5483B3] to-[#052659] text-sm font-bold text-white">

                                {{ strtoupper(substr($stockOpname->product->name ?? '-', 0, 1)) }}

                            </div>

                            <div class="min-w-0">

                                <p class="truncate font-semibold text-[#021024]">

                                    {{ $stockOpname->product->name ?? '-' }}

                                </p>

                                <div class="mt-1 flex items-center gap-1 text-xs text-[#7DA0CA]">

                                    <i data-lucide="calendar-days"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $stockOpname->date->format('d-m-Y') }}

                                </div>

                            </div>

                        </div>


                        {{-- ADMIN DELETE --}}
                        @if($isAdmin)

                            <form action="{{ route('stock-opnames.destroy', $stockOpname->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data stock opname ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white">

                                    <i data-lucide="trash-2"
                                       class="h-4 w-4"></i>

                                </button>

                            </form>

                        @endif

                    </div>


                    {{-- STOCK INFO --}}
                    <div class="mt-4 grid grid-cols-2 gap-3">

                        <div class="rounded-xl bg-[#F1FAFF] p-3">

                            <p class="text-xs text-[#7DA0CA]">
                                Stok Sistem
                            </p>

                            <p class="mt-1 text-lg font-bold text-[#052659]">
                                {{ $stockOpname->system_stock }}
                            </p>

                        </div>


                        <div class="rounded-xl bg-[#E8F7FF] p-3">

                            <p class="text-xs text-[#7DA0CA]">
                                Stok Fisik
                            </p>

                            <p class="mt-1 text-lg font-bold text-[#5483B3]">
                                {{ $stockOpname->physical_stock }}
                            </p>

                        </div>

                    </div>


                    {{-- SELISIH --}}
                    <div class="mt-3">

                        <p class="mb-1 text-xs text-[#7DA0CA]">
                            Selisih
                        </p>


                        @if($stockOpname->difference > 0)

                            <div class="flex items-center gap-2 rounded-xl bg-[#E8F7FF] px-3 py-2 font-semibold text-[#052659]">

                                <i data-lucide="arrow-up"
                                   class="h-4 w-4"></i>

                                +{{ $stockOpname->difference }}

                            </div>

                        @elseif($stockOpname->difference < 0)

                            <div class="flex items-center gap-2 rounded-xl bg-red-50 px-3 py-2 font-semibold text-red-600">

                                <i data-lucide="arrow-down"
                                   class="h-4 w-4"></i>

                                {{ $stockOpname->difference }}

                            </div>

                        @else

                            <div class="flex items-center gap-2 rounded-xl bg-slate-100 px-3 py-2 font-semibold text-slate-500">

                                <i data-lucide="minus"
                                   class="h-4 w-4"></i>

                                0

                            </div>

                        @endif

                    </div>


                    {{-- STATUS --}}
                    <div class="mt-3">

                        @if($stockOpname->status === 'pending')

                            <div class="rounded-xl bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-600">

                                <div class="flex items-center gap-2">

                                    <i data-lucide="clock-3"
                                       class="h-4 w-4"></i>

                                    Menunggu Pemeriksaan

                                </div>

                                @if($isStaff)

                                    <p class="mt-1 pl-6 text-[11px] font-normal text-amber-500">

                                        Silakan lakukan pengecekan.

                                    </p>

                                @endif

                            </div>

                        @else

                            <div class="rounded-xl bg-[#E8F7FF] px-3 py-2 text-xs font-semibold text-[#052659]">

                                <div class="flex items-center gap-2">

                                    <i data-lucide="circle-check"
                                       class="h-4 w-4"></i>

                                    Sudah Dikonfirmasi

                                </div>

                                @if($stockOpname->confirmer)

                                    <p class="mt-1 pl-6 text-[11px] font-normal text-[#7DA0CA]">

                                        oleh {{ $stockOpname->confirmer->name }}

                                    </p>

                                @endif

                            </div>

                        @endif

                    </div>


                    {{-- KETERANGAN --}}
                    <div class="mt-3 rounded-xl bg-[#F8FCFF] p-3">

                        <p class="mb-1 text-xs font-medium text-[#7DA0CA]">
                            Keterangan
                        </p>

                        <p class="text-sm text-[#5483B3]">

                            {{ $stockOpname->description ?? '-' }}

                        </p>

                    </div>


                    {{-- STAFF CONFIRM --}}
                    @if($isStaff && $stockOpname->status === 'pending')

                        <form action="{{ route('stock-opnames.confirm', $stockOpname->id) }}"
                              method="POST"
                              class="mt-3"
                              onsubmit="return confirm('Yakin hasil pengecekan stok fisik sudah sesuai?')">

                            @csrf

                            <button type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#052659] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#021024]">

                                <i data-lucide="check"
                                   class="h-4 w-4"></i>

                                Konfirmasi Stock Opname

                            </button>

                        </form>

                    @endif

                </div>

            @empty

                <div class="py-12 text-center">

                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                        <i data-lucide="clipboard-x"
                           class="h-8 w-8 text-[#5483B3]">
                        </i>

                    </div>

                    <h3 class="font-semibold text-[#021024]">
                        Belum ada data Stock Opname
                    </h3>

                    <p class="mt-1 text-sm text-[#7DA0CA]">
                        Data hasil pengecekan stok akan muncul di sini.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>


<style>

    .opname-card {
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            border-color 0.25s ease;
    }

    .opname-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(2, 16, 36, 0.08);
        border-color: #7DA0CA;
    }

    @media (max-width: 767px) {

        .opname-card:hover {
            transform: none;
        }

    }

</style>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            if (
                typeof lucide !== 'undefined'
            ) {

                lucide.createIcons();

            }

        }
    );

</script>

@endsection