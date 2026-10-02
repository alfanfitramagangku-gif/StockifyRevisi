@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')

<div class="min-h-screen bg-[#F5F9FC] px-4 py-6 md:px-6 lg:px-8">

    <div class="mx-auto max-w-5xl">

        {{-- =========================================================
             HEADER
        ========================================================== --}}
        <div class="mb-6">

            {{-- Breadcrumb --}}
            <div class="mb-3 flex items-center gap-2 text-sm text-[#5483B3]">

                <i data-lucide="package" class="h-4 w-4"></i>

                <span>Manajemen Inventaris</span>

                <i data-lucide="chevron-right"
                   class="h-4 w-4 text-[#7DA0CA]"></i>

                <span class="font-medium text-[#052659]">
                    Edit Produk
                </span>

            </div>


            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h1 class="text-2xl font-bold tracking-tight text-[#021024] md:text-3xl">
                        Edit Produk
                    </h1>

                    <p class="mt-1.5 text-sm text-slate-500">
                        Perbarui informasi produk yang tersimpan di Stockify.
                    </p>

                </div>


                {{-- Product Info --}}
                <div class="flex items-center gap-3 rounded-2xl border border-[#C1E8FF]
                            bg-white px-4 py-3 shadow-sm">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl
                                bg-gradient-to-br from-[#5483B3] to-[#7DA0CA]
                                text-white shadow-sm">

                        <i data-lucide="package-pen" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-xs font-medium text-slate-400">
                            Produk yang diedit
                        </p>

                        <p class="max-w-[180px] truncate text-sm font-bold text-[#021024]">
                            {{ $product->name }}
                        </p>

                    </div>

                </div>

            </div>

        </div>



        {{-- =========================================================
             FORM CARD
        ========================================================== --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200
                    bg-white shadow-sm">

            {{-- Card Header --}}
            <div class="border-b border-slate-100 bg-gradient-to-r
                        from-[#F1FAFF] via-white to-[#F8FBFF]
                        px-6 py-5 md:px-8">

                <div class="flex items-center gap-4">

                    <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center
                                rounded-xl bg-[#C1E8FF] text-[#052659]">

                        <i data-lucide="file-pen-line" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-[#021024]">
                            Informasi Produk
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Silakan perbarui data produk sesuai kebutuhan.
                        </p>

                    </div>

                </div>

            </div>



            {{-- =====================================================
                 FORM
            ====================================================== --}}
            <form action="{{ route('products.update', $product) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-6 md:p-8">

                @csrf

                @method('PUT')



                {{-- =================================================
                     INFORMASI DASAR
                ================================================== --}}
                <div class="mb-8">

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#5483B3]"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Informasi Dasar
                            </h3>

                            <p class="text-xs text-slate-400">
                                Data utama produk
                            </p>

                        </div>

                    </div>



                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- =================================================
                             KATEGORI
                        ================================================== --}}
                        <div class="md:col-span-2">

                            <label for="category_id"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="layers"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Kategori

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <select name="category_id"
                                        id="category_id"
                                        required
                                        class="w-full appearance-none rounded-xl border border-slate-200
                                               bg-[#F8FBFF] px-4 py-3 pr-10 text-sm text-slate-700
                                               outline-none transition
                                               hover:border-[#7DA0CA]
                                               focus:border-[#5483B3]
                                               focus:bg-white
                                               focus:ring-4 focus:ring-[#C1E8FF]/60">

                                    <option value="">
                                        -- Pilih Kategori --
                                    </option>

                                    @foreach ($categories as $category)

                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>

                                            {{ $category->name }}

                                        </option>

                                    @endforeach

                                </select>


                                <i data-lucide="chevron-down"
                                   class="pointer-events-none absolute right-4 top-1/2
                                          h-4 w-4 -translate-y-1/2 text-[#5483B3]">
                                </i>

                            </div>


                            @error('category_id')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- =================================================
                             NAMA PRODUK
                        ================================================== --}}
                        <div>

                            <label for="name"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="package"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Nama Produk

                                <span class="text-red-500">*</span>

                            </label>


                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name', $product->name) }}"
                                   placeholder="Contoh: Kaos Polos"
                                   required
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            @error('name')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- =================================================
                             SKU
                        ================================================== --}}
                        <div>

                            <label for="sku"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="barcode"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                SKU

                                <span class="text-red-500">*</span>

                            </label>


                            <input type="text"
                                   name="sku"
                                   id="sku"
                                   value="{{ old('sku', $product->sku) }}"
                                   placeholder="Contoh: PRD-001"
                                   required
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm uppercase text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            @error('sku')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- =================================================
                             UKURAN
                        ================================================== --}}
                        <div>

                            <label for="size"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="ruler"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Ukuran

                            </label>


                            <input type="text"
                                   name="size"
                                   id="size"
                                   value="{{ old('size', $product->size) }}"
                                   placeholder="Contoh: M, L, XL, 42"
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            @error('size')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- =================================================
                             WARNA
                        ================================================== --}}
                        <div>

                            <label for="color"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="palette"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Warna

                            </label>


                            <input type="text"
                                   name="color"
                                   id="color"
                                   value="{{ old('color', $product->color) }}"
                                   placeholder="Contoh: Hitam, Putih, Merah"
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            @error('color')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- =================================================
                             SUPPLIER
                        ================================================== --}}
                        <div class="md:col-span-2">

                            <label
                                class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700"
                            >

                                <i
                                    data-lucide="truck"
                                    class="h-4 w-4 text-[#5483B3]"
                                ></i>

                                Supplier

                                <span class="text-xs font-normal text-slate-400">
                                    (Dapat memilih lebih dari satu)
                                </span>

                            </label>


                            <div
                                class="rounded-2xl border border-slate-200
                                       bg-[#F8FBFF] p-4"
                            >

                                @php

                                    /*
                                    |--------------------------------------------------------------------------
                                    | SUPPLIER YANG SUDAH DIPILIH
                                    |--------------------------------------------------------------------------
                                    */

                                    $selectedSupplierIds =
                                        old(
                                            'supplier_ids',
                                            $product->suppliers
                                                ? $product->suppliers
                                                    ->pluck('id')
                                                    ->toArray()
                                                : []
                                        );

                                @endphp


                                @if($suppliers->count() > 0)

                                    <div
                                        class="grid grid-cols-1 gap-3
                                               sm:grid-cols-2 lg:grid-cols-3"
                                    >

                                        @foreach($suppliers as $supplier)

                                            <label
                                                class="group flex cursor-pointer
                                                       items-center gap-3 rounded-xl
                                                       border border-slate-200
                                                       bg-white p-3 transition
                                                       hover:border-[#7DA0CA]
                                                       hover:bg-[#F1FAFF]"
                                            >

                                                <input
                                                    type="checkbox"
                                                    name="supplier_ids[]"
                                                    value="{{ $supplier->id }}"
                                                    {{ in_array(
                                                        $supplier->id,
                                                        $selectedSupplierIds
                                                    ) ? 'checked' : '' }}
                                                    class="h-4 w-4 rounded
                                                           border-slate-300
                                                           text-[#052659]
                                                           focus:ring-[#5483B3]"
                                                >


                                                <div class="min-w-0 flex-1">

                                                    <div class="flex items-center gap-2">

                                                        <p
                                                            class="truncate text-sm
                                                                   font-semibold text-[#052659]"
                                                        >
                                                            {{ $supplier->name }}
                                                        </p>

                                                    </div>


                                                    @if($supplier->phone)

                                                        <p
                                                            class="mt-0.5 truncate
                                                                   text-xs text-slate-400"
                                                        >
                                                            {{ $supplier->phone }}
                                                        </p>

                                                    @else

                                                        <p
                                                            class="mt-0.5 text-xs
                                                                   text-slate-400"
                                                        >
                                                            Supplier
                                                        </p>

                                                    @endif

                                                </div>

                                            </label>

                                        @endforeach

                                    </div>


                                    {{-- Informasi Supplier --}}
                                    <div
                                        class="mt-4 flex items-start gap-2
                                               rounded-xl border border-[#C1E8FF]
                                               bg-[#F1FAFF] px-4 py-3"
                                    >

                                        <i
                                            data-lucide="info"
                                            class="mt-0.5 h-4 w-4 flex-shrink-0
                                                   text-[#5483B3]"
                                        ></i>

                                        <p
                                            class="text-xs leading-relaxed
                                                   text-slate-500"
                                        >
                                            Supplier yang sudah terhubung dengan produk
                                            akan otomatis tercentang. Anda dapat
                                            menambah atau menghapus supplier kemudian
                                            menyimpan perubahan.
                                        </p>

                                    </div>

                                @else

                                    {{-- Belum Ada Supplier --}}
                                    <div
                                        class="rounded-xl border border-dashed
                                               border-[#C1E8FF] bg-[#F1FAFF]
                                               px-5 py-6 text-center"
                                    >

                                        <div
                                            class="mx-auto flex h-11 w-11
                                                   items-center justify-center
                                                   rounded-xl bg-[#C1E8FF]
                                                   text-[#052659]"
                                        >

                                            <i
                                                data-lucide="truck"
                                                class="h-5 w-5"
                                            ></i>

                                        </div>


                                        <p
                                            class="mt-3 text-sm font-bold
                                                   text-[#052659]"
                                        >
                                            Belum ada supplier
                                        </p>


                                        <p
                                            class="mt-1 text-xs text-slate-400"
                                        >
                                            Tambahkan supplier terlebih dahulu
                                            sebelum menghubungkannya dengan produk.
                                        </p>

                                    </div>

                                @endif

                            </div>


                            @error('supplier_ids')

                                <p
                                    class="mt-1.5 flex items-center gap-1
                                           text-xs text-red-600"
                                >

                                    <i
                                        data-lucide="circle-alert"
                                        class="h-3.5 w-3.5"
                                    ></i>

                                    {{ $message }}

                                </p>

                            @enderror


                            @error('supplier_ids.*')

                                <p
                                    class="mt-1.5 flex items-center gap-1
                                           text-xs text-red-600"
                                >

                                    <i
                                        data-lucide="circle-alert"
                                        class="h-3.5 w-3.5"
                                    ></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>



                        {{-- =================================================
                             FOTO PRODUK
                        ================================================== --}}
                        <div class="md:col-span-2">

                            <label for="image"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="image"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Foto Produk

                                <span class="text-xs font-normal text-slate-400">
                                    (Opsional)
                                </span>

                            </label>


                            <div class="grid grid-cols-1 gap-5 md:grid-cols-[220px_1fr]">


                                {{-- =================================================
                                     PREVIEW FOTO
                                ================================================== --}}
                                <div class="relative">

                                    <div
                                        id="imagePreviewContainer"
                                        class="relative flex aspect-square w-full
                                               items-center justify-center
                                               overflow-hidden rounded-2xl
                                               border-2 border-dashed
                                               border-[#C1E8FF]
                                               bg-[#F8FBFF]"
                                    >

                                        @if ($product->image)

                                            {{-- Foto Lama --}}
                                            <img
                                                id="imagePreview"
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="h-full w-full object-cover"
                                            >


                                            {{-- Badge Foto Saat Ini --}}
                                            <div
                                                id="currentImageBadge"
                                                class="absolute bottom-3 left-3
                                                       rounded-lg bg-black/60
                                                       px-3 py-1.5 text-[11px]
                                                       font-medium text-white
                                                       backdrop-blur-sm"
                                            >
                                                Foto saat ini
                                            </div>

                                        @else

                                            {{-- Placeholder --}}
                                            <div
                                                id="imagePlaceholder"
                                                class="flex flex-col items-center
                                                       justify-center px-5 text-center"
                                            >

                                                <div
                                                    class="mb-3 flex h-14 w-14
                                                           items-center justify-center
                                                           rounded-2xl bg-[#E8F7FF]
                                                           text-[#5483B3]"
                                                >

                                                    <i
                                                        data-lucide="image-plus"
                                                        class="h-7 w-7"
                                                    ></i>

                                                </div>


                                                <p
                                                    class="text-sm font-semibold
                                                           text-slate-600"
                                                >
                                                    Belum ada foto
                                                </p>


                                                <p
                                                    class="mt-1 text-xs
                                                           leading-relaxed
                                                           text-slate-400"
                                                >
                                                    Preview foto akan muncul di sini
                                                </p>

                                            </div>


                                            {{-- Preview Foto Baru --}}
                                            <img
                                                id="imagePreview"
                                                src=""
                                                alt="Preview foto produk"
                                                class="hidden h-full w-full object-cover"
                                            >

                                        @endif


                                        {{-- Tombol Reset --}}
                                        <button
                                            type="button"
                                            id="removeImage"
                                            class="{{ $product->image ? 'flex' : 'hidden' }}
                                                   absolute right-3 top-3 h-9 w-9
                                                   items-center justify-center
                                                   rounded-full bg-red-500
                                                   text-white shadow-lg
                                                   transition hover:bg-red-600"
                                            title="Batalkan foto baru"
                                        >

                                            <i
                                                data-lucide="x"
                                                class="h-4 w-4"
                                            ></i>

                                        </button>

                                    </div>

                                </div>



                                {{-- =================================================
                                     AREA UPLOAD
                                ================================================== --}}
                                <div class="flex flex-col justify-center">

                                    <label
                                        for="image"
                                        class="group flex min-h-[180px]
                                               cursor-pointer flex-col
                                               items-center justify-center
                                               rounded-2xl border-2
                                               border-dashed border-slate-200
                                               bg-[#F8FBFF] px-6 py-8
                                               text-center transition
                                               hover:border-[#7DA0CA]
                                               hover:bg-[#F1FAFF]"
                                    >

                                        <div
                                            class="mb-3 flex h-12 w-12
                                                   items-center justify-center
                                                   rounded-xl bg-[#E8F7FF]
                                                   text-[#5483B3]
                                                   transition
                                                   group-hover:scale-105"
                                        >

                                            <i
                                                data-lucide="upload"
                                                class="h-5 w-5"
                                            ></i>

                                        </div>


                                        <p
                                            class="text-sm font-semibold
                                                   text-[#052659]"
                                        >
                                            Ganti Foto Produk
                                        </p>


                                        <p
                                            class="mt-1 text-xs text-slate-400"
                                        >
                                            Pilih foto baru dari komputer
                                        </p>


                                        <div
                                            class="mt-4 flex flex-wrap
                                                   justify-center gap-2"
                                        >

                                            <span
                                                class="rounded-lg bg-white
                                                       px-2.5 py-1
                                                       text-[11px] font-medium
                                                       text-slate-500 shadow-sm
                                                       ring-1 ring-slate-100"
                                            >
                                                JPG
                                            </span>


                                            <span
                                                class="rounded-lg bg-white
                                                       px-2.5 py-1
                                                       text-[11px] font-medium
                                                       text-slate-500 shadow-sm
                                                       ring-1 ring-slate-100"
                                            >
                                                JPEG
                                            </span>


                                            <span
                                                class="rounded-lg bg-white
                                                       px-2.5 py-1
                                                       text-[11px] font-medium
                                                       text-slate-500 shadow-sm
                                                       ring-1 ring-slate-100"
                                            >
                                                PNG
                                            </span>


                                            <span
                                                class="rounded-lg bg-white
                                                       px-2.5 py-1
                                                       text-[11px] font-medium
                                                       text-slate-500 shadow-sm
                                                       ring-1 ring-slate-100"
                                            >
                                                WEBP
                                            </span>

                                        </div>


                                        <p
                                            class="mt-3 text-[11px]
                                                   text-slate-400"
                                        >
                                            Maksimal ukuran file 2 MB
                                        </p>

                                    </label>


                                    <input
                                        type="file"
                                        name="image"
                                        id="image"
                                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                        class="hidden"
                                    >


                                    @error('image')

                                        <p
                                            class="mt-2 flex items-center
                                                   gap-1.5 text-xs text-red-600"
                                        >

                                            <i
                                                data-lucide="circle-alert"
                                                class="h-3.5 w-3.5"
                                            ></i>

                                            {{ $message }}

                                        </p>

                                    @enderror


                                    <p
                                        id="imageFileName"
                                        class="mt-2 hidden text-xs
                                               text-[#5483B3]"
                                    ></p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     STOK & HARGA
                ================================================== --}}
                <div class="mb-8 border-t border-slate-100 pt-8">

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#7DA0CA]"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Stok & Harga
                            </h3>

                            <p class="text-xs text-slate-400">
                                Atur jumlah stok dan harga produk
                            </p>

                        </div>

                    </div>



                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                        {{-- Harga Beli --}}
                        <div>

                            <label
                                for="purchase_price"
                                class="mb-2 flex items-center gap-1.5
                                       text-sm font-semibold text-slate-700"
                            >

                                <i
                                    data-lucide="shopping-cart"
                                    class="h-4 w-4 text-[#5483B3]"
                                ></i>

                                Harga Beli

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <span
                                    class="absolute left-4 top-1/2
                                           -translate-y-1/2
                                           text-xs font-semibold
                                           text-[#5483B3]"
                                >
                                    Rp
                                </span>


                                <input
                                    type="number"
                                    name="purchase_price"
                                    id="purchase_price"
                                    value="{{ old('purchase_price', $product->purchase_price) }}"
                                    min="0"
                                    required
                                    class="w-full rounded-xl border
                                           border-slate-200
                                           bg-[#F8FBFF] py-3 pl-11
                                           pr-4 text-sm text-slate-700
                                           outline-none transition
                                           hover:border-[#7DA0CA]
                                           focus:border-[#5483B3]
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-[#C1E8FF]/60"
                                >

                            </div>


                            @error('purchase_price')

                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>



                        {{-- Harga Jual --}}
                        <div>

                            <label
                                for="selling_price"
                                class="mb-2 flex items-center gap-1.5
                                       text-sm font-semibold text-slate-700"
                            >

                                <i
                                    data-lucide="badge-dollar-sign"
                                    class="h-4 w-4 text-[#5483B3]"
                                ></i>

                                Harga Jual

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <span
                                    class="absolute left-4 top-1/2
                                           -translate-y-1/2
                                           text-xs font-semibold
                                           text-[#5483B3]"
                                >
                                    Rp
                                </span>


                                <input
                                    type="number"
                                    name="selling_price"
                                    id="selling_price"
                                    value="{{ old('selling_price', $product->selling_price) }}"
                                    min="0"
                                    required
                                    class="w-full rounded-xl border
                                           border-slate-200
                                           bg-[#F8FBFF] py-3 pl-11
                                           pr-4 text-sm text-slate-700
                                           outline-none transition
                                           hover:border-[#7DA0CA]
                                           focus:border-[#5483B3]
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-[#C1E8FF]/60"
                                >

                            </div>


                            @error('selling_price')

                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>



                        {{-- Stok --}}
                        <div>

                            <label
                                for="stock"
                                class="mb-2 flex items-center gap-1.5
                                       text-sm font-semibold text-slate-700"
                            >

                                <i
                                    data-lucide="boxes"
                                    class="h-4 w-4 text-[#5483B3]"
                                ></i>

                                Stok

                                <span class="text-red-500">*</span>

                            </label>


                            <input
                                type="number"
                                name="stock"
                                id="stock"
                                value="{{ old('stock', $product->stock) }}"
                                min="0"
                                required
                                class="w-full rounded-xl border
                                       border-slate-200
                                       bg-[#F8FBFF] px-4 py-3
                                       text-sm text-slate-700
                                       outline-none transition
                                       hover:border-[#7DA0CA]
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-[#C1E8FF]/60"
                            >


                            @error('stock')

                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>



                        {{-- Stok Minimum --}}
                        <div>

                            <label
                                for="minimum_stock"
                                class="mb-2 flex items-center gap-1.5
                                       text-sm font-semibold text-slate-700"
                            >

                                <i
                                    data-lucide="triangle-alert"
                                    class="h-4 w-4 text-red-400"
                                ></i>

                                Stok Minimum

                            </label>


                            <input
                                type="number"
                                name="minimum_stock"
                                id="minimum_stock"
                                value="{{ old('minimum_stock', $product->minimum_stock ?? 5) }}"
                                min="0"
                                class="w-full rounded-xl border
                                       border-slate-200
                                       bg-[#F8FBFF] px-4 py-3
                                       text-sm text-slate-700
                                       outline-none transition
                                       hover:border-[#7DA0CA]
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-[#C1E8FF]/60"
                            >


                            <div class="mt-2 flex items-start gap-1.5">

                                <i
                                    data-lucide="info"
                                    class="mt-0.5 h-3.5 w-3.5
                                           flex-shrink-0 text-[#7DA0CA]"
                                ></i>

                                <p class="text-xs leading-relaxed text-slate-400">
                                    Digunakan sebagai batas peringatan stok menipis.
                                </p>

                            </div>


                            @error('minimum_stock')

                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     DESKRIPSI
                ================================================== --}}
                <div class="border-t border-slate-100 pt-8">

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#C1E8FF]"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Deskripsi Produk
                            </h3>

                            <p class="text-xs text-slate-400">
                                Tambahkan informasi tambahan mengenai produk
                            </p>

                        </div>

                    </div>



                    <label
                        for="description"
                        class="mb-2 flex items-center gap-1.5
                               text-sm font-semibold text-slate-700"
                    >

                        <i
                            data-lucide="align-left"
                            class="h-4 w-4 text-[#5483B3]"
                        ></i>

                        Deskripsi

                    </label>


                    <textarea
                        name="description"
                        id="description"
                        rows="5"
                        placeholder="Masukkan deskripsi produk..."
                        class="w-full resize-none rounded-xl
                               border border-slate-200
                               bg-[#F8FBFF] px-4 py-3
                               text-sm text-slate-700
                               outline-none transition
                               hover:border-[#7DA0CA]
                               focus:border-[#5483B3]
                               focus:bg-white
                               focus:ring-4
                               focus:ring-[#C1E8FF]/60"
                    >{{ old('description', $product->description) }}</textarea>


                    @error('description')

                        <p
                            class="mt-1.5 flex items-center gap-1
                                   text-xs text-red-600"
                        >

                            <i
                                data-lucide="circle-alert"
                                class="h-3.5 w-3.5"
                            ></i>

                            {{ $message }}

                        </p>

                    @enderror

                </div>



                {{-- =================================================
                     BUTTON
                ================================================== --}}
                <div
                    class="mt-8 flex flex-col-reverse gap-3
                           border-t border-slate-100 pt-6
                           sm:flex-row sm:justify-end"
                >

                    <a
                        href="{{ route('products.index') }}"
                        class="inline-flex items-center
                               justify-center gap-2 rounded-xl
                               border border-slate-200 bg-white
                               px-5 py-3 text-sm font-semibold
                               text-slate-600 shadow-sm transition
                               hover:border-slate-300
                               hover:bg-slate-50
                               active:scale-[0.98]"
                    >

                        <i
                            data-lucide="arrow-left"
                            class="h-4 w-4"
                        ></i>

                        Batal

                    </a>


                    <button
                        type="submit"
                        class="inline-flex items-center
                               justify-center gap-2 rounded-xl
                               bg-gradient-to-r from-[#052659]
                               to-[#5483B3] px-6 py-3
                               text-sm font-semibold text-white
                               shadow-lg shadow-[#052659]/20
                               transition duration-200
                               hover:-translate-y-0.5
                               hover:shadow-xl
                               hover:shadow-[#052659]/25
                               active:translate-y-0"
                    >

                        <i
                            data-lucide="save"
                            class="h-4 w-4"
                        ></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>



        {{-- =========================================================
             FOOTER INFO
        ========================================================== --}}
        <div
            class="mt-4 flex items-start gap-3
                   rounded-2xl border border-[#C1E8FF]
                   bg-[#F1FAFF] px-4 py-3"
        >

            <i
                data-lucide="info"
                class="mt-0.5 h-4 w-4
                       flex-shrink-0 text-[#5483B3]"
            ></i>

            <p class="text-xs leading-relaxed text-slate-500">
                Pastikan data produk yang diperbarui sudah sesuai sebelum
                menyimpan perubahan. Supplier yang dipilih akan digunakan
                untuk membedakan sumber pemasok produk yang sama.
            </p>

        </div>

    </div>

</div>



{{-- =========================================================
     IMAGE PREVIEW SCRIPT
========================================================== --}}
@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const imagePlaceholder = document.getElementById('imagePlaceholder');
    const removeImageButton = document.getElementById('removeImage');
    const imageFileName = document.getElementById('imageFileName');
    const currentImageBadge = document.getElementById('currentImageBadge');


    if (!imageInput) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | FOTO LAMA
    |--------------------------------------------------------------------------
    */

    const existingImage =
        @json(
            $product->image
                ? asset('storage/' . $product->image)
                : null
        );


    /*
    |--------------------------------------------------------------------------
    | PILIH FOTO BARU
    |--------------------------------------------------------------------------
    */

    imageInput.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI UKURAN
        |--------------------------------------------------------------------------
        */

        const maxSize = 2 * 1024 * 1024;

        if (file.size > maxSize) {

            alert('Ukuran foto maksimal 2 MB.');

            resetImageSelection();

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI FORMAT
        |--------------------------------------------------------------------------
        */

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        if (!allowedTypes.includes(file.type)) {

            alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');

            resetImageSelection();

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | PREVIEW FOTO BARU
        |--------------------------------------------------------------------------
        */

        const imageUrl =
            URL.createObjectURL(file);

        imagePreview.src =
            imageUrl;

        imagePreview.classList.remove(
            'hidden'
        );


        if (imagePlaceholder) {

            imagePlaceholder.classList.add(
                'hidden'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | SEMBUNYIKAN FOTO LAMA
        |--------------------------------------------------------------------------
        */

        if (currentImageBadge) {

            currentImageBadge.classList.add(
                'hidden'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | TOMBOL RESET
        |--------------------------------------------------------------------------
        */

        removeImageButton.classList.remove(
            'hidden'
        );

        removeImageButton.classList.add(
            'flex'
        );


        /*
        |--------------------------------------------------------------------------
        | NAMA FILE
        |--------------------------------------------------------------------------
        */

        imageFileName.textContent =
            'Foto baru dipilih: ' +
            file.name;

        imageFileName.classList.remove(
            'hidden'
        );

    });



    /*
    |--------------------------------------------------------------------------
    | RESET FOTO
    |--------------------------------------------------------------------------
    */

    removeImageButton?.addEventListener(
        'click',
        function () {

            resetImageSelection();

        }
    );



    /*
    |--------------------------------------------------------------------------
    | FUNGSI RESET
    |--------------------------------------------------------------------------
    */

    function resetImageSelection() {

        imageInput.value = '';

        imageFileName.textContent = '';

        imageFileName.classList.add(
            'hidden'
        );


        /*
        |--------------------------------------------------------------------------
        | JIKA ADA FOTO LAMA
        |--------------------------------------------------------------------------
        */

        if (existingImage) {

            imagePreview.src =
                existingImage;

            imagePreview.classList.remove(
                'hidden'
            );


            if (imagePlaceholder) {

                imagePlaceholder.classList.add(
                    'hidden'
                );

            }


            if (currentImageBadge) {

                currentImageBadge.classList.remove(
                    'hidden'
                );

            }


            removeImageButton.classList.remove(
                'hidden'
            );

            removeImageButton.classList.add(
                'flex'
            );

        } else {

            /*
            |--------------------------------------------------------------------------
            | JIKA TIDAK ADA FOTO LAMA
            |--------------------------------------------------------------------------
            */

            imagePreview.src = '';

            imagePreview.classList.add(
                'hidden'
            );


            if (imagePlaceholder) {

                imagePlaceholder.classList.remove(
                    'hidden'
                );

            }


            removeImageButton.classList.add(
                'hidden'
            );

            removeImageButton.classList.remove(
                'flex'
            );

        }

    }

});
</script>

@endpush

@endsection