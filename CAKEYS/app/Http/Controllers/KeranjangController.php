<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        $total = 0;

        // Hitung grand total
        foreach($keranjang as $item) {
            $subtotal = ($item['harga_kue'] + $item['addon_harga']) * $item['jumlah'];
            $total += $subtotal;
        }

        return view('keranjang', compact('keranjang', 'total'));
    }

    // Fungsi untuk menambah item ke session keranjang
    public function tambah(Request $request)
    {
        // Cari data kue dari database berdasarkan ID yang dikirim form
        $produk = \App\Models\Produk::findOrFail($request->produk_id);

        // Ambil session 'keranjang' saat ini. Jika kosong, buat array baru []
        $keranjang = session()->get('keranjang', []);

        // Rapikan data catatan dan add-on
        $catatan = $request->catatan ? trim($request->catatan) : '-';
        $addon = $request->addon ?? 0;

        // Membuat ID unik berdasarkan kombinasi Produk + Add-on + Catatan
        // Jika ketiganya sama persis, MD5 hash-nya akan sama.
        $cartItemId = md5($produk->id . '_' . $addon . '_' . strtolower($catatan));

        // Cek apakah barang dengan spesifikasi persis ini sudah ada di keranjang
        if(isset($keranjang[$cartItemId])) {
            // Jika ada, cukup tambahkan jumlah kuantitinya saja
            $keranjang[$cartItemId]['jumlah'] += $request->jumlah;
        } else {
            // Jika belum ada (atau catatannya beda), buat baris baru
            $keranjang[$cartItemId] = [
                'produk_id'   => $produk->id,
                'nama_produk' => $produk->nama_produk,
                'gambar'      => $produk->gambar,
                'harga_kue'   => $produk->harga,
                'addon_harga' => $addon,
                'jumlah'      => $request->jumlah,
                'catatan'     => $catatan,
            ];
        }

        // Simpan kembali array yang sudah diupdate ke dalam Session
        session()->put('keranjang', $keranjang);

        // Lempar kembali customer ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', '🎂 Asyik! Kue berhasil dimasukkan ke keranjang.');
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang');

        if(isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return back()->with('success', 'Kue berhasil dihapus dari keranjang.');
    }

    // Fungsi memproses checkout
    public function checkout(Request $request)
    {
        // 1. Ambil session keranjang
        $keranjang = session()->get('keranjang');

        if (!$keranjang || count($keranjang) == 0) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        // 2. Hitung Grand Total & Siapkan Teks Rincian untuk WA
        $total = 0;
        $teksRincian = "";

        foreach ($keranjang as $item) {
            $subtotal = ($item['harga_kue'] + $item['addon_harga']) * $item['jumlah'];
            $total += $subtotal;

            $teksRincian .= "- " . $item['jumlah'] . "x " . $item['nama_produk'] . " (Catatan: " . $item['catatan'] . ")\n";
        }

        // 3. Simpan ke Tabel `pesanans` (Struk Utama)
        $pesanan = Pesanan::create([
            'no_pesanan'         => 'ORD-' . strtoupper(substr(uniqid(), -6)), // Menghasilkan nomor unik seperti ORD-A1B2C3
            'nama_pemesan'       => $request->nama,
            'no_wa'              => $request->no_wa,
            'metode_pengambilan' => $request->metode,
            'alamat'             => $request->alamat,
            'tanggal_diperlukan' => $request->tanggal,
            'total_harga'        => $total,
            'status'             => 'Menunggu Pembayaran'
        ]);

        // 4. Simpan ke Tabel `detail_pesanans` (Rincian Item) sekaligus Kurangi Stok
        foreach ($keranjang as $item) {
            DetailPesanan::create([
                'pesanan_id'  => $pesanan->id,
                'produk_id'   => $item['produk_id'],
                'jumlah'      => $item['jumlah'],
                'harga_kue'   => $item['harga_kue'],
                'addon_harga' => $item['addon_harga'],
                'catatan'     => $item['catatan']
            ]);

            // --- TAMBAHAN BARU: Kurangi stok kue di database ---
            $kue = \App\Models\Produk::find($item['produk_id']);
            if ($kue) {
                $kue->stok = $kue->stok - $item['jumlah'];
                $kue->save();
            }
        }

        // 5. Hapus session keranjang karena sudah berhasil dicheckout
        session()->forget('keranjang');

        // 6. Rangkai Pesan WhatsApp Otomatis
        $nomorWaAdmin = "6281615112608"; // GANTI DENGAN NOMOR WA ADMIN CAKEYS (Gunakan 62, jangan 0 atau +)

        $pesanWA = "Halo Admin *Cakeys*! 🎂\nSaya ingin mengonfirmasi pesanan saya:\n\n";
        $pesanWA .= "*Nomor Pesanan:* " . $pesanan->no_pesanan . "\n";
        $pesanWA .= "*Nama:* " . $request->nama . "\n";
        $pesanWA .= "*Pengambilan:* " . $request->metode . "\n";
        $pesanWA .= "*Tanggal Diperlukan:* " . $request->tanggal . "\n\n";
        $pesanWA .= "*Rincian Kue:*\n" . $teksRincian . "\n";
        $pesanWA .= "*Total Tagihan:* Rp " . number_format($total, 0, ',', '.') . "\n\n";
        $pesanWA .= "Mohon info pembayarannya ya! Terima kasih.";

        // Ubah teks menjadi format link url
        $urlWA = "https://api.whatsapp.com/send?phone=" . $nomorWaAdmin . "&text=" . urlencode($pesanWA);

        // Kembali ke katalog dan bawa URL WA di dalam session
        return redirect()->route('katalog')->with('whatsapp_url', $urlWA);
    }
}
