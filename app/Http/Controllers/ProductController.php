<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index(Request $request)
    {
        $query = Product::with([
            'category',
            'suppliers'
        ]);

        // Pencarian berdasarkan nama, SKU, ukuran, atau warna
        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%')
                    ->orWhere('size', 'like', '%' . $search . '%')
                    ->orWhere('color', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->input('category_id')
            );
        }

        // Data produk untuk tabel
        $products = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Seluruh produk untuk kebutuhan ringkasan
        $allProducts = Product::all();

        // Data kategori untuk filter
        $categories = Category::orderBy('name')->get();

        return view(
            'products.index',
            compact(
                'products',
                'allProducts',
                'categories'
            )
        );
    }


    /**
     * Menampilkan halaman tambah produk
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        // Ambil semua supplier
        $suppliers = Supplier::orderBy('name')->get();

        return view(
            'products.create',
            compact(
                'categories',
                'suppliers'
            )
        );
    }


    /**
     * Menyimpan produk baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'required',
                'string',
                'max:255',
                'unique:products,sku',
            ],

            'size' => [
                'nullable',
                'string',
                'max:100',
            ],

            'color' => [
                'nullable',
                'string',
                'max:100',
            ],

            /*
            |--------------------------------------------------------------------------
            | SUPPLIER
            |--------------------------------------------------------------------------
            */

            'supplier_ids' => [
                'nullable',
                'array',
            ],

            'supplier_ids.*' => [
                'exists:suppliers,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | FOTO PRODUK
            |--------------------------------------------------------------------------
            */

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'minimum_stock' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ], [
            'category_id.required' =>
                'Kategori produk wajib dipilih.',

            'category_id.exists' =>
                'Kategori yang dipilih tidak tersedia.',

            'name.required' =>
                'Nama produk wajib diisi.',

            'sku.required' =>
                'SKU produk wajib diisi.',

            'sku.unique' =>
                'SKU tersebut sudah digunakan.',

            'supplier_ids.array' =>
                'Data supplier tidak valid.',

            'supplier_ids.*.exists' =>
                'Supplier yang dipilih tidak tersedia.',

            'size.string' =>
                'Ukuran harus berupa teks.',

            'color.string' =>
                'Warna harus berupa teks.',

            'image.image' =>
                'File yang dipilih harus berupa gambar.',

            'image.mimes' =>
                'Foto produk harus berformat JPG, JPEG, PNG, atau WEBP.',

            'image.max' =>
                'Ukuran foto produk maksimal 2 MB.',

            'purchase_price.required' =>
                'Harga beli wajib diisi.',

            'purchase_price.numeric' =>
                'Harga beli harus berupa angka.',

            'purchase_price.min' =>
                'Harga beli tidak boleh kurang dari 0.',

            'selling_price.required' =>
                'Harga jual wajib diisi.',

            'selling_price.numeric' =>
                'Harga jual harus berupa angka.',

            'selling_price.min' =>
                'Harga jual tidak boleh kurang dari 0.',

            'stock.required' =>
                'Stok wajib diisi.',

            'stock.integer' =>
                'Stok harus berupa bilangan bulat.',

            'stock.min' =>
                'Stok tidak boleh kurang dari 0.',

            'minimum_stock.integer' =>
                'Stok minimum harus berupa bilangan bulat.',

            'minimum_stock.min' =>
                'Stok minimum tidak boleh kurang dari 0.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA SUPPLIER TERPISAH
        |--------------------------------------------------------------------------
        */

        $supplierIds = $validated['supplier_ids'] ?? [];

        unset($validated['supplier_ids']);


        /*
        |--------------------------------------------------------------------------
        | NILAI DEFAULT
        |--------------------------------------------------------------------------
        */

        $validated['minimum_stock'] =
            $validated['minimum_stock'] ?? 5;

        $validated['size'] =
            $validated['size'] ?? null;

        $validated['color'] =
            $validated['color'] ?? null;

        $validated['description'] =
            $validated['description'] ?? null;


        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO PRODUK
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] =
                $request->file('image')
                    ->store('products', 'public');

        } else {

            $validated['image'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PRODUK + SUPPLIER
        |--------------------------------------------------------------------------
        */

        $product = DB::transaction(function () use (
            $validated,
            $supplierIds
        ) {

            $product = Product::create($validated);

            // Hubungkan produk dengan supplier
            $product->suppliers()->sync($supplierIds);

            return $product;
        });


        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS
        |--------------------------------------------------------------------------
        */

        ActivityLog::record(
            'created',
            'Menambahkan produk: ' .
            $product->name .
            ' (SKU: ' .
            $product->sku .
            ') dengan ' .
            count($supplierIds) .
            ' supplier.'
        );


        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail produk
     */
    public function show(Product $product)
    {
        // Load kategori dan supplier
        $product->load([
            'category',
            'suppliers'
        ]);

        // Produk lainnya
        $products = Product::with([
            'category',
            'suppliers'
        ])
            ->where(
                'id',
                '!=',
                $product->id
            )
            ->latest()
            ->get();

        return view(
            'products.show',
            compact(
                'product',
                'products'
            )
        );
    }


    /**
     * Menampilkan halaman edit produk
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        // Semua supplier
        $suppliers = Supplier::orderBy('name')->get();

        // Supplier yang sudah dimiliki produk
        $product->load('suppliers');

        return view(
            'products.edit',
            compact(
                'product',
                'categories',
                'suppliers'
            )
        );
    }


    /**
     * Memperbarui data produk
     */
    public function update(
        Request $request,
        Product $product
    ) {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'required',
                'string',
                'max:255',
                'unique:products,sku,' . $product->id,
            ],

            'size' => [
                'nullable',
                'string',
                'max:100',
            ],

            'color' => [
                'nullable',
                'string',
                'max:100',
            ],

            /*
            |--------------------------------------------------------------------------
            | SUPPLIER
            |--------------------------------------------------------------------------
            */

            'supplier_ids' => [
                'nullable',
                'array',
            ],

            'supplier_ids.*' => [
                'exists:suppliers,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | FOTO PRODUK
            |--------------------------------------------------------------------------
            */

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'minimum_stock' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ], [
            'category_id.required' =>
                'Kategori produk wajib dipilih.',

            'category_id.exists' =>
                'Kategori yang dipilih tidak tersedia.',

            'name.required' =>
                'Nama produk wajib diisi.',

            'sku.required' =>
                'SKU produk wajib diisi.',

            'sku.unique' =>
                'SKU tersebut sudah digunakan.',

            'supplier_ids.array' =>
                'Data supplier tidak valid.',

            'supplier_ids.*.exists' =>
                'Supplier yang dipilih tidak tersedia.',

            'size.string' =>
                'Ukuran harus berupa teks.',

            'color.string' =>
                'Warna harus berupa teks.',

            'image.image' =>
                'File yang dipilih harus berupa gambar.',

            'image.mimes' =>
                'Foto produk harus berformat JPG, JPEG, PNG, atau WEBP.',

            'image.max' =>
                'Ukuran foto produk maksimal 2 MB.',

            'purchase_price.required' =>
                'Harga beli wajib diisi.',

            'purchase_price.numeric' =>
                'Harga beli harus berupa angka.',

            'purchase_price.min' =>
                'Harga beli tidak boleh kurang dari 0.',

            'selling_price.required' =>
                'Harga jual wajib diisi.',

            'selling_price.numeric' =>
                'Harga jual harus berupa angka.',

            'selling_price.min' =>
                'Harga jual tidak boleh kurang dari 0.',

            'stock.required' =>
                'Stok wajib diisi.',

            'stock.integer' =>
                'Stok harus berupa bilangan bulat.',

            'stock.min' =>
                'Stok tidak boleh kurang dari 0.',

            'minimum_stock.integer' =>
                'Stok minimum harus berupa bilangan bulat.',

            'minimum_stock.min' =>
                'Stok minimum tidak boleh kurang dari 0.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA SUPPLIER
        |--------------------------------------------------------------------------
        */

        $supplierIds = $validated['supplier_ids'] ?? [];

        unset($validated['supplier_ids']);


        /*
        |--------------------------------------------------------------------------
        | NILAI DEFAULT
        |--------------------------------------------------------------------------
        */

        $validated['minimum_stock'] =
            $validated['minimum_stock'] ?? 5;

        $validated['size'] =
            $validated['size'] ?? null;

        $validated['color'] =
            $validated['color'] ?? null;

        $validated['description'] =
            $validated['description'] ?? null;


        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $product->image &&
                Storage::disk('public')->exists(
                    $product->image
                )
            ) {

                Storage::disk('public')->delete(
                    $product->image
                );
            }

            $validated['image'] =
                $request->file('image')
                    ->store('products', 'public');

        } else {

            unset($validated['image']);
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PRODUK + SUPPLIER
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $product,
            $validated,
            $supplierIds
        ) {

            $product->update($validated);

            // Update supplier produk
            $product->suppliers()->sync($supplierIds);
        });


        /*
        |--------------------------------------------------------------------------
        | CATAT AKTIVITAS
        |--------------------------------------------------------------------------
        */

        ActivityLog::record(
            'updated',
            'Mengubah data produk: ' .
            $product->name .
            ' (SKU: ' .
            $product->sku .
            ') dengan ' .
            count($supplierIds) .
            ' supplier.'
        );


        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Produk berhasil diperbarui.'
            );
    }


    /**
     * Menghapus produk
     */
    public function destroy(Product $product)
    {
        try {

            $productName = $product->name;
            $productSku = $product->sku;
            $productImage = $product->image;


            /*
            |--------------------------------------------------------------------------
            | HAPUS FOTO PRODUK
            |--------------------------------------------------------------------------
            */

            if (
                $productImage &&
                Storage::disk('public')->exists(
                    $productImage
                )
            ) {

                Storage::disk('public')->delete(
                    $productImage
                );
            }


            /*
            |--------------------------------------------------------------------------
            | HAPUS RELASI SUPPLIER
            |--------------------------------------------------------------------------
            */

            $product->suppliers()->detach();


            /*
            |--------------------------------------------------------------------------
            | HAPUS PRODUK
            |--------------------------------------------------------------------------
            */

            $product->delete();


            /*
            |--------------------------------------------------------------------------
            | CATAT AKTIVITAS
            |--------------------------------------------------------------------------
            */

            ActivityLog::record(
                'deleted',
                'Menghapus produk: ' .
                $productName .
                ' (SKU: ' .
                $productSku .
                ')'
            );


            return redirect()
                ->route('products.index')
                ->with(
                    'success',
                    'Produk berhasil dihapus.'
                );

        } catch (Throwable $e) {

            return redirect()
                ->route('products.index')
                ->with(
                    'error',
                    'Produk tidak dapat dihapus karena masih digunakan pada data transaksi.'
                );
        }
    }


    /**
     * Export data produk ke CSV
     */
    public function exportCsv()
    {
        $products = Product::with([
            'category',
            'suppliers'
        ])
            ->orderBy('name')
            ->get();

        $fileName =
            'data-produk-' .
            now()->format('Y-m-d-H-i-s') .
            '.csv';


        ActivityLog::record(
            'exported',
            'Mengekspor data produk ke file CSV.'
        );


        return response()->streamDownload(
            function () use ($products) {

                $file = fopen(
                    'php://output',
                    'w'
                );

                if ($file === false) {
                    return;
                }

                // BOM
                fwrite(
                    $file,
                    "\xEF\xBB\xBF"
                );

                // Header
                fputcsv($file, [
                    'Nama Produk',
                    'SKU',
                    'Kategori',
                    'Supplier',
                    'Ukuran',
                    'Warna',
                    'Deskripsi',
                    'Harga Beli',
                    'Harga Jual',
                    'Stok',
                    'Stok Minimum',
                ]);

                // Data
                foreach ($products as $product) {

                    $supplierNames = $product->suppliers
                        ->pluck('name')
                        ->implode(', ');

                    fputcsv($file, [
                        $product->name,
                        $product->sku,
                        $product->category?->name ?? '',
                        $supplierNames,
                        $product->size ?? '',
                        $product->color ?? '',
                        $product->description ?? '',
                        $product->purchase_price,
                        $product->selling_price,
                        $product->stock,
                        $product->minimum_stock ?? 5,
                    ]);
                }

                fclose($file);

            },
            $fileName,
            [
                'Content-Type' =>
                    'text/csv; charset=UTF-8',

                'Content-Disposition' =>
                    'attachment; filename="' .
                    $fileName .
                    '"',
            ]
        );
    }


    /**
     * Import data produk dari CSV
     */
    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:csv,txt',
                'max:5120',
            ],
        ], [
            'file.required' =>
                'Silakan pilih file CSV terlebih dahulu.',

            'file.file' =>
                'File yang diunggah tidak valid.',

            'file.mimes' =>
                'File harus berformat CSV atau TXT.',

            'file.max' =>
                'Ukuran file maksimal 5 MB.',
        ]);


        $uploadedFile = $request->file('file');

        $handle = fopen(
            $uploadedFile->getRealPath(),
            'r'
        );


        if ($handle === false) {

            return redirect()
                ->route('products.index')
                ->with(
                    'error',
                    'File CSV tidak dapat dibaca.'
                );
        }


        $imported = 0;
        $skipped = 0;
        $failedRows = [];


        try {

            $header = fgetcsv($handle);


            if (
                $header === false ||
                count($header) < 10
            ) {

                fclose($handle);

                return redirect()
                    ->route('products.index')
                    ->with(
                        'error',
                        'Format CSV tidak sesuai. File harus memiliki minimal 10 kolom.'
                    );
            }


            if (isset($header[0])) {

                $header[0] =
                    preg_replace(
                        '/^\xEF\xBB\xBF/',
                        '',
                        (string) $header[0]
                    );
            }


            DB::beginTransaction();

            $lineNumber = 1;


            while (
                ($row = fgetcsv($handle)) !== false
            ) {

                $lineNumber++;


                if (
                    count($row) === 1 &&
                    trim(
                        (string) (
                            $row[0] ?? ''
                        )
                    ) === ''
                ) {

                    continue;
                }


                if (count($row) < 10) {

                    $skipped++;
                    $failedRows[] = $lineNumber;

                    continue;
                }


                $name = trim(
                    (string) (
                        $row[0] ?? ''
                    )
                );

                $sku = trim(
                    (string) (
                        $row[1] ?? ''
                    )
                );

                $categoryName = trim(
                    (string) (
                        $row[2] ?? ''
                    )
                );

                $size = trim(
                    (string) (
                        $row[3] ?? ''
                    )
                );

                $color = trim(
                    (string) (
                        $row[4] ?? ''
                    )
                );

                $description = trim(
                    (string) (
                        $row[5] ?? ''
                    )
                );


                $purchasePrice =
                    $this->cleanNumber(
                        $row[6] ?? 0
                    );

                $sellingPrice =
                    $this->cleanNumber(
                        $row[7] ?? 0
                    );

                $stock =
                    $this->cleanNumber(
                        $row[8] ?? 0
                    );

                $minimumStock =
                    $this->cleanNumber(
                        $row[9] ?? 5
                    );


                if (
                    $name === '' ||
                    $sku === ''
                ) {

                    $skipped++;
                    $failedRows[] = $lineNumber;

                    continue;
                }


                if (
                    Product::where(
                        'sku',
                        $sku
                    )->exists()
                ) {

                    $skipped++;
                    $failedRows[] = $lineNumber;

                    continue;
                }


                if (
                    $purchasePrice === null ||
                    $sellingPrice === null ||
                    $stock === null ||
                    $minimumStock === null
                ) {

                    $skipped++;
                    $failedRows[] = $lineNumber;

                    continue;
                }


                if (
                    $purchasePrice < 0 ||
                    $sellingPrice < 0 ||
                    $stock < 0 ||
                    $minimumStock < 0
                ) {

                    $skipped++;
                    $failedRows[] = $lineNumber;

                    continue;
                }


                if (
                    floor($stock) != $stock ||
                    floor($minimumStock) != $minimumStock
                ) {

                    $skipped++;
                    $failedRows[] = $lineNumber;

                    continue;
                }


                // Cari / buat kategori
                $category = null;

                if ($categoryName !== '') {

                    $category =
                        Category::firstOrCreate([
                            'name' =>
                                $categoryName,
                        ]);
                }


                if ($category === null) {

                    $skipped++;
                    $failedRows[] = $lineNumber;

                    continue;
                }


                // Simpan produk
                Product::create([
                    'category_id' =>
                        $category->id,

                    'name' =>
                        $name,

                    'sku' =>
                        $sku,

                    'size' =>
                        $size !== ''
                            ? $size
                            : null,

                    'color' =>
                        $color !== ''
                            ? $color
                            : null,

                    'image' =>
                        null,

                    'description' =>
                        $description !== ''
                            ? $description
                            : null,

                    'purchase_price' =>
                        $purchasePrice,

                    'selling_price' =>
                        $sellingPrice,

                    'stock' =>
                        (int) $stock,

                    'minimum_stock' =>
                        (int) $minimumStock,
                ]);


                $imported++;
            }


            fclose($handle);

            DB::commit();


            ActivityLog::record(
                'created',
                'Import produk selesai. ' .
                $imported .
                ' produk berhasil ditambahkan' .
                (
                    $skipped > 0
                        ? ' dan ' .
                        $skipped .
                        ' baris dilewati.'
                        : '.'
                )
            );


            $message =
                "Import selesai. {$imported} produk berhasil ditambahkan.";


            if ($skipped > 0) {

                $message .=
                    " {$skipped} baris dilewati.";

                if (
                    count($failedRows) > 0
                ) {

                    $message .=
                        ' Baris bermasalah: ' .
                        implode(
                            ', ',
                            $failedRows
                        ) .
                        '.';
                }
            }


            return redirect()
                ->route('products.index')
                ->with(
                    'success',
                    $message
                );

        } catch (Throwable $e) {

            DB::rollBack();

            if (
                is_resource($handle)
            ) {

                fclose($handle);
            }

            report($e);


            return redirect()
                ->route('products.index')
                ->with(
                    'error',
                    'Import gagal. Periksa format CSV dan struktur tabel products.'
                );
        }
    }


    /**
     * Membersihkan angka dari format CSV
     */
    private function cleanNumber(
        $value
    ): ?float {

        if ($value === null) {
            return null;
        }

        $value =
            trim(
                (string) $value
            );

        if ($value === '') {
            return null;
        }


        // Hilangkan simbol mata uang
        $value =
            str_replace(
                [
                    'Rp',
                    'rp',
                    ' ',
                    "\u{00A0}"
                ],
                '',
                $value
            );


        // Titik + koma
        if (
            str_contains(
                $value,
                '.'
            ) &&
            str_contains(
                $value,
                ','
            )
        ) {

            if (
                strrpos(
                    $value,
                    ','
                ) >
                strrpos(
                    $value,
                    '.'
                )
            ) {

                $value =
                    str_replace(
                        '.',
                        '',
                        $value
                    );

                $value =
                    str_replace(
                        ',',
                        '.',
                        $value
                    );

            } else {

                $value =
                    str_replace(
                        ',',
                        '',
                        $value
                    );
            }

        } elseif (
            str_contains(
                $value,
                ','
            )
        ) {

            $value =
                str_replace(
                    ',',
                    '.',
                    $value
                );

        } elseif (
            substr_count(
                $value,
                '.'
            ) > 1
        ) {

            $value =
                str_replace(
                    '.',
                    '',
                    $value
                );
        }


        return is_numeric($value)
            ? (float) $value
            : null;
    }
}