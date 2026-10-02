@extends('layouts.app')

@section('title', 'Aktivitas')
@section('page-title', 'Aktivitas Pengguna')

@section('content')

@php

    $totalActivities = isset($activities)
        ? $activities->count()
        : 0;

@endphp


<div class="min-h-screen bg-[#F5F9FC] px-4 py-5 sm:px-6 lg:px-8">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="mb-6">

        {{-- Breadcrumb --}}
        <div class="mb-3 flex items-center gap-2 text-xs sm:text-sm">

            <span class="flex items-center gap-1.5 text-[#5483B3]">
                <i
                    data-lucide="layout-dashboard"
                    class="h-4 w-4">
                </i>

                Dashboard
            </span>

            <i
                data-lucide="chevron-right"
                class="h-4 w-4 text-[#A8C4DC]">
            </i>

            <span class="font-semibold text-[#052659]">
                Aktivitas
            </span>

        </div>


        {{-- Header Content --}}
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">

            <div class="min-w-0">

                {{-- Label --}}
                <div class="mb-2 inline-flex items-center gap-2 rounded-full border border-[#C1E8FF] bg-white px-3 py-1.5 text-[11px] font-bold text-[#052659] shadow-sm">

                    <span class="relative flex h-2 w-2">

                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-[#5483B3] opacity-60"></span>

                        <span class="relative inline-flex h-2 w-2 rounded-full bg-[#5483B3]"></span>

                    </span>

                    Monitoring Aktivitas

                </div>


                <h1 class="text-2xl font-extrabold tracking-tight text-[#021024] sm:text-3xl">

                    Aktivitas Pengguna

                </h1>


                <p class="mt-1.5 max-w-2xl text-sm leading-6 text-[#5483B3]">

                    Pantau riwayat aktivitas pengguna yang tercatat
                    pada sistem Stockify.

                </p>

            </div>


            {{-- System Status --}}
            <div class="flex w-full items-center justify-between gap-4 rounded-2xl border border-[#C1E8FF] bg-white px-4 py-3 shadow-sm sm:w-fit">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#021024] to-[#5483B3]">

                        <i
                            data-lucide="activity"
                            class="h-5 w-5 text-white">
                        </i>

                    </div>


                    <div>

                        <p class="text-[11px] font-medium text-[#7DA0CA]">
                            Status Sistem
                        </p>

                        <div class="mt-0.5 flex items-center gap-1.5">

                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                            <span class="text-sm font-bold text-[#052659]">
                                Sistem Aktif
                            </span>

                        </div>

                    </div>

                </div>


                <div class="hidden h-8 w-px bg-[#E8F7FF] sm:block"></div>


                <div class="text-right">

                    <p class="text-[11px] text-[#7DA0CA]">
                        Total
                    </p>

                    <p class="text-lg font-extrabold text-[#021024]">
                        {{ $totalActivities }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FILTER
    ========================================================== --}}
    <div class="mb-6 rounded-2xl border border-[#C1E8FF] bg-white shadow-[0_6px_25px_rgba(2,16,36,0.04)]">

        <form
            action="{{ route('activities.index') }}"
            method="GET"
            class="p-4 sm:p-5">

            <div class="mb-4 flex items-center gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#E8F7FF]">

                    <i
                        data-lucide="filter"
                        class="h-4 w-4 text-[#5483B3]">
                    </i>

                </div>


                <div>

                    <h2 class="text-sm font-bold text-[#021024] sm:text-base">
                        Filter Aktivitas
                    </h2>

                    <p class="text-[11px] text-[#7DA0CA] sm:text-xs">
                        Gunakan pencarian untuk menemukan aktivitas tertentu.
                    </p>

                </div>

            </div>


            <div class="grid grid-cols-1 gap-3 md:grid-cols-[minmax(0,1.5fr)_minmax(190px,0.8fr)_auto]">

                {{-- Search --}}
                <div class="min-w-0">

                    <label
                        for="search"
                        class="mb-1.5 block text-xs font-bold text-[#052659]">

                        Kata Kunci

                    </label>


                    <div class="relative">

                        <i
                            data-lucide="search"
                            class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]">
                        </i>


                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ $search ?? '' }}"
                            placeholder="Cari aktivitas atau keterangan..."
                            class="w-full rounded-xl border border-[#C1E8FF] bg-[#F8FCFF] py-3 pl-10 pr-4 text-sm text-[#021024] outline-none transition placeholder:text-[#A0B8CD] focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/40">

                    </div>

                </div>


                {{-- Date --}}
                <div class="min-w-0">

                    <label
                        for="date"
                        class="mb-1.5 block text-xs font-bold text-[#052659]">

                        Tanggal

                    </label>


                    <div class="relative">

                        <i
                            data-lucide="calendar-days"
                            class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-[#7DA0CA]">
                        </i>


                        <input
                            type="date"
                            id="date"
                            name="date"
                            value="{{ $date ?? '' }}"
                            class="w-full rounded-xl border border-[#C1E8FF] bg-[#F8FCFF] py-3 pl-10 pr-3 text-sm text-[#021024] outline-none transition focus:border-[#5483B3] focus:bg-white focus:ring-4 focus:ring-[#C1E8FF]/40">

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="flex items-end gap-2">

                    <button
                        type="submit"
                        class="flex h-[46px] flex-1 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#021024] to-[#5483B3] px-5 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg md:flex-none">

                        <i
                            data-lucide="search"
                            class="h-4 w-4">
                        </i>

                        Cari

                    </button>


                    <a
                        href="{{ route('activities.index') }}"
                        class="flex h-[46px] items-center justify-center gap-2 rounded-xl border border-[#C1E8FF] bg-white px-4 text-sm font-semibold text-[#5483B3] transition hover:bg-[#F1FAFF]">

                        <i
                            data-lucide="rotate-ccw"
                            class="h-4 w-4">
                        </i>

                        <span class="hidden lg:inline">
                            Reset
                        </span>

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
        ACTIVITY CONTAINER
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white shadow-[0_8px_30px_rgba(2,16,36,0.05)]">

        {{-- =====================================================
            ACTIVITY HEADER
        ====================================================== --}}
        <div class="border-b border-[#E8F7FF] px-5 py-4 sm:px-6">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                {{-- Title --}}
                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#021024] to-[#5483B3] shadow-sm">

                        <i
                            data-lucide="history"
                            class="h-5 w-5 text-white">
                        </i>

                    </div>


                    <div>

                        <h2 class="text-base font-extrabold text-[#021024] sm:text-lg">
                            Riwayat Aktivitas
                        </h2>

                        <p class="text-xs text-[#7DA0CA]">
                            Aktivitas terbaru pengguna Stockify.
                        </p>

                    </div>

                </div>


                {{-- Total --}}
                <div class="flex w-fit items-center gap-2 rounded-full bg-[#E8F7FF] px-3 py-1.5">

                    <span class="h-2 w-2 rounded-full bg-[#5483B3]"></span>

                    <span class="text-xs font-bold text-[#052659]">

                        {{ $totalActivities }} Aktivitas

                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
            ACTIVITY LIST
        ====================================================== --}}
        <div class="p-4 sm:p-6">

            @forelse (($activities ?? collect()) as $activity)

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | ACTION
                    |--------------------------------------------------------------------------
                    */

                    $action = strtolower(
                        $activity->action ?? ''
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | ACTION LABEL
                    |--------------------------------------------------------------------------
                    */

                    $actionLabel = match ($action) {

                        'created' =>
                            'Menambahkan',

                        'updated' =>
                            'Mengubah',

                        'deleted' =>
                            'Menghapus',

                        'login' =>
                            'Login',

                        'logout' =>
                            'Logout',

                        'exported' =>
                            'Export',

                        'imported' =>
                            'Import',

                        default =>
                            ucfirst(
                                $activity->action
                                ?? 'Aktivitas'
                            ),

                    };


                    /*
                    |--------------------------------------------------------------------------
                    | ICON
                    |--------------------------------------------------------------------------
                    */

                    $icon = match ($action) {

                        'created' =>
                            'plus',

                        'updated' =>
                            'pencil',

                        'deleted' =>
                            'trash-2',

                        'login' =>
                            'log-in',

                        'logout' =>
                            'log-out',

                        'exported' =>
                            'download',

                        'imported' =>
                            'upload',

                        default =>
                            'activity',

                    };


                    /*
                    |--------------------------------------------------------------------------
                    | COLOR
                    |--------------------------------------------------------------------------
                    */

                    $avatarClass = match ($action) {

                        'deleted' =>
                            'bg-red-50 text-red-500 border-red-100',

                        'login' =>
                            'bg-emerald-50 text-emerald-600 border-emerald-100',

                        'logout' =>
                            'bg-slate-100 text-slate-500 border-slate-200',

                        'updated' =>
                            'bg-amber-50 text-amber-600 border-amber-100',

                        default =>
                            'bg-[#E8F7FF] text-[#5483B3] border-[#C1E8FF]',

                    };


                    $badgeClass = match ($action) {

                        'deleted' =>
                            'bg-red-50 text-red-600',

                        'login' =>
                            'bg-emerald-50 text-emerald-600',

                        'logout' =>
                            'bg-slate-100 text-slate-600',

                        'updated' =>
                            'bg-amber-50 text-amber-600',

                        default =>
                            'bg-[#E8F7FF] text-[#052659]',

                    };


                    /*
                    |--------------------------------------------------------------------------
                    | USER
                    |--------------------------------------------------------------------------
                    */

                    $userName =
                        $activity->user->name
                        ?? 'Pengguna tidak tersedia';


                    $initial =
                        strtoupper(
                            substr(
                                trim($userName),
                                0,
                                1
                            )
                        );

                @endphp


                {{-- =================================================
                    ACTIVITY ROW
                ================================================== --}}
                <div class="activity-row group relative">


                    {{-- Timeline --}}
                    @if (!$loop->last)

                        <div class="timeline-line absolute left-[21px] top-[48px] bottom-[-18px] w-px bg-[#E8F7FF]">
                        </div>

                    @endif


                    <div class="relative flex gap-3 sm:gap-4">


                        {{-- =================================================
                            AVATAR
                        ================================================== --}}
                        <div class="relative z-10 shrink-0">

                            <div class="activity-avatar flex h-[43px] w-[43px] items-center justify-center rounded-xl border font-extrabold shadow-sm ring-4 ring-white {{ $avatarClass }}">

                                {{ $initial }}

                            </div>


                            {{-- Action Icon --}}
                            <div class="action-icon absolute -bottom-1 -right-1 flex h-5 w-5 items-center justify-center rounded-md border-2 border-white bg-white shadow-sm">

                                <i
                                    data-lucide="{{ $icon }}"
                                    class="h-3 w-3">
                                </i>

                            </div>

                        </div>


                        {{-- =================================================
                            MAIN CONTENT
                        ================================================== --}}
                        <div class="min-w-0 flex-1 pb-5">

                            <div class="activity-card rounded-xl border border-transparent px-3 py-2 transition duration-200 group-hover:border-[#E8F7FF] group-hover:bg-[#FAFDFF] sm:px-4 sm:py-3">


                                {{-- Top Row --}}
                                <div class="flex flex-col gap-2 lg:flex-row lg:items-start lg:justify-between">


                                    {{-- User --}}
                                    <div class="min-w-0">

                                        <div class="flex flex-wrap items-center gap-2">

                                            <h3 class="truncate text-sm font-extrabold text-[#021024] sm:text-[15px]">

                                                {{ $userName }}

                                            </h3>


                                            <span class="rounded-full px-2.5 py-1 text-[10px] font-extrabold tracking-wide {{ $badgeClass }}">

                                                {{ $actionLabel }}

                                            </span>

                                        </div>


                                        {{-- Description --}}
                                        <p class="mt-1.5 max-w-3xl text-sm leading-6 text-[#385F86]">

                                            {{ $activity->description ?? 'Tidak ada keterangan aktivitas.' }}

                                        </p>

                                    </div>


                                    {{-- Time --}}
                                    <div class="flex shrink-0 items-center gap-1.5 text-[11px] font-medium text-[#8AA5BD] lg:ml-4">

                                        <i
                                            data-lucide="clock-3"
                                            class="h-3.5 w-3.5">
                                        </i>

                                        <span class="whitespace-nowrap">

                                            {{ $activity->created_at?->format('d M Y, H:i') ?? '-' }}

                                        </span>

                                    </div>

                                </div>


                                {{-- =================================================
                                    META
                                ================================================== --}}
                                <div class="mt-2.5 flex flex-wrap items-center gap-1.5">


                                    {{-- IP --}}
                                    @if ($activity->ip_address)

                                        <span class="meta-item inline-flex items-center gap-1 rounded-md bg-[#F5F9FC] px-2 py-1 text-[10px] font-medium text-[#7DA0CA]">

                                            <i
                                                data-lucide="globe-2"
                                                class="h-3 w-3 text-[#5483B3]">
                                            </i>

                                            {{ $activity->ip_address }}

                                        </span>

                                    @endif


                                    {{-- Role --}}
                                    @if ($activity->user)

                                        <span class="meta-item inline-flex items-center gap-1 rounded-md bg-[#F5F9FC] px-2 py-1 text-[10px] font-semibold text-[#7DA0CA]">

                                            <i
                                                data-lucide="user-round"
                                                class="h-3 w-3 text-[#5483B3]">
                                            </i>

                                            {{ ucfirst($activity->user->role ?? 'user') }}

                                        </span>

                                    @endif


                                    {{-- System --}}
                                    <span class="meta-item inline-flex items-center gap-1 rounded-md bg-[#F5F9FC] px-2 py-1 text-[10px] font-medium text-[#7DA0CA]">

                                        <i
                                            data-lucide="shield-check"
                                            class="h-3 w-3 text-[#5483B3]">
                                        </i>

                                        Sistem

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            @empty

                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}
                <div class="flex min-h-[360px] flex-col items-center justify-center rounded-2xl border border-dashed border-[#C1E8FF] bg-[#F8FCFF] px-5 py-12 text-center">

                    <div class="mb-5 flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-to-br from-[#E8F7FF] to-[#C1E8FF]">

                        <i
                            data-lucide="history"
                            class="h-9 w-9 text-[#5483B3]">
                        </i>

                    </div>


                    <h3 class="text-lg font-extrabold text-[#021024]">

                        Belum Ada Aktivitas

                    </h3>


                    <p class="mt-2 max-w-md text-sm leading-6 text-[#7DA0CA]">

                        Belum ada aktivitas pengguna yang tercatat.
                        Aktivitas seperti menambah, mengubah, menghapus,
                        import, dan export akan muncul di sini.

                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>


