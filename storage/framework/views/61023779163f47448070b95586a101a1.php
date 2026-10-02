

<?php $__env->startSection('title', 'Supplier'); ?>

<?php $__env->startSection('page-title', 'Supplier'); ?>

<?php $__env->startSection('content'); ?>

<?php
    $totalSuppliers = $suppliers->count();
?>

<div class="min-h-screen bg-[#F5F9FC]">

    <div class="space-y-6">

        
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>

                
                <div class="mb-3 flex items-center gap-2 text-sm">

                    <div
                        class="flex h-8 w-8 items-center justify-center
                               rounded-lg bg-[#C1E8FF] text-[#052659]"
                    >
                        <i
                            data-lucide="truck"
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
                        Supplier
                    </span>

                </div>


                
                <h1
                    class="text-3xl font-bold tracking-tight
                           text-[#021024] md:text-4xl"
                >
                    Data Supplier
                </h1>


                
                <p
                    class="mt-2 text-sm font-medium text-[#5483B3]"
                >
                    <?php echo e(auth()->user()->role === 'admin'
                        ? 'Kelola data supplier untuk mendukung kebutuhan persediaan Stockify.'
                        : 'Lihat informasi supplier yang tersimpan dalam sistem Stockify.'); ?>

                </p>

            </div>


            
            <?php if(auth()->user()->role === 'admin'): ?>

                <a
                    href="<?php echo e(route('suppliers.create')); ?>"
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

                    Tambah Supplier

                </a>

            <?php endif; ?>

        </div>


        
        <?php if(session('success')): ?>

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

                    <p class="mt-1 text-sm font-medium text-[#5483B3]">
                        <?php echo e(session('success')); ?>

                    </p>

                </div>

            </div>

        <?php endif; ?>


        
        <?php if(session('error')): ?>

            <div
                class="flex items-start gap-3 rounded-2xl
                       border border-red-200
                       bg-red-50
                       px-4 py-4
                       text-sm text-red-700"
            >

                <div
                    class="flex h-9 w-9 shrink-0 items-center
                           justify-center rounded-xl bg-red-100"
                >

                    <i
                        data-lucide="alert-circle"
                        class="h-5 w-5 text-red-600"
                    ></i>

                </div>


                <div class="pt-0.5">

                    <p class="font-bold text-red-700">
                        Terjadi Kesalahan
                    </p>

                    <p class="mt-1 text-sm font-medium text-red-600">
                        <?php echo e(session('error')); ?>

                    </p>

                </div>

            </div>

        <?php endif; ?>


        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">


            
            <div
                class="group rounded-3xl
                       border border-[#D9E4EE]
                       bg-white p-5
                       shadow-sm
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
                            Total Supplier
                        </p>

                        <h3
                            class="mt-2 text-3xl font-bold
                                   tracking-tight
                                   text-[#021024]"
                        >
                            <?php echo e($totalSuppliers); ?>

                        </h3>

                        <p
                            class="mt-1 text-xs font-medium
                                   text-[#7DA0CA]"
                        >
                            Supplier yang tersedia
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
                            data-lucide="truck"
                            class="h-6 w-6"
                        ></i>

                    </div>

                </div>

            </div>


            
            <div
                class="group rounded-3xl
                       border border-[#D9E4EE]
                       bg-white p-5
                       shadow-sm
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
                            Data Supplier
                        </p>

                        <h3
                            class="mt-2 text-xl font-bold
                                   tracking-tight
                                   text-[#052659]"
                        >
                            Terorganisir
                        </h3>

                        <p
                            class="mt-1 text-xs font-medium
                                   text-[#7DA0CA]"
                        >
                            Informasi supplier tersimpan
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
                            data-lucide="contact-round"
                            class="h-6 w-6"
                        ></i>

                    </div>

                </div>

            </div>

        </div>


        
        <div
            class="overflow-hidden rounded-3xl
                   border border-[#D9E4EE]
                   bg-white shadow-sm"
        >

            
            <div
                class="border-b border-[#D9E4EE]
                       px-5 py-5 md:px-6"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center
                               justify-center rounded-xl
                               bg-[#E8F7FF]
                               text-[#052659]"
                    >

                        <i
                            data-lucide="truck"
                            class="h-5 w-5"
                        ></i>

                    </div>


                    <div>

                        <h2
                            class="text-lg font-bold
                                   text-[#021024]"
                        >
                            Daftar Supplier
                        </h2>

                        <p
                            class="mt-1 text-sm font-medium
                                   text-[#64748B]"
                        >
                            Informasi supplier yang tersimpan
                            dalam sistem Stockify.
                        </p>

                    </div>

                </div>

            </div>


            
            <div class="hidden overflow-x-auto md:block">

                <table class="min-w-full text-left text-sm">

                    
                    <thead class="bg-[#F5F9FC]">

                        <tr class="border-b border-[#D9E4EE]">

                            <th
                                class="px-6 py-4 text-xs font-bold
                                       uppercase tracking-wider
                                       text-[#475569]"
                            >
                                No
                            </th>

                            <th
                                class="px-6 py-4 text-xs font-bold
                                       uppercase tracking-wider
                                       text-[#475569]"
                            >
                                Nama Supplier
                            </th>

                            <th
                                class="px-6 py-4 text-xs font-bold
                                       uppercase tracking-wider
                                       text-[#475569]"
                            >
                                Telepon
                            </th>

                            <th
                                class="px-6 py-4 text-xs font-bold
                                       uppercase tracking-wider
                                       text-[#475569]"
                            >
                                Alamat
                            </th>

                            <?php if(auth()->user()->role === 'admin'): ?>

                                <th
                                    class="px-6 py-4 text-center
                                           text-xs font-bold
                                           uppercase tracking-wider
                                           text-[#475569]"
                                >
                                    Aksi
                                </th>

                            <?php endif; ?>

                        </tr>

                    </thead>


                    
                    <tbody class="divide-y divide-[#EDF2F7]">

                        <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr
                                class="group transition duration-200
                                       hover:bg-[#F8FBFE]"
                            >

                                
                                <td
                                    class="whitespace-nowrap
                                           px-6 py-5
                                           text-sm font-semibold
                                           text-[#64748B]"
                                >

                                    <?php echo e($loop->iteration); ?>


                                </td>


                                
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-11 w-11 shrink-0
                                                   items-center justify-center
                                                   rounded-xl
                                                   bg-gradient-to-br
                                                   from-[#021024]
                                                   to-[#5483B3]
                                                   font-bold uppercase
                                                   text-[#C1E8FF]
                                                   shadow-sm"
                                        >

                                            <?php echo e(substr($supplier->name, 0, 1)); ?>


                                        </div>


                                        <div>

                                            <p
                                                class="font-bold
                                                       text-[#021024]"
                                            >
                                                <?php echo e($supplier->name); ?>

                                            </p>

                                            <p
                                                class="mt-1 text-xs
                                                       font-medium
                                                       text-[#7DA0CA]"
                                            >
                                                Supplier Stockify
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                
                                <td class="px-6 py-5">

                                    <?php if($supplier->phone): ?>

                                        <div
                                            class="inline-flex items-center
                                                   gap-2 rounded-xl
                                                   bg-[#F1FAFF]
                                                   px-3 py-2
                                                   text-sm font-semibold
                                                   text-[#052659]"
                                        >

                                            <i
                                                data-lucide="phone"
                                                class="h-4 w-4 text-[#5483B3]"
                                            ></i>

                                            <?php echo e($supplier->phone); ?>


                                        </div>

                                    <?php else: ?>

                                        <span
                                            class="text-sm font-medium
                                                   text-[#94A3B8]"
                                        >
                                            -
                                        </span>

                                    <?php endif; ?>

                                </td>


                                
                                <td class="max-w-sm px-6 py-5">

                                    <?php if($supplier->address): ?>

                                        <div
                                            class="flex items-start gap-2"
                                        >

                                            <i
                                                data-lucide="map-pin"
                                                class="mt-0.5 h-4 w-4
                                                       shrink-0
                                                       text-[#5483B3]"
                                            ></i>

                                            <p
                                                class="text-sm font-medium
                                                       leading-6
                                                       text-[#475569]"
                                            >
                                                <?php echo e($supplier->address); ?>

                                            </p>

                                        </div>

                                    <?php else: ?>

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
                                            Alamat belum tersedia
                                        </span>

                                    <?php endif; ?>

                                </td>


                                
                                <?php if(auth()->user()->role === 'admin'): ?>

                                    <td class="px-6 py-5">

                                        <div
                                            class="flex items-center
                                                   justify-center gap-2"
                                        >

                                            
                                            <a
                                                href="<?php echo e(route('suppliers.edit', $supplier->id)); ?>"
                                                title="Edit Supplier"
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


                                            
                                            <form
                                                action="<?php echo e(route('suppliers.destroy', $supplier->id)); ?>"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus supplier ini?')"
                                            >

                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button
                                                    type="submit"
                                                    title="Hapus Supplier"
                                                    class="inline-flex
                                                           items-center
                                                           gap-2 rounded-xl
                                                           border
                                                           border-red-200
                                                           bg-red-50
                                                           px-3 py-2
                                                           text-xs font-bold
                                                           text-red-700
                                                           transition duration-200
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

                                <?php endif; ?>

                            </tr>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            
                            <tr>

                                <td
                                    colspan="<?php echo e(auth()->user()->role === 'admin' ? 5 : 4); ?>"
                                    class="px-6 py-16 text-center"
                                >

                                    <div
                                        class="mx-auto flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl bg-[#E8F7FF]"
                                    >

                                        <i
                                            data-lucide="truck"
                                            class="h-8 w-8 text-[#7DA0CA]"
                                        ></i>

                                    </div>


                                    <h3
                                        class="mt-4 font-bold
                                               text-[#334155]"
                                    >
                                        Belum Ada Supplier
                                    </h3>


                                    <p
                                        class="mx-auto mt-1 max-w-md
                                               text-sm font-medium
                                               text-[#7DA0CA]"
                                    >
                                        Belum ada data supplier yang
                                        tersimpan dalam sistem.
                                    </p>


                                    <?php if(auth()->user()->role === 'admin'): ?>

                                        <a
                                            href="<?php echo e(route('suppliers.create')); ?>"
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

                                            Tambah Supplier

                                        </a>

                                    <?php endif; ?>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>


            
            <div class="space-y-4 p-4 md:hidden">

                <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <div
                        class="rounded-2xl
                               border border-[#D9E4EE]
                               bg-[#F8FAFC]
                               p-4 transition duration-200
                               hover:border-[#C1E8FF]
                               hover:bg-white"
                    >

                        
                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-12 w-12 shrink-0
                                       items-center justify-center
                                       rounded-xl
                                       bg-gradient-to-br
                                       from-[#021024]
                                       to-[#5483B3]
                                       font-bold uppercase
                                       text-[#C1E8FF]"
                            >

                                <?php echo e(substr($supplier->name, 0, 1)); ?>


                            </div>


                            <div class="min-w-0 flex-1">

                                <h3
                                    class="truncate font-bold
                                           text-[#021024]"
                                >
                                    <?php echo e($supplier->name); ?>

                                </h3>

                                <p
                                    class="mt-1 text-xs font-medium
                                           text-[#7DA0CA]"
                                >
                                    Supplier Stockify
                                </p>

                            </div>

                        </div>


                        
                        <div
                            class="mt-4 space-y-3
                                   border-t border-[#D9E4EE]
                                   pt-4"
                        >

                            
                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0
                                           items-center justify-center
                                           rounded-lg bg-[#E8F7FF]
                                           text-[#052659]"
                                >

                                    <i
                                        data-lucide="phone"
                                        class="h-4 w-4"
                                    ></i>

                                </div>


                                <div>

                                    <p
                                        class="text-xs font-medium
                                               text-[#94A3B8]"
                                    >
                                        Nomor Telepon
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-semibold
                                               text-[#334155]"
                                    >
                                        <?php echo e($supplier->phone ?? '-'); ?>

                                    </p>

                                </div>

                            </div>


                            
                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0
                                           items-center justify-center
                                           rounded-lg bg-[#E8F7FF]
                                           text-[#052659]"
                                >

                                    <i
                                        data-lucide="map-pin"
                                        class="h-4 w-4"
                                    ></i>

                                </div>


                                <div class="min-w-0">

                                    <p
                                        class="text-xs font-medium
                                               text-[#94A3B8]"
                                    >
                                        Alamat
                                    </p>

                                    <p
                                        class="mt-1 text-sm font-semibold
                                               leading-5 text-[#334155]"
                                    >
                                        <?php echo e($supplier->address ?? '-'); ?>

                                    </p>

                                </div>

                            </div>

                        </div>


                        
                        <?php if(auth()->user()->role === 'admin'): ?>

                            <div
                                class="mt-4 flex gap-2
                                       border-t border-[#D9E4EE]
                                       pt-4"
                            >

                                
                                <a
                                    href="<?php echo e(route('suppliers.edit', $supplier->id)); ?>"
                                    class="flex flex-1 items-center
                                           justify-center gap-2
                                           rounded-xl
                                           border border-[#C1E8FF]
                                           bg-[#F1FAFF]
                                           px-3 py-2.5
                                           text-xs font-bold
                                           text-[#052659]
                                           transition
                                           hover:bg-[#C1E8FF]"
                                >

                                    <i
                                        data-lucide="pencil"
                                        class="h-4 w-4"
                                    ></i>

                                    Edit

                                </a>


                                
                                <form
                                    action="<?php echo e(route('suppliers.destroy', $supplier->id)); ?>"
                                    method="POST"
                                    class="flex-1"
                                    onsubmit="return confirm('Yakin ingin menghapus supplier ini?')"
                                >

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button
                                        type="submit"
                                        class="flex w-full
                                               items-center justify-center
                                               gap-2 rounded-xl
                                               border border-red-200
                                               bg-red-50
                                               px-3 py-2.5
                                               text-xs font-bold
                                               text-red-700
                                               transition
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

                        <?php endif; ?>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <div class="py-12 text-center">

                        <div
                            class="mx-auto flex h-16 w-16
                                   items-center justify-center
                                   rounded-2xl bg-[#E8F7FF]"
                        >

                            <i
                                data-lucide="truck"
                                class="h-8 w-8 text-[#7DA0CA]"
                            ></i>

                        </div>


                        <p
                            class="mt-4 font-bold text-[#334155]"
                        >
                            Belum Ada Supplier
                        </p>


                        <p
                            class="mt-1 text-sm font-medium
                                   text-[#7DA0CA]"
                        >
                            Belum ada data supplier yang tersedia.
                        </p>


                        <?php if(auth()->user()->role === 'admin'): ?>

                            <a
                                href="<?php echo e(route('suppliers.create')); ?>"
                                class="mt-5 inline-flex
                                       items-center gap-2 rounded-xl
                                       bg-[#021024] px-4 py-2.5
                                       text-sm font-bold text-white
                                       transition hover:bg-[#052659]"
                            >

                                <i
                                    data-lucide="plus"
                                    class="h-4 w-4"
                                ></i>

                                Tambah Supplier

                            </a>

                        <?php endif; ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\stockify\resources\views/suppliers/index.blade.php ENDPATH**/ ?>