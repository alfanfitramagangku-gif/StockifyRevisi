@extends('layouts.app')

@section('title', 'Stok Keluar')

@section('page-title', 'Stok Keluar')

@section('content')

@php
    $totalTransactions = $stockOuts->count();
    $totalQuantity = $stockOuts->sum('quantity');

    $pendingTransactions = $stockOuts
        ->where('status', 'pending')
        ->count();

    $confirmedTransactions = $stockOuts
        ->where('status', 'confirmed')
        ->count();

    $isAdmin = auth()->user()->role === 'admin';
    $isManager = auth()->user()->role === 'manager';
    $isStaff = auth()->user()->role === 'staff';
@endphp

<div class="min-h-screen bg-[#F5F9FC]">

    <div class="space-y-6">

        {{-- =========================================================
             HEADER
        ========================================================== --}}
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>

                {{-- BREADCRUMB --}}
                <div class="mb-3 flex items-center gap-2 text-sm">

                    <div
                        class="flex h-8 w-8 items-center justify-center
                               rounded-lg bg-red-50 text-red-600"
                    >
                        <i
                            data-lucide="package-minus"
                            class="h-4 w-4"
                        ></i>
                    </div>

                    <span class="font-semibold text-[#5483B3]">
                        Manajemen Inventaris
                    </span>

                    <i
                        data-lucide="chevron-right"
                        class="h-4 w-4 text-[#7DA0CA]"
                    ></i>

                    <span class="font-semibold text-[#052659]">
                        Stok Keluar
                    </span>

                </div>


                {{-- JUDUL --}}
                <h1
                    class="text-3xl font-bold tracking-tight
                           text-[#021024] md:text-4xl"
                >
                    Stok Keluar
                </h1>


                {{-- DESKRIPSI --}}
                @if($isStaff)

                    <p class="mt-2 text-sm font-medium text-[#5483B3]">
                        Periksa dan konfirmasi barang yang perlu disiapkan untuk keluar dari gudang.
                    </p>

                @else

                    <p class="mt-2 text-sm font-medium text-[#5483B3]">
                        Kelola pencatatan barang yang keluar dari gudang.
                    </p>

                @endif

            </div>


            {{-- =====================================================
                 TOMBOL TAMBAH
                 ADMIN + MANAGER
            ====================================================== --}}
            @if($isAdmin || $isManager)

                <a
                    href="{{ route('stock-outs.create') }}"
                    class="inline-flex items-center justify-center
                           gap-2 rounded-xl
                           bg-gradient-to-r from-[#021024] to-[#052659]
                           px-5 py-3 text-sm font-bold text-white
                           shadow-lg shadow-[#021024]/20
                           transition duration-200
                           hover:-translate-y-0.5
                           hover:from-[#052659]
                           hover:to-[#5483B3]
                           hover:shadow-xl"
                >
                    <i
                        data-lucide="plus"
                        class="h-5 w-5"
                    ></i>

                    Tambah Stok Keluar
                </a>

            @endif

        </div>


        {{-- =========================================================
             SUCCESS
        ========================================================== --}}
        @if (session('success'))

            <div
                class="flex items-start gap-3 rounded-2xl
                       border border-[#C1E8FF]
                       bg-[#E8F7FF]
                       px-4 py-4
                       text-sm text-[#052659]"
            >

                <div
                    class="flex h-9 w-9 shrink-0 items-center
                           justify-center rounded-xl bg-[#C1E8FF]"
                >
                    <i
                        data-lucide="check-circle"
                        class="h-5 w-5 text-[#052659]"
                    ></i>
                </div>

                <div class="pt-0.5">

                    <p class="font-bold text-[#052659]">
                        Berhasil
                    </p>

                    <p class="mt-1 text-sm font-medium text-[#5483B3]">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- =========================================================
             ERROR
        ========================================================== --}}
        @if (session('error'))

            <div
                class="flex items-start gap-3 rounded-2xl
                       border border-red-200
                       bg-red-50
                       px-4 py-4
                       text-sm text-red-700"
            >

                <div
                    class="flex h-9 w-9 shrink-0 items-center
                           justify-center rounded-xl bg-red-100"
                >
                    <i
                        data-lucide="alert-circle"
                        class="h-5 w-5 text-red-600"
                    ></i>
                </div>

                <div class="pt-0.5">

                    <p class="font-bold text-red-700">
                        Terjadi Kesalahan
                    </p>

                    <p class="mt-1 text-sm font-medium text-red-600">
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- =========================================================
             ERROR VALIDASI
        ========================================================== --}}
        @if ($errors->any())

            <div
                class="rounded-2xl border border-red-200
                       bg-red-50 px-4 py-4"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-9 w-9 shrink-0 items-center
                               justify-center rounded-xl bg-red-100"
                    >
                        <i
                            data-lucide="alert-circle"
                            class="h-5 w-5 text-red-600"
                        ></i>
                    </div>

                    <div>

                        <p class="font-bold text-red-700">
                            Data belum dapat diproses
                        </p>

                        <ul class="mt-1 list-disc pl-5 text-sm text-red-600">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
             RINGKASAN
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- TOTAL TRANSAKSI --}}
            <div
                class="group rounded-3xl border border-[#D9E4EE]
                       bg-white p-5 shadow-sm
                       transition duration-300
                       hover:-translate-y-1 hover:shadow-lg"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-[#5483B3]">
                            Total Transaksi
                        </p>

                        <h3
                            class="mt-2 text-3xl font-bold
                                   tracking-tight text-[#021024]"
                        >
                            {{ $totalTransactions }}
                        </h3>

                        <p class="mt-1 text-xs font-medium text-[#7DA0CA]">
                            Seluruh data stok keluar
                        </p>

                    </div>

                    <div
                        class="flex h-12 w-12 items-center justify-center
                               rounded-2xl bg-[#E8F7FF]
                               text-[#052659]
                               transition duration-300
                               group-hover:scale-110"
                    >
                        <i
                            data-lucide="clipboard-list"
                            class="h-6 w-6"
                        ></i>
                    </div>

                </div>

            </div>


            {{-- TOTAL BARANG --}}
            <div
                class="group rounded-3xl border border-[#D9E4EE]
                       bg-white p-5 shadow-sm
                       transition duration-300
                       hover:-translate-y-1 hover:shadow-lg"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-[#5483B3]">
                            Total Barang Keluar
                        </p>

                        <h3
                            class="mt-2 text-3xl font-bold
                                   tracking-tight text-red-600"
                        >
                            {{ $totalQuantity }}
                        </h3>

                        <p class="mt-1 text-xs font-medium text-[#7DA0CA]">
                            Total unit tercatat
                        </p>

                    </div>

                    <div
                        class="flex h-12 w-12 items-center justify-center
                               rounded-2xl bg-red-50
                               text-red-600
                               transition duration-300
                               group-hover:scale-110"
                    >
                        <i
                            data-lucide="package-minus"
                            class="h-6 w-6"
                        ></i>
                    </div>

                </div>

            </div>


            {{-- MENUNGGU --}}
            <div
                class="group rounded-3xl border border-amber-200
                       bg-white p-5 shadow-sm
                       transition duration-300
                       hover:-translate-y-1 hover:shadow-lg"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-amber-600">
                            Menunggu Persiapan
                        </p>

                        <h3
                            class="mt-2 text-3xl font-bold
                                   tracking-tight text-amber-600"
                        >
                            {{ $pendingTransactions }}
                        </h3>

                        <p class="mt-1 text-xs font-medium text-amber-400">
                            Perlu dikonfirmasi Staff
                        </p>

                    </div>

                    <div
                        class="flex h-12 w-12 items-center justify-center
                               rounded-2xl bg-amber-50
                               text-amber-600
                               transition duration-300
                               group-hover:scale-110"
                    >
                        <i
                            data-lucide="clock-3"
                            class="h-6 w-6"
                        ></i>
                    </div>

                </div>

            </div>


            {{-- SUDAH DIKONFIRMASI --}}
            <div
                class="group rounded-3xl border border-red-100
                       bg-white p-5 shadow-sm
                       transition duration-300
                       hover:-translate-y-1 hover:shadow-lg"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-red-500">
                            Sudah Disiapkan
                        </p>

                        <h3
                            class="mt-2 text-3xl font-bold
                                   tracking-tight text-red-600"
                        >
                            {{ $confirmedTransactions }}
                        </h3>

                        <p class="mt-1 text-xs font-medium text-red-400">
                            Transaksi sudah dikonfirmasi
                        </p>

                    </div>

                    <div
                        class="flex h-12 w-12 items-center justify-center
                               rounded-2xl bg-red-50
                               text-red-600
                               transition duration-300
                               group-hover:scale-110"
                    >
                        <i
                            data-lucide="badge-check"
                            class="h-6 w-6"
                        ></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             DAFTAR STOK KELUAR
        ========================================================== --}}
        <div
            class="overflow-hidden rounded-3xl
                   border border-[#D9E4EE]
                   bg-white shadow-sm"
        >

            {{-- HEADER --}}
            <div
                class="border-b border-[#D9E4EE]
                       px-5 py-5 md:px-6"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center
                               rounded-xl bg-red-50 text-red-600"
                    >
                        <i
                            data-lucide="clipboard-list"
                            class="h-5 w-5"
                        ></i>
                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-[#021024]">
                            Riwayat Stok Keluar
                        </h2>

                        <p class="mt-1 text-sm font-medium text-[#64748B]">
                            Daftar pencatatan barang yang keluar dari gudang.
                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 DESKTOP
            ====================================================== --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="min-w-full text-left text-sm">

                    <thead class="bg-[#F5F9FC]">

                        <tr class="border-b border-[#D9E4EE]">

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#475569]">
                                No
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#475569]">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#475569]">
                                Produk
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-[#475569]">
                                Jumlah
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#475569]">
                                Tujuan
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#475569]">
                                Status
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#475569]">
                                Keterangan
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-[#475569]">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#EDF2F7]">

                        @forelse ($stockOuts as $stockOut)

                            <tr class="group transition duration-200 hover:bg-[#F8FBFE]">

                                {{-- NO --}}
                                <td class="whitespace-nowrap px-6 py-5 text-sm font-semibold text-[#64748B]">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- TANGGAL --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="flex h-9 w-9 items-center justify-center
                                                   rounded-lg bg-[#E8F7FF]
                                                   text-[#052659]"
                                        >
                                            <i
                                                data-lucide="calendar"
                                                class="h-4 w-4"
                                            ></i>
                                        </div>

                                        <span class="font-semibold text-[#334155]">
                                            {{ $stockOut->date->format('d-m-Y') }}
                                        </span>

                                    </div>

                                </td>


                                {{-- PRODUK --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0
                                                   items-center justify-center
                                                   rounded-xl
                                                   bg-gradient-to-br
                                                   from-[#021024]
                                                   to-[#5483B3]
                                                   font-bold uppercase
                                                   text-[#C1E8FF]"
                                        >
                                            {{ strtoupper(substr($stockOut->product->name ?? 'P', 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">

                                            <p class="font-bold text-[#021024]">
                                                {{ $stockOut->product->name ?? '-' }}
                                            </p>

                                            @if($stockOut->product)

                                                <p class="mt-1 text-xs font-medium text-[#7DA0CA]">
                                                    SKU: {{ $stockOut->product->sku }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- JUMLAH --}}
                                <td class="px-6 py-5 text-center">

                                    <span
                                        class="inline-flex items-center
                                               rounded-full
                                               border border-red-200
                                               bg-red-50
                                               px-3 py-1.5
                                               text-sm font-bold text-red-700"
                                    >
                                        -{{ $stockOut->quantity }}
                                    </span>

                                </td>


                                {{-- TUJUAN --}}
                                <td class="px-6 py-5">

                                    @if($stockOut->destination)

                                        <div
                                            class="inline-flex items-center gap-2
                                                   rounded-xl bg-[#F1FAFF]
                                                   px-3 py-2
                                                   text-sm font-semibold
                                                   text-[#052659]"
                                        >
                                            <i
                                                data-lucide="map-pin"
                                                class="h-4 w-4 text-[#5483B3]"
                                            ></i>

                                            {{ $stockOut->destination }}
                                        </div>

                                    @else

                                        <span class="text-sm font-medium text-[#94A3B8]">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td class="px-6 py-5">

                                    @if($stockOut->status === 'pending')

                                        <span
                                            class="inline-flex items-center gap-1.5
                                                   rounded-full
                                                   border border-amber-200
                                                   bg-amber-50
                                                   px-3 py-1.5
                                                   text-xs font-bold text-amber-700"
                                        >
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                            Menunggu Persiapan
                                        </span>

                                    @else

                                        <div class="inline-flex flex-col gap-1">

                                            <span
                                                class="inline-flex w-fit items-center gap-1.5
                                                       rounded-full
                                                       border border-red-200
                                                       bg-red-50
                                                       px-3 py-1.5
                                                       text-xs font-bold text-red-700"
                                            >
                                                <i
                                                    data-lucide="check"
                                                    class="h-3.5 w-3.5"
                                                ></i>

                                                Sudah Disiapkan
                                            </span>

                                            @if($stockOut->confirmer)

                                                <span class="text-[11px] text-[#7DA0CA]">
                                                    oleh {{ $stockOut->confirmer->name }}
                                                </span>

                                            @endif

                                        </div>

                                    @endif

                                </td>


                                {{-- KETERANGAN --}}
                                <td class="max-w-xs px-6 py-5">

                                    @if($stockOut->description)

                                        <p
                                            class="line-clamp-2
                                                   text-sm font-medium
                                                   leading-6 text-[#475569]"
                                        >
                                            {{ $stockOut->description }}
                                        </p>

                                    @else

                                        <span class="text-sm font-medium text-[#94A3B8]">
                                            Tidak ada keterangan
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="px-6 py-5 text-center">

                                    {{-- STAFF --}}
                                    @if($isStaff)

                                        @if($stockOut->status === 'pending')

                                            <form
                                                action="{{ route('stock-outs.confirm', $stockOut->id) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Konfirmasi bahwa barang ini sudah disiapkan untuk dikeluarkan?')"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-2
                                                           rounded-xl
                                                           bg-[#052659]
                                                           px-3 py-2
                                                           text-xs font-bold text-white
                                                           shadow-sm
                                                           transition duration-200
                                                           hover:bg-[#5483B3]"
                                                >
                                                    <i
                                                        data-lucide="check-circle"
                                                        class="h-4 w-4"
                                                    ></i>

                                                    Konfirmasi Disiapkan
                                                </button>

                                            </form>

                                        @else

                                            <span
                                                class="inline-flex items-center gap-2
                                                       rounded-xl
                                                       bg-red-50
                                                       px-3 py-2
                                                       text-xs font-bold text-red-700"
                                            >
                                                <i
                                                    data-lucide="badge-check"
                                                    class="h-4 w-4"
                                                ></i>

                                                Sudah Dikonfirmasi
                                            </span>

                                        @endif


                                    {{-- ADMIN --}}
                                    @elseif($isAdmin)

                                        <form
                                            action="{{ route('stock-outs.destroy', $stockOut->id) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data stok keluar ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Hapus Data"
                                                class="inline-flex items-center gap-2
                                                       rounded-xl
                                                       border border-red-200
                                                       bg-red-50
                                                       px-3 py-2
                                                       text-xs font-bold
                                                       text-red-700
                                                       transition duration-200
                                                       hover:bg-red-100"
                                            >
                                                <i
                                                    data-lucide="trash-2"
                                                    class="h-4 w-4"
                                                ></i>

                                                Hapus
                                            </button>

                                        </form>


                                    {{-- MANAGER --}}
                                    @else

                                        <span class="text-xs font-semibold text-[#94A3B8]">
                                            Tidak ada aksi
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="px-6 py-16 text-center"
                                >

                                    <div
                                        class="mx-auto flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl bg-red-50"
                                    >
                                        <i
                                            data-lucide="package-open"
                                            class="h-8 w-8 text-red-300"
                                        ></i>
                                    </div>

                                    <h3 class="mt-4 font-bold text-[#334155]">
                                        Belum Ada Data Stok Keluar
                                    </h3>

                                    <p
                                        class="mx-auto mt-1 max-w-md
                                               text-sm font-medium text-[#7DA0CA]"
                                    >
                                        Belum ada pencatatan barang keluar
                                        yang tersimpan dalam sistem.
                                    </p>

                                    @if($isAdmin || $isManager)

                                        <a
                                            href="{{ route('stock-outs.create') }}"
                                            class="mt-5 inline-flex items-center gap-2
                                                   rounded-xl
                                                   bg-[#021024]
                                                   px-4 py-2.5
                                                   text-sm font-bold text-white
                                                   transition hover:bg-[#052659]"
                                        >
                                            <i
                                                data-lucide="plus"
                                                class="h-4 w-4"
                                            ></i>

                                            Tambah Stok Keluar
                                        </a>

                                    @endif

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                 MOBILE
            ====================================================== --}}
            <div class="space-y-4 p-4 md:hidden">

                @forelse ($stockOuts as $stockOut)

                    <div
                        class="rounded-2xl
                               border border-[#D9E4EE]
                               bg-[#F8FAFC]
                               p-4
                               transition duration-200
                               hover:border-[#C1E8FF]
                               hover:bg-white"
                    >

                        {{-- HEADER --}}
                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-12 w-12 shrink-0
                                       items-center justify-center
                                       rounded-xl
                                       bg-gradient-to-br
                                       from-[#021024]
                                       to-[#5483B3]
                                       font-bold uppercase
                                       text-[#C1E8FF]"
                            >
                                {{ strtoupper(substr($stockOut->product->name ?? 'P', 0, 1)) }}
                            </div>

                            <div class="min-w-0 flex-1">

                                <h3 class="truncate font-bold text-[#021024]">
                                    {{ $stockOut->product->name ?? '-' }}
                                </h3>

                                @if($stockOut->product)

                                    <p class="mt-1 text-xs font-medium text-[#7DA0CA]">
                                        SKU: {{ $stockOut->product->sku }}
                                    </p>

                                @endif

                            </div>

                            <span
                                class="shrink-0 rounded-full
                                       border border-red-200
                                       bg-red-50
                                       px-2.5 py-1
                                       text-xs font-bold text-red-700"
                            >
                                -{{ $stockOut->quantity }}
                            </span>

                        </div>


                        {{-- INFORMASI --}}
                        <div
                            class="mt-4 space-y-3
                                   border-t border-[#D9E4EE]
                                   pt-4"
                        >

                            {{-- TANGGAL --}}
                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0
                                           items-center justify-center
                                           rounded-lg bg-[#E8F7FF]
                                           text-[#052659]"
                                >
                                    <i
                                        data-lucide="calendar"
                                        class="h-4 w-4"
                                    ></i>
                                </div>

                                <div>

                                    <p class="text-xs font-medium text-[#94A3B8]">
                                        Tanggal
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-[#334155]">
                                        {{ $stockOut->date->format('d-m-Y') }}
                                    </p>

                                </div>

                            </div>


                            {{-- TUJUAN --}}
                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0
                                           items-center justify-center
                                           rounded-lg bg-[#E8F7FF]
                                           text-[#052659]"
                                >
                                    <i
                                        data-lucide="map-pin"
                                        class="h-4 w-4"
                                    ></i>
                                </div>

                                <div class="min-w-0">

                                    <p class="text-xs font-medium text-[#94A3B8]">
                                        Tujuan
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-semibold
                                               leading-5 text-[#334155]"
                                    >
                                        {{ $stockOut->destination ?? '-' }}
                                    </p>

                                </div>

                            </div>


                            {{-- STATUS --}}
                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0
                                           items-center justify-center
                                           rounded-lg
                                           {{ $stockOut->status === 'pending'
                                                ? 'bg-amber-50 text-amber-600'
                                                : 'bg-red-50 text-red-600' }}"
                                >
                                    <i
                                        data-lucide="{{ $stockOut->status === 'pending' ? 'clock-3' : 'badge-check' }}"
                                        class="h-4 w-4"
                                    ></i>
                                </div>

                                <div>

                                    <p class="text-xs font-medium text-[#94A3B8]">
                                        Status
                                    </p>

                                    @if($stockOut->status === 'pending')

                                        <span
                                            class="mt-1 inline-flex items-center
                                                   rounded-full
                                                   border border-amber-200
                                                   bg-amber-50
                                                   px-2.5 py-1
                                                   text-xs font-bold text-amber-700"
                                        >
                                            Menunggu Persiapan
                                        </span>

                                    @else

                                        <span
                                            class="mt-1 inline-flex items-center
                                                   rounded-full
                                                   border border-red-200
                                                   bg-red-50
                                                   px-2.5 py-1
                                                   text-xs font-bold text-red-700"
                                        >
                                            Sudah Disiapkan
                                        </span>

                                        @if($stockOut->confirmer)

                                            <p class="mt-1 text-[11px] text-[#7DA0CA]">
                                                oleh {{ $stockOut->confirmer->name }}
                                            </p>

                                        @endif

                                    @endif

                                </div>

                            </div>


                            {{-- KETERANGAN --}}
                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0
                                           items-center justify-center
                                           rounded-lg bg-[#E8F7FF]
                                           text-[#052659]"
                                >
                                    <i
                                        data-lucide="file-text"
                                        class="h-4 w-4"
                                    ></i>
                                </div>

                                <div class="min-w-0">

                                    <p class="text-xs font-medium text-[#94A3B8]">
                                        Keterangan
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-semibold
                                               leading-5 text-[#334155]"
                                    >
                                        {{ $stockOut->description ?? '-' }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- AKSI MOBILE --}}
                        <div
                            class="mt-4 border-t border-[#D9E4EE]
                                   pt-4"
                        >

                            {{-- STAFF --}}
                            @if($isStaff)

                                @if($stockOut->status === 'pending')

                                    <form
                                        action="{{ route('stock-outs.confirm', $stockOut->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Konfirmasi bahwa barang ini sudah disiapkan untuk dikeluarkan?')"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="flex w-full items-center justify-center
                                                   gap-2 rounded-xl
                                                   bg-[#052659]
                                                   px-3 py-2.5
                                                   text-xs font-bold text-white
                                                   transition hover:bg-[#5483B3]"
                                        >
                                            <i
                                                data-lucide="check-circle"
                                                class="h-4 w-4"
                                            ></i>

                                            Konfirmasi Disiapkan
                                        </button>

                                    </form>

                                @else

                                    <div
                                        class="flex w-full items-center justify-center
                                               gap-2 rounded-xl
                                               bg-red-50
                                               px-3 py-2.5
                                               text-xs font-bold text-red-700"
                                    >
                                        <i
                                            data-lucide="badge-check"
                                            class="h-4 w-4"
                                        ></i>

                                        Sudah Dikonfirmasi
                                    </div>

                                @endif


                            {{-- ADMIN --}}
                            @elseif($isAdmin)

                                <form
                                    action="{{ route('stock-outs.destroy', $stockOut->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data stok keluar ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="flex w-full items-center justify-center
                                               gap-2 rounded-xl
                                               border border-red-200
                                               bg-red-50
                                               px-3 py-2.5
                                               text-xs font-bold text-red-700
                                               transition hover:bg-red-100"
                                    >
                                        <i
                                            data-lucide="trash-2"
                                            class="h-4 w-4"
                                        ></i>

                                        Hapus Data Stok Keluar
                                    </button>

                                </form>

                            @else

                                <div
                                    class="flex w-full items-center justify-center
                                           rounded-xl bg-[#F1F5F9]
                                           px-3 py-2.5
                                           text-xs font-semibold text-[#64748B]"
                                >
                                    Tidak ada aksi
                                </div>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="py-12 text-center">

                        <div
                            class="mx-auto flex h-16 w-16
                                   items-center justify-center
                                   rounded-2xl bg-red-50"
                        >
                            <i
                                data-lucide="package-open"
                                class="h-8 w-8 text-red-300"
                            ></i>
                        </div>

                        <p class="mt-4 font-bold text-[#334155]">
                            Belum Ada Data Stok Keluar
                        </p>

                        <p class="mt-1 text-sm font-medium text-[#7DA0CA]">
                            Belum ada pencatatan barang keluar.
                        </p>

                        @if($isAdmin || $isManager)

                            <a
                                href="{{ route('stock-outs.create') }}"
                                class="mt-5 inline-flex items-center gap-2
                                       rounded-xl bg-[#021024]
                                       px-4 py-2.5
                                       text-sm font-bold text-white
                                       transition hover:bg-[#052659]"
                            >
                                <i
                                    data-lucide="plus"
                                    class="h-4 w-4"
                                ></i>

                                Tambah Stok Keluar
                            </a>

                        @endif

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection