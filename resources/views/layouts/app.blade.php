<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $appName = \App\Models\Setting::where('key', 'app_name')->value('value')
            ?? 'Stockify';

        $appLogo = \App\Models\Setting::where('key', 'app_logo')->value('value');
    @endphp

    <title>{{ $title ?? $appName }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
</head>


<body class="bg-[#F5F9FC] text-[#021024]">

    {{-- =========================================================
         PEMBUNGKUS UTAMA
    ========================================================== --}}
    <div
        x-data="{
            sidebarOpen: false,
            sidebarCollapsed: false
        }"
        class="flex min-h-screen w-full overflow-x-hidden"
    >

        {{-- =====================================================
             OVERLAY MOBILE
        ====================================================== --}}
        <div
            x-show="sidebarOpen"
            x-cloak
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-[#021024]/60 backdrop-blur-sm lg:hidden"
        ></div>


        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}
        <aside
            :class="[
                sidebarOpen
                    ? 'translate-x-0'
                    : '-translate-x-full lg:translate-x-0',

                sidebarCollapsed
                    ? 'lg:w-[82px]'
                    : 'lg:w-[280px]'
            ]"

            class="app-sidebar fixed inset-y-0 left-0 z-50
                   flex h-screen w-[280px] max-w-[88vw] flex-shrink-0
                   -translate-x-full flex-col overflow-hidden
                   bg-gradient-to-b from-[#021024] via-[#052659] to-[#021024]
                   text-white shadow-[10px_0_40px_rgba(2,16,36,0.25)]
                   transition-all duration-300
                   lg:static lg:inset-auto lg:h-auto
                   lg:min-h-screen lg:translate-x-0"
        >

            {{-- =================================================
                 DECORASI BACKGROUND SIDEBAR
            ================================================== --}}

            <div
                class="pointer-events-none absolute -right-24 -top-24
                       h-64 w-64 rounded-full
                       bg-[#5483B3]/10 blur-3xl">
            </div>

            <div
                class="pointer-events-none absolute -bottom-32 -left-24
                       h-72 w-72 rounded-full
                       bg-[#7DA0CA]/10 blur-3xl">
            </div>


            {{-- =================================================
                 HEADER SIDEBAR
            ================================================== --}}
            <div
                class="relative z-10 flex h-20 flex-shrink-0
                       items-center justify-between
                       border-b border-[#C1E8FF]/10 px-4"
            >

                {{-- LOGO --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="flex min-w-0 items-center gap-3"
                >

                    <div
                        class="flex h-11 w-11 flex-shrink-0
                               items-center justify-center
                               overflow-hidden rounded-2xl
                               border border-[#C1E8FF]/20
                               bg-white shadow-lg"
                    >

                        @if ($appLogo)

                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($appLogo) }}"
                                alt="{{ $appName }}"
                                class="h-full w-full object-contain"
                            >

                        @else

                            <i
                                data-lucide="boxes"
                                class="h-6 w-6 text-[#052659]"
                            ></i>

                        @endif

                    </div>


                    {{-- NAMA APLIKASI --}}
                    <div
                        x-show="!sidebarCollapsed"
                        x-transition
                        class="min-w-0 whitespace-nowrap"
                    >

                        <h1
                            class="text-xl font-bold tracking-wide text-[#C1E8FF]"
                        >
                            {{ $appName }}
                        </h1>

                        <p class="text-[11px] text-[#7DA0CA]">
                            Inventory Management
                        </p>

                    </div>

                </a>


                {{-- BUTTON SIDEBAR --}}
                <div class="flex items-center gap-1">

                    {{-- COLLAPSE --}}
                    <button
                        type="button"
                        @click="sidebarCollapsed = !sidebarCollapsed"
                        class="hidden rounded-xl p-2
                               text-[#7DA0CA]
                               transition-all duration-200
                               hover:bg-[#5483B3]/20
                               hover:text-[#C1E8FF]
                               lg:block"
                        title="Perkecil atau perbesar sidebar"
                    >

                        <i
                            data-lucide="panel-left"
                            class="h-5 w-5"
                        ></i>

                    </button>


                    {{-- CLOSE MOBILE --}}
                    <button
                        type="button"
                        @click="sidebarOpen = false"
                        class="rounded-xl p-2
                               text-[#7DA0CA]
                               transition
                               hover:bg-[#5483B3]/20
                               hover:text-[#C1E8FF]
                               lg:hidden"
                    >

                        <i
                            data-lucide="x"
                            class="h-5 w-5"
                        ></i>

                    </button>

                </div>

            </div>


            {{-- =================================================
                 MENU
            ================================================== --}}
            <nav
                class="sidebar-menu relative z-10 flex-1
                       space-y-7 overflow-y-auto
                       overflow-x-hidden px-3 py-5"
            >

                {{-- =================================================
                     MENU UTAMA
                ================================================== --}}
                <div>

                    <p
                        x-show="!sidebarCollapsed"
                        x-transition
                        class="mb-3 px-3 text-[10px]
                               font-bold uppercase tracking-[0.18em]
                               text-[#7DA0CA]/70"
                    >
                        Menu Utama
                    </p>


                    <div class="space-y-1.5">

                        {{-- DASHBOARD --}}
                        <a
                            href="{{ route('dashboard') }}"
                            @click="sidebarOpen = false"
                            title="Dashboard"
                            class="menu-item
                                {{ request()->routeIs('dashboard')
                                    ? 'menu-active'
                                    : 'menu-normal' }}"
                            :class="sidebarCollapsed
                                ? 'lg:justify-center lg:px-2'
                                : ''"
                        >

                            <i
                                data-lucide="layout-dashboard"
                                class="menu-icon"
                            ></i>

                            <span
                                x-show="!sidebarCollapsed"
                                x-transition
                                class="menu-label"
                            >
                                Dashboard
                            </span>

                        </a>


                        {{-- PRODUK --}}
                        <a
                            href="{{ route('products.index') }}"
                            @click="sidebarOpen = false"
                            title="Produk"
                            class="menu-item
                                {{ request()->routeIs('products.*')
                                    ? 'menu-active'
                                    : 'menu-normal' }}"
                            :class="sidebarCollapsed
                                ? 'lg:justify-center lg:px-2'
                                : ''"
                        >

                            <i
                                data-lucide="package"
                                class="menu-icon"
                            ></i>

                            <span
                                x-show="!sidebarCollapsed"
                                x-transition
                                class="menu-label"
                            >
                                Produk
                            </span>

                        </a>


                        {{-- =================================================
                             KATEGORI
                             KHUSUS ADMIN
                        ================================================== --}}
                        @if (auth()->user()->role === 'admin')

                            <a
                                href="{{ route('categories.index') }}"
                                @click="sidebarOpen = false"
                                title="Kategori"
                                class="menu-item
                                    {{ request()->routeIs('categories.*')
                                        ? 'menu-active'
                                        : 'menu-normal' }}"
                                :class="sidebarCollapsed
                                    ? 'lg:justify-center lg:px-2'
                                    : ''"
                            >

                                <i
                                    data-lucide="layers"
                                    class="menu-icon"
                                ></i>

                                <span
                                    x-show="!sidebarCollapsed"
                                    x-transition
                                    class="menu-label"
                                >
                                    Kategori
                                </span>

                            </a>

                        @endif


                        {{-- =================================================
                             SUPPLIER
                             ADMIN + MANAGER
                        ================================================== --}}
                        @if (in_array(auth()->user()->role, ['admin', 'manager']))

                            <a
                                href="{{ route('suppliers.index') }}"
                                @click="sidebarOpen = false"
                                title="Supplier"
                                class="menu-item
                                    {{ request()->routeIs('suppliers.*')
                                        ? 'menu-active'
                                        : 'menu-normal' }}"
                                :class="sidebarCollapsed
                                    ? 'lg:justify-center lg:px-2'
                                    : ''"
                            >

                                <i
                                    data-lucide="truck"
                                    class="menu-icon"
                                ></i>

                                <span
                                    x-show="!sidebarCollapsed"
                                    x-transition
                                    class="menu-label"
                                >
                                    Supplier
                                </span>

                            </a>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     PERSEDIAAN
                ================================================== --}}
                <div>

                    <p
                        x-show="!sidebarCollapsed"
                        x-transition
                        class="mb-3 px-3 text-[10px]
                               font-bold uppercase tracking-[0.18em]
                               text-[#7DA0CA]/70"
                    >
                        Persediaan
                    </p>


                    <div class="space-y-1.5">

                        {{-- STOK MASUK --}}
                        <a
                            href="{{ route('stock-ins.index') }}"
                            @click="sidebarOpen = false"
                            title="Stok Masuk"
                            class="menu-item
                                {{ request()->routeIs('stock-ins.*')
                                    ? 'menu-active'
                                    : 'menu-normal' }}"
                            :class="sidebarCollapsed
                                ? 'lg:justify-center lg:px-2'
                                : ''"
                        >

                            <i
                                data-lucide="arrow-down-left"
                                class="menu-icon"
                            ></i>

                            <span
                                x-show="!sidebarCollapsed"
                                x-transition
                                class="menu-label"
                            >
                                Stok Masuk
                            </span>

                        </a>


                        {{-- STOK KELUAR --}}
                        <a
                            href="{{ route('stock-outs.index') }}"
                            @click="sidebarOpen = false"
                            title="Stok Keluar"
                            class="menu-item
                                {{ request()->routeIs('stock-outs.*')
                                    ? 'menu-active'
                                    : 'menu-normal' }}"
                            :class="sidebarCollapsed
                                ? 'lg:justify-center lg:px-2'
                                : ''"
                        >

                            <i
                                data-lucide="arrow-up-right"
                                class="menu-icon"
                            ></i>

                            <span
                                x-show="!sidebarCollapsed"
                                x-transition
                                class="menu-label"
                            >
                                Stok Keluar
                            </span>

                        </a>


                        {{-- STOCK OPNAME --}}
                        <a
                            href="{{ route('stock-opnames.index') }}"
                            @click="sidebarOpen = false"
                            title="Stock Opname"
                            class="menu-item
                                {{ request()->routeIs('stock-opnames.*')
                                    ? 'menu-active'
                                    : 'menu-normal' }}"
                            :class="sidebarCollapsed
                                ? 'lg:justify-center lg:px-2'
                                : ''"
                        >

                            <i
                                data-lucide="clipboard-check"
                                class="menu-icon"
                            ></i>

                            <span
                                x-show="!sidebarCollapsed"
                                x-transition
                                class="menu-label"
                            >
                                Stock Opname
                            </span>

                        </a>

                    </div>

                </div>


          {{-- =================================================
     ANALISIS
     LAPORAN : ADMIN + MANAGER
     AKTIVITAS : ADMIN SAJA
================================================== --}}

@if (in_array(auth()->user()->role, ['admin', 'manager']))

    <div>

        {{-- Judul Analisis --}}
        <p
            x-show="!sidebarCollapsed"
            x-transition
            class="mb-3 px-3 text-[10px]
                   font-bold uppercase tracking-[0.18em]
                   text-[#7DA0CA]/70"
        >
            Analisis
        </p>


        <div class="space-y-1.5">

                    {{-- =================================================
                        LAPORAN
                        ADMIN + MANAGER
                    ================================================== --}}
                    <a
                        href="{{ route('reports.index') }}"
                        @click="sidebarOpen = false"
                        title="Laporan"
                        class="menu-item
                            {{ request()->routeIs('reports.*')
                                ? 'menu-active'
                                : 'menu-normal' }}"
                        :class="sidebarCollapsed
                            ? 'lg:justify-center lg:px-2'
                            : ''"
                    >

                        <i
                            data-lucide="chart-no-axes-combined"
                            class="menu-icon"
                        ></i>


                        <span
                            x-show="!sidebarCollapsed"
                            x-transition
                            class="menu-label"
                        >
                            Laporan
                        </span>

                    </a>


                    {{-- =================================================
                        AKTIVITAS
                        ADMIN SAJA
                    ================================================== --}}
                    @if (auth()->user()->role === 'admin')

                        <a
                            href="{{ route('activities.index') }}"
                            @click="sidebarOpen = false"
                            title="Aktivitas"
                            class="menu-item
                                {{ request()->routeIs('activities.*')
                                    ? 'menu-active'
                                    : 'menu-normal' }}"
                            :class="sidebarCollapsed
                                ? 'lg:justify-center lg:px-2'
                                : ''"
                        >

                            <i
                                data-lucide="activity"
                                class="menu-icon"
                            ></i>


                            <span
                                x-show="!sidebarCollapsed"
                                x-transition
                                class="menu-label"
                            >
                                Aktivitas
                            </span>

                        </a>

                    @endif

                </div>

            </div>

        @endif



                {{-- =================================================
                     ADMINISTRASI
                     KHUSUS ADMIN
                ================================================== --}}
                @if (auth()->user()->role === 'admin')

                    <div>

                        <p
                            x-show="!sidebarCollapsed"
                            x-transition
                            class="mb-3 px-3 text-[10px]
                                   font-bold uppercase tracking-[0.18em]
                                   text-[#7DA0CA]/70"
                        >
                            Administrasi
                        </p>


                        <div class="space-y-1.5">

                            {{-- USER --}}
                            <a
                                href="{{ route('users.index') }}"
                                @click="sidebarOpen = false"
                                title="Manajemen Pengguna"
                                class="menu-item
                                    {{ request()->routeIs('users.*')
                                        ? 'menu-active'
                                        : 'menu-normal' }}"
                                :class="sidebarCollapsed
                                    ? 'lg:justify-center lg:px-2'
                                    : ''"
                            >

                                <i
                                    data-lucide="users"
                                    class="menu-icon"
                                ></i>

                                <span
                                    x-show="!sidebarCollapsed"
                                    x-transition
                                    class="menu-label"
                                >
                                    Manajemen Pengguna
                                </span>

                            </a>


                            {{-- PENGATURAN --}}
                            <a
                                href="{{ route('admin.settings.edit') }}"
                                @click="sidebarOpen = false"
                                title="Pengaturan"
                                class="menu-item
                                    {{ request()->routeIs('admin.settings.*')
                                        ? 'menu-active'
                                        : 'menu-normal' }}"
                                :class="sidebarCollapsed
                                    ? 'lg:justify-center lg:px-2'
                                    : ''"
                            >

                                <i
                                    data-lucide="settings"
                                    class="menu-icon"
                                ></i>

                                <span
                                    x-show="!sidebarCollapsed"
                                    x-transition
                                    class="menu-label"
                                >
                                    Pengaturan
                                </span>

                            </a>

                        </div>

                    </div>

                @endif

            </nav>


            {{-- =================================================
                 PROFILE USER
            ================================================== --}}
            <div
                class="relative z-10 flex-shrink-0
                       border-t border-[#C1E8FF]/10 p-3"
            >

                <div
                    class="group flex items-center gap-3
                           rounded-2xl
                           border border-[#C1E8FF]/10
                           bg-[#C1E8FF]/5
                           p-3
                           transition-all duration-200
                           hover:bg-[#5483B3]/15"
                    :class="sidebarCollapsed
                        ? 'lg:justify-center lg:p-2'
                        : ''"
                >

                    {{-- AVATAR --}}
                    <div
                        class="flex h-10 w-10 flex-shrink-0
                               items-center justify-center
                               rounded-xl
                               bg-gradient-to-br
                               from-[#5483B3]
                               to-[#7DA0CA]
                               text-sm font-bold
                               text-[#021024]
                               shadow-lg"
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>


                    {{-- USER INFO --}}
                    <div
                        x-show="!sidebarCollapsed"
                        x-transition
                        class="min-w-0 flex-1"
                    >

                        <p
                            class="truncate text-sm font-semibold text-[#C1E8FF]"
                        >
                            {{ auth()->user()->name }}
                        </p>

                        <p
                            class="mt-0.5 truncate text-[11px]
                                   capitalize text-[#7DA0CA]"
                        >
                            {{ auth()->user()->role }}
                        </p>

                    </div>


                    {{-- LOGOUT --}}
                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        x-show="!sidebarCollapsed"
                        x-transition
                    >

                        @csrf

                        <button
                            type="submit"
                            title="Keluar"
                            class="rounded-xl p-2
                                   text-[#7DA0CA]
                                   transition-all duration-200
                                   hover:bg-red-500/10
                                   hover:text-red-300"
                        >

                            <i
                                data-lucide="log-out"
                                class="h-5 w-5"
                            ></i>

                        </button>

                    </form>

                </div>

            </div>

        </aside>


        {{-- =====================================================
             KONTEN UTAMA
        ====================================================== --}}
        <div class="flex min-h-screen min-w-0 flex-1 flex-col">

            {{-- =================================================
                 TOPBAR
            ================================================== --}}
            <header
                class="sticky top-0 z-30 flex h-20 flex-shrink-0
                       items-center justify-between
                       border-b border-[#7DA0CA]/20
                       bg-white/90 px-4
                       shadow-sm backdrop-blur-xl
                       sm:px-6 lg:px-8"
            >

                <div class="flex min-w-0 items-center gap-3">

                    {{-- HAMBURGER --}}
                    <button
                        type="button"
                        @click="sidebarOpen = true"
                        class="rounded-xl
                               bg-[#C1E8FF]/60
                               p-3 text-[#052659]
                               transition
                               hover:bg-[#7DA0CA]/30
                               hover:text-[#021024]
                               lg:hidden"
                    >

                        <i
                            data-lucide="menu"
                            class="h-5 w-5"
                        ></i>

                    </button>


                    {{-- PAGE TITLE --}}
                    <div class="min-w-0">

                        <p class="truncate text-xs text-[#7DA0CA]">
                            Sistem Manajemen Inventaris
                        </p>

                        <h2
                            class="truncate text-lg font-bold
                                   text-[#021024]
                                   sm:text-xl"
                        >
                            {{ $pageTitle ?? 'Dashboard' }}
                        </h2>

                    </div>

                </div>


                {{-- USER TOPBAR --}}
                <div class="hidden items-center gap-3 sm:flex">

                    <div class="text-right">

                        <p class="text-sm font-semibold text-[#052659]">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs capitalize text-[#7DA0CA]">
                            {{ auth()->user()->role }}
                        </p>

                    </div>


                    <div
                        class="flex h-10 w-10 flex-shrink-0
                               items-center justify-center
                               rounded-xl
                               bg-gradient-to-br
                               from-[#052659]
                               to-[#5483B3]
                               font-bold text-[#C1E8FF]
                               shadow-sm"
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                </div>

            </header>


            {{-- =================================================
                 MAIN
            ================================================== --}}
            <main
                class="min-w-0 flex-1 overflow-x-hidden
                       p-4 sm:p-6 lg:p-8"
            >

                {{-- SUCCESS --}}
                @if (session('success'))

                    <div
                        class="mb-5 rounded-xl
                               border border-[#7DA0CA]/30
                               bg-[#C1E8FF]/50
                               px-4 py-3 text-sm
                               text-[#052659]"
                    >
                        {{ session('success') }}
                    </div>

                @endif


                {{-- ERROR --}}
                @if (session('error'))

                    <div
                        class="mb-5 rounded-xl
                               border border-red-200
                               bg-red-50
                               px-4 py-3
                               text-sm text-red-700"
                    >
                        {{ session('error') }}
                    </div>

                @endif


                {{-- CONTENT --}}
                <div class="w-full min-w-0">
                    @yield('content')
                </div>

            </main>

        </div>

    </div>


    {{-- =========================================================
         CSS SIDEBAR
    ========================================================== --}}
    <style>

        [x-cloak] {
            display: none !important;
        }

        html,
        body {
            min-height: 100%;
            margin: 0;
        }

        body {
            min-height: 100vh;
        }

        .app-sidebar {
            min-height: 100vh;
        }


        /* =====================================================
           MENU
        ====================================================== */

        .menu-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 14px;
            width: 100%;
            min-height: 48px;
            padding: 11px 14px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 500;
            transition:
                background-color 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease;
        }


        /* =====================================================
           MENU NORMAL
        ====================================================== */

        .menu-normal {
            color: rgba(193, 232, 255, 0.72);
        }

        .menu-normal:hover {
            color: #C1E8FF;
            background: rgba(84, 131, 179, 0.14);
            transform: translateX(2px);
        }


        /* =====================================================
           MENU ACTIVE
        ====================================================== */

        .menu-active {
            color: #C1E8FF;

            background:
                linear-gradient(
                    90deg,
                    rgba(84, 131, 179, 0.42),
                    rgba(84, 131, 179, 0.16)
                );

            box-shadow:
                inset 0 0 0 1px rgba(193, 232, 255, 0.08),
                0 8px 20px rgba(2, 16, 36, 0.12);
        }


        /* GARIS MENU AKTIF */

        .menu-active::before {
            content: "";

            position: absolute;
            left: 0;
            top: 10px;
            bottom: 10px;
            width: 3px;

            border-radius: 0 8px 8px 0;

            background: #C1E8FF;

            box-shadow:
                0 0 10px rgba(193, 232, 255, 0.55);
        }


        /* =====================================================
           ICON
        ====================================================== */

        .menu-icon {
            width: 20px;
            height: 20px;
            min-width: 20px;
            flex-shrink: 0;

            transition:
                transform 0.2s ease,
                color 0.2s ease;
        }

        .menu-item:hover .menu-icon {
            transform: scale(1.08);
        }


        /* =====================================================
           LABEL
        ====================================================== */

        .menu-label {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        /* =====================================================
           SIDEBAR SCROLLBAR
        ====================================================== */

        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(125, 160, 202, 0.25);
            border-radius: 20px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(193, 232, 255, 0.35);
        }


        /* =====================================================
           DESKTOP
        ====================================================== */

        @media (min-width: 1024px) {

            .app-sidebar {
                position: relative;
                height: auto !important;
                min-height: 100vh;
                align-self: stretch;
            }

        }


        /* =====================================================
           MOBILE
        ====================================================== */

        @media (max-width: 1023px) {

            .app-sidebar {
                position: fixed;
                width: 290px;
                max-width: 88vw;
                height: 100dvh;
                min-height: 100dvh;
            }

        }


        /* =====================================================
           TABLE
        ====================================================== */

        main table {
            max-width: 100%;
        }

        main .overflow-x-auto {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
        }


        /* =====================================================
           MOBILE MENU
        ====================================================== */

        @media (max-width: 640px) {

            .menu-item {
                min-height: 46px;
                padding: 11px 13px;
            }

            main {
                padding: 16px !important;
            }

        }

    </style>


    {{-- =========================================================
         LUCIDE
    ========================================================== --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

        });


        document.addEventListener('alpine:init', function () {

            setTimeout(function () {

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

            }, 300);

        });

    </script>


</body>

</html>