<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id', 'produk_id', 'jumlah', 'harga_kue', 'addon_harga', 'catatan'
    ];

    // Relasi: Detail pesanan ini milik pesanan yang mana?
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    // Relasi: Detail pesanan ini kue yang mana?
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
