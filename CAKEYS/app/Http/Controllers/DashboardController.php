<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $username = 'Owner';

        $ringkasan_pesanan = [
            'total_order' => 5,
            'total_produkorder' => 9,
            'order_diproses' => 1,
            'order_dikirim' => 2,
            'order_selesai' => 1,
            'income' => 'Rp 4.750.000'
        ];

        $overview = [
            'total_produk' => 13,
            'produk_terlaris' => 'Chocolate Strawberry Cake',
            'stok_menipis' => 1
        ];

        $order = [
            ['id_order' => 'P001', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Fudgy Chocolate Brownies', 'harga' => '300000', 'jumlah' => '2', 'subtotal' => '600000', 'nama_cust' => 'Esther', 'alamat' => 'Bondowoso, Jawa Timur', 'no_telp' => '081234567890', 'email' => 'esther@gmail.com', 'status' => 'Diproses'],
            ['id_order' => 'P002', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Tiramisu Cake', 'harga' => '500000', 'jumlah' => '2', 'subtotal' => '1000000', 'nama_cust' => 'Ophelia', 'alamat' => 'Ubud, Bali', 'no_telp' => '081325476980', 'email' => 'lia@gmail.com', 'status' => 'Dikirim'],
            ['id_order' => 'P003', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Chocolate Cream Pie', 'harga' => '250000', 'jumlah' => '1', 'subtotal' => '500000', 'nama_cust' => 'Amelia', 'alamat' => 'Bandung, Jawa Barat', 'no_telp' => '08237465819', 'email' => 'amel34@gmail.com', 'status' => 'Dikirim'],
            ['id_order' => 'P004', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Apple Pie', 'harga' => '260000', 'jumlah' => '1', 'subtotal' => '520000', 'nama_cust' => 'Sabil', 'alamat' => 'Bondowoso, Jawa Timur', 'no_telp' => '08134675281', 'email' => 'sabilbila@gmail.com', 'status' => 'Diproses'],
            ['id_order' => 'P005', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Chocolate Strawberry Cake', 'harga' => '650000', 'jumlah' => '3', 'subtotal' => '1950000', 'nama_cust' => 'Michell', 'alamat' => 'Bondowoso, Jawa Timur', 'no_telp' => '085326756456', 'email' => 'michi@gmail.com', 'status' => 'Selesai'],
        ];

        return view('dashboard', compact('username', 'ringkasan_pesanan', 'overview', 'order'));
    }
}
