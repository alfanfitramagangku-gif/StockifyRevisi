@extends('layouts.app')

@section('title', 'Tambah Supplier')
@section('page-title', 'Tambah Supplier')

@section('content')

<div class="min-h-screen bg-[#F5F9FC] px-4 py-6 md:px-6 lg:px-8">

    <div class="mx-auto max-w-4xl">

        {{-- =========================================================
             HEADER
        ========================================================== --}}
        <div class="mb-6">

            {{-- Breadcrumb --}}
            <div class="mb-3 flex items-center gap-2 text-sm text-[#5483B3]">

                <i data-lucide="truck" class="h-4 w-4"></i>

                <span>Manajemen Inventaris</span>

                <i data-lucide="chevron-right"
                   class="h-4 w-4 text-[#7DA0CA]"></i>

                <span class="font-medium text-[#052659]">
                    Tambah Supplier
                </span>

            </div>


            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h1 class="text-2xl font-bold tracking-tight text-[#021024] md:text-3xl">
                        Tambah Supplier
                    </h1>

                    <p class="mt-1.5 text-sm text-slate-500">
                        Tambahkan supplier baru ke dalam sistem Stockify.
                    </p>

                </div>


                {{-- Header Badge --}}
                <div class="flex items-center gap-3 rounded-2xl border border-[#C1E8FF]
                            bg-white px-4 py-3 shadow-sm">

                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center
                                rounded-xl bg-gradient-to-br from-[#5483B3] to-[#7DA0CA]
                                text-white shadow-sm">

                        <i data-lucide="truck" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-xs font-medium text-slate-400">
                            Data Baru
                        </p>

                        <p class="text-sm font-bold text-[#021024]">
                            Supplier
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

                        <i data-lucide="building-2" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-[#021024]">
                            Informasi Supplier
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Masukkan informasi supplier yang ingin ditambahkan.
                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 FORM
            ====================================================== --}}
            <form action="{{ route('suppliers.store') }}"
                  method="POST"
                  class="p-6 md:p-8">

                @csrf


                {{-- =================================================
                     INFORMASI SUPPLIER
                ================================================== --}}
                <div>

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#5483B3]"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Data Supplier
                            </h3>

                            <p class="text-xs text-slate-400">
                                Isi informasi dasar supplier
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- Nama Supplier --}}
                        <div class="md:col-span-2">

                            <label for="name"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="building-2"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Nama Supplier

                                <span class="text-red-500">*</span>

                            </label>


                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama supplier"
                                required
                                class="w-full rounded-xl border border-slate-200
                                       bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                       outline-none transition
                                       hover:border-[#7DA0CA]
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4 focus:ring-[#C1E8FF]/60"
                            >


                            @error('name')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>


                        {{-- Nomor Telepon --}}
                        <div>

                            <label for="phone"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="phone"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Nomor Telepon

                            </label>


                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                value="{{ old('phone') }}"
                                placeholder="Masukkan nomor telepon"
                                class="w-full rounded-xl border border-slate-200
                                       bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                       outline-none transition
                                       hover:border-[#7DA0CA]
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4 focus:ring-[#C1E8FF]/60"
                            >


                            @error('phone')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>


                        {{-- Alamat --}}
                        <div>

                            <label for="address"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="map-pin"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Alamat

                            </label>


                            <textarea
                                name="address"
                                id="address"
                                rows="1"
                                placeholder="Masukkan alamat supplier"
                                class="min-h-[50px] w-full resize-none rounded-xl
                                       border border-slate-200 bg-[#F8FBFF]
                                       px-4 py-3 text-sm text-slate-700
                                       outline-none transition
                                       hover:border-[#7DA0CA]
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4 focus:ring-[#C1E8FF]/60"
                            >{{ old('address') }}</textarea>


                            @error('address')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>


                        {{-- Keterangan --}}
                        <div class="md:col-span-2">

                            <label for="description"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="align-left"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Keterangan

                            </label>


                            <textarea
                                name="description"
                                id="description"
                                rows="5"
                                placeholder="Masukkan keterangan tambahan"
                                class="w-full resize-none rounded-xl border border-slate-200
                                       bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                       outline-none transition
                                       hover:border-[#7DA0CA]
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4 focus:ring-[#C1E8FF]/60"
                            >{{ old('description') }}</textarea>


                            @error('description')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     BUTTON
                ================================================== --}}
                <div class="mt-8 flex flex-col-reverse gap-3
                            border-t border-slate-100 pt-6
                            sm:flex-row sm:justify-end">

                    {{-- Batal --}}
                    <a href="{{ route('suppliers.index') }}"
                       class="inline-flex items-center justify-center gap-2
                              rounded-xl border border-slate-200 bg-white
                              px-5 py-3 text-sm font-semibold text-slate-600
                              shadow-sm transition
                              hover:border-slate-300 hover:bg-slate-50
                              active:scale-[0.98]">

                        <i data-lucide="arrow-left" class="h-4 w-4"></i>

                        Batal

                    </a>


                    {{-- Simpan --}}
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2
                               rounded-xl
                               bg-gradient-to-r from-[#052659] to-[#5483B3]
                               px-6 py-3 text-sm font-semibold text-white
                               shadow-lg shadow-[#052659]/20
                               transition duration-200
                               hover:-translate-y-0.5
                               hover:shadow-xl hover:shadow-[#052659]/25
                               active:translate-y-0">

                        <i data-lucide="save" class="h-4 w-4"></i>

                        Simpan Supplier

                    </button>

                </div>

            </form>

        </div>


        {{-- =========================================================
             FOOTER INFO
        ========================================================== --}}
        <div class="mt-4 flex items-start gap-3 rounded-2xl
                    border border-[#C1E8FF]
                    bg-[#F1FAFF] px-4 py-3">

            <i data-lucide="info"
               class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#5483B3]">
            </i>

            <p class="text-xs leading-relaxed text-slate-500">
                Pastikan informasi supplier yang dimasukkan sudah benar.
                Data supplier akan digunakan dalam pencatatan transaksi
                stok masuk di Stockify.
            </p>

        </div>

    </div>

</div>

@endsection