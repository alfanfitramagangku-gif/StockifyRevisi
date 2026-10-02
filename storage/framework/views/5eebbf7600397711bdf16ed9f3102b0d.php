

<?php $__env->startSection('title', 'Manajemen Pengguna'); ?>
<?php $__env->startSection('page-title', 'Manajemen Pengguna'); ?>

<?php $__env->startSection('content'); ?>

<div class="min-h-screen bg-[#F5F9FC] px-4 py-6 sm:px-6 lg:px-8">

    
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            
            <div class="mb-2 flex items-center gap-2 text-sm">

                <span class="flex items-center gap-1 text-[#5483B3]">
                    <i data-lucide="settings-2" class="h-4 w-4"></i>
                    Pengaturan
                </span>

                <i data-lucide="chevron-right" class="h-4 w-4 text-[#7DA0CA]"></i>

                <span class="font-medium text-[#052659]">
                    Manajemen Pengguna
                </span>

            </div>

            <h1 class="text-2xl font-bold tracking-tight text-[#021024] sm:text-3xl">
                Manajemen Pengguna
            </h1>

            <p class="mt-1 text-sm text-[#5483B3]">
                Kelola akun dan hak akses pengguna Stockify.
            </p>

        </div>


        
        <a
            href="<?php echo e(route('users.create')); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#052659] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#021024] hover:shadow-md active:scale-95">

            <i data-lucide="user-plus" class="h-5 w-5"></i>

            <span>Tambah Pengguna</span>

        </a>

    </div>


    
    <?php if(session('success')): ?>

        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-[#C1E8FF] bg-[#E8F7FF] p-4 shadow-sm">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#C1E8FF]">
                <i data-lucide="check-circle-2" class="h-5 w-5 text-[#052659]"></i>
            </div>

            <div>

                <p class="font-semibold text-[#021024]">
                    Berhasil
                </p>

                <p class="mt-0.5 text-sm text-[#5483B3]">
                    <?php echo e(session('success')); ?>

                </p>

            </div>

        </div>

    <?php endif; ?>


    
    <?php if(session('error')): ?>

        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-100 bg-red-50 p-4 shadow-sm">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100">
                <i data-lucide="circle-alert" class="h-5 w-5 text-red-500"></i>
            </div>

            <div>

                <p class="font-semibold text-red-700">
                    Terjadi Kesalahan
                </p>

                <p class="mt-0.5 text-sm text-red-500">
                    <?php echo e(session('error')); ?>

                </p>

            </div>

        </div>

    <?php endif; ?>


    
    <?php
        $totalUsers = $users->count();
        $totalAdmins = $users->where('role', 'admin')->count();
        $totalManagers = $users->where('role', 'manager')->count();
        $totalStaff = $users->where('role', 'staff')->count();
    ?>


    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        
        <div class="user-stat-card relative overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white p-5 shadow-sm">

            <div class="relative z-10 flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-[#5483B3]">
                        Total Pengguna
                    </p>

                    <p class="mt-2 text-3xl font-bold text-[#021024]">
                        <?php echo e($totalUsers); ?>

                    </p>

                    <p class="mt-1 text-xs text-[#7DA0CA]">
                        Akun terdaftar
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#E8F7FF]">
                    <i data-lucide="users" class="h-6 w-6 text-[#5483B3]"></i>
                </div>

            </div>

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-[#C1E8FF]/40"></div>

        </div>


        
        <div class="user-stat-card relative overflow-hidden rounded-2xl border border-red-100 bg-white p-5 shadow-sm">

            <div class="relative z-10 flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-red-500">
                        Admin
                    </p>

                    <p class="mt-2 text-3xl font-bold text-[#021024]">
                        <?php echo e($totalAdmins); ?>

                    </p>

                    <p class="mt-1 text-xs text-red-400">
                        Akses administrator
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50">
                    <i data-lucide="shield-check" class="h-6 w-6 text-red-500"></i>
                </div>

            </div>

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-red-50"></div>

        </div>


        
        <div class="user-stat-card relative overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white p-5 shadow-sm">

            <div class="relative z-10 flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-[#5483B3]">
                        Manager
                    </p>

                    <p class="mt-2 text-3xl font-bold text-[#021024]">
                        <?php echo e($totalManagers); ?>

                    </p>

                    <p class="mt-1 text-xs text-[#7DA0CA]">
                        Akses manajemen
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#E8F7FF]">
                    <i data-lucide="briefcase-business" class="h-6 w-6 text-[#5483B3]"></i>
                </div>

            </div>

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-[#C1E8FF]/40"></div>

        </div>


        
        <div class="user-stat-card relative overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white p-5 shadow-sm">

            <div class="relative z-10 flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-[#5483B3]">
                        Staff
                    </p>

                    <p class="mt-2 text-3xl font-bold text-[#021024]">
                        <?php echo e($totalStaff); ?>

                    </p>

                    <p class="mt-1 text-xs text-[#7DA0CA]">
                        Akses operasional
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#E8F7FF]">
                    <i data-lucide="user-round" class="h-6 w-6 text-[#5483B3]"></i>
                </div>

            </div>

            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-[#C1E8FF]/40"></div>

        </div>

    </div>


    
    <div class="overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white shadow-sm">

        
        <div class="flex flex-col gap-3 border-b border-[#E8F7FF] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#E8F7FF]">
                    <i data-lucide="users-round" class="h-5 w-5 text-[#5483B3]"></i>
                </div>

                <div>

                    <h2 class="font-semibold text-[#021024]">
                        Daftar Pengguna
                    </h2>

                    <p class="text-sm text-[#7DA0CA]">
                        Daftar akun yang terdaftar di Stockify.
                    </p>

                </div>

            </div>

            <span class="w-fit rounded-lg bg-[#F1FAFF] px-3 py-2 text-xs font-semibold text-[#5483B3]">
                <?php echo e($totalUsers); ?> Pengguna
            </span>

        </div>


        
        <div class="hidden overflow-x-auto md:block">

            <table class="min-w-full text-left text-sm">

                <thead class="bg-[#F8FCFF] text-xs uppercase tracking-wider text-[#5483B3]">

                    <tr>
                        <th class="px-5 py-4 font-semibold">No</th>
                        <th class="px-5 py-4 font-semibold">Pengguna</th>
                        <th class="px-5 py-4 font-semibold">Email</th>
                        <th class="px-5 py-4 font-semibold">Role</th>
                        <th class="px-5 py-4 font-semibold">Tanggal Dibuat</th>
                        <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-[#E8F7FF]">

                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="transition hover:bg-[#F8FCFF]">

                            
                            <td class="px-5 py-4 text-[#7DA0CA]">
                                <?php echo e($loop->iteration); ?>

                            </td>


                            
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#5483B3] to-[#052659] text-sm font-bold text-white">

                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>


                                    </div>

                                    <div>

                                        <p class="font-semibold text-[#021024]">
                                            <?php echo e($user->name); ?>

                                        </p>

                                        <p class="text-xs text-[#7DA0CA]">
                                            Pengguna Stockify
                                        </p>

                                    </div>

                                </div>

                            </td>


                            
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-2 text-[#5483B3]">

                                    <i data-lucide="mail" class="h-4 w-4 text-[#7DA0CA]"></i>

                                    <?php echo e($user->email); ?>


                                </div>

                            </td>


                            
                            <td class="px-5 py-4">

                                <?php if($user->role === 'admin'): ?>

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">

                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                        Admin

                                    </span>

                                <?php elseif($user->role === 'manager'): ?>

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#E8F7FF] px-3 py-1.5 text-xs font-semibold text-[#052659]">

                                        <span class="h-1.5 w-1.5 rounded-full bg-[#5483B3]"></span>

                                        Manager

                                    </span>

                                <?php else: ?>

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#F1FAFF] px-3 py-1.5 text-xs font-semibold text-[#5483B3]">

                                        <span class="h-1.5 w-1.5 rounded-full bg-[#7DA0CA]"></span>

                                        Staff

                                    </span>

                                <?php endif; ?>

                            </td>


                            
                            <td class="whitespace-nowrap px-5 py-4 text-[#5483B3]">

                                <div class="flex items-center gap-2">

                                    <i data-lucide="calendar-days" class="h-4 w-4 text-[#7DA0CA]"></i>

                                    <?php echo e($user->created_at?->format('d/m/Y') ?? '-'); ?>


                                </div>

                            </td>


                            
                            <td class="px-5 py-4">

                                <div class="flex justify-center gap-2">

                                    
                                    <a
                                        href="<?php echo e(route('users.edit', $user)); ?>"
                                        title="Edit pengguna"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#E8F7FF] text-[#5483B3] transition hover:bg-[#5483B3] hover:text-white">

                                        <i data-lucide="pencil" class="h-4 w-4"></i>

                                    </a>


                                    
                                    <?php if(auth()->id() !== $user->id): ?>

                                        <form
                                            action="<?php echo e(route('users.destroy', $user)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                title="Hapus pengguna"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-500 transition hover:bg-red-500 hover:text-white">

                                                <i data-lucide="trash-2" class="h-4 w-4"></i>

                                            </button>

                                        </form>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="mx-auto flex max-w-sm flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#E8F7FF]">
                                        <i data-lucide="users-round" class="h-8 w-8 text-[#5483B3]"></i>
                                    </div>

                                    <h3 class="font-semibold text-[#021024]">
                                        Belum ada data pengguna
                                    </h3>

                                    <p class="mt-1 text-sm text-[#7DA0CA]">
                                        Pengguna yang ditambahkan akan muncul di halaman ini.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


        
        <div class="space-y-3 p-4 md:hidden">

            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <div class="rounded-2xl border border-[#C1E8FF] bg-white p-4 shadow-sm">

                    
                    <div class="flex items-start justify-between gap-3">

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#5483B3] to-[#052659] text-sm font-bold text-white">

                                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>


                            </div>

                            <div class="min-w-0">

                                <p class="truncate font-semibold text-[#021024]">
                                    <?php echo e($user->name); ?>

                                </p>

                                <p class="truncate text-xs text-[#7DA0CA]">
                                    <?php echo e($user->email); ?>

                                </p>

                            </div>

                        </div>


                        
                        <?php if($user->role === 'admin'): ?>

                            <span class="shrink-0 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-600">
                                Admin
                            </span>

                        <?php elseif($user->role === 'manager'): ?>

                            <span class="shrink-0 rounded-full bg-[#E8F7FF] px-2.5 py-1 text-xs font-semibold text-[#052659]">
                                Manager
                            </span>

                        <?php else: ?>

                            <span class="shrink-0 rounded-full bg-[#F1FAFF] px-2.5 py-1 text-xs font-semibold text-[#5483B3]">
                                Staff
                            </span>

                        <?php endif; ?>

                    </div>


                    
                    <div class="mt-4 rounded-xl bg-[#F8FCFF] p-3">

                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-2 text-xs text-[#7DA0CA]">

                                <i data-lucide="calendar-days" class="h-4 w-4"></i>

                                Tanggal Dibuat

                            </div>

                            <span class="text-sm font-medium text-[#052659]">
                                <?php echo e($user->created_at?->format('d/m/Y') ?? '-'); ?>

                            </span>

                        </div>

                    </div>


                    
                    <div class="mt-3 flex gap-2">

                        <a
                            href="<?php echo e(route('users.edit', $user)); ?>"
                            class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#E8F7FF] px-4 py-2.5 text-sm font-semibold text-[#5483B3] transition hover:bg-[#5483B3] hover:text-white">

                            <i data-lucide="pencil" class="h-4 w-4"></i>

                            Edit

                        </a>


                        <?php if(auth()->id() !== $user->id): ?>

                            <form
                                action="<?php echo e(route('users.destroy', $user)); ?>"
                                method="POST"
                                class="flex-1"
                                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button
                                    type="submit"
                                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-500 transition hover:bg-red-500 hover:text-white">

                                    <i data-lucide="trash-2" class="h-4 w-4"></i>

                                    Hapus

                                </button>

                            </form>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <div class="py-12 text-center">

                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#E8F7FF]">
                        <i data-lucide="users-round" class="h-8 w-8 text-[#5483B3]"></i>
                    </div>

                    <h3 class="font-semibold text-[#021024]">
                        Belum ada data pengguna
                    </h3>

                    <p class="mt-1 text-sm text-[#7DA0CA]">
                        Pengguna yang ditambahkan akan muncul di sini.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>



<style>

    .user-stat-card {
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            border-color 0.25s ease;
    }

    .user-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(2, 16, 36, 0.08);
        border-color: #7DA0CA;
    }

    @media (max-width: 767px) {

        .user-stat-card:hover {
            transform: none;
        }

    }

</style>



<script>

    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\stockify\resources\views/users/index.blade.php ENDPATH**/ ?>