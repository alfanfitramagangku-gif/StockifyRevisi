<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Stockify</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-b from-[#C1E8FF] via-[#5483B3] to-[#052659]">

    <div class="flex min-h-screen items-center justify-center p-4 sm:p-6 lg:p-8">

        {{-- =====================================================
             LOGIN CONTAINER
        ====================================================== --}}
        <div
            class="flex w-full max-w-6xl overflow-hidden rounded-3xl bg-white shadow-2xl">

            {{-- =====================================================
                 BAGIAN KIRI
            ====================================================== --}}
            <div
                class="relative hidden min-h-[650px] w-1/2 overflow-hidden bg-gradient-to-br from-[#021024] via-[#052659] to-[#5483B3] lg:flex">

                {{-- Dekorasi --}}
                <div
                    class="absolute -left-40 -top-40 h-[500px] w-[500px] rounded-full bg-[#C1E8FF]/10">
                </div>

                <div
                    class="absolute -bottom-48 -right-40 h-[500px] w-[500px] rounded-full bg-[#7DA0CA]/10">
                </div>

                <div
                    class="absolute left-20 top-24 h-32 w-32 rounded-full bg-[#5483B3]/20 blur-3xl">
                </div>

                <div
                    class="absolute bottom-24 right-20 h-40 w-40 rounded-full bg-[#C1E8FF]/10 blur-3xl">
                </div>

                {{-- Content kiri --}}
                <div
                    class="relative z-10 flex w-full flex-col items-center justify-center px-12 text-center">

                    {{-- Logo --}}
                    <div
                        class="mb-8 flex h-64 w-64 items-center justify-center rounded-full border border-[#C1E8FF]/10 bg-[#C1E8FF]/10 shadow-2xl backdrop-blur-sm">

                        <img
                            src="{{ asset('images/stockify-logo.png') }}"
                            alt="Stockify Logo"
                            class="h-52 w-52 object-contain drop-shadow-2xl"
                        >

                    </div>

                    {{-- Nama --}}
                    <h1
                        class="text-5xl font-bold tracking-wide text-[#C1E8FF]">
                        Stockify
                    </h1>

                    {{-- Deskripsi --}}
                    <p
                        class="mt-4 max-w-md text-sm leading-7 text-[#C1E8FF]/80">

                        Sistem Informasi Manajemen Persediaan
                        untuk membantu pengelolaan stok barang
                        menjadi lebih mudah dan teratur.

                    </p>

                    {{-- Garis --}}
                    <div
                        class="mt-8 h-1 w-16 rounded-full bg-[#C1E8FF]/80">
                    </div>

                </div>

            </div>

            {{-- =====================================================
                 BAGIAN KANAN
            ====================================================== --}}
            <div
                class="flex min-h-[650px] w-full items-center justify-center bg-white px-6 py-10 sm:px-10 lg:w-1/2 lg:px-16">

                <div class="w-full max-w-md">

                    {{-- =================================================
                         LOGO MOBILE
                    ================================================== --}}
                    <div class="mb-8 flex flex-col items-center lg:hidden">

                        <div
                            class="flex h-24 w-24 items-center justify-center rounded-2xl bg-gradient-to-br from-[#021024] via-[#052659] to-[#5483B3] p-3 shadow-xl">

                            <img
                                src="{{ asset('images/stockify-logo.png') }}"
                                alt="Stockify Logo"
                                class="h-full w-full object-contain"
                            >

                        </div>

                        <h1
                            class="mt-4 text-2xl font-bold text-[#052659]">
                            Stockify
                        </h1>

                    </div>

                    {{-- =================================================
                         HEADER
                    ================================================== --}}
                    <div class="mb-8">

                        <h2
                            class="text-3xl font-bold tracking-tight text-[#021024] sm:text-4xl">

                            Selamat Datang!

                        </h2>

                        <p
                            class="mt-2 text-sm leading-6 text-[#5483B3]">

                            Silakan masuk ke akun Anda untuk melanjutkan.

                        </p>

                    </div>

                    {{-- =================================================
                         ERROR
                    ================================================== --}}
                    @if ($errors->any())

                        <div
                            class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="mt-0.5 h-5 w-5 shrink-0"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.64h15.58a2 2 0 001.74-2.64l-7.82-14a2 2 0 00-3.48 0z" />

                            </svg>

                            <span>
                                {{ $errors->first() }}
                            </span>

                        </div>

                    @endif

                    {{-- =================================================
                         SUCCESS
                    ================================================== --}}
                    @if (session('success'))

                        <div
                            class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">

                            {{ session('success') }}

                        </div>

                    @endif

                    {{-- =================================================
                         FORM LOGIN
                    ================================================== --}}
                    <form
                        action="{{ route('login.process') }}"
                        method="POST"
                        class="space-y-5">

                        @csrf

                        {{-- =================================================
                             EMAIL
                        ================================================== --}}
                        <div>

                            <label
                                for="email"
                                class="mb-2 block text-sm font-semibold text-[#052659]">

                                Email

                            </label>

                            <div class="relative">

                                {{-- Icon --}}
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-[#5483B3]"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15a2.25 2.25 0 01-2.25-2.25V6.75M21.75 6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0l-8.69 6.037a2.25 2.25 0 01-2.62 0L2.25 6.75" />

                                    </svg>

                                </div>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Masukkan email"
                                    required
                                    autocomplete="email"
                                    class="w-full rounded-xl border border-[#7DA0CA] bg-[#C1E8FF]/60 py-3.5 pl-12 pr-4 text-sm text-[#021024] outline-none transition duration-200 placeholder:text-[#5483B3] focus:border-[#052659] focus:bg-white focus:ring-4 focus:ring-[#5483B3]/20"
                                >

                            </div>

                            @error('email')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        {{-- =================================================
                             PASSWORD
                        ================================================== --}}
                        <div>

                            <label
                                for="password"
                                class="mb-2 block text-sm font-semibold text-[#052659]">

                                Password

                            </label>

                            <div class="relative">

                                {{-- Icon --}}
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-[#5483B3]"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">

                                        <rect
                                            width="15"
                                            height="12"
                                            x="4.5"
                                            y="10"
                                            rx="2" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 10V7a4 4 0 018 0v3" />

                                    </svg>

                                </div>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan password"
                                    required
                                    autocomplete="current-password"
                                    class="w-full rounded-xl border border-[#7DA0CA] bg-[#C1E8FF]/60 py-3.5 pl-12 pr-12 text-sm text-[#021024] outline-none transition duration-200 placeholder:text-[#5483B3] focus:border-[#052659] focus:bg-white focus:ring-4 focus:ring-[#5483B3]/20"
                                >

                                {{-- Tombol lihat password --}}
                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-[#5483B3] transition hover:text-[#021024]"
                                    aria-label="Tampilkan password">

                                    <svg
                                        id="eyeIcon"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3" />

                                    </svg>

                                </button>

                            </div>

                            @error('password')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        {{-- =================================================
                             TOMBOL LOGIN
                        ================================================== --}}
                        <div class="pt-2">

                            <button
                                type="submit"
                                class="group flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#021024] via-[#052659] to-[#5483B3] py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#021024]/20 transition duration-200 hover:-translate-y-0.5 hover:from-[#052659] hover:to-[#5483B3] hover:shadow-xl">

                                <span>
                                    Masuk ke Stockify
                                </span>

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-1"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />

                                </svg>

                            </button>

                        </div>

                    </form>

                    {{-- =================================================
                         FOOTER
                    ================================================== --}}
                    <div
                        class="mt-10 text-center text-xs leading-6 text-[#7DA0CA]">

                        <p>
                            © {{ date('Y') }} Stockify
                        </p>

                        <p>
                            Inventory Management System
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- =====================================================
         JAVASCRIPT SHOW / HIDE PASSWORD
    ====================================================== --}}
    <script>

        function togglePassword() {

            const password =
                document.getElementById('password');

            const eyeIcon =
                document.getElementById('eyeIcon');

            if (password.type === 'password') {

                password.type = 'text';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.057 7.016 19 11.493 19c1.17 0 2.294-.204 3.328-.58" />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6.228 6.228A10.45 10.45 0 0111.493 5c4.478 0 8.268 2.943 9.542 7a10.5 10.5 0 01-4.043 5.178" />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 3l18 18" />
                `;

            } else {

                password.type = 'password';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                    <circle
                        cx="12"
                        cy="12"
                        r="3" />
                `;

            }

        }

    </script>

</body>

</html>