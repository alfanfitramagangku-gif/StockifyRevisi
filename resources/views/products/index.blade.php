@extends('layouts.app')

@section('title', 'Produk')
@section('page-title', 'Produk')

@section('content')

@php
    $lowStockCount = $products->filter(function ($product) {
        return $product->stock <= ($product->minimum_stock ?? 5);
    })->count();

    $totalStock = $products->sum('stock');
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

                    <div class="flex h-8 w-8 items-center justify-center
                                rounded-lg bg-[#C1E8FF] text-[#052659]">
                        <i data-lucide="package" class="h-4 w-4"></i>
                    </div>

                    <span class="font-semibold text-[#5483B3]">
                        Manajemen Inventaris
                    </span>

                    <i data-lucide="chevron-right"
                       class="h-4 w-4 text-[#7DA0CA]"></i>

                    <span class="font-medium text-[#052659]">
                        Produk
                    </span>

                </div>

                {{-- JUDUL --}}
                <h1 class="text-3xl font-bold tracking-tight text-[#021024] md:text-4xl">
                    Data Produk
                </h1>

                <p class="mt-2 text-sm font-medium text-[#5483B3]">
                    Kelola data, informasi, supplier, dan persediaan produk Stockify.
                </p>

            </div>

            {{-- =====================================================
                 AKSI ADMIN
            ====================================================== --}}
            @if(auth()->user()->role === 'admin')

                <div class="flex flex-col gap-2 sm:flex-row sm:flex-wrap">

                    {{-- EXPORT --}}
                    <a href="{{ route('products.export') }}"
                       class="inline-flex items-center justify-center gap-2
                              rounded-xl border border-[#C1E8FF]
                              bg-white px-4 py-3
                              text-sm font-semibold text-[#052659]
                              shadow-sm transition duration-200
                              hover:-translate-y-0.5
                              hover:border-[#7DA0CA]
                              hover:bg-[#F1FAFF]
                              hover:shadow-md">

                        <i data-lucide="file-down" class="h-4 w-4"></i>
                        Export CSV

                    </a>

                    {{-- IMPORT --}}
                    <button type="button"
                            onclick="openImportModal()"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-xl border border-[#C1E8FF]
                                   bg-[#E8F7FF] px-4 py-3
                                   text-sm font-semibold text-[#052659]
                                   shadow-sm transition duration-200
                                   hover:-translate-y-0.5
                                   hover:bg-[#C1E8FF]
                                   hover:shadow-md">

                        <i data-lucide="file-up" class="h-4 w-4"></i>
                        Import CSV

                    </button>

                    {{-- TAMBAH --}}
                    <a href="{{ route('products.create') }}"
                       class="inline-flex items-center justify-center gap-2
                              rounded-xl
                              bg-gradient-to-r from-[#021024] to-[#052659]
                              px-4 py-3 text-sm font-semibold text-white
                              shadow-lg shadow-[#021024]/20
                              transition duration-200
                              hover:-translate-y-0.5
                              hover:from-[#052659]
                              hover:to-[#5483B3]
                              hover:shadow-xl">

                        <i data-lucide="plus" class="h-4 w-4"></i>
                        Tambah Produk

                    </a>

                </div>

            @endif

        </div>


        {{-- =========================================================
             NOTIFIKASI SUCCESS
        ========================================================== --}}
        @if(session('success'))

            <div class="flex items-start gap-3 rounded-2xl
                        border border-[#C1E8FF]
                        bg-[#E8F7FF] px-4 py-4
                        text-sm text-[#052659]">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center
                            rounded-xl bg-[#C1E8FF]">

                    <i data-lucide="check-circle"
                       class="h-5 w-5 text-[#052659]"></i>

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
             NOTIFIKASI ERROR
        ========================================================== --}}
        @if(session('error'))

            <div class="flex items-start gap-3 rounded-2xl
                        border border-red-200
                        bg-red-50 px-4 py-4
                        text-sm text-red-700">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center
                            rounded-xl bg-red-100">

                    <i data-lucide="alert-circle"
                       class="h-5 w-5 text-red-600"></i>

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
             VALIDATION ERROR
        ========================================================== --}}
        @if($errors->any())

            <div class="rounded-2xl border border-red-200 bg-red-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center
                                rounded-xl bg-red-100">

                        <i data-lucide="alert-circle"
                           class="h-5 w-5 text-red-600"></i>

                    </div>

                    <div>

                        <p class="font-bold text-red-700">
                            Terjadi Kesalahan
                        </p>

                        <ul class="mt-2 space-y-1 text-sm text-red-600">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
             RINGKASAN
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            {{-- TOTAL PRODUK --}}
            <div class="group rounded-3xl border border-[#D9E4EE]
                        bg-white p-5 shadow-sm
                        transition duration-300
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-[#5483B3]">
                            Produk Ditampilkan
                        </p>

                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-[#021024]">
                            {{ $products->count() }}
                        </h3>

                        <p class="mt-1 text-xs font-medium text-[#7DA0CA]">
                            Data pada halaman ini
                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center
                                rounded-2xl bg-[#E8F7FF] text-[#052659]
                                transition duration-300
                                group-hover:scale-110">

                        <i data-lucide="package" class="h-6 w-6"></i>

                    </div>

                </div>

            </div>


            {{-- TOTAL STOK --}}
            <div class="group rounded-3xl border border-[#D9E4EE]
                        bg-white p-5 shadow-sm
                        transition duration-300
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-[#5483B3]">
                            Stok Produk
                        </p>

                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-[#052659]">
                            {{ number_format($totalStock, 0, ',', '.') }}
                        </h3>

                        <p class="mt-1 text-xs font-medium text-[#7DA0CA]">
                            Total unit pada halaman ini
                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center
                                rounded-2xl bg-[#E8F7FF] text-[#052659]
                                transition duration-300
                                group-hover:scale-110">

                        <i data-lucide="warehouse" class="h-6 w-6"></i>

                    </div>

                </div>

            </div>


            {{-- STOK MENIPIS --}}
            <div class="group rounded-3xl border border-red-200
                        bg-white p-5 shadow-sm
                        transition duration-300
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-[#64748B]">
                            Stok Menipis
                        </p>

                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-red-600">
                            {{ $lowStockCount }}
                        </h3>

                        <p class="mt-1 text-xs font-semibold text-red-400">
                            Perlu segera diperiksa
                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center
                                rounded-2xl bg-red-50 text-red-600
                                transition duration-300
                                group-hover:scale-110">

                        <i data-lucide="alert-triangle" class="h-6 w-6"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             TABEL PRODUK
        ========================================================== --}}
        <div class="overflow-hidden rounded-3xl
                    border border-[#D9E4EE]
                    bg-white shadow-sm">

            {{-- TOOLBAR --}}
            <div class="border-b border-[#E2E8F0] bg-white p-5 md:p-6">

                <div class="flex flex-col justify-between gap-5 xl:flex-row xl:items-center">

                    <div>

                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center
                                        rounded-xl bg-[#E8F7FF]
                                        text-[#052659]">

                                <i data-lucide="list" class="h-5 w-5"></i>

                            </div>

                            <div>

                                <h2 class="text-lg font-bold text-[#021024]">
                                    Daftar Produk
                                </h2>

                                <p class="mt-1 text-sm font-medium text-[#64748B]">
                                    Informasi produk dan supplier yang tersimpan dalam sistem.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- SEARCH --}}
                    <form action="{{ route('products.index') }}"
                          method="GET"
                          class="flex w-full flex-col gap-2 sm:flex-row xl:w-auto">

                        <div class="relative">

                            <i data-lucide="search"
                               class="pointer-events-none absolute left-3 top-1/2
                                      h-4 w-4 -translate-y-1/2
                                      text-[#7DA0CA]">
                            </i>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama atau SKU..."
                                   class="w-full rounded-xl
                                          border border-[#CBD5E1]
                                          bg-[#F8FAFC]
                                          py-3 pl-10 pr-4
                                          text-sm font-medium
                                          text-[#021024]
                                          outline-none transition
                                          placeholder:text-[#94A3B8]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4
                                          focus:ring-[#5483B3]/10
                                          sm:w-64">

                        </div>


                        {{-- FILTER --}}
                        <select name="category_id"
                                class="rounded-xl
                                       border border-[#CBD5E1]
                                       bg-[#F8FAFC]
                                       px-4 py-3
                                       text-sm font-semibold
                                       text-[#334155]
                                       outline-none transition
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-[#5483B3]/10">

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach($categories ?? [] as $category)

                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>


                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2
                                       rounded-xl bg-[#021024]
                                       px-4 py-3
                                       text-sm font-bold text-white
                                       transition duration-200
                                       hover:bg-[#052659]">

                            <i data-lucide="search" class="h-4 w-4"></i>
                            Cari

                        </button>


                        @if(request()->filled('search') || request()->filled('category_id'))

                            <a href="{{ route('products.index') }}"
                               class="inline-flex items-center justify-center gap-2
                                      rounded-xl border border-[#D9E4EE]
                                      bg-[#F8FAFC]
                                      px-4 py-3
                                      text-sm font-bold text-[#475569]
                                      transition
                                      hover:border-[#C1E8FF]
                                      hover:bg-[#E8F7FF]
                                      hover:text-[#052659]">

                                <i data-lucide="rotate-ccw" class="h-4 w-4"></i>
                                Reset

                            </a>

                        @endif

                    </form>

                </div>

            </div>


            {{-- =====================================================
                 DESKTOP TABLE
            ====================================================== --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="min-w-full text-left text-sm">

                    <thead class="bg-[#F5F9FC]">

                        <tr class="border-b border-[#D9E4EE]">

                            <th class="px-6 py-4 text-xs font-bold uppercase
                                       tracking-wider text-[#475569]">
                                No
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase
                                       tracking-wider text-[#475569]">
                                Produk
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase
                                       tracking-wider text-[#475569]">
                                Supplier
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase
                                       tracking-wider text-[#475569]">
                                Kategori
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase
                                       tracking-wider text-[#475569]">
                                Harga Jual
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold
                                       uppercase tracking-wider text-[#475569]">
                                Stok
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold
                                       uppercase tracking-wider text-[#475569]">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold
                                       uppercase tracking-wider text-[#475569]">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#EDF2F7]">

                        @forelse($products as $product)

                            @php
                                $productLowStock =
                                    $product->stock <= ($product->minimum_stock ?? 5);

                                $suppliers = $product->relationLoaded('suppliers')
                                    ? $product->suppliers
                                    : $product->suppliers()->orderBy('name')->get();
                            @endphp

                            <tr class="group transition duration-200 hover:bg-[#F8FBFE]">

                                {{-- NOMOR --}}
                                <td class="whitespace-nowrap px-6 py-4
                                           text-sm font-medium text-[#64748B]">

                                    @if(method_exists($products, 'firstItem'))

                                        {{ $products->firstItem() + $loop->index }}

                                    @else

                                        {{ $loop->iteration }}

                                    @endif

                                </td>


                                {{-- PRODUK --}}
                                <td class="min-w-[280px] px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        {{-- FOTO --}}
                                        <div class="flex h-14 w-14 shrink-0
                                                    items-center justify-center
                                                    overflow-hidden rounded-xl
                                                    bg-gradient-to-br
                                                    from-[#021024] to-[#5483B3]
                                                    font-bold uppercase
                                                    text-[#C1E8FF]
                                                    shadow-sm">

                                            @if($product->image)

                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                     alt="{{ $product->name }}"
                                                     loading="lazy"
                                                     class="h-full w-full object-cover">

                                            @else

                                                <span class="text-lg font-bold">
                                                    {{ strtoupper(substr($product->name, 0, 1)) }}
                                                </span>

                                            @endif

                                        </div>


                                        {{-- INFO --}}
                                        <div class="min-w-0">

                                            <a href="{{ route('products.show', $product) }}"
                                               class="block truncate text-sm font-bold
                                                      text-[#021024]
                                                      transition hover:text-[#5483B3]">

                                                {{ $product->name }}

                                            </a>

                                            <p class="mt-1 text-xs font-medium text-[#7DA0CA]">
                                                SKU: {{ $product->sku }}
                                            </p>

                                            @if($product->size || $product->color)

                                                <p class="mt-1 text-xs text-[#94A3B8]">

                                                    @if($product->size)
                                                        Ukuran: {{ $product->size }}
                                                    @endif

                                                    @if($product->size && $product->color)
                                                        ·
                                                    @endif

                                                    @if($product->color)
                                                        Warna: {{ $product->color }}
                                                    @endif

                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- =================================================
                                     SUPPLIER
                                ================================================== --}}
                                <td class="min-w-[180px] px-6 py-4">

                                    @if($suppliers->count())

                                        <div class="space-y-1.5">

                                            @foreach($suppliers as $supplier)

                                                <div class="flex items-center gap-2">

                                                    <div class="flex h-7 w-7 shrink-0
                                                                items-center justify-center
                                                                rounded-lg bg-[#E8F7FF]
                                                                text-[#052659]">

                                                        <i data-lucide="truck"
                                                           class="h-3.5 w-3.5"></i>

                                                    </div>

                                                    <span class="max-w-[180px] truncate
                                                                 text-xs font-bold
                                                                 text-[#334155]"
                                                          title="{{ $supplier->name }}">

                                                        {{ $supplier->name }}

                                                    </span>

                                                </div>

                                            @endforeach

                                        </div>

                                    @else

                                        <span class="inline-flex items-center gap-1.5
                                                     rounded-lg bg-[#F8FAFC]
                                                     px-2.5 py-1.5
                                                     text-xs font-medium
                                                     text-[#94A3B8]">

                                            <i data-lucide="minus-circle"
                                               class="h-3.5 w-3.5"></i>

                                            Belum ada supplier

                                        </span>

                                    @endif

                                </td>


                                {{-- KATEGORI --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <span class="inline-flex items-center
                                                 rounded-lg
                                                 border border-[#C1E8FF]
                                                 bg-[#F1FAFF]
                                                 px-3 py-1.5
                                                 text-xs font-bold
                                                 text-[#052659]">

                                        {{ $product->category->name ?? '-' }}

                                    </span>

                                </td>


                                {{-- HARGA --}}
                                <td class="whitespace-nowrap px-6 py-4
                                           text-sm font-bold text-[#334155]">

                                    Rp {{ number_format($product->selling_price, 0, ',', '.') }}

                                </td>


                                {{-- STOK --}}
                                <td class="px-6 py-4 text-center">

                                    <span class="text-base font-bold
                                        {{ $productLowStock
                                            ? 'text-red-600'
                                            : 'text-[#052659]' }}">

                                        {{ number_format($product->stock, 0, ',', '.') }}

                                    </span>

                                    <span class="ml-1 text-xs font-medium text-[#7DA0CA]">
                                        unit
                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-6 py-4 text-center">

                                    @if($productLowStock)

                                        <span class="inline-flex items-center gap-1.5
                                                     rounded-full border border-red-200
                                                     bg-red-50 px-3 py-1.5
                                                     text-xs font-bold text-red-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                            Menipis

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5
                                                     rounded-full border border-[#C1E8FF]
                                                     bg-[#F1FAFF] px-3 py-1.5
                                                     text-xs font-bold text-[#052659]">

                                            <span class="h-1.5 w-1.5 rounded-full bg-[#5483B3]"></span>

                                            Aman

                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('products.show', $product) }}"
                                           title="Lihat Detail"
                                           class="rounded-xl border border-[#C1E8FF]
                                                  bg-[#F1FAFF] p-2 text-[#052659]
                                                  transition duration-200
                                                  hover:bg-[#C1E8FF]">

                                            <i data-lucide="eye" class="h-4 w-4"></i>

                                        </a>


                                        @if(auth()->user()->role === 'admin')

                                            {{-- EDIT --}}
                                            <a href="{{ route('products.edit', $product) }}"
                                               title="Edit Produk"
                                               class="rounded-xl border border-[#C1E8FF]
                                                      bg-white p-2 text-[#5483B3]
                                                      transition duration-200
                                                      hover:bg-[#E8F7FF]
                                                      hover:text-[#052659]">

                                                <i data-lucide="pencil" class="h-4 w-4"></i>

                                            </a>


                                            {{-- HAPUS --}}
                                            <form action="{{ route('products.destroy', $product) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        title="Hapus Produk"
                                                        class="rounded-xl border border-red-200
                                                               bg-red-50 p-2 text-red-600
                                                               transition duration-200
                                                               hover:bg-red-100">

                                                    <i data-lucide="trash-2" class="h-4 w-4"></i>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex h-16 w-16 items-center
                                                justify-center rounded-2xl bg-[#E8F7FF]">

                                        <i data-lucide="package-search"
                                           class="h-8 w-8 text-[#7DA0CA]"></i>

                                    </div>

                                    <h3 class="mt-4 font-bold text-[#334155]">
                                        Produk tidak ditemukan
                                    </h3>

                                    <p class="mt-1 text-sm font-medium text-[#7DA0CA]">
                                        Belum ada produk yang sesuai dengan pencarian.
                                    </p>

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

                @forelse($products as $product)

                    @php
                        $productLowStock =
                            $product->stock <= ($product->minimum_stock ?? 5);

                        $suppliers = $product->relationLoaded('suppliers')
                            ? $product->suppliers
                            : $product->suppliers()->orderBy('name')->get();
                    @endphp

                    <div class="rounded-2xl border border-[#D9E4EE]
                                bg-[#F8FAFC] p-4
                                transition hover:border-[#C1E8FF]
                                hover:bg-white">

                        {{-- INFO UTAMA --}}
                        <div class="flex items-start gap-3">

                            {{-- FOTO --}}
                            <div class="flex h-14 w-14 shrink-0 items-center
                                        justify-center overflow-hidden rounded-xl
                                        bg-gradient-to-br
                                        from-[#021024] to-[#5483B3]
                                        font-bold uppercase text-[#C1E8FF]
                                        shadow-sm">

                                @if($product->image)

                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         loading="lazy"
                                         class="h-full w-full object-cover">

                                @else

                                    <span class="text-lg font-bold">
                                        {{ strtoupper(substr($product->name, 0, 1)) }}
                                    </span>

                                @endif

                            </div>


                            <div class="min-w-0 flex-1">

                                <a href="{{ route('products.show', $product) }}"
                                   class="block truncate text-sm font-bold
                                          text-[#021024] hover:text-[#5483B3]">

                                    {{ $product->name }}

                                </a>

                                <p class="mt-1 text-xs font-medium text-[#7DA0CA]">
                                    SKU: {{ $product->sku }}
                                </p>

                                <p class="mt-1 text-xs font-semibold text-[#64748B]">
                                    {{ $product->category->name ?? 'Tanpa kategori' }}
                                </p>

                            </div>


                            @if($productLowStock)

                                <span class="shrink-0 rounded-full
                                             border border-red-200
                                             bg-red-50 px-2.5 py-1
                                             text-xs font-bold text-red-700">
                                    Menipis
                                </span>

                            @else

                                <span class="shrink-0 rounded-full
                                             border border-[#C1E8FF]
                                             bg-[#F1FAFF]
                                             px-2.5 py-1
                                             text-xs font-bold text-[#052659]">
                                    Aman
                                </span>

                            @endif

                        </div>


                        {{-- =================================================
                             SUPPLIER MOBILE
                        ================================================== --}}
                        <div class="mt-4 border-t border-[#D9E4EE] pt-4">

                            <div class="mb-2 flex items-center gap-2">

                                <i data-lucide="truck"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                <span class="text-xs font-bold text-[#64748B]">
                                    Supplier
                                </span>

                            </div>

                            @if($suppliers->count())

                                <div class="flex flex-wrap gap-2">

                                    @foreach($suppliers as $supplier)

                                        <span class="inline-flex items-center gap-1.5
                                                     rounded-lg
                                                     border border-[#C1E8FF]
                                                     bg-[#F1FAFF]
                                                     px-2.5 py-1.5
                                                     text-xs font-bold
                                                     text-[#052659]">

                                            <i data-lucide="building-2"
                                               class="h-3.5 w-3.5"></i>

                                            {{ $supplier->name }}

                                        </span>

                                    @endforeach

                                </div>

                            @else

                                <span class="text-xs font-medium text-[#94A3B8]">
                                    Belum ada supplier
                                </span>

                            @endif

                        </div>


                        {{-- HARGA & STOK --}}
                        <div class="mt-4 grid grid-cols-2 gap-3
                                    border-t border-[#D9E4EE] pt-4">

                            <div>

                                <p class="text-xs font-semibold text-[#7DA0CA]">
                                    Harga Jual
                                </p>

                                <p class="mt-1 text-sm font-bold text-[#334155]">
                                    Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs font-semibold text-[#7DA0CA]">
                                    Stok
                                </p>

                                <p class="mt-1 text-sm font-bold
                                    {{ $productLowStock
                                        ? 'text-red-600'
                                        : 'text-[#052659]' }}">

                                    {{ number_format($product->stock, 0, ',', '.') }} unit

                                </p>

                            </div>

                        </div>


                        {{-- AKSI MOBILE --}}
                        <div class="mt-4 flex gap-2">

                            {{-- DETAIL --}}
                            <a href="{{ route('products.show', $product) }}"
                               class="flex flex-1 items-center justify-center
                                      gap-2 rounded-xl border border-[#C1E8FF]
                                      bg-[#F1FAFF] px-3 py-2.5
                                      text-xs font-bold text-[#052659]
                                      transition hover:bg-[#C1E8FF]">

                                <i data-lucide="eye" class="h-4 w-4"></i>
                                Detail

                            </a>


                            @if(auth()->user()->role === 'admin')

                                {{-- EDIT --}}
                                <a href="{{ route('products.edit', $product) }}"
                                   class="flex flex-1 items-center justify-center
                                          gap-2 rounded-xl border border-[#C1E8FF]
                                          bg-white px-3 py-2.5
                                          text-xs font-bold text-[#5483B3]
                                          transition hover:bg-[#E8F7FF]
                                          hover:text-[#052659]">

                                    <i data-lucide="pencil" class="h-4 w-4"></i>
                                    Edit

                                </a>


                                {{-- HAPUS --}}
                                <form action="{{ route('products.destroy', $product) }}"
                                      method="POST"
                                      class="flex-1"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="flex w-full items-center
                                                   justify-center gap-2
                                                   rounded-xl border border-red-200
                                                   bg-red-50 px-3 py-2.5
                                                   text-xs font-bold text-red-700
                                                   transition hover:bg-red-100">

                                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        Hapus

                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="py-12 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center
                                    justify-center rounded-2xl bg-[#E8F7FF]">

                            <i data-lucide="package-search"
                               class="h-8 w-8 text-[#7DA0CA]"></i>

                        </div>

                        <p class="mt-4 font-bold text-[#334155]">
                            Produk tidak ditemukan
                        </p>

                        <p class="mt-1 text-sm font-medium text-[#7DA0CA]">
                            Belum ada produk yang sesuai.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- =====================================================
                 PAGINATION
            ====================================================== --}}
            @if(method_exists($products, 'links'))

                @if($products->hasPages())

                    <div class="border-t border-[#D9E4EE] px-5 py-4">

                        {{ $products->withQueryString()->links() }}

                    </div>

                @endif

            @endif

        </div>

    </div>
</div>


{{-- ================================================================
     MODAL IMPORT CSV
================================================================ --}}
@if(auth()->user()->role === 'admin')

<div id="importModal"
     class="fixed inset-0 z-[100] hidden items-center
            justify-center bg-[#021024]/60 px-4 backdrop-blur-sm">

    <div class="w-full max-w-lg overflow-hidden
                rounded-3xl border border-[#D9E4EE]
                bg-white shadow-2xl">

        {{-- HEADER --}}
        <div class="flex items-start justify-between gap-4
                    border-b border-[#D9E4EE] p-6">

            <div class="flex items-center gap-3">

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-2xl bg-[#E8F7FF] text-[#052659]">

                    <i data-lucide="file-up" class="h-6 w-6"></i>

                </div>

                <div>

                    <h2 class="text-xl font-bold text-[#021024]">
                        Import Data Produk
                    </h2>

                    <p class="mt-1 text-sm font-medium text-[#64748B]">
                        Tambahkan banyak produk melalui file CSV.
                    </p>

                </div>

            </div>


            <button type="button"
                    onclick="closeImportModal()"
                    class="rounded-xl bg-[#F8FAFC]
                           p-2 text-[#64748B]
                           transition hover:bg-red-50
                           hover:text-red-600">

                <i data-lucide="x" class="h-5 w-5"></i>

            </button>

        </div>


        {{-- BODY --}}
        <div class="p-6">

            <div class="mb-5 rounded-2xl
                        border border-[#C1E8FF]
                        bg-[#F1FAFF] p-4">

                <div class="flex gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center
                                justify-center rounded-lg bg-[#C1E8FF]">

                        <i data-lucide="info"
                           class="h-5 w-5 text-[#052659]"></i>

                    </div>

                    <div>

                        <p class="text-sm font-bold text-[#052659]">
                            Format kolom CSV
                        </p>

                        <p class="mt-2 text-xs font-medium leading-5 text-[#475569]">

                            Nama Produk, SKU, Kategori, Ukuran,
                            Warna, Deskripsi, Harga Beli,
                            Harga Jual, Stok, Stok Minimum

                        </p>

                        <p class="mt-2 text-xs font-semibold text-[#5483B3]">
                            SKU yang sudah terdaftar akan dilewati.
                        </p>

                    </div>

                </div>

            </div>


            {{-- FORM --}}
            <form action="{{ route('products.import') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <label for="csvFile"
                       class="mb-2 block text-sm font-bold text-[#334155]">

                    Pilih File CSV

                </label>

                <input id="csvFile"
                       type="file"
                       name="file"
                       accept=".csv,.txt"
                       required
                       class="block w-full rounded-xl
                              border border-[#CBD5E1]
                              bg-[#F8FAFC] p-3
                              text-sm font-medium
                              text-[#475569]
                              outline-none transition
                              file:mr-4
                              file:rounded-lg
                              file:border-0
                              file:bg-[#E8F7FF]
                              file:px-3 file:py-2
                              file:text-sm
                              file:font-bold
                              file:text-[#052659]
                              focus:border-[#5483B3]">


                @error('file')

                    <p class="mt-2 text-sm font-semibold text-red-600">
                        {{ $message }}
                    </p>

                @enderror

                <p class="mt-2 text-xs font-medium text-[#7DA0CA]">
                    Format file: CSV atau TXT. Maksimal 5 MB.
                </p>


                {{-- BUTTON --}}
                <div class="mt-6 flex justify-end gap-3">

                    <button type="button"
                            onclick="closeImportModal()"
                            class="rounded-xl border border-[#D9E4EE]
                                   bg-[#F8FAFC]
                                   px-4 py-3
                                   text-sm font-bold
                                   text-[#475569]
                                   transition
                                   hover:bg-[#E2E8F0]">

                        Batal

                    </button>


                    <button type="submit"
                            class="inline-flex items-center gap-2
                                   rounded-xl
                                   bg-gradient-to-r
                                   from-[#021024] to-[#052659]
                                   px-4 py-3
                                   text-sm font-bold text-white
                                   transition
                                   hover:from-[#052659]
                                   hover:to-[#5483B3]">

                        <i data-lucide="upload" class="h-4 w-4"></i>

                        Import Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endif


{{-- ================================================================
     JAVASCRIPT
================================================================ --}}
<script>

    function openImportModal() {

        const modal = document.getElementById('importModal');

        if (modal) {

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');

        }

    }


    function closeImportModal() {

        const modal = document.getElementById('importModal');

        if (modal) {

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }

    }


    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            closeImportModal();
        }

    });


    document.addEventListener('click', function (event) {

        const modal = document.getElementById('importModal');

        if (modal && event.target === modal) {
            closeImportModal();
        }

    });

</script>

@endsection