{{-- =========================================================
    CUSTOM CSS
========================================================= --}}
<style>

    /*
    |--------------------------------------------------------------------------
    | Activity Container
    |--------------------------------------------------------------------------
    */

    .activity-row {
        transition:
            transform 0.2s ease;
    }


    .activity-row:hover {
        transform: translateX(2px);
    }


    /*
    |--------------------------------------------------------------------------
    | Activity Avatar
    |--------------------------------------------------------------------------
    */

    .activity-avatar {
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }


    .activity-row:hover .activity-avatar {
        transform: scale(1.05);
        box-shadow:
            0 7px 18px rgba(2, 16, 36, 0.10);
    }


    /*
    |--------------------------------------------------------------------------
    | Action Icon
    |--------------------------------------------------------------------------
    */

    .action-icon svg {
        stroke: #5483B3;
    }


    /*
    |--------------------------------------------------------------------------
    | Metadata
    |--------------------------------------------------------------------------
    */

    .meta-item {
        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }


    .meta-item:hover {
        background-color: #E8F7FF;
    }


    /*
    |--------------------------------------------------------------------------
    | Mobile
    |--------------------------------------------------------------------------
    */

    @media (max-width: 767px) {

        .activity-row:hover {
            transform: none;
        }


        .activity-row:hover .activity-avatar {
            transform: none;
        }


        .timeline-line {
            left: 21px;
        }

    }

</style>


{{-- =========================================================
    LUCIDE
========================================================= --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {

            lucide.createIcons();

        }

    });

</script>

@endsection