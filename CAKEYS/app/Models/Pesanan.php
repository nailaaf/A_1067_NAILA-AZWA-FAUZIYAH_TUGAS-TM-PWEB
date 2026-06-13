<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_pesanan', 'nama_pemesan', 'no_wa', 'metode_pengambilan',
        'alamat', 'tanggal_diperlukan', 'total_harga', 'status'
    ];

    // Relasi: Satu pesanan punya banyak detail
    public function detail_pesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
