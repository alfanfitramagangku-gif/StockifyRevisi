<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'size',
        'color',
        'image',
        'description',
        'purchase_price',
        'selling_price',
        'stock',
        'minimum_stock',
    ];

    /**
     * Relasi produk dengan kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi produk dengan supplier.
     *
     * Satu produk dapat memiliki banyak supplier.
     */
    public function suppliers()
    {
        return $this->belongsToMany(
            Supplier::class,
            'product_supplier',
            'product_id',
            'supplier_id'
        )->withTimestamps();
    }

    /**
     * Relasi produk dengan stok masuk.
     */
    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }
}