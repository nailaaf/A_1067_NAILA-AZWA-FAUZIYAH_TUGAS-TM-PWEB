<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        $kategori = ['cake', 'brownies', 'pies', 'cupcake'];
        
        $produk = [
            ['id_produk' => 'C001', 'nama_produk' => 'Classic Chocolate Cake', 'kategori' => 'cake', 'harga' => '430000', 'stok' => '10', 'images' => 'images/chocolate-cake-square.jpg'],
            ['id_produk' => 'C002', 'nama_produk' => 'Black Velvet Cake', 'kategori' => 'cake', 'harga' => '580000', 'stok' => '10', 'images' => 'images/black-velvet-cake-square.jpg'],
            ['id_produk' => 'C003', 'nama_produk' => 'Red Velvet Cake', 'kategori' => 'cake', 'harga' => '450000', 'stok' => '10', 'images' => 'images/red-velvet-cake-square.jpg'],
            ['id_produk' => 'C004', 'nama_produk' => 'Chocolate Strawberry Cake', 'kategori' => 'cake', 'harga' => '650000', 'stok' => '2', 'images' => 'images/choco-strawberry-square.png'],
            ['id_produk' => 'C005', 'nama_produk' => 'Tiramisu Cake', 'kategori' => 'cake', 'harga' => '500000', 'stok' => '5', 'images' => 'images/tiramisu-cake-square.jpg'],
            ['id_produk' => 'C006', 'nama_produk' => 'Cream Cheese Brownies', 'kategori' => 'brownies', 'harga' => '275000', 'stok' => '10', 'images' => 'images/cream-cheese-brownies.png'],
            ['id_produk' => 'C007', 'nama_produk' => 'Fudgy Chocolate Brownies', 'kategori' => 'brownies', 'harga' => '300000', 'stok' => '8', 'images' => 'images/fudgy-chocolate-brownies.jpg'],
            ['id_produk' => 'C008', 'nama_produk' => 'Strawberry Brownies', 'kategori' => 'brownies', 'harga' => '300000', 'stok' => '10', 'images' => 'images/strawberry-brownies.webp'],
            ['id_produk' => 'C009', 'nama_produk' => 'Tiramisu Brownies', 'kategori' => 'brownies', 'harga' => '250000', 'stok' => '10', 'images' => 'images/tiramisu-brownie.webp'],
            ['id_produk' => 'C0010', 'nama_produk' => 'Blueberry Pie', 'kategori' => 'pies', 'harga' => '260000', 'stok' => '10', 'images' => 'images/blueberry-pie-square.jpg'],
            ['id_produk' => 'C0011', 'nama_produk' => 'Chocolate Cream Pie', 'kategori' => 'pies', 'harga' => '250000', 'stok' => '9', 'images' => 'images/chocolate-cream-pie.png'],
            ['id_produk' => 'C0012', 'nama_produk' => 'Strawberry Pie', 'kategori' => 'pies', 'harga' => '300000', 'stok' => '10', 'images' => 'images/strawberry-pie-square.jpg'],
            ['id_produk' => 'C0013', 'nama_produk' => 'Apple Pie', 'kategori' => 'pies', 'harga' => '260000', 'stok' => '9', 'images' => 'images/apple-pie-square.jpg'],
        ];

        return view('katalog', compact('produk', 'kategori'));
    }
}
