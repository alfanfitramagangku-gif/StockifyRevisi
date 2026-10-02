@extends('layouts.app')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('content')

<div class="min-h-screen bg-[#F5F9FC] px-4 py-6 md:px-6 lg:px-8">

    <div class="mx-auto max-w-4xl">

        {{-- HEADER --}}
        <div class="mb-6">

            {{-- Breadcrumb --}}
            <div class="mb-3 flex items-center gap-2 text-sm text-[#5483B3]">

                <i data-lucide="settings" class="h-4 w-4"></i>

                <span>Pengaturan</span>

                <i data-lucide="chevron-right"
                   class="h-4 w-4 text-[#7DA0CA]"></i>

                <span class="font-medium text-[#052659]">
                    Edit Pengguna
                </span>

            </div>


            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h1 class="text-2xl font-bold tracking-tight text-[#021024] md:text-3xl">
                        Edit Pengguna
                    </h1>

                    <p class="mt-1.5 text-sm text-slate-500">
                        Perbarui informasi akun pengguna Stockify.
                    </p>

                </div>


                {{-- USER BADGE --}}
                <div class="flex items-center gap-3 rounded-2xl border border-[#C1E8FF] bg-white px-4 py-3 shadow-sm">

                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#5483B3] to-[#7DA0CA] text-white shadow-sm">

                        <i data-lucide="user-cog" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-xs font-medium text-slate-400">
                            Akun Pengguna
                        </p>

                        <p class="max-w-[180px] truncate text-sm font-bold text-[#021024]">
                            {{ $user->name }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ERROR ALERT --}}
        @if ($errors->any())

            <div class="mb-6 overflow-hidden rounded-2xl border border-red-200 bg-white shadow-sm">

                <div class="flex items-start gap-3 bg-red-50 px-5 py-4">

                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">

                        <i data-lucide="circle-alert" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-sm font-bold text-red-700">
                            Terdapat kesalahan pada input
                        </p>

                        <ul class="mt-1.5 space-y-1 text-xs text-red-600">

                            @foreach ($errors->all() as $error)

                                <li class="flex items-start gap-2">

                                    <span class="mt-1 h-1.5 w-1.5 flex-shrink-0 rounded-full bg-red-500"></span>

                                    <span>{{ $error }}</span>

                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- FORM CARD --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            {{-- CARD HEADER --}}
            <div class="border-b border-slate-100 bg-gradient-to-r from-[#F1FAFF] via-white to-[#F8FBFF] px-6 py-5 md:px-8">

                <div class="flex items-center gap-4">

                    <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-[#C1E8FF] text-[#052659]">

                        <i data-lucide="user-round-cog" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-[#021024]">
                            Informasi Pengguna
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Perbarui data akun pengguna sesuai kebutuhan.
                        </p>

                    </div>

                </div>

            </div>


            {{-- FORM --}}
            <form action="{{ route('users.update', $user) }}"
                  method="POST"
                  class="p-6 md:p-8">

                @csrf
                @method('PUT')


                {{-- DATA AKUN --}}
                <div>

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#5483B3]"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Data Akun
                            </h3>

                            <p class="text-xs text-slate-400">
                                Perbarui informasi dasar pengguna
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- NAMA --}}
                        <div class="md:col-span-2">

                            <label for="name"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="user"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Nama Lengkap
                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <i data-lucide="user"
                                   class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]">
                                </i>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-[#F8FBFF] py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition hover:border-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/60"
                                >

                            </div>


                            @error('name')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>


                        {{-- EMAIL --}}
                        <div>

                            <label for="email"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="mail"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Email
                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <i data-lucide="mail"
                                   class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]">
                                </i>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="contoh@email.com"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-[#F8FBFF] py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition hover:border-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/60"
                                >

                            </div>


                            @error('email')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>


                        {{-- ROLE --}}
                        <div>

                            <label for="role"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="shield-check"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Role Pengguna
                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <select
                                    id="role"
                                    name="role"
                                    required
                                    class="w-full appearance-none rounded-xl border border-slate-200 bg-[#F8FBFF] px-4 py-3 pr-10 text-sm text-slate-700 outline-none transition hover:border-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/60"
                                >

                                    <option value="admin"
                                        {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="manager"
                                        {{ old('role', $user->role) === 'manager' ? 'selected' : '' }}>
                                        Manager
                                    </option>

                                    <option value="staff"
                                        {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>
                                        Staff
                                    </option>

                                </select>


                                <i data-lucide="chevron-down"
                                   class="pointer-events-none absolute right-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#5483B3]">
                                </i>

                            </div>


                            @error('role')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- PASSWORD SECTION --}}
                <div class="mt-8 border-t border-slate-100 pt-7">

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#5483B3]"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Keamanan Akun
                            </h3>

                            <p class="text-xs text-slate-400">
                                Ubah password jika diperlukan
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- PASSWORD BARU --}}
                        <div>

                            <label for="password"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="lock"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Password Baru

                                <span class="font-normal text-slate-400">
                                    (Opsional)
                                </span>

                            </label>


                            <div class="relative">

                                <i data-lucide="lock"
                                   class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]">
                                </i>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Kosongkan jika tidak diubah"
                                    class="w-full rounded-xl border border-slate-200 bg-[#F8FBFF] py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition hover:border-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/60"
                                >

                            </div>


                            @error('password')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}
                        <div>

                            <label for="password_confirmation"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="shield"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Konfirmasi Password Baru

                            </label>


                            <div class="relative">

                                <i data-lucide="shield-check"
                                   class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]">
                                </i>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Ulangi password baru"
                                    class="w-full rounded-xl border border-slate-200 bg-[#F8FBFF] py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition hover:border-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/60"
                                >

                            </div>


                            @error('password_confirmation')

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- PASSWORD INFO --}}
                    <div class="mt-5 flex items-start gap-3 rounded-2xl border border-[#C1E8FF] bg-[#F1FAFF] px-4 py-3">

                        <i data-lucide="info"
                           class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#5483B3]">
                        </i>

                        <p class="text-xs leading-relaxed text-slate-500">
                            Password bersifat opsional. Kosongkan kedua kolom
                            password jika tidak ingin mengubah password pengguna.
                        </p>

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('users.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 active:scale-[0.98]"
                    >

                        <i data-lucide="arrow-left"
                           class="h-4 w-4"></i>

                        Batal

                    </a>


                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#052659] to-[#5483B3] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-[#052659]/20 transition duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-[#052659]/25 active:translate-y-0"
                    >

                        <i data-lucide="save"
                           class="h-4 w-4"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>


        {{-- FOOTER INFO --}}
        <div class="mt-4 flex items-start gap-3 rounded-2xl border border-[#C1E8FF] bg-[#F1FAFF] px-4 py-3">

            <i data-lucide="info"
               class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#5483B3]">
            </i>

            <p class="text-xs leading-relaxed text-slate-500">
                Pastikan perubahan data pengguna sudah sesuai sebelum
                menyimpan perubahan akun.
            </p>

        </div>

    </div>

</div>

@endsection