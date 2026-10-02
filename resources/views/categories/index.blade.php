@extends('layouts.app')

@section('title', 'Kategori')

@section('page-title', 'Kategori')

@section('content')

<div class="min-h-screen bg-[#F5F9FC]">

    <div class="space-y-6">

        {{-- =========================================================
             HEADER HALAMAN
        ========================================================== --}}
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>

                {{-- BREADCRUMB --}}
                <div class="mb-3 flex items-center gap-2 text-sm">

                    <div
                        class="flex h-8 w-8 items-center justify-center
                               rounded-lg bg-[#C1E8FF] text-[#052659]"
                    >

                        <i
                            data-lucide="layers"
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
                        Kategori
                    </span>

                </div>


                {{-- JUDUL --}}
                <h1
                    class="text-3xl font-bold tracking-tight
                           text-[#021024] md:text-4xl"
                >
                    Data Kategori
                </h1>


                {{-- DESKRIPSI --}}
                <p
                    class="mt-2 text-sm font-medium
                           text-[#5483B3]"
                >
                    Kelola kategori produk agar data inventaris
                    lebih terorganisir.
                </p>

            </div>


            {{-- =====================================================
                 TOMBOL TAMBAH
            ====================================================== --}}
            <a
                href="{{ route('categories.create') }}"
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

                Tambah Kategori

            </a>

        </div>


        {{-- =========================================================
             NOTIFIKASI SUCCESS
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
                           justify-center rounded-xl
                           bg-[#C1E8FF]"
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

                    <p
                        class="mt-1 text-sm font-medium
                               text-[#5483B3]"
                    >
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- =========================================================
             RINGKASAN
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">


            {{-- TOTAL KATEGORI --}}
            <div
                class="group rounded-3xl
                       border border-[#D9E4EE]
                       bg-white p-5 shadow-sm
                       transition duration-300
                       hover:-translate-y-1
                       hover:shadow-lg"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p
                            class="text-sm font-semibold
                                   text-[#5483B3]"
                        >
                            Total Kategori
                        </p>

                        <h3
                            class="mt-2 text-3xl font-bold
                                   tracking-tight
                                   text-[#021024]"
                        >
                            {{ $categories->count() }}
                        </h3>

                        <p
                            class="mt-1 text-xs font-medium
                                   text-[#7DA0CA]"
                        >
                            Kategori yang tersedia
                        </p>

                    </div>


                    <div
                        class="flex h-12 w-12 items-center
                               justify-center rounded-2xl
                               bg-[#E8F7FF]
                               text-[#052659]
                               transition duration-300
                               group-hover:scale-110"
                    >

                        <i
                            data-lucide="layers"
                            class="h-6 w-6"
                        ></i>

                    </div>

                </div>

            </div>


            {{-- INFORMASI --}}
            <div
                class="group rounded-3xl
                       border border-[#D9E4EE]
                       bg-white p-5 shadow-sm
                       transition duration-300
                       hover:-translate-y-1
                       hover:shadow-lg"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p
                            class="text-sm font-semibold
                                   text-[#5483B3]"
                        >
                            Pengelolaan Kategori
                        </p>

                        <h3
                            class="mt-2 text-xl font-bold
                                   tracking-tight
                                   text-[#052659]"
                        >
                            Data Terorganisir
                        </h3>

                        <p
                            class="mt-1 text-xs font-medium
                                   text-[#7DA0CA]"
                        >
                            Memudahkan pengelompokan produk
                        </p>

                    </div>


                    <div
                        class="flex h-12 w-12 items-center
                               justify-center rounded-2xl
                               bg-[#E8F7FF]
                               text-[#052659]
                               transition duration-300
                               group-hover:scale-110"
                    >

                        <i
                            data-lucide="folder-tree"
                            class="h-6 w-6"
                        ></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             CARD DAFTAR KATEGORI
        ========================================================== --}}
        <div
            class="overflow-hidden rounded-3xl
                   border border-[#D9E4EE]
                   bg-white shadow-sm"
        >

            {{-- HEADER CARD --}}
            <div
                class="border-b border-[#D9E4EE]
                       bg-white px-5 py-5 md:px-6"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center
                               justify-center rounded-xl
                               bg-[#E8F7FF]
                               text-[#052659]"
                    >

                        <i
                            data-lucide="list"
                            class="h-5 w-5"
                        ></i>

                    </div>


                    <div>

                        <h2
                            class="text-lg font-bold
                                   text-[#021024]"
                        >
                            Daftar Kategori
                        </h2>

                        <p
                            class="mt-1 text-sm font-medium
                                   text-[#64748B]"
                        >
                            Daftar kategori produk yang tersedia
                            dalam sistem Stockify.
                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 TABEL
            ====================================================== --}}
            <div class="overflow-x-auto">

                <table class="min-w-full text-left text-sm">

                    {{-- HEADER TABEL --}}
                    <thead class="bg-[#F5F9FC]">

                        <tr
                            class="border-b border-[#D9E4EE]"
                        >

                            <th
                                class="px-6 py-4 text-xs
                                       font-bold uppercase
                                       tracking-wider
                                       text-[#475569]"
                            >
                                No
                            </th>

                            <th
                                class="px-6 py-4 text-xs
                                       font-bold uppercase
                                       tracking-wider
                                       text-[#475569]"
                            >
                                Nama Kategori
                            </th>

                            <th
                                class="px-6 py-4 text-xs
                                       font-bold uppercase
                                       tracking-wider
                                       text-[#475569]"
                            >
                                Deskripsi
                            </th>

                            <th
                                class="px-6 py-4 text-center
                                       text-xs font-bold
                                       uppercase tracking-wider
                                       text-[#475569]"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    {{-- BODY --}}
                    <tbody class="divide-y divide-[#EDF2F7]">

                        @forelse ($categories as $category)

                            <tr
                                class="group transition duration-200
                                       hover:bg-[#F8FBFE]"
                            >

                                {{-- NOMOR --}}
                                <td
                                    class="whitespace-nowrap
                                           px-6 py-5
                                           text-sm font-semibold
                                           text-[#64748B]"
                                >

                                    {{ $loop->iteration }}

                                </td>


                                {{-- NAMA KATEGORI --}}
                                <td class="px-6 py-5">

                                    <div
                                        class="flex items-center gap-3"
                                    >

                                        <div
                                            class="flex h-11 w-11
                                                   shrink-0
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-gradient-to-br
                                                   from-[#021024]
                                                   to-[#5483B3]
                                                   font-bold
                                                   uppercase
                                                   text-[#C1E8FF]
                                                   shadow-sm"
                                        >

                                            {{ substr($category->name, 0, 1) }}

                                        </div>


                                        <div>

                                            <p
                                                class="font-bold
                                                       text-[#021024]"
                                            >
                                                {{ $category->name }}
                                            </p>

                                            <p
                                                class="mt-1 text-xs
                                                       font-medium
                                                       text-[#7DA0CA]"
                                            >
                                                Kategori Produk
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- DESKRIPSI --}}
                                <td
                                    class="max-w-md px-6 py-5"
                                >

                                    @if($category->description)

                                        <p
                                            class="line-clamp-2
                                                   text-sm font-medium
                                                   leading-6
                                                   text-[#475569]"
                                        >
                                            {{ $category->description }}
                                        </p>

                                    @else

                                        <span
                                            class="inline-flex
                                                   items-center
                                                   rounded-full
                                                   border
                                                   border-[#D9E4EE]
                                                   bg-[#F8FAFC]
                                                   px-3 py-1.5
                                                   text-xs font-semibold
                                                   text-[#7DA0CA]"
                                        >
                                            Tidak ada deskripsi
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="px-6 py-5">

                                    <div
                                        class="flex items-center
                                               justify-center gap-2"
                                    >

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('categories.edit', $category) }}"
                                            title="Edit Kategori"
                                            class="inline-flex
                                                   items-center
                                                   gap-2 rounded-xl
                                                   border
                                                   border-[#C1E8FF]
                                                   bg-[#F1FAFF]
                                                   px-3 py-2
                                                   text-xs font-bold
                                                   text-[#052659]
                                                   transition duration-200
                                                   hover:bg-[#C1E8FF]"
                                        >

                                            <i
                                                data-lucide="pencil"
                                                class="h-4 w-4"
                                            ></i>

                                            Edit

                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('categories.destroy', $category) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Hapus Kategori"
                                                class="inline-flex
                                                       items-center
                                                       gap-2 rounded-xl
                                                       border
                                                       border-red-200
                                                       bg-red-50
                                                       px-3 py-2
                                                       text-xs font-bold
                                                       text-red-700
                                                       transition
                                                       duration-200
                                                       hover:bg-red-100"
                                            >

                                                <i
                                                    data-lucide="trash-2"
                                                    class="h-4 w-4"
                                                ></i>

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            {{-- EMPTY STATE --}}
                            <tr>

                                <td
                                    colspan="4"
                                    class="px-6 py-16 text-center"
                                >

                                    <div
                                        class="mx-auto flex h-16 w-16
                                               items-center
                                               justify-center
                                               rounded-2xl
                                               bg-[#E8F7FF]"
                                    >

                                        <i
                                            data-lucide="folder-open"
                                            class="h-8 w-8
                                                   text-[#7DA0CA]"
                                        ></i>

                                    </div>


                                    <h3
                                        class="mt-4 font-bold
                                               text-[#334155]"
                                    >
                                        Belum Ada Kategori
                                    </h3>


                                    <p
                                        class="mx-auto mt-1 max-w-md
                                               text-sm font-medium
                                               text-[#7DA0CA]"
                                    >
                                        Belum ada kategori produk
                                        yang tersimpan dalam sistem.
                                    </p>


                                    <a
                                        href="{{ route('categories.create') }}"
                                        class="mt-5 inline-flex
                                               items-center gap-2
                                               rounded-xl
                                               bg-[#021024]
                                               px-4 py-2.5
                                               text-sm font-bold
                                               text-white
                                               transition
                                               hover:bg-[#052659]"
                                    >

                                        <i
                                            data-lucide="plus"
                                            class="h-4 w-4"
                                        ></i>

                                        Tambah Kategori

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection