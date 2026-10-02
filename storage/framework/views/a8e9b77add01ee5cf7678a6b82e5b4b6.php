

<?php $__env->startSection('title', 'Tambah Stok Keluar'); ?>
<?php $__env->startSection('page-title', 'Tambah Stok Keluar'); ?>

<?php $__env->startSection('content'); ?>

<div class="min-h-screen bg-[#F5F9FC] px-4 py-6 md:px-6 lg:px-8">

    <div class="mx-auto max-w-4xl">

        
        <div class="mb-6">

            
            <div class="mb-3 flex items-center gap-2 text-sm text-red-500">

                <i data-lucide="package-minus" class="h-4 w-4"></i>

                <span>Persediaan</span>

                <i data-lucide="chevron-right"
                   class="h-4 w-4 text-[#7DA0CA]"></i>

                <span class="font-medium text-[#052659]">
                    Tambah Stok Keluar
                </span>

            </div>


            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h1 class="text-2xl font-bold tracking-tight text-[#021024] md:text-3xl">
                        Tambah Stok Keluar
                    </h1>

                    <p class="mt-1.5 text-sm text-slate-500">
                        Catat barang yang keluar dari gudang melalui Stockify.
                    </p>

                </div>


                
                <div class="flex items-center gap-3 rounded-2xl border border-red-100
                            bg-white px-4 py-3 shadow-sm">

                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center
                                rounded-xl bg-red-50 text-red-500 shadow-sm">

                        <i data-lucide="package-minus" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-xs font-medium text-slate-400">
                            Transaksi Baru
                        </p>

                        <p class="text-sm font-bold text-[#021024]">
                            Stok Keluar
                        </p>

                    </div>

                </div>

            </div>

        </div>


        
        <?php if($errors->any()): ?>

            <div class="mb-6 overflow-hidden rounded-2xl border border-red-100
                        bg-red-50 shadow-sm">

                <div class="flex items-start gap-3 p-4">

                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center
                                rounded-xl bg-red-100 text-red-600">

                        <i data-lucide="circle-alert" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <h3 class="text-sm font-bold text-red-700">
                            Terjadi kesalahan
                        </h3>

                        <ul class="mt-1.5 list-inside list-disc space-y-1 text-xs text-red-600">

                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                    </div>

                </div>

            </div>

        <?php endif; ?>


        
        <div class="overflow-hidden rounded-3xl border border-slate-200
                    bg-white shadow-sm">

            
            <div class="border-b border-slate-100 bg-gradient-to-r
                        from-red-50/70 via-white to-[#F8FBFF]
                        px-6 py-5 md:px-8">

                <div class="flex items-center gap-4">

                    <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center
                                rounded-xl bg-red-50 text-red-500">

                        <i data-lucide="clipboard-minus" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-[#021024]">
                            Informasi Stok Keluar
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Lengkapi data barang yang akan keluar dari gudang.
                        </p>

                    </div>

                </div>

            </div>


            
            <form action="<?php echo e(route('stock-outs.store')); ?>"
                  method="POST"
                  class="p-6 md:p-8">

                <?php echo csrf_field(); ?>


                
                <div>

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-red-500"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Detail Transaksi
                            </h3>

                            <p class="text-xs text-slate-400">
                                Pilih produk dan masukkan jumlah barang yang keluar
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        
                        <div class="md:col-span-2">

                            <label for="product_id"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="package"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Produk

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <select
                                    id="product_id"
                                    name="product_id"
                                    required
                                    class="w-full appearance-none rounded-xl border border-slate-200
                                           bg-[#F8FBFF] px-4 py-3 pr-10 text-sm text-slate-700
                                           outline-none transition
                                           hover:border-[#7DA0CA]
                                           focus:border-[#5483B3]
                                           focus:bg-white
                                           focus:ring-4 focus:ring-[#C1E8FF]/60"
                                >

                                    <option value="">
                                        -- Pilih Produk --
                                    </option>

                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option
                                            value="<?php echo e($product->id); ?>"
                                            <?php echo e(old('product_id') == $product->id ? 'selected' : ''); ?>

                                        >
                                            <?php echo e($product->name); ?> — Stok: <?php echo e($product->stock); ?>

                                        </option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>

                                <i data-lucide="chevron-down"
                                   class="pointer-events-none absolute right-4 top-1/2
                                          h-4 w-4 -translate-y-1/2 text-[#5483B3]">
                                </i>

                            </div>


                            <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    <?php echo e($message); ?>


                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>


                        
                        <div>

                            <label for="quantity"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="boxes"
                                   class="h-4 w-4 text-red-500"></i>

                                Jumlah Barang

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    value="<?php echo e(old('quantity')); ?>"
                                    min="1"
                                    required
                                    placeholder="Masukkan jumlah barang"
                                    class="w-full rounded-xl border border-slate-200
                                           bg-[#F8FBFF] px-4 py-3 pr-16 text-sm text-slate-700
                                           outline-none transition
                                           hover:border-[#7DA0CA]
                                           focus:border-red-400
                                           focus:bg-white
                                           focus:ring-4 focus:ring-red-100"
                                >

                                <span class="absolute right-4 top-1/2 -translate-y-1/2
                                             text-xs font-medium text-slate-400">
                                    unit
                                </span>

                            </div>


                            <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    <?php echo e($message); ?>


                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>


                        
                        <div>

                            <label for="date"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="calendar-days"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Tanggal Keluar

                                <span class="text-red-500">*</span>

                            </label>


                            <input
                                type="date"
                                id="date"
                                name="date"
                                value="<?php echo e(old('date', date('Y-m-d'))); ?>"
                                required
                                class="w-full rounded-xl border border-slate-200
                                       bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                       outline-none transition
                                       hover:border-[#7DA0CA]
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4 focus:ring-[#C1E8FF]/60"
                            >


                            <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    <?php echo e($message); ?>


                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>


                        
                        <div class="md:col-span-2">

                            <label for="destination"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="map-pin"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Tujuan Barang

                            </label>


                            <input
                                type="text"
                                id="destination"
                                name="destination"
                                value="<?php echo e(old('destination')); ?>"
                                placeholder="Contoh: Bagian Produksi"
                                class="w-full rounded-xl border border-slate-200
                                       bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                       outline-none transition
                                       hover:border-[#7DA0CA]
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4 focus:ring-[#C1E8FF]/60"
                            >


                            <?php $__errorArgs = ['destination'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    <?php echo e($message); ?>


                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>


                        
                        <div class="md:col-span-2">

                            <label for="description"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="align-left"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Keterangan

                            </label>


                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Masukkan keterangan tambahan"
                                class="w-full resize-none rounded-xl border border-slate-200
                                       bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                       outline-none transition
                                       hover:border-[#7DA0CA]
                                       focus:border-[#5483B3]
                                       focus:bg-white
                                       focus:ring-4 focus:ring-[#C1E8FF]/60"
                            ><?php echo e(old('description')); ?></textarea>


                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="h-3.5 w-3.5"></i>

                                    <?php echo e($message); ?>


                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>

                    </div>

                </div>


                
                <div class="mt-8 flex flex-col-reverse gap-3
                            border-t border-slate-100 pt-6
                            sm:flex-row sm:justify-end">

                    
                    <a
                        href="<?php echo e(route('stock-outs.index')); ?>"
                        class="inline-flex items-center justify-center gap-2
                               rounded-xl border border-slate-200 bg-white
                               px-5 py-3 text-sm font-semibold text-slate-600
                               shadow-sm transition
                               hover:border-slate-300 hover:bg-slate-50
                               active:scale-[0.98]"
                    >

                        <i data-lucide="arrow-left" class="h-4 w-4"></i>

                        Batal

                    </a>


                    
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2
                               rounded-xl bg-gradient-to-r from-[#991B1B] to-[#DC2626]
                               px-6 py-3 text-sm font-semibold text-white
                               shadow-lg shadow-red-600/20
                               transition duration-200
                               hover:-translate-y-0.5
                               hover:shadow-xl hover:shadow-red-600/25
                               active:translate-y-0"
                    >

                        <i data-lucide="save" class="h-4 w-4"></i>

                        Simpan Stok Keluar

                    </button>

                </div>

            </form>

        </div>


        
        <div class="mt-4 flex items-start gap-3 rounded-2xl
                    border border-red-100 bg-red-50 px-4 py-3">

            <i data-lucide="triangle-alert"
               class="mt-0.5 h-4 w-4 flex-shrink-0 text-red-500">
            </i>

            <p class="text-xs leading-relaxed text-slate-500">
                Pastikan produk dan jumlah barang yang keluar sudah sesuai.
                Stok produk akan berkurang setelah transaksi berhasil disimpan.
            </p>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\stockify\resources\views/stock-outs/create.blade.php ENDPATH**/ ?>