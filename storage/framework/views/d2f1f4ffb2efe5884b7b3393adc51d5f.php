

<?php $__env->startSection('title', 'Tambah Produk'); ?>
<?php $__env->startSection('page-title', 'Tambah Produk'); ?>

<?php $__env->startSection('content'); ?>

<div class="min-h-screen bg-[#F5F9FC] px-4 py-6 md:px-6 lg:px-8">

    <div class="mx-auto max-w-5xl">

        
        <div class="mb-6">

            
            <div class="mb-3 flex items-center gap-2 text-sm text-[#5483B3]">

                <i data-lucide="package" class="h-4 w-4"></i>

                <span>Manajemen Inventaris</span>

                <i data-lucide="chevron-right"
                   class="h-4 w-4 text-[#7DA0CA]"></i>

                <span class="font-medium text-[#052659]">
                    Tambah Produk
                </span>

            </div>


            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h1 class="text-2xl font-bold tracking-tight text-[#021024] md:text-3xl">
                        Tambah Produk
                    </h1>

                    <p class="mt-1.5 text-sm text-slate-500">
                        Tambahkan produk baru ke dalam sistem Stockify.
                    </p>

                </div>


                
                <div class="flex items-center gap-3 rounded-2xl border border-[#C1E8FF]
                            bg-white px-4 py-3 shadow-sm">

                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center
                                rounded-xl bg-gradient-to-br from-[#5483B3] to-[#7DA0CA]
                                text-white shadow-sm">

                        <i data-lucide="package-plus" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-xs font-medium text-slate-400">
                            Data Baru
                        </p>

                        <p class="text-sm font-bold text-[#021024]">
                            Produk
                        </p>

                    </div>

                </div>

            </div>

        </div>



        
        <div class="overflow-hidden rounded-3xl border border-slate-200
                    bg-white shadow-sm">

            
            <div class="border-b border-slate-100 bg-gradient-to-r
                        from-[#F1FAFF] via-white to-[#F8FBFF]
                        px-6 py-5 md:px-8">

                <div class="flex items-center gap-4">

                    <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center
                                rounded-xl bg-[#C1E8FF] text-[#052659]">

                        <i data-lucide="file-plus-2" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-[#021024]">
                            Informasi Produk
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Isi informasi produk yang akan ditambahkan ke dalam sistem.
                        </p>

                    </div>

                </div>

            </div>



            
            <form action="<?php echo e(route('products.store')); ?>"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-6 md:p-8">

                <?php echo csrf_field(); ?>


                
                <div class="mb-8">

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#5483B3]"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Informasi Dasar
                            </h3>

                            <p class="text-xs text-slate-400">
                                Masukkan identitas utama produk
                            </p>

                        </div>

                    </div>



                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        
                        <div class="md:col-span-2">

                            <label for="category_id"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="layers"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Kategori

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <select name="category_id"
                                        id="category_id"
                                        required
                                        class="w-full appearance-none rounded-xl border border-slate-200
                                               bg-[#F8FBFF] px-4 py-3 pr-10 text-sm text-slate-700
                                               outline-none transition
                                               hover:border-[#7DA0CA]
                                               focus:border-[#5483B3]
                                               focus:bg-white
                                               focus:ring-4 focus:ring-[#C1E8FF]/60">

                                    <option value="">
                                        -- Pilih Kategori --
                                    </option>

                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option value="<?php echo e($category->id); ?>"
                                            <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>

                                            <?php echo e($category->name); ?>


                                        </option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>


                                <i data-lucide="chevron-down"
                                   class="pointer-events-none absolute right-4 top-1/2
                                          h-4 w-4 -translate-y-1/2 text-[#5483B3]">
                                </i>

                            </div>


                            <?php $__errorArgs = ['category_id'];
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

                            <label for="name"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="package"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Nama Produk

                                <span class="text-red-500">*</span>

                            </label>


                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="<?php echo e(old('name')); ?>"
                                   placeholder="Contoh: Kaos Polos"
                                   required
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            <?php $__errorArgs = ['name'];
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

                            <label for="sku"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="barcode"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                SKU

                                <span class="text-red-500">*</span>

                            </label>


                            <input type="text"
                                   name="sku"
                                   id="sku"
                                   value="<?php echo e(old('sku')); ?>"
                                   placeholder="Contoh: PRD-001"
                                   required
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm uppercase text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            <?php $__errorArgs = ['sku'];
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

                            <label for="size"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="ruler"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Ukuran

                            </label>


                            <input type="text"
                                   name="size"
                                   id="size"
                                   value="<?php echo e(old('size')); ?>"
                                   placeholder="Contoh: M, L, XL, 42"
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            <?php $__errorArgs = ['size'];
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

                            <label for="color"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="palette"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Warna

                            </label>


                            <input type="text"
                                   name="color"
                                   id="color"
                                   value="<?php echo e(old('color')); ?>"
                                   placeholder="Contoh: Hitam, Putih, Merah"
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            <?php $__errorArgs = ['color'];
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

                            <label
                                class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700"
                            >

                                <i
                                    data-lucide="truck"
                                    class="h-4 w-4 text-[#5483B3]"
                                ></i>

                                Supplier

                                <span class="text-xs font-normal text-slate-400">
                                    (Opsional, dapat memilih lebih dari satu)
                                </span>

                            </label>


                            <div
                                class="rounded-2xl border border-slate-200
                                       bg-[#F8FBFF] p-4"
                            >

                                <?php if($suppliers->count() > 0): ?>

                                    <div
                                        class="grid grid-cols-1 gap-3
                                               sm:grid-cols-2 lg:grid-cols-3"
                                    >

                                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <label
                                                class="group flex cursor-pointer
                                                       items-center gap-3 rounded-xl
                                                       border border-slate-200
                                                       bg-white p-3 transition
                                                       hover:border-[#7DA0CA]
                                                       hover:bg-[#F1FAFF]"
                                            >

                                                <input
                                                    type="checkbox"
                                                    name="supplier_ids[]"
                                                    value="<?php echo e($supplier->id); ?>"
                                                    <?php echo e(in_array(
                                                        $supplier->id,
                                                        old('supplier_ids', [])
                                                    ) ? 'checked' : ''); ?>

                                                    class="h-4 w-4 rounded
                                                           border-slate-300
                                                           text-[#052659]
                                                           focus:ring-[#5483B3]"
                                                >


                                                <div class="min-w-0 flex-1">

                                                    <p
                                                        class="truncate text-sm
                                                               font-semibold text-[#052659]"
                                                    >
                                                        <?php echo e($supplier->name); ?>

                                                    </p>


                                                    <?php if($supplier->phone): ?>

                                                        <p
                                                            class="mt-0.5 truncate
                                                                   text-xs text-slate-400"
                                                        >
                                                            <?php echo e($supplier->phone); ?>

                                                        </p>

                                                    <?php else: ?>

                                                        <p
                                                            class="mt-0.5 text-xs
                                                                   text-slate-400"
                                                        >
                                                            Supplier
                                                        </p>

                                                    <?php endif; ?>

                                                </div>

                                            </label>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>

                                <?php else: ?>

                                    <div
                                        class="rounded-xl border border-dashed
                                               border-[#C1E8FF] bg-[#F1FAFF]
                                               px-5 py-6 text-center"
                                    >

                                        <div
                                            class="mx-auto flex h-11 w-11
                                                   items-center justify-center
                                                   rounded-xl bg-[#C1E8FF]
                                                   text-[#052659]"
                                        >

                                            <i
                                                data-lucide="truck"
                                                class="h-5 w-5"
                                            ></i>

                                        </div>


                                        <p
                                            class="mt-3 text-sm font-bold
                                                   text-[#052659]"
                                        >
                                            Belum ada supplier
                                        </p>


                                        <p
                                            class="mt-1 text-xs text-slate-400"
                                        >
                                            Tambahkan supplier terlebih dahulu
                                            sebelum menghubungkannya dengan produk.
                                        </p>

                                    </div>

                                <?php endif; ?>

                            </div>


                            <?php $__errorArgs = ['supplier_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p
                                    class="mt-1.5 flex items-center gap-1
                                           text-xs text-red-600"
                                >

                                    <i
                                        data-lucide="circle-alert"
                                        class="h-3.5 w-3.5"
                                    ></i>

                                    <?php echo e($message); ?>


                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                            <?php $__errorArgs = ['supplier_ids.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p
                                    class="mt-1.5 flex items-center gap-1
                                           text-xs text-red-600"
                                >

                                    <i
                                        data-lucide="circle-alert"
                                        class="h-3.5 w-3.5"
                                    ></i>

                                    <?php echo e($message); ?>


                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>



                        
                        <div class="md:col-span-2">

                            <label for="image"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="image"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Foto Produk

                                <span class="text-xs font-normal text-slate-400">
                                    (Opsional)
                                </span>

                            </label>


                            <div class="grid grid-cols-1 gap-5 md:grid-cols-[220px_1fr]">


                                
                                <div class="relative">

                                    <div id="imagePreviewContainer"
                                         class="relative flex aspect-square w-full items-center justify-center
                                                overflow-hidden rounded-2xl border-2 border-dashed
                                                border-[#C1E8FF] bg-[#F8FBFF]">

                                        
                                        <div id="imagePlaceholder"
                                             class="flex flex-col items-center justify-center px-5 text-center">

                                            <div class="mb-3 flex h-14 w-14 items-center justify-center
                                                        rounded-2xl bg-[#E8F7FF] text-[#5483B3]">

                                                <i data-lucide="image-plus"
                                                   class="h-7 w-7"></i>

                                            </div>

                                            <p class="text-sm font-semibold text-slate-600">
                                                Belum ada foto
                                            </p>

                                            <p class="mt-1 text-xs leading-relaxed text-slate-400">
                                                Preview foto akan muncul di sini
                                            </p>

                                        </div>


                                        
                                        <img id="imagePreview"
                                             src=""
                                             alt="Preview foto produk"
                                             class="hidden h-full w-full object-cover">


                                        
                                        <button type="button"
                                                id="removeImage"
                                                class="absolute right-3 top-3 hidden h-9 w-9
                                                       items-center justify-center rounded-full
                                                       bg-red-500 text-white shadow-lg
                                                       transition hover:bg-red-600"
                                                title="Hapus foto">

                                            <i data-lucide="x"
                                               class="h-4 w-4"></i>

                                        </button>

                                    </div>

                                </div>


                                
                                <div class="flex flex-col justify-center">

                                    <label for="image"
                                           class="group flex min-h-[180px] cursor-pointer flex-col
                                                  items-center justify-center rounded-2xl border-2
                                                  border-dashed border-slate-200 bg-[#F8FBFF]
                                                  px-6 py-8 text-center transition
                                                  hover:border-[#7DA0CA]
                                                  hover:bg-[#F1FAFF]">

                                        <div class="mb-3 flex h-12 w-12 items-center justify-center
                                                    rounded-xl bg-[#E8F7FF] text-[#5483B3]
                                                    transition group-hover:scale-105">

                                            <i data-lucide="upload"
                                               class="h-5 w-5"></i>

                                        </div>


                                        <p class="text-sm font-semibold text-[#052659]">
                                            Pilih Foto Produk
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            Klik untuk memilih gambar dari komputer
                                        </p>

                                        <div class="mt-4 flex flex-wrap justify-center gap-2">

                                            <span class="rounded-lg bg-white px-2.5 py-1
                                                         text-[11px] font-medium text-slate-500
                                                         shadow-sm ring-1 ring-slate-100">
                                                JPG
                                            </span>

                                            <span class="rounded-lg bg-white px-2.5 py-1
                                                         text-[11px] font-medium text-slate-500
                                                         shadow-sm ring-1 ring-slate-100">
                                                JPEG
                                            </span>

                                            <span class="rounded-lg bg-white px-2.5 py-1
                                                         text-[11px] font-medium text-slate-500
                                                         shadow-sm ring-1 ring-slate-100">
                                                PNG
                                            </span>

                                            <span class="rounded-lg bg-white px-2.5 py-1
                                                         text-[11px] font-medium text-slate-500
                                                         shadow-sm ring-1 ring-slate-100">
                                                WEBP
                                            </span>

                                        </div>

                                        <p class="mt-3 text-[11px] text-slate-400">
                                            Maksimal ukuran file 2 MB
                                        </p>

                                    </label>


                                    <input type="file"
                                           name="image"
                                           id="image"
                                           accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                           class="hidden">


                                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                        <p class="mt-2 flex items-center gap-1.5 text-xs text-red-600">

                                            <i data-lucide="circle-alert"
                                               class="h-3.5 w-3.5"></i>

                                            <?php echo e($message); ?>


                                        </p>

                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                                    <p id="imageFileName"
                                       class="mt-2 hidden text-xs text-[#5483B3]">
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                
                <div class="mb-8 border-t border-slate-100 pt-8">

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#7DA0CA]"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Stok & Harga
                            </h3>

                            <p class="text-xs text-slate-400">
                                Tentukan harga dan jumlah persediaan awal
                            </p>

                        </div>

                    </div>



                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                        
                        <div>

                            <label for="purchase_price"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="shopping-cart"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Harga Beli

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2
                                             text-xs font-semibold text-[#5483B3]">
                                    Rp
                                </span>


                                <input type="number"
                                       name="purchase_price"
                                       id="purchase_price"
                                       value="<?php echo e(old('purchase_price', 0)); ?>"
                                       min="0"
                                       required
                                       class="w-full rounded-xl border border-slate-200
                                              bg-[#F8FBFF] py-3 pl-11 pr-4 text-sm text-slate-700
                                              outline-none transition
                                              hover:border-[#7DA0CA]
                                              focus:border-[#5483B3]
                                              focus:bg-white
                                              focus:ring-4 focus:ring-[#C1E8FF]/60">

                            </div>


                            <?php $__errorArgs = ['purchase_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1.5 text-xs text-red-600">
                                    <?php echo e($message); ?>

                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>



                        
                        <div>

                            <label for="selling_price"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="badge-dollar-sign"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Harga Jual

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2
                                             text-xs font-semibold text-[#5483B3]">
                                    Rp
                                </span>


                                <input type="number"
                                       name="selling_price"
                                       id="selling_price"
                                       value="<?php echo e(old('selling_price', 0)); ?>"
                                       min="0"
                                       required
                                       class="w-full rounded-xl border border-slate-200
                                              bg-[#F8FBFF] py-3 pl-11 pr-4 text-sm text-slate-700
                                              outline-none transition
                                              hover:border-[#7DA0CA]
                                              focus:border-[#5483B3]
                                              focus:bg-white
                                              focus:ring-4 focus:ring-[#C1E8FF]/60">

                            </div>


                            <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1.5 text-xs text-red-600">
                                    <?php echo e($message); ?>

                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>



                        
                        <div>

                            <label for="stock"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="boxes"
                                   class="h-4 w-4 text-[#5483B3]"></i>

                                Stok Awal

                                <span class="text-red-500">*</span>

                            </label>


                            <input type="number"
                                   name="stock"
                                   id="stock"
                                   value="<?php echo e(old('stock', 0)); ?>"
                                   min="0"
                                   required
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1.5 text-xs text-red-600">
                                    <?php echo e($message); ?>

                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>



                        
                        <div>

                            <label for="minimum_stock"
                                   class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                                <i data-lucide="triangle-alert"
                                   class="h-4 w-4 text-red-400"></i>

                                Stok Minimum

                            </label>


                            <input type="number"
                                   name="minimum_stock"
                                   id="minimum_stock"
                                   value="<?php echo e(old('minimum_stock', 5)); ?>"
                                   min="0"
                                   class="w-full rounded-xl border border-slate-200
                                          bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                          outline-none transition
                                          hover:border-[#7DA0CA]
                                          focus:border-[#5483B3]
                                          focus:bg-white
                                          focus:ring-4 focus:ring-[#C1E8FF]/60">


                            <div class="mt-2 flex items-start gap-1.5">

                                <i data-lucide="info"
                                   class="mt-0.5 h-3.5 w-3.5 flex-shrink-0 text-[#7DA0CA]">
                                </i>

                                <p class="text-xs leading-relaxed text-slate-400">
                                    Digunakan sebagai batas peringatan stok menipis.
                                </p>

                            </div>


                            <?php $__errorArgs = ['minimum_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1.5 text-xs text-red-600">
                                    <?php echo e($message); ?>

                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>

                    </div>

                </div>



                
                <div class="border-t border-slate-100 pt-8">

                    <div class="mb-5 flex items-center gap-3">

                        <div class="h-8 w-1 rounded-full bg-[#C1E8FF]"></div>

                        <div>

                            <h3 class="text-sm font-bold text-[#021024]">
                                Deskripsi Produk
                            </h3>

                            <p class="text-xs text-slate-400">
                                Tambahkan informasi tambahan mengenai produk
                            </p>

                        </div>

                    </div>



                    <label for="description"
                           class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">

                        <i data-lucide="align-left"
                           class="h-4 w-4 text-[#5483B3]"></i>

                        Deskripsi

                    </label>


                    <textarea name="description"
                              id="description"
                              rows="5"
                              placeholder="Masukkan deskripsi produk..."
                              class="w-full resize-none rounded-xl border border-slate-200
                                     bg-[#F8FBFF] px-4 py-3 text-sm text-slate-700
                                     outline-none transition
                                     hover:border-[#7DA0CA]
                                     focus:border-[#5483B3]
                                     focus:bg-white
                                     focus:ring-4 focus:ring-[#C1E8FF]/60"><?php echo e(old('description')); ?></textarea>


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



                
                <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-6
                            sm:flex-row sm:justify-end">

                    <a href="<?php echo e(route('products.index')); ?>"
                       class="inline-flex items-center justify-center gap-2 rounded-xl
                              border border-slate-200 bg-white px-5 py-3
                              text-sm font-semibold text-slate-600
                              shadow-sm transition
                              hover:border-slate-300 hover:bg-slate-50
                              active:scale-[0.98]">

                        <i data-lucide="arrow-left" class="h-4 w-4"></i>

                        Batal

                    </a>


                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl
                                   bg-gradient-to-r from-[#052659] to-[#5483B3]
                                   px-6 py-3 text-sm font-semibold text-white
                                   shadow-lg shadow-[#052659]/20
                                   transition duration-200
                                   hover:-translate-y-0.5
                                   hover:shadow-xl hover:shadow-[#052659]/25
                                   active:translate-y-0">

                        <i data-lucide="save" class="h-4 w-4"></i>

                        Simpan Produk

                    </button>

                </div>

            </form>

        </div>



        
        <div class="mt-4 flex items-start gap-3 rounded-2xl border border-[#C1E8FF]
                    bg-[#F1FAFF] px-4 py-3">

            <i data-lucide="info"
               class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#5483B3]">
            </i>

            <p class="text-xs leading-relaxed text-slate-500">
                Pastikan data produk sudah diisi dengan benar sebelum disimpan.
                Data produk akan digunakan dalam pengelolaan persediaan Stockify.
            </p>

        </div>

    </div>

</div>



<?php $__env->startPush('scripts'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imagePlaceholder = document.getElementById('imagePlaceholder');
        const removeImageButton = document.getElementById('removeImage');
        const imageFileName = document.getElementById('imageFileName');

        if (!imageInput) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | PILIH FOTO
        |--------------------------------------------------------------------------
        */

        imageInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | VALIDASI UKURAN
            |--------------------------------------------------------------------------
            */

            const maxSize = 2 * 1024 * 1024;

            if (file.size > maxSize) {

                alert('Ukuran foto maksimal 2 MB.');

                imageInput.value = '';

                imagePreview.src = '';
                imagePreview.classList.add('hidden');

                imagePlaceholder.classList.remove('hidden');

                removeImageButton.classList.add('hidden');
                removeImageButton.classList.remove('flex');

                imageFileName.textContent = '';
                imageFileName.classList.add('hidden');

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | VALIDASI FORMAT
            |--------------------------------------------------------------------------
            */

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {

                alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');

                imageInput.value = '';

                imagePreview.src = '';
                imagePreview.classList.add('hidden');

                imagePlaceholder.classList.remove('hidden');

                removeImageButton.classList.add('hidden');
                removeImageButton.classList.remove('flex');

                imageFileName.textContent = '';
                imageFileName.classList.add('hidden');

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | PREVIEW
            |--------------------------------------------------------------------------
            */

            const imageUrl = URL.createObjectURL(file);

            imagePreview.src = imageUrl;

            imagePreview.classList.remove('hidden');

            imagePlaceholder.classList.add('hidden');


            /*
            |--------------------------------------------------------------------------
            | TOMBOL HAPUS
            |--------------------------------------------------------------------------
            */

            removeImageButton.classList.remove('hidden');
            removeImageButton.classList.add('flex');


            /*
            |--------------------------------------------------------------------------
            | NAMA FILE
            |--------------------------------------------------------------------------
            */

            imageFileName.textContent =
                'Foto dipilih: ' + file.name;

            imageFileName.classList.remove('hidden');

        });


        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO
        |--------------------------------------------------------------------------
        */

        removeImageButton?.addEventListener('click', function () {

            imageInput.value = '';

            imagePreview.src = '';

            imagePreview.classList.add('hidden');

            imagePlaceholder.classList.remove('hidden');

            removeImageButton.classList.add('hidden');
            removeImageButton.classList.remove('flex');

            imageFileName.textContent = '';
            imageFileName.classList.add('hidden');

        });

    });
</script>

<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\stockify\resources\views/products/create.blade.php ENDPATH**/ ?>