<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $username = Auth::user()->name;

        // --- 1. AMBIL DATA OVERVIEW PRODUK ---
        $totalProduk = Produk::count();
        $stokMenipis = Produk::where('stok', '<=', 5)->count();

        // Logika sederhana mencari produk paling banyak dibeli
        $terlaris = DetailPesanan::selectRaw('produk_id, SUM(jumlah) as total_terjual')
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->first();
        $namaTerlaris = $terlaris && $terlaris->produk ? $terlaris->produk->nama_produk : 'Belum ada penjualan';

        $overview = [
            [
                'judul' => 'Total Produk', 'nilai' => $totalProduk, 'ikon' => '📦', 'warna' => 'var(--primary-color)',
                'link' => route('produk.index') // Arahkan ke Produk
            ],
            [
                'judul' => 'Produk Terlaris', 'nilai' => $namaTerlaris, 'ikon' => '🌟', 'warna' => 'var(--primary-color)',
                'link' => route('laporan.index') // Arahkan ke Laporan
            ],
            [
                'judul' => 'Stok Menipis', 'nilai' => $stokMenipis . ' Produk', 'ikon' => '⚠️', 'warna' => '#E11D48',
                'link' => route('produk.index') // Arahkan ke Produk
            ]
        ];


        // --- 2. AMBIL DATA RINGKASAN PESANAN (DIPISAH ATAS & BAWAH) ---
        $totalOrder = Pesanan::count();
        $produkDiorder = DetailPesanan::sum('jumlah');
        $totalPendapatan = Pesanan::where('status', 'Selesai')->sum('total_harga'); // Menghitung pendapatan hanya dari pesanan selesai

        $menunggu = Pesanan::where('status', 'Menunggu Pembayaran')->count();
        $diproses = Pesanan::where('status', 'Diproses')->count();
        $dikirim = Pesanan::whereIn('status', ['Proses Pengantaran', 'Siap Diambil'])->count();
        $selesai = Pesanan::where('status', 'Selesai')->count();

        $ringkasan_atas = [
            ['judul' => 'Total Order', 'nilai' => $totalOrder, 'ikon' => '🛒', 'warna' => 'var(--primary-color)', 'link' => route('pesanan.index')],
            ['judul' => 'Produk Diorder', 'nilai' => $produkDiorder, 'ikon' => '🛍️', 'warna' => 'var(--primary-color)', 'link' => route('laporan.index')],
            ['judul' => 'Total Pendapatan', 'nilai' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'), 'ikon' => '💰', 'warna' => 'var(--primary-color)', 'link' => route('laporan.index')]
        ];

        $ringkasan_bawah = [
            ['judul' => 'Menunggu Pembayaran', 'nilai' => $menunggu, 'ikon' => '🕒', 'warna' => '#DC3545', 'link' => route('pesanan.index')],
            ['judul' => 'Pesanan Diproses', 'nilai' => $diproses, 'ikon' => '⏳', 'warna' => '#D97706', 'link' => route('pesanan.index')],
            ['judul' => 'Dikirim / Diambil', 'nilai' => $dikirim, 'ikon' => '🚚', 'warna' => '#2563EB', 'link' => route('pesanan.index')],
            ['judul' => 'Pesanan Selesai', 'nilai' => $selesai, 'ikon' => '✅', 'warna' => '#16A34A', 'link' => route('pesanan.index')]
        ];


        // --- 3. AMBIL DATA 5 ORDERAN TERBARU ---
        $order = Pesanan::with('detail_pesanan.produk')->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact('username', 'overview', 'ringkasan_atas', 'ringkasan_bawah', 'order'));
    }
}
