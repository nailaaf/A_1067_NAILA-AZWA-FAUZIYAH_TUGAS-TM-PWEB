<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class PesananController extends Controller
{
    // public function index()
    // {
    //     $order = [
    //         ['id_order' => 'P001', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Fudgy Chocolate Brownies', 'harga' => '300000', 'jumlah' => '2', 'subtotal' => '600000', 'nama_cust' => 'Esther', 'alamat' => 'Bondowoso, Jawa Timur', 'no_telp' => '081234567890', 'email' => 'esther@gmail.com', 'status' => 'Diproses'],
    //         ['id_order' => 'P002', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Tiramisu Cake', 'harga' => '500000', 'jumlah' => '2', 'subtotal' => '1000000', 'nama_cust' => 'Ophelia', 'alamat' => 'Ubud, Bali', 'no_telp' => '081325476980', 'email' => 'lia@gmail.com', 'status' => 'Dikirim'],
    //         ['id_order' => 'P003', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Chocolate Cream Pie', 'harga' => '250000', 'jumlah' => '1', 'subtotal' => '500000', 'nama_cust' => 'Amelia', 'alamat' => 'Bandung, Jawa Barat', 'no_telp' => '08237465819', 'email' => 'amel34@gmail.com', 'status' => 'Dikirim'],
    //         ['id_order' => 'P004', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Apple Pie', 'harga' => '260000', 'jumlah' => '1', 'subtotal' => '520000', 'nama_cust' => 'Sabil', 'alamat' => 'Bondowoso, Jawa Timur', 'no_telp' => '08134675281', 'email' => 'sabilbila@gmail.com', 'status' => 'Diproses'],
    //         ['id_order' => 'P005', 'tanggal_order' => '24-04-26', 'nama_produk' => 'Chocolate Strawberry Cake', 'harga' => '650000', 'jumlah' => '3', 'subtotal' => '1950000', 'nama_cust' => 'Michell', 'alamat' => 'Bondowoso, Jawa Timur', 'no_telp' => '085326756456', 'email' => 'michi@gmail.com', 'status' => 'Selesai'],
    //     ];

    //     return view('pesanan', compact('order'));
    // }

    public function index()
    {
        // Mengubah get() menjadi paginate(10) agar tampil per 10 baris
        $pesanans = Pesanan::orderBy('created_at', 'desc')->paginate(10);
        return view('pesanan.index', compact('pesanans'));
    }

    // 2. Menampilkan Halaman Detail Spesifik 1 Pesanan
    public function show($id)
    {
        // Mengambil pesanan beserta relasi detail dan produknya
        $pesanan = Pesanan::with('detail_pesanan.produk')->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }

    // 3. Mengubah Status & Memicu WhatsApp Otomatis ke Customer
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        // Cek apakah statusnya mengharuskan Owner nge-chat Customer
        if (in_array($request->status, ['Proses Pengantaran', 'Siap Diambil'])) {

            // Merapikan nomor WA (mengubah angka 0 di depan jadi 62)
            $nomorWaCustomer = $pesanan->no_wa;
            if(substr($nomorWaCustomer, 0, 1) == '0') {
                $nomorWaCustomer = '62' . substr($nomorWaCustomer, 1);
            }

            // Merangkai isi pesan otomatis
            $pesanWA = "Halo kak *" . $pesanan->nama_pemesan . "*! 🎂\n\n";
            $pesanWA .= "Kami dari Cakeys ingin mengabarkan bahwa pesanan kakak dengan nomor resi *" . $pesanan->no_pesanan . "* saat ini statusnya: *" . $pesanan->status . "*.\n\n";

            if ($request->status == 'Proses Pengantaran') {
                $pesanWA .= "Pesanan kakak sedang dalam perjalanan menuju alamat: " . $pesanan->alamat . ". Mohon ditunggu ya kak! 🛵\n\n";
            } else {
                $pesanWA .= "Pesanan kakak sudah siap dan bisa diambil di Toko Cakeys (Jl. Jember No. 1) sekarang juga! 🏪\n\n";
            }

            $pesanWA .= "Terima kasih sudah mempercayakan momen spesial kakak bersama Cakeys! 🥰";

            // Membuat Link WA
            $urlWA = "https://api.whatsapp.com/send?phone=" . $nomorWaCustomer . "&text=" . urlencode($pesanWA);

            // Kembali ke halaman detail sambil membawa Pop-up Link WA
            return back()->with('success', 'Status sukses diubah!')->with('whatsapp_url', $urlWA);
        }

        // Jika statusnya cuma "Diproses", "Selesai", dll, ubah diam-diam tanpa pop-up WA
        return back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    // 4. Fitur Lacak Pesanan untuk Customer (Tanpa Login)
    public function lacak(Request $request)
    {
        $pesanan = null;

        // Jika ada inputan nomor resi di kolom pencarian
        if ($request->has('resi') && $request->resi != '') {
            $pesanan = Pesanan::with('detail_pesanan.produk')->where('no_pesanan', trim($request->resi))->first();
        }

        return view('cek-pesanan', compact('pesanan'));
    }
}
