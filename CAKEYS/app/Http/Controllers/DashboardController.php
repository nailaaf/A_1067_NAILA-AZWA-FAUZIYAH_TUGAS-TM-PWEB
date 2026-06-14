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

        // --- KUMPULAN ICON SVG CUSTOM (SUDAH DIATUR AGAR KELIHATAN DI DARK MODE) ---

        // Total Produk (Menggunakan var(--primary-color) agar otomatis menyesuaikan tema)
        $svgTotalProduk = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none" /><path fill="var(--primary-color)" d="M8.422 20.618C10.178 21.54 11.056 22 12 22V12L2.638 7.073l-.04.067C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709z" /><path fill="var(--primary-color)" d="m17.577 4.432l-2-1.05C13.822 2.461 12.944 2 12 2c-.945 0-1.822.46-3.578 1.382l-2 1.05C4.318 5.536 3.242 6.1 2.638 7.072L12 12l9.362-4.927c-.606-.973-1.68-1.537-3.785-2.641" opacity=".7" /><path fill="var(--primary-color)" d="m21.403 7.14l-.041-.067L12 12v10c.944 0 1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.597-1.014.597-2.277.597-4.8v-.117c0-2.525 0-3.788-.597-4.802" opacity=".5" /><path fill="var(--primary-color)" d="m6.323 4.484l.1-.052l1.493-.784l9.1 5.005l4.025-2.011q.205.232.362.498c.15.254.262.524.346.825L17.75 9.964V13a.75.75 0 0 1-1.5 0v-2.286l-3.5 1.75v9.44A3 3 0 0 1 12 22c-.248 0-.493-.032-.75-.096v-9.44l-8.998-4.5c.084-.3.196-.57.346-.824q.156-.266.362-.498l9.04 4.52l3.387-1.693z" /></svg>';

        // Produk Terlaris (Warna bawaan sudah cerah, aman di Dark Mode)
        $svgTerlaris = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><path d="M0 0h512v512H0z" fill="none" /><path fill="#FFB636" d="m252.5 381l-128 49c-5.9 2.2-12.1-2.3-11.8-8.6l7-136.9c.1-2.1-.6-4.2-1.9-5.9L31.6 172c-4-4.9-1.6-12.2 4.5-13.9l132.4-35.6c2.1-.6 3.9-1.9 5-3.7L248.3 4c3.4-5.3 11.2-5.3 14.6 0l74.8 114.9c1.2 1.8 3 3.1 5 3.7l132.4 35.6c6.1 1.6 8.5 9 4.5 13.9l-86.1 106.6c-1.3 1.7-2 3.8-1.9 5.9l7 136.9c.3 6.3-5.9 10.8-11.8 8.6l-128-49c-2.1-.8-4.3-.8-6.3-.1" /><path fill="#FFD469" d="m456.1 51.7l-41-41c-1.2-1.2-2.8-1.7-4.4-1.5s-3.1 1.2-3.9 2.6l-42.3 83.3c-1.2 2.1-.8 4.6.9 6.3c1 1 2.4 1.5 3.7 1.5c.9 0 1.8-.2 2.6-.7L454.9 60c1.4-.8 2.4-2.2 2.6-3.9c.3-1.6-.3-3.2-1.4-4.4m-307 43.5l-42.3-83.3c-.8-1.4-2.2-2.4-3.9-2.6c-1.6-.2-3.3.3-4.4 1.5l-41 41c-1.2 1.2-1.7 2.8-1.5 4.4s1.2 3.1 2.6 3.9l83.3 42.3c.8.5 1.7.7 2.6.7c1.4 0 2.7-.5 3.7-1.5c1.7-1.8 2-4.4.9-6.4m140.7 410l-29-88.8c-.2-.9-.7-1.7-1.3-2.3c-1-1-2.3-1.5-3.7-1.5c-2.4 0-4.4 1.6-5.1 3.9l-29 88.8c-.4 1.6-.1 3.3.9 4.6s2.5 2.1 4.2 2.1h57.9c1.6 0 3.2-.8 4.2-2.1c1.1-1.4 1.4-3.1.9-4.7" /></svg>';

        // Stok Menipis (Diubah menjadi merah yang lebih cerah #EF4444 agar tidak tenggelam)
        $svgMenipis = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none" /><path fill="#EF4444" d="M4.47 21h15.06c1.54 0 2.5-1.67 1.73-3L13.73 4.99c-.77-1.33-2.69-1.33-3.46 0L2.74 18c-.77 1.33.19 3 1.73 3M12 14c-.55 0-1-.45-1-1v-2c0-.55.45-1 1-1s1 .45 1 1v2c0 .55-.45 1-1 1m1 4h-2v-2h2z" /></svg>';

        // Total Order (Menggunakan var(--primary-color))
        $svgTotalOrder = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none" /><path fill="var(--primary-color)" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2" /></svg>';

        // Produk Diorder (Diubah menjadi biru terang #3B82F6)
        $svgDiorder = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none" /><path fill="#3B82F6" fill-rule="evenodd" d="M8.25 6.015V5a3.75 3.75 0 0 1 7.5 0v1.015c1.287.039 2.075.177 2.676.676c.833.692 1.053 1.862 1.492 4.203l.75 4c.617 3.292.925 4.938.026 6.022C19.794 22 18.119 22 14.77 22H9.23c-3.35 0-5.024 0-5.924-1.084s-.59-2.73.026-6.022l.75-4c.44-2.34.659-3.511 1.492-4.203c.601-.499 1.389-.637 2.676-.676M9.75 5a2.25 2.25 0 1 1 4.5 0v1h-4.5z" clip-rule="evenodd" /></svg>';

        // Total Pendapatan (Warna emas bawaan sudah cerah, aman di Dark Mode)
        $svgPendapatan = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none" /><path fill="#e2a610" d="M9 8h6a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2m.47-3.5a.5.5 0 0 0 .5.44H14a.51.51 0 0 0 .5-.44a9.2 9.2 0 0 1 1.2-3a.47.47 0 0 0-.07-.57a.5.5 0 0 0-.53-.18l-1.86.8a.23.23 0 0 1-.2 0a.25.25 0 0 1-.14-.13L12.46.31a.5.5 0 0 0-.92 0l-.44 1.11a.25.25 0 0 1-.14.13a.23.23 0 0 1-.2 0L8.9.75a.5.5 0 0 0-.56.13a.47.47 0 0 0-.07.57a9.2 9.2 0 0 1 1.2 3.05m5.97 4.62a.58.58 0 0 0-.36-.12H8.92a.58.58 0 0 0-.36.12c-2.55 2-5.4 5.4-5.4 8.4C3.16 21.75 5.52 24 12 24s8.84-2.25 8.84-6.48c0-3-2.84-6.45-5.4-8.4M13 20.13a.26.26 0 0 0-.21.25v.37a.75.75 0 0 1-1.5 0v-.32a.25.25 0 0 0-.25-.25h-.59a.75.75 0 0 1 0-1.5h2.15a.67.67 0 0 0 .25-1.3l-2.18-.87a2.16 2.16 0 0 1 .33-4.14a.26.26 0 0 0 .21-.25v-.37a.75.75 0 0 1 1.5 0v.32a.25.25 0 0 0 .25.25h.59a.75.75 0 0 1 0 1.5h-2.11a.67.67 0 0 0-.25 1.3l2.18.87a2.16 2.16 0 0 1-.37 4.14" /></svg>';

        // Menunggu Pembayaran (Diubah menjadi merah yang lebih cerah #EF4444)
        $svgMenunggu = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none" /><path fill="#EF4444" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" /><rect width="2" height="7" x="11" y="6" fill="#EF4444" rx="1"><animateTransform attributeName="transform" dur="9s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12" /></rect><rect width="2" height="9" x="11" y="11" fill="#EF4444" rx="1"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12" /></rect></svg>';

        // Pesanan Diproses (Diubah menjadi orange cerah #F59E0B)
        $svgDiproses = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none" /><g><path fill="#F59E0B" d="M7 3H17V7.2L12 12L7 7.2V3Z"><animate id="SVGFjnOndxt" fill="freeze" attributeName="opacity" begin="0;SVGn6mLadge.end" dur="2s" from="1" to="0" /></path><path fill="#F59E0B" d="M17 21H7V16.8L12 12L17 16.8V21Z"><animate fill="freeze" attributeName="opacity" begin="0;SVGn6mLadge.end" dur="2s" from="0" to="1" /></path><path fill="#F59E0B" d="M6 2V8H6.01L6 8.01L10 12L6 16L6.01 16.01H6V22H18V16.01H17.99L18 16L14 12L18 8.01L17.99 8H18V2H6ZM16 16.5V20H8V16.5L12 12.5L16 16.5ZM12 11.5L8 7.5V4H16V7.5L12 11.5Z" /><animateTransform id="SVGn6mLadge" attributeName="transform" attributeType="XML" begin="SVGFjnOndxt.end" dur="0.5s" from="0 12 12" to="180 12 12" type="rotate" /></g></svg>';

        // Dikirim/Diambil (Diubah warna hitam pekatnya menjadi var(--text-color) agar bisa putih otomatis saat Dark Mode)
        $svgDikirim = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><path d="M0 0h512v512H0z" fill="none" /><path fill="#C7CFD3" d="M504.505 377.843H171.057V115.342c0-26.6 21.563-48.163 48.163-48.163h237.123c26.6 0 48.163 21.563 48.163 48.163v262.501z" /><path fill="#FF473E" d="M87.196 198.558h61.285c12.468 0 22.576 11.188 22.576 24.989v153.961H6.812v-75.8c0-8.864 2.664-17.477 7.573-24.481l44.302-63.211c6.834-9.752 17.358-15.458 28.509-15.458" /><path fill="var(--text-color)" d="M15.467 420.116h482.79c7.354 0 13.315-5.961 13.315-13.315V384.22a6.71 6.71 0 0 0-6.712-6.712H6.908a4.756 4.756 0 0 0-4.756 4.755V406.8c0 7.354 5.962 13.316 13.315 13.316" /><path fill="#76DFFF" d="m37.741 282.906l38.847-55.394c.905-1.291 2.297-2.046 3.771-2.046h45.922c2.639 0 4.778 2.375 4.778 5.304v55.394c0 2.929-2.139 5.304-4.778 5.304H41.512c-3.977 0-6.214-5.079-3.771-8.562" /><path fill="#FFD469" d="M20.039 352.665H6.812v-35.062h13.227c6.202 0 11.229 5.027 11.229 11.229v12.603c0 6.203-5.027 11.23-11.229 11.23" /><path fill="var(--secondary-color)" d="M128.69 432.253c0 22.227-18.018 40.245-40.245 40.245S48.2 454.48 48.2 432.253s18.018-40.245 40.245-40.245s40.245 18.019 40.245 40.245m152.916-40.244c-22.227 0-40.245 18.018-40.245 40.245s18.018 40.245 40.245 40.245s40.245-18.018 40.245-40.245s-18.019-40.245-40.245-40.245m112.35 0c-22.227 0-40.245 18.018-40.245 40.245s18.018 40.245 40.245 40.245s40.245-18.018 40.245-40.245s-18.018-40.245-40.245-40.245" /><path fill="var(--text-color)" d="M114.823 432.253c0 14.568-11.81 26.378-26.378 26.378s-26.378-11.81-26.378-26.378s11.81-26.378 26.378-26.378s26.378 11.81 26.378 26.378m166.783-26.377c-14.568 0-26.378 11.81-26.378 26.378s11.81 26.378 26.378 26.378s26.378-11.81 26.378-26.378s-11.81-26.378-26.378-26.378m112.35 0c-14.568 0-26.378 11.81-26.378 26.378s11.81 26.378 26.378 26.378s26.378-11.81 26.378-26.378s-11.81-26.378-26.378-26.378" /></svg>';

        // Pesanan Selesai (Diubah menjadi hijau yang lebih cerah #22C55E)
        $svgSelesai = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M0 0h20v20H0z" fill="none" /><path fill="#22C55E" fill-rule="evenodd" d="M3.213 5.8c.015.759-.398 1.785-.935 2.321a2.66 2.66 0 0 0 0 3.76c.53.528.92 1.444.935 2.192c.014.662.273 1.32.778 1.824a2.65 2.65 0 0 0 1.748.775c.791.04 1.827.5 2.387 1.06a2.66 2.66 0 0 0 3.759 0c.56-.56 1.596-1.02 2.387-1.06a2.65 2.65 0 0 0 1.748-.775a2.65 2.65 0 0 0 .777-1.826c.015-.746.4-1.656.929-2.184a2.663 2.663 0 0 0 .006-3.766c-.536-.535-.95-1.562-.934-2.32a2.65 2.65 0 0 0-.778-1.932a2.65 2.65 0 0 0-2.015-.775c-.714.036-1.615-.31-2.12-.816a2.66 2.66 0 0 0-3.76 0c-.504.505-1.406.852-2.12.816a2.65 2.65 0 0 0-2.014.775A2.65 2.65 0 0 0 3.213 5.8m9.828.826a1 1 0 0 1 .389 1.36l-2.768 4.982a1 1 0 0 1-.298.343a1 1 0 0 1-1.23-.045l-2.759-2.207a1 1 0 1 1 1.25-1.562l1.853 1.483l2.203-3.966a1 1 0 0 1 1.36-.388" clip-rule="evenodd" /></svg>';

        // --- MENGGABUNGKAN ARRAY ---
        $overview = [
            ['judul' => 'Total Produk', 'nilai' => $totalProduk, 'ikon' => $svgTotalProduk, 'warna' => 'var(--primary-color)', 'link' => route('produk.index')],
            ['judul' => 'Produk Terlaris', 'nilai' => $namaTerlaris, 'ikon' => $svgTerlaris, 'warna' => 'var(--primary-color)', 'link' => route('laporan.index')],
            ['judul' => 'Stok Menipis', 'nilai' => $stokMenipis . ' Produk', 'ikon' => $svgMenipis, 'warna' => '#E11D48', 'link' => route('produk.index')]
        ];

        // --- 2. AMBIL DATA RINGKASAN PESANAN ---
        $totalOrder = Pesanan::count();
        $produkDiorder = DetailPesanan::sum('jumlah');
        $totalPendapatan = Pesanan::where('status', 'Selesai')->sum('total_harga');

        $menunggu = Pesanan::where('status', 'Menunggu Pembayaran')->count();
        $diproses = Pesanan::where('status', 'Diproses')->count();
        $dikirim = Pesanan::whereIn('status', ['Proses Pengantaran', 'Siap Diambil'])->count();
        $selesai = Pesanan::where('status', 'Selesai')->count();

        $ringkasan_atas = [
            ['judul' => 'Total Order', 'nilai' => $totalOrder, 'ikon' => $svgTotalOrder, 'warna' => 'var(--primary-color)', 'link' => route('pesanan.index')],
            ['judul' => 'Produk Diorder', 'nilai' => $produkDiorder, 'ikon' => $svgDiorder, 'warna' => 'var(--primary-color)', 'link' => route('laporan.index')],
            ['judul' => 'Total Pendapatan', 'nilai' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'), 'ikon' => $svgPendapatan, 'warna' => 'var(--primary-color)', 'link' => route('laporan.index')]
        ];

        $ringkasan_bawah = [
            ['judul' => 'Menunggu Pembayaran', 'nilai' => $menunggu, 'ikon' => $svgMenunggu, 'warna' => '#DC3545', 'link' => route('pesanan.index')],
            ['judul' => 'Pesanan Diproses', 'nilai' => $diproses, 'ikon' => $svgDiproses, 'warna' => '#D97706', 'link' => route('pesanan.index')],
            ['judul' => 'Dikirim / Diambil', 'nilai' => $dikirim, 'ikon' => $svgDikirim, 'warna' => '#2563EB', 'link' => route('pesanan.index')],
            ['judul' => 'Pesanan Selesai', 'nilai' => $selesai, 'ikon' => $svgSelesai, 'warna' => '#16A34A', 'link' => route('pesanan.index')]
        ];

        // --- 3. AMBIL DATA 5 ORDERAN TERBARU ---
        $order = Pesanan::with('detail_pesanan.produk')->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact('username', 'overview', 'ringkasan_atas', 'ringkasan_bawah', 'order'));
    }
}
