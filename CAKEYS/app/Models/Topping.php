<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_topping',
        'tambahan_harga'
    ];

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'produk_topping');
    }
}
