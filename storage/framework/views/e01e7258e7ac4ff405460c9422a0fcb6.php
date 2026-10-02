

<?php $__env->startSection('title', 'Pengaturan Aplikasi'); ?>
<?php $__env->startSection('page-title', 'Pengaturan Aplikasi'); ?>

<?php $__env->startSection('content'); ?>

<div class="min-h-screen bg-[#F5F9FC] px-4 py-6 sm:px-6 lg:px-8">

    
    <div class="mb-6">

        
        <div class="mb-2 flex items-center gap-2 text-sm">

            <span class="flex items-center gap-1 text-[#5483B3]">
                <i data-lucide="settings" class="h-4 w-4"></i>
                Pengaturan
            </span>

            <i data-lucide="chevron-right" class="h-4 w-4 text-[#7DA0CA]"></i>

            <span class="font-medium text-[#052659]">
                Aplikasi
            </span>

        </div>

        <h1 class="text-2xl font-bold tracking-tight text-[#021024] sm:text-3xl">
            Pengaturan Aplikasi
        </h1>

        <p class="mt-1 text-sm text-[#5483B3]">
            Kelola informasi umum dan tampilan aplikasi Stockify.
        </p>

    </div>


    
    <?php if(session('success')): ?>

        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-[#C1E8FF] bg-[#E8F7FF] p-4 shadow-sm">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#C1E8FF]">
                <i data-lucide="check-circle-2" class="h-5 w-5 text-[#052659]"></i>
            </div>

            <div>

                <p class="font-semibold text-[#021024]">
                    Pengaturan berhasil disimpan
                </p>

                <p class="mt-0.5 text-sm text-[#5483B3]">
                    <?php echo e(session('success')); ?>

                </p>

            </div>

        </div>

    <?php endif; ?>


    
    <?php if($errors->any()): ?>

        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-100 bg-red-50 p-4 shadow-sm">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100">
                <i data-lucide="circle-alert" class="h-5 w-5 text-red-500"></i>
            </div>

            <div>

                <p class="font-semibold text-red-700">
                    Terjadi kesalahan
                </p>

                <ul class="mt-1 list-disc space-y-1 pl-5 text-sm text-red-500">

                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li>
                            <?php echo e($error); ?>

                        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>

            </div>

        </div>

    <?php endif; ?>


    
    <div class="mb-6 overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white shadow-sm">

        
        <div class="border-b border-[#E8F7FF] px-5 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#E8F7FF]">
                    <i data-lucide="sliders-horizontal" class="h-5 w-5 text-[#5483B3]"></i>
                </div>

                <div>

                    <h2 class="font-semibold text-[#021024]">
                        Informasi Umum Aplikasi
                    </h2>

                    <p class="text-sm text-[#7DA0CA]">
                        Atur nama dan logo yang akan ditampilkan pada aplikasi.
                    </p>

                </div>

            </div>

        </div>


        
        <form
            action="<?php echo e(route('admin.settings.update')); ?>"
            method="POST"
            enctype="multipart/form-data"
            class="p-5 sm:p-6">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>


            
            <div class="mb-6">

                <label
                    for="app_name"
                    class="mb-2 block text-sm font-semibold text-[#052659]">

                    Nama Aplikasi

                </label>

                <div class="relative">

                    <i
                        data-lucide="app-window"
                        class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-[#7DA0CA]">
                    </i>

                    <input
                        type="text"
                        id="app_name"
                        name="app_name"
                        value="<?php echo e(old('app_name', $settings['app_name'] ?? 'Stockify')); ?>"
                        placeholder="Masukkan nama aplikasi"
                        required
                        class="w-full rounded-xl border border-[#C1E8FF] bg-[#F8FCFF] py-3.5 pl-12 pr-4 text-sm text-[#021024] outline-none transition placeholder:text-[#7DA0CA] focus:border-[#5483B3] focus:bg-white focus:ring-2 focus:ring-[#C1E8FF]">

                </div>

                <p class="mt-2 text-xs text-[#7DA0CA]">
                    Nama ini akan digunakan sebagai identitas aplikasi Stockify.
                </p>

            </div>


            
            <div class="mb-6">

                <label
                    for="logo"
                    class="mb-2 block text-sm font-semibold text-[#052659]">

                    Logo Aplikasi

                </label>


                
                <?php if(!empty($settings['app_logo'])): ?>

                    <div class="mb-4 rounded-2xl border border-[#C1E8FF] bg-[#F8FCFF] p-4">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                            <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-2xl border border-[#C1E8FF] bg-white p-3 shadow-sm">

                                <img
                                    src="<?php echo e(Storage::url($settings['app_logo'])); ?>"
                                    alt="Logo Aplikasi"
                                    class="h-full w-full object-contain">

                            </div>

                            <div>

                                <p class="font-semibold text-[#021024]">
                                    Logo saat ini
                                </p>

                                <p class="mt-1 text-sm text-[#7DA0CA]">
                                    Logo ini sedang digunakan pada aplikasi.
                                </p>

                            </div>

                        </div>

                    </div>

                <?php else: ?>

                    <div class="mb-4 rounded-2xl border border-dashed border-[#7DA0CA] bg-[#F8FCFF] p-6 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#E8F7FF]">

                            <i data-lucide="image" class="h-7 w-7 text-[#5483B3]"></i>

                        </div>

                        <p class="mt-3 font-medium text-[#021024]">
                            Belum ada logo
                        </p>

                        <p class="mt-1 text-xs text-[#7DA0CA]">
                            Upload logo untuk menampilkan identitas aplikasi.
                        </p>

                    </div>

                <?php endif; ?>


                
                <div class="relative">

                    <input
                        type="file"
                        id="logo"
                        name="logo"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="block w-full cursor-pointer rounded-xl border border-[#C1E8FF] bg-[#F8FCFF] text-sm text-[#5483B3]
                        file:mr-4 file:cursor-pointer file:border-0
                        file:bg-[#E8F7FF] file:px-4 file:py-3
                        file:text-sm file:font-semibold file:text-[#052659]
                        hover:file:bg-[#C1E8FF]">

                </div>

                <p class="mt-2 flex items-center gap-1 text-xs text-[#7DA0CA]">

                    <i data-lucide="info" class="h-3.5 w-3.5"></i>

                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.

                </p>

            </div>


            
            <div class="flex flex-col-reverse gap-3 border-t border-[#E8F7FF] pt-5 sm:flex-row sm:justify-end">

                <a
                    href="<?php echo e(url('/dashboard')); ?>"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#C1E8FF] bg-white px-5 py-3 text-sm font-semibold text-[#5483B3] transition hover:bg-[#F1FAFF]">

                    <i data-lucide="x" class="h-4 w-4"></i>

                    Batal

                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#052659] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#021024] hover:shadow-md active:scale-95">

                    <i data-lucide="save" class="h-4 w-4"></i>

                    Simpan Pengaturan

                </button>

            </div>

        </form>

    </div>


    
    <div class="overflow-hidden rounded-2xl border border-[#C1E8FF] bg-white shadow-sm">

        
        <div class="border-b border-[#E8F7FF] px-5 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#E8F7FF]">
                    <i data-lucide="settings-2" class="h-5 w-5 text-[#5483B3]"></i>
                </div>

                <div>

                    <h2 class="font-semibold text-[#021024]">
                        Pengaturan Sistem
                    </h2>

                    <p class="text-sm text-[#7DA0CA]">
                        Informasi mengenai pengaturan tambahan pada sistem.
                    </p>

                </div>

            </div>

        </div>


        
        <div class="space-y-3 p-5 sm:p-6">


            
            <div class="system-setting-card group rounded-2xl border border-[#C1E8FF] bg-[#F8FCFF] p-4">

                <div class="flex items-start gap-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#E8F7FF] transition group-hover:bg-[#5483B3]">

                        <i
                            data-lucide="shield-check"
                            class="h-5 w-5 text-[#5483B3] transition group-hover:text-white">
                        </i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-[#021024]">
                            Hak Akses Pengguna
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-[#7DA0CA]">
                            Pengaturan peran dan hak akses pengguna dapat dikelola
                            melalui halaman Manajemen Pengguna.
                        </p>

                    </div>

                </div>

            </div>


            
            <div class="system-setting-card group rounded-2xl border border-[#C1E8FF] bg-[#F8FCFF] p-4">

                <div class="flex items-start gap-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#E8F7FF] transition group-hover:bg-[#5483B3]">

                        <i
                            data-lucide="lock-keyhole"
                            class="h-5 w-5 text-[#5483B3] transition group-hover:text-white">
                        </i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-[#021024]">
                            Keamanan Administrator
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-[#7DA0CA]">
                            Pengaturan keamanan akun administrator dapat dikembangkan
                            melalui fitur pengelolaan akun.
                        </p>

                    </div>

                </div>

            </div>


            
            <div class="system-setting-card group rounded-2xl border border-[#C1E8FF] bg-[#F8FCFF] p-4">

                <div class="flex items-start gap-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#E8F7FF] transition group-hover:bg-[#5483B3]">

                        <i
                            data-lucide="bell"
                            class="h-5 w-5 text-[#5483B3] transition group-hover:text-white">
                        </i>

                    </div>

                    <div>

                        <h3 class="font-semibold text-[#021024]">
                            Notifikasi Sistem
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-[#7DA0CA]">
                            Pengaturan notifikasi aplikasi dapat ditambahkan sesuai
                            kebutuhan sistem.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<style>

    .system-setting-card {
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            border-color 0.25s ease;
    }

    .system-setting-card:hover {
        transform: translateY(-2px);
        border-color: #7DA0CA;
        box-shadow: 0 10px 25px rgba(2, 16, 36, 0.05);
    }

    @media (max-width: 767px) {

        .system-setting-card:hover {
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\stockify\resources\views/admin/settings/edit.blade.php ENDPATH**/ ?>