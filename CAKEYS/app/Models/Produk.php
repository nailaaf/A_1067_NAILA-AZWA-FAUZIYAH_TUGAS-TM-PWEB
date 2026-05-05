<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'is_available',
        'gambar'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'harga' => 'decimal:2',
    ];

    public function scopeTersedia($query)
    {
        return $query->where('is_available', true)->where('stok', '>', 0);
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'produk_topping');
    }
}
