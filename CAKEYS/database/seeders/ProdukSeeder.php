<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $dataProduk = [
            ['kode_produk' => 'C001', 'nama_produk' => 'Classic Chocolate Cake', 'kategori' => 'cake', 'harga' => 430000, 'stok' => 10, 'is_available' => true, 'gambar' => 'images/chocolate-cake-square.jpg'],
            ['kode_produk' => 'C002', 'nama_produk' => 'Black Velvet Cake', 'kategori' => 'cake', 'harga' => 580000, 'stok' => 10, 'is_available' => true, 'gambar' => 'images/black-velvet-cake-square.jpg'],
            ['kode_produk' => 'C003', 'nama_produk' => 'Red Velvet Cake', 'kategori' => 'cake', 'harga' => 450000, 'stok' => 10, 'is_available' => true, 'gambar' => 'images/red-velvet-cake-square.jpg'],
            ['kode_produk' => 'C004', 'nama_produk' => 'Chocolate Strawberry Cake', 'kategori' => 'cake', 'harga' => 650000, 'stok' => 2, 'is_available' => true, 'gambar' => 'images/choco-strawberry-square.png'],
            ['kode_produk' => 'C005', 'nama_produk' => 'Tiramisu Cake', 'kategori' => 'cake', 'harga' => 500000, 'stok' => 5, 'is_available' => true, 'gambar' => 'images/tiramisu-cake-square.jpg'],
            ['kode_produk' => 'C006', 'nama_produk' => 'Cream Cheese Brownies', 'kategori' => 'brownies', 'harga' => 275000, 'stok' => 10, 'is_available' => true, 'gambar' => 'images/cream-cheese-brownies.png'],
            ['kode_produk' => 'C007', 'nama_produk' => 'Fudgy Chocolate Brownies', 'kategori' => 'brownies', 'harga' => 300000, 'stok' => 8, 'is_available' => true, 'gambar' => 'images/fudgy-chocolate-brownies.jpg'],
            ['kode_produk' => 'C008', 'nama_produk' => 'Strawberry Brownies', 'kategori' => 'brownies', 'harga' => 300000, 'stok' => 10, 'is_available' => true, 'gambar' => 'images/strawberry-brownies.webp'],
            ['kode_produk' => 'C009', 'nama_produk' => 'Tiramisu Brownies', 'kategori' => 'brownies', 'harga' => 250000, 'stok' => 0, 'is_available' => false, 'gambar' => 'images/tiramisu-brownie.webp'],
        ];

        foreach ($dataProduk as $produk) {
            Produk::create($produk);
        }
    }
}
