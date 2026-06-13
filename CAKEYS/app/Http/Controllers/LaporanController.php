<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil inputan filter tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // 2. Query Dasar Pesanan (Hanya ambil yang sudah 'Selesai')
        $queryPesanan = Pesanan::with('detail_pesanan.produk')->where('status', 'Selesai');

        // Jika filter tanggal diisi, terapkan filternya
        if ($startDate) {
            $queryPesanan->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $queryPesanan->whereDate('created_at', '<=', $endDate);
        }

        // --- DATA LAPORAN PENJUALAN & KEUANGAN ---
        $laporanPenjualan = $queryPesanan->orderBy('created_at', 'desc')->get();
        $totalPendapatan = $laporanPenjualan->sum('total_harga');
        $totalTransaksi = $laporanPenjualan->count();

        // --- DATA PERFORMA PRODUK (Kue Terlaris) ---
        // Ambil detail pesanan yang pesanannya berstatus 'Selesai' dan sesuai filter tanggal
        $detailTerjual = DetailPesanan::whereHas('pesanan', function($q) use ($startDate, $endDate) {
            $q->where('status', 'Selesai');
            if ($startDate) $q->whereDate('created_at', '>=', $startDate);
            if ($endDate) $q->whereDate('created_at', '<=', $endDate);
        })->with('produk')->get();

        $performaProduk = [];
        foreach ($detailTerjual as $detail) {
            if (!$detail->produk) continue; // Skip jika produk sudah dihapus

            $id = $detail->produk_id;
            if(!isset($performaProduk[$id])) {
                $performaProduk[$id] = [
                    'kode' => $detail->produk->kode_produk,
                    'nama' => $detail->produk->nama_produk,
                    'terjual' => 0,
                    'pendapatan' => 0
                ];
            }
            $performaProduk[$id]['terjual'] += $detail->jumlah;
            $performaProduk[$id]['pendapatan'] += ($detail->harga_kue + $detail->addon_harga) * $detail->jumlah;
        }

        // Urutkan array dari kue yang paling banyak terjual
        usort($performaProduk, function($a, $b) {
            return $b['terjual'] <=> $a['terjual'];
        });


        // --- DATA LAPORAN STOK ---
        // Stok tidak terpengaruh filter tanggal (menampilkan stok real-time saat ini)
        // Diurutkan dari stok yang paling sedikit (menipis) ke paling banyak
        $laporanStok = Produk::orderBy('stok', 'asc')->get();

        return view('laporan.index', compact(
            'laporanPenjualan', 'totalPendapatan', 'totalTransaksi',
            'performaProduk', 'laporanStok', 'startDate', 'endDate'
        ));
    }
}
