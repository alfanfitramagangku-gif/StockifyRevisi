@extends('layouts.app')

@section('title', 'Detail Produk')
@section('page-title', 'Detail Produk')

@section('content')

@php
    $stock = (int) $product->stock;
    $minimumStock = (int) ($product->minimum_stock ?? 0);

    $isLowStock = $stock <= $minimumStock;

    /*
    |--------------------------------------------------------------------------
    | Supplier Produk
    |--------------------------------------------------------------------------
    | Mengambil supplier yang sudah terhubung dengan produk.
    | Jika belum ada supplier, gunakan collection kosong.
    */
    $productSuppliers = $product->relationLoaded('suppliers')
        ? $product->suppliers
        : $product->suppliers()->orderBy('name')->get();
@endphp

<div class="min-h-screen bg-[#F5F9FC]">

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        {{-- =========================================================
             HEADER
        ========================================================== --}}
        <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                {{-- Breadcrumb --}}
                <div class="mb-2 flex items-center gap-2 text-sm">

                    <a
                        href="{{ route('products.index') }}"
                        class="font-medium text-[#5483B3] transition hover:text-[#052659]"
                    >
                        Produk
                    </a>

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 text-[#94A3B8]"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>

                    <span class="text-[#64748B]">
                        Detail Produk
                    </span>

                </div>

                <h1 class="text-2xl font-bold tracking-tight text-[#021024] sm:text-3xl">
                    Detail Produk
                </h1>

                <p class="mt-1.5 text-sm text-[#64748B]">
                    Informasi lengkap mengenai produk dan stok yang tersedia.
                </p>

            </div>


            {{-- Tombol kembali --}}
            <a
                href="{{ route('products.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       border border-[#CBD5E1] bg-white px-4 py-2.5
                       text-sm font-semibold text-[#334155] shadow-sm
                       transition duration-200
                       hover:-translate-y-0.5
                       hover:border-[#7DA0CA]
                       hover:bg-[#F8FBFE]
                       hover:text-[#052659]
                       hover:shadow-md"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
                    />
                </svg>

                Kembali

            </a>

        </div>


        {{-- =========================================================
             PRODUCT HERO
        ========================================================== --}}
        <div
            class="relative mb-6 overflow-hidden rounded-3xl
                   bg-gradient-to-br from-[#021024] via-[#052659] to-[#5483B3]
                   p-6 shadow-xl sm:p-8"
        >

            {{-- Dekorasi --}}
            <div
                class="absolute -right-20 -top-24 h-64 w-64
                       rounded-full bg-[#C1E8FF]/10 blur-2xl"
            ></div>

            <div
                class="absolute -bottom-28 -left-16 h-64 w-64
                       rounded-full bg-[#7DA0CA]/10 blur-2xl"
            ></div>


            <div
                class="relative z-10 flex flex-col gap-6
                       lg:flex-row lg:items-center lg:justify-between"
            >

                {{-- Identitas produk --}}
                <div class="flex items-center gap-5">

                    {{-- FOTO PRODUK HERO --}}
                    <div
                        class="flex h-20 w-20 shrink-0 items-center
                               justify-center overflow-hidden rounded-2xl
                               border border-white/10
                               bg-white/10 shadow-lg backdrop-blur-sm"
                    >

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-cover"
                            >

                        @else

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 text-[#C1E8FF]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9l-8.25 4.5m8.25-13.5L12 12m0 0L3.75 7.5M12 12v9"
                                />
                            </svg>

                        @endif

                    </div>


                    <div>

                        <p
                            class="mb-1 text-xs font-semibold uppercase
                                   tracking-[0.18em] text-[#C1E8FF]/70"
                        >
                            Informasi Produk
                        </p>

                        <h2 class="text-2xl font-bold text-white sm:text-3xl">
                            {{ $product->name }}
                        </h2>

                        <div class="mt-3 flex flex-wrap items-center gap-2">

                            {{-- SKU --}}
                            <span
                                class="inline-flex items-center gap-1.5
                                       rounded-lg border border-white/10
                                       bg-white/10 px-3 py-1.5
                                       text-xs font-medium text-[#E8F7FF]
                                       backdrop-blur-sm"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-3.5 w-3.5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M7.5 7.5h.008v.008H7.5V7.5zm0 4.5h.008v.008H7.5V12zm0 4.5h.008v.008H7.5V16.5z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 5.25A2.25 2.25 0 015.25 3h6.879c.597 0 1.169.237 1.591.659l6.621 6.621a2.25 2.25 0 010 3.182l-5.879 5.879a2.25 2.25 0 01-3.182 0l-7.621-7.621A2.25 2.25 0 013 10.129V5.25z"
                                    />
                                </svg>

                                SKU: {{ $product->sku ?? '-' }}

                            </span>


                            {{-- Kategori --}}
                            <span
                                class="inline-flex items-center rounded-lg
                                       border border-[#C1E8FF]/10
                                       bg-[#C1E8FF]/10 px-3 py-1.5
                                       text-xs font-medium text-[#E8F7FF]"
                            >
                                {{ $product->category->name ?? 'Tanpa Kategori' }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Stok --}}
                <div
                    class="rounded-2xl border border-white/10
                           bg-white/10 px-6 py-4 backdrop-blur-sm
                           lg:min-w-[200px]"
                >

                    <p class="text-xs font-medium text-[#C1E8FF]/70">
                        Stok Saat Ini
                    </p>

                    <div class="mt-1 flex items-end gap-2">

                        <span class="text-4xl font-bold text-white">
                            {{ $stock }}
                        </span>

                        <span class="mb-1 text-sm text-[#C1E8FF]/80">
                            unit
                        </span>

                    </div>

                    @if($isLowStock)

                        <div
                            class="mt-2 inline-flex items-center gap-1.5
                                   text-xs font-semibold text-red-300"
                        >

                            <span class="h-2 w-2 rounded-full bg-red-400"></span>

                            Stok Menipis

                        </div>

                    @else

                        <div
                            class="mt-2 inline-flex items-center gap-1.5
                                   text-xs font-semibold text-[#C1E8FF]"
                        >

                            <span class="h-2 w-2 rounded-full bg-[#C1E8FF]"></span>

                            Stok Tersedia

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =========================================================
             MAIN CONTENT
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


            {{-- =====================================================
                 INFORMASI PRODUK
            ====================================================== --}}
            <div class="lg:col-span-2">

                <div
                    class="overflow-hidden rounded-3xl
                           border border-[#E2E8F0]
                           bg-white shadow-sm"
                >

                    {{-- Header --}}
                    <div
                        class="flex items-center gap-3
                               border-b border-[#E2E8F0]
                               px-6 py-5"
                    >

                        <div
                            class="flex h-11 w-11 items-center
                                   justify-center rounded-xl
                                   bg-[#E8F7FF] text-[#052659]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 3a9 9 0 100 18 9 9 0 000-18z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-bold text-[#052659]">
                                Informasi Produk
                            </h3>

                            <p class="mt-0.5 text-xs text-[#64748B]">
                                Detail data produk
                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                         FOTO PRODUK
                    ================================================== --}}
                    <div
                        class="border-b border-[#E2E8F0]
                               bg-gradient-to-br
                               from-[#F8FBFF] via-white to-[#F1FAFF]
                               p-6 sm:p-8"
                    >

                        <div
                            class="flex flex-col items-center
                                   justify-center"
                        >

                            {{-- Container Foto --}}
                            <div
                                class="relative flex h-64 w-full max-w-md
                                       items-center justify-center
                                       overflow-hidden rounded-3xl
                                       border border-[#C1E8FF]
                                       bg-white shadow-sm
                                       sm:h-72"
                            >

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="h-full w-full object-contain"
                                    >

                                    {{-- Label --}}
                                    <div
                                        class="absolute left-4 top-4
                                               inline-flex items-center gap-2
                                               rounded-full
                                               border border-white/80
                                               bg-white/90 px-3 py-1.5
                                               text-xs font-bold
                                               text-[#052659]
                                               shadow-sm backdrop-blur"
                                    >

                                        <span
                                            class="h-2 w-2 rounded-full
                                                   bg-[#5483B3]"
                                        ></span>

                                        Foto Produk

                                    </div>

                                @else

                                    <div
                                        class="flex flex-col
                                               items-center justify-center
                                               text-center"
                                    >

                                        <div
                                            class="flex h-20 w-20
                                                   items-center justify-center
                                                   rounded-2xl
                                                   bg-[#E8F7FF]
                                                   text-[#5483B3]"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-10 w-10"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9l-8.25 4.5m8.25-13.5L12 12m0 0L3.75 7.5M12 12v9"
                                                />
                                            </svg>

                                        </div>

                                        <p
                                            class="mt-4 text-sm font-bold
                                                   text-[#334155]"
                                        >
                                            Belum Ada Foto Produk
                                        </p>

                                        <p
                                            class="mt-1 text-xs
                                                   text-[#94A3B8]"
                                        >
                                            Foto produk belum ditambahkan.
                                        </p>

                                    </div>

                                @endif

                            </div>


                            {{-- Nama foto --}}
                            @if($product->image)

                                <p
                                    class="mt-3 max-w-md truncate
                                           text-center text-xs
                                           font-medium text-[#94A3B8]"
                                >
                                    {{ basename($product->image) }}
                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                         NAMA & SKU
                    ================================================== --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2">

                        <div
                            class="border-b border-[#E2E8F0]
                                   p-6 sm:border-r"
                        >

                            <p
                                class="text-xs font-semibold
                                       uppercase tracking-wider
                                       text-[#64748B]"
                            >
                                Nama Produk
                            </p>

                            <p
                                class="mt-2 text-base font-semibold
                                       text-[#1E293B]"
                            >
                                {{ $product->name }}
                            </p>

                        </div>


                        <div class="border-b border-[#E2E8F0] p-6">

                            <p
                                class="text-xs font-semibold
                                       uppercase tracking-wider
                                       text-[#64748B]"
                            >
                                SKU
                            </p>

                            <p
                                class="mt-2 font-mono text-sm
                                       font-semibold text-[#052659]"
                            >
                                {{ $product->sku ?? '-' }}
                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                         KATEGORI & UKURAN
                    ================================================== --}}
                    <div
                        class="grid grid-cols-1
                               border-b border-[#E2E8F0]
                               sm:grid-cols-2"
                    >

                        <div
                            class="border-b border-[#E2E8F0]
                                   p-6
                                   sm:border-b-0 sm:border-r"
                        >

                            <p
                                class="text-xs font-semibold
                                       uppercase tracking-wider
                                       text-[#64748B]"
                            >
                                Kategori
                            </p>

                            <div class="mt-2 flex items-center gap-2">

                                <span
                                    class="flex h-8 w-8 items-center
                                           justify-center rounded-lg
                                           bg-[#E8F7FF] text-[#052659]"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3.75 6.75A2.25 2.25 0 016 4.5h4.19c.597 0 1.169.237 1.591.659l7.56 7.56a2.25 2.25 0 010 3.182l-4.5 4.5a2.25 2.25 0 01-3.182 0l-7.56-7.56A2.25 2.25 0 013.75 11.25v-4.5z"
                                        />
                                    </svg>

                                </span>

                                <span
                                    class="text-sm font-semibold
                                           text-[#1E293B]"
                                >
                                    {{ $product->category->name ?? '-' }}
                                </span>

                            </div>

                        </div>


                        <div class="p-6">

                            <p
                                class="text-xs font-semibold
                                       uppercase tracking-wider
                                       text-[#64748B]"
                            >
                                Ukuran
                            </p>

                            <p
                                class="mt-2 text-sm font-semibold
                                       text-[#1E293B]"
                            >
                                {{ $product->size ?? '-' }}
                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                         SUPPLIER
                    ================================================== --}}
                    <div class="border-b border-[#E2E8F0] p-6 sm:p-7">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <p
                                    class="text-xs font-semibold uppercase
                                           tracking-wider text-[#64748B]"
                                >
                                    Supplier
                                </p>

                                <p class="mt-1 text-xs text-[#94A3B8]">
                                    Supplier yang terhubung dengan produk ini
                                </p>

                            </div>

                            <div
                                class="flex h-10 w-10 shrink-0 items-center
                                       justify-center rounded-xl
                                       bg-[#E8F7FF] text-[#052659]"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M8 9h1m-1 3h1m6-3h1m-1 3h1"
                                    />
                                </svg>

                            </div>

                        </div>


                        @if($productSuppliers->count() > 0)

                            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">

                                @foreach($productSuppliers as $supplier)

                                    <div
                                        class="flex items-center gap-3 rounded-2xl
                                               border border-[#E2E8F0]
                                               bg-[#F8FAFC] p-4
                                               transition
                                               hover:border-[#C1E8FF]
                                               hover:bg-[#F1FAFF]"
                                    >

                                        <div
                                            class="flex h-10 w-10 shrink-0
                                                   items-center justify-center
                                                   rounded-xl bg-[#C1E8FF]
                                                   text-[#052659]"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M8 9h1m-1 3h1m6-3h1m-1 3h1"
                                                />
                                            </svg>

                                        </div>


                                        <div class="min-w-0 flex-1">

                                            <p
                                                class="truncate text-sm font-bold
                                                       text-[#052659]"
                                            >
                                                {{ $supplier->name }}
                                            </p>

                                            @if($supplier->phone)

                                                <p
                                                    class="mt-1 flex items-center gap-1.5
                                                           truncate text-xs text-[#64748B]"
                                                >

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-3.5 w-3.5 shrink-0"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.096l-3.5-.91a1.125 1.125 0 00-1.173.417l-.97 1.293a12.035 12.035 0 01-5.392-5.392l1.293-.97c.364-.273.53-.738.417-1.173l-.91-3.5A1.125 1.125 0 009.622 6H8.25A2.25 2.25 0 006 8.25v2.25"
                                                        />
                                                    </svg>

                                                    {{ $supplier->phone }}

                                                </p>

                                            @else

                                                <p class="mt-1 text-xs text-[#94A3B8]">
                                                    Nomor telepon belum tersedia
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div
                                class="mt-4 rounded-2xl border border-dashed
                                       border-[#C1E8FF] bg-[#F1FAFF]
                                       px-5 py-6 text-center"
                            >

                                <div
                                    class="mx-auto flex h-11 w-11 items-center
                                           justify-center rounded-xl
                                           bg-[#C1E8FF] text-[#052659]"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M8 9h1m-1 3h1m6-3h1m-1 3h1"
                                        />
                                    </svg>

                                </div>

                                <p
                                    class="mt-3 text-sm font-bold text-[#052659]"
                                >
                                    Belum ada supplier
                                </p>

                                <p class="mt-1 text-xs text-[#94A3B8]">
                                    Produk ini belum terhubung dengan supplier mana pun.
                                </p>

                            </div>

                        @endif

                    </div>


                    {{-- =================================================
                         WARNA & STOK
                    ================================================== --}}
                    <div
                        class="grid grid-cols-1
                               border-b border-[#E2E8F0]
                               sm:grid-cols-2"
                    >

                        <div
                            class="border-b border-[#E2E8F0]
                                   p-6
                                   sm:border-b-0 sm:border-r"
                        >

                            <p
                                class="text-xs font-semibold
                                       uppercase tracking-wider
                                       text-[#64748B]"
                            >
                                Warna
                            </p>

                            <div class="mt-2 flex items-center gap-3">

                                <span
                                    class="h-7 w-7 rounded-full
                                           border-4 border-[#E8F7FF]
                                           bg-[#5483B3]"
                                ></span>

                                <span
                                    class="text-sm font-semibold
                                           text-[#1E293B]"
                                >
                                    {{ $product->color ?? '-' }}
                                </span>

                            </div>

                        </div>


                        <div class="p-6">

                            <p
                                class="text-xs font-semibold
                                       uppercase tracking-wider
                                       text-[#64748B]"
                            >
                                Stok Tersedia
                            </p>

                            <div class="mt-2 flex items-center gap-3">

                                <span
                                    class="flex h-9 w-9 items-center
                                           justify-center rounded-lg
                                           {{ $isLowStock
                                                ? 'bg-red-50 text-red-500'
                                                : 'bg-[#E8F7FF] text-[#052659]' }}"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9l-8.25 4.5m8.25-13.5L12 12m0 0L3.75 7.5M12 12v9"
                                        />
                                    </svg>

                                </span>

                                <div>

                                    <p
                                        class="text-xl font-bold
                                        {{ $isLowStock
                                            ? 'text-red-600'
                                            : 'text-[#052659]' }}"
                                    >
                                        {{ $stock }}
                                    </p>

                                    <p class="text-xs text-[#64748B]">
                                        Unit tersedia
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         DESKRIPSI
                    ================================================== --}}
                    <div class="p-6">

                        <p
                            class="text-xs font-semibold uppercase
                                   tracking-wider text-[#64748B]"
                        >
                            Deskripsi
                        </p>

                        <div
                            class="mt-3 rounded-2xl
                                   border border-[#E2E8F0]
                                   bg-[#F8FAFC] p-4
                                   text-sm leading-7 text-[#334155]"
                        >

                            {{ $product->description
                                ?? 'Tidak ada deskripsi untuk produk ini.' }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 SIDEBAR
            ====================================================== --}}
            <div class="space-y-6">


                {{-- =================================================
                     INFORMASI HARGA
                ================================================== --}}
                <div
                    class="overflow-hidden rounded-3xl
                           border border-[#E2E8F0]
                           bg-white shadow-sm"
                >

                    <div
                        class="border-b border-[#E2E8F0]
                               px-6 py-5"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 items-center
                                       justify-center rounded-xl
                                       bg-[#E8F7FF] text-[#052659]"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6v12m4-9.5c0-1.105-1.79-2-4-2s-4 .895-4 2 1.79 2 4 2 4 .895 4 2-1.79 2-4 2-4-.895-4-2"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h3 class="font-bold text-[#052659]">
                                    Informasi Harga
                                </h3>

                                <p class="mt-0.5 text-xs text-[#64748B]">
                                    Harga produk
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-4 p-6">

                        {{-- Pembelian --}}
                        <div
                            class="rounded-2xl border border-[#E2E8F0]
                                   bg-[#F8FAFC] p-4"
                        >

                            <p class="text-xs font-medium text-[#64748B]">
                                Harga Pembelian
                            </p>

                            <p
                                class="mt-1 text-xl font-bold
                                       text-[#052659]"
                            >
                                Rp {{ number_format($product->purchase_price, 0, ',', '.') }}
                            </p>

                        </div>


                        {{-- Penjualan --}}
                        <div
                            class="rounded-2xl border border-[#C1E8FF]
                                   bg-[#F1FAFF] p-4"
                        >

                            <p class="text-xs font-medium text-[#5483B3]">
                                Harga Penjualan
                            </p>

                            <p
                                class="mt-1 text-xl font-bold
                                       text-[#021024]"
                            >
                                Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     STATUS STOK
                ================================================== --}}
                <div
                    class="rounded-3xl border p-6 shadow-sm
                    {{ $isLowStock
                        ? 'border-red-200 bg-red-50'
                        : 'border-[#E2E8F0] bg-white' }}"
                >

                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-12 w-12 shrink-0
                                   items-center justify-center rounded-xl
                            {{ $isLowStock
                                ? 'bg-red-100 text-red-600'
                                : 'bg-[#E8F7FF] text-[#052659]' }}"
                        >

                            @if($isLowStock)

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.64h15.58a2 2 0 001.74 2.64l-7.82-14a2 2 0 00-3.48 0z"
                                    />
                                </svg>

                            @else

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m5.25 2a8.25 8.25 0 11-16.5 0 8.25 8.25 0 010-16.5 8.25 8.25 0 0116.5 0z"
                                    />
                                </svg>

                            @endif

                        </div>


                        <div>

                            <p
                                class="text-sm font-bold
                                {{ $isLowStock
                                    ? 'text-red-700'
                                    : 'text-[#052659]' }}"
                            >
                                {{ $isLowStock
                                    ? 'Stok Menipis'
                                    : 'Stok Aman' }}
                            </p>

                            <p
                                class="mt-1 text-xs leading-5
                                {{ $isLowStock
                                    ? 'text-red-600'
                                    : 'text-[#64748B]' }}"
                            >
                                Minimum stok:

                                <strong>
                                    {{ $minimumStock }}
                                </strong>

                                unit
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     KELOLA PRODUK
                ================================================== --}}
                @if(auth()->user()->role === 'admin')

                    <div
                        class="rounded-3xl
                               bg-gradient-to-br
                               from-[#021024] to-[#052659]
                               p-6 shadow-lg"
                    >

                        <p
                            class="text-xs font-medium uppercase
                                   tracking-wider text-[#7DA0CA]"
                        >
                            Pengelolaan Produk
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-white">
                            Kelola Produk
                        </h3>

                        <p
                            class="mt-2 text-xs leading-5
                                   text-[#D9F2FF]/75"
                        >
                            Perbarui informasi produk jika terdapat perubahan data.
                        </p>

                        <a
                            href="{{ route('products.edit', $product->id) }}"
                            class="mt-5 flex w-full items-center
                                   justify-center gap-2 rounded-xl
                                   bg-[#C1E8FF] px-4 py-3
                                   text-sm font-bold text-[#021024]
                                   transition duration-200
                                   hover:-translate-y-0.5
                                   hover:bg-white hover:shadow-lg"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M11 5h2m-1-2a2 2 0 110 4 2 2 0 010-4zm-7 7h14M5 10v9a2 2 0 002 2h10a2 2 0 002-2v-9"
                                />
                            </svg>

                            Edit Produk

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection