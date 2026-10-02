<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'description',
    ];

    /**
     * Relasi supplier dengan stok masuk.
     */
    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }

    /**
     * Relasi supplier dengan produk.
     *
     * Satu supplier dapat menyediakan banyak produk.
     */
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_supplier',
            'supplier_id',
            'product_id'
        )->withTimestamps();
    }
}