<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'system_stock',
        'physical_stock',
        'difference',
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function confirmer()
    {
        return $this->belongsTo(
            User::class,
            'confirmed_by'
        );
    }
}