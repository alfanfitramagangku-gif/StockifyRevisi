@extends('layouts.app')

@section('title', 'Stock Opname')
@section('page-title', 'Stock Opname')

@section('content')

@php
    $isStaff = auth()->user()->role === 'staff';
@endphp


<div class="min-h-screen bg-[#F5F9FC] px-4 py-6 md:px-6 lg:px-8">

    <div class="mx-auto max-w-4xl">


        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="mb-6">

            <div class="mb-3 flex items-center gap-2 text-sm text-[#5483B3]">

                <i data-lucide="clipboard-check"
                   class="h-4 w-4"></i>

                <span>
                    Persediaan
                </span>

                <i data-lucide="chevron-right"
                   class="h-4 w-4 text-[#7DA0CA]">
                </i>

                <span class="font-medium text-[#052659]">
                    {{ $isStaff ? 'Pemeriksaan Stock Opname' : 'Tambah Stock Opname' }}
                </span>

            </div>


            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h1 class="text-2xl font-bold tracking-tight text-[#021024] md:text-3xl">

                        {{ $isStaff ? 'Pemeriksaan Stock Opname' : 'Tambah Stock Opname' }}

                    </h1>

                    <p class="mt-1.5 text-sm text-slate-500">

                        {{ $isStaff
                            ? 'Masukkan hasil pengecekan stok fisik barang di gudang.'
                            : 'Catat hasil pengecekan stok fisik barang.'
                        }}

                    </p>

                </div>


                {{-- ROLE BADGE --}}
                <div class="flex items-center gap-3 rounded-2xl border border-[#C1E8FF] bg-white px-4 py-3 shadow-sm">

                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#5483B3] to-[#7DA0CA] text-white shadow-sm">

                        <i data-lucide="{{ $isStaff ? 'scan-search' : 'clipboard-check' }}"
                           class="h-5 w-5">
                        </i>

                    </div>

                    <div>

                        <p class="text-xs font-medium text-slate-400">

                            {{ $isStaff ? 'Staff Gudang' : 'Transaksi Baru' }}

                        </p>

                        <p class="text-sm font-bold text-[#021024]">

                            {{ $isStaff ? 'Pemeriksaan Stok' : 'Stock Opname' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            ERROR
        ====================================================== --}}

        @if ($errors->any())

            <div class="mb-6 overflow-hidden rounded-2xl border border-red-200 bg-white shadow-sm">

                <div class="flex items-start gap-3 bg-red-50 px-5 py-4">

                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">

                        <i data-lucide="circle-alert"
                           class="h-5 w-5">
                        </i>

                    </div>

                    <div>

                        <p class="text-sm font-bold text-red-700">
                            Terjadi kesalahan
                        </p>

                        <ul class="mt-1.5 space-y-1 text-xs text-red-600">

                            @foreach ($errors->all() as $error)

                                <li class="flex items-start gap-2">

                                    <span class="mt-1 h-1.5 w-1.5 flex-shrink-0 rounded-full bg-red-500">
                                    </span>

                                    <span>
                                        {{ $error }}
                                    </span>

                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =====================================================
            FORM CARD
        ====================================================== --}}

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


            {{-- HEADER CARD --}}
            <div class="border-b border-slate-100 bg-gradient-to-r from-[#F1FAFF] via-white to-[#F8FBFF] px-6 py-5 md:px-8">

                <div class="flex items-center gap-4">

                    <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-[#C1E8FF] text-[#052659]">

                        <i data-lucide="clipboard-list"
                           class="h-5 w-5">
                        </i>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-[#021024]">

                            {{ $isStaff
                                ? 'Hasil Pemeriksaan Stok'
                                : 'Informasi Stock Opname'
                            }}

                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">

                            Masukkan jumlah stok yang benar-benar tersedia secara fisik di gudang.

                        </p>

                    </div>

                </div>

            </div>


            {{-- FORM --}}
            <form action="{{ route('stock-opnames.store') }}"
                  method="POST"
                  class="p-6 md:p-8">

                @csrf


                {{-- =================================================
                    DETAIL PEMERIKSAAN
                ================================================== --}}

                <div>

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#5483B3]">
                        </div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">

                                Detail Pemeriksaan

                            </h3>

                            <p class="text-xs text-slate-400">

                                Isi berdasarkan hasil pengecekan langsung di gudang.

                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- PRODUK --}}
                        <div class="md:col-span-2">

                            <label for="product_id"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="package"
                                   class="h-4 w-4 text-[#5483B3]">
                                </i>

                                Produk

                                <span class="text-red-500">
                                    *
                                </span>

                            </label>


                            <div class="relative">

                                <select name="product_id"
                                        id="product_id"
                                        required
                                        class="w-full appearance-none rounded-xl border border-slate-200 bg-[#F8FBFF] px-4 py-3 pr-10 text-sm text-slate-700 outline-none transition hover:border-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/60">

                                    <option value="">
                                        -- Pilih Produk --
                                    </option>


                                    @foreach ($products as $product)

                                        <option value="{{ $product->id }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>

                                            {{ $product->name }}
                                            —
                                            Stok Sistem:
                                            {{ $product->stock }}

                                        </option>

                                    @endforeach

                                </select>


                                <i data-lucide="chevron-down"
                                   class="pointer-events-none absolute right-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#5483B3]">
                                </i>

                            </div>


                            @error('product_id')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5">
                                    </i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>


                        {{-- STOK FISIK --}}
                        <div>

                            <label for="physical_stock"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="boxes"
                                   class="h-4 w-4 text-[#5483B3]">
                                </i>

                                Stok Fisik

                                <span class="text-red-500">
                                    *
                                </span>

                            </label>


                            <div class="relative">

                                <input type="number"
                                       name="physical_stock"
                                       id="physical_stock"
                                       min="0"
                                       value="{{ old('physical_stock') }}"
                                       required
                                       placeholder="Masukkan jumlah fisik"
                                       class="w-full rounded-xl border border-slate-200 bg-[#F8FBFF] px-4 py-3 pr-16 text-sm text-slate-700 outline-none transition hover:border-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/60">

                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-medium text-slate-400">

                                    unit

                                </span>

                            </div>


                            <p class="mt-1.5 text-xs text-slate-400">

                                Masukkan jumlah barang yang benar-benar ditemukan di gudang.

                            </p>


                            @error('physical_stock')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5">
                                    </i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>


                        {{-- TANGGAL --}}
                        <div>

                            <label for="date"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="calendar-days"
                                   class="h-4 w-4 text-[#5483B3]">
                                </i>

                                Tanggal Pemeriksaan

                                <span class="text-red-500">
                                    *
                                </span>

                            </label>


                            <input type="date"
                                   name="date"
                                   id="date"
                                   value="{{ old('date', date('Y-m-d')) }}"
                                   required
                                   class="w-full rounded-xl border border-slate-200 bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700 outline-none transition hover:border-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/60">


                            @error('date')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5">
                                    </i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>


                        {{-- KETERANGAN --}}
                        <div class="md:col-span-2">

                            <label for="description"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="align-left"
                                   class="h-4 w-4 text-[#5483B3]">
                                </i>

                                Keterangan

                            </label>


                            <textarea name="description"
                                      id="description"
                                      rows="5"
                                      placeholder="Contoh: Ditemukan 2 barang rusak atau stok sesuai hasil pengecekan."
                                      class="w-full resize-none rounded-xl border border-slate-200 bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700 outline-none transition hover:border-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/60">{{ old('description') }}</textarea>


                            @error('description')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5">
                                    </i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    INFO
                ================================================== --}}

                <div class="mt-6 flex items-start gap-3 rounded-2xl border border-[#C1E8FF] bg-[#F1FAFF] px-4 py-3">

                    <i data-lucide="info"
                       class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#5483B3]">
                    </i>

                    <p class="text-xs leading-relaxed text-slate-500">

                        Sistem akan membandingkan stok fisik dengan stok sistem
                        untuk menghitung selisih. Stok produk belum akan berubah
                        sampai hasil Stock Opname dikonfirmasi oleh Staff Gudang.

                    </p>

                </div>


                {{-- =================================================
                    BUTTON
                ================================================== --}}

                <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">


                    <a href="{{ route('stock-opnames.index') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 active:scale-[0.98]">

                        <i data-lucide="arrow-left"
                           class="h-4 w-4">
                        </i>

                        Batal

                    </a>


                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#052659] to-[#5483B3] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-[#052659]/20 transition duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-[#052659]/25 active:translate-y-0">

                        <i data-lucide="save"
                           class="h-4 w-4">
                        </i>

                        {{ $isStaff
                            ? 'Simpan Hasil Pemeriksaan'
                            : 'Simpan Stock Opname'
                        }}

                    </button>

                </div>

            </form>

        </div>


        {{-- =====================================================
            INFO BAWAH
        ====================================================== --}}

        <div class="mt-4 flex items-start gap-3 rounded-2xl border border-[#C1E8FF] bg-[#F1FAFF] px-4 py-3">

            <i data-lucide="clipboard-check"
               class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#5483B3]">
            </i>

            <p class="text-xs leading-relaxed text-slate-500">

                {{ $isStaff
                    ? 'Setelah hasil pengecekan disimpan, periksa kembali data sebelum melakukan konfirmasi Stock Opname.'
                    : 'Hasil pemeriksaan yang sudah disimpan akan menunggu proses pemeriksaan dan konfirmasi Staff Gudang.'
                }}

            </p>

        </div>

    </div>

</div>


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