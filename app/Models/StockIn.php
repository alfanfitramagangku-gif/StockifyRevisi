<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'quantity',
        'date',
        'description',
        'status',
        'confirmed_by',
        'confirmed_at',
    ];


    protected $casts = [
        'date' => 'date',
        'confirmed_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | PRODUK
    |--------------------------------------------------------------------------
    */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    /*
    |--------------------------------------------------------------------------
    | SUPPLIER
    |--------------------------------------------------------------------------
    */

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }


    /*
    |--------------------------------------------------------------------------
    | USER YANG MELAKUKAN KONFIRMASI
    |--------------------------------------------------------------------------
    */

    public function confirmer()
    {
        return $this->belongsTo(
            User::class,
            'confirmed_by'
        );
    }
}