@extends('layouts.app')

@section('title', 'Dashboard Owner - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-welcome">
        <h3>Cakeys's Dashboard</h3>
        <h1>Halo, {{ Auth::user()->name }}! Selamat Datang...</h1>
    </div>

    <!-- OVERVIEW PRODUK -->
    <div class="dashboard-section mt-4">
        <h2>Overview Produk</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            @forelse ($overview as $data)
                <x-stat-card
                    :judul="$data['judul']"
                    :nilai="$data['nilai']"
                    :ikon="$data['ikon']"
                    :warna="$data['warna']"
                    :link="$data['link']"
                />
            @empty
                <p style="text-align: center; grid-column: span 3; color: #888;">Data statistik belum tersedia saat ini.</p>
            @endforelse
        </div>
    </div>

    <!-- RINGKASAN PESANAN -->
    <div class="dashboard-section">
        <h2 style="margin-bottom: 15px;">Ringkasan Pesanan</h2>

        <!-- Baris Atas (3 Kolom) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 20px;">
            @foreach ($ringkasan_atas as $data)
                <x-stat-card
                    :judul="$data['judul']"
                    :nilai="$data['nilai']"
                    :ikon="$data['ikon']"
                    :warna="$data['warna']"
                    :link="$data['link']"
                />
            @endforeach
        </div>

        <!-- Baris Bawah (4 Kolom Status) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            @foreach ($ringkasan_bawah as $data)
                <x-stat-card
                    :judul="$data['judul']"
                    :nilai="$data['nilai']"
                    :ikon="$data['ikon']"
                    :warna="$data['warna']"
                    :link="$data['link']"
                />
            @endforeach
        </div>
    </div>

    <!-- TABEL ORDERAN TERBARU -->
    <style>
        /* CSS Khusus agar Judul & Tombol tidak tergencet di HP */
        @media (max-width: 600px) {
            .header-order {
                flex-direction: column;
                align-items: stretch !important;
                gap: 15px;
            }
            .header-order h2 {
                font-size: 1.4rem;
                text-align: center;
            }
            .btn-lihat-semua {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="dashboard-section">
        <div class="header-order" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h2 style="margin: 0;">Orderan Masuk Terbaru</h2>
            <a href="{{ route('pesanan.index') }}" class="btn-lihat-semua" style="color: #F9F6F0; font-weight: 600; background-color:#5A3E36; border-radius: 8px; padding: 10px 15px; text-decoration: none;">Lihat Semua</a>
        </div>

        <div class="table" style="overflow-x: auto; padding-bottom: 10px;">
            <!-- RAHASIANYA ADA DI SINI: min-width: 800px; akan memaksa tabel memunculkan scrollbar di HP -->
            <table class="table-order" style="width: 100%; border-collapse: collapse; min-width: 800px;">
                <thead class="thead-order" style="background-color: #f4e8e1; text-align: left;">
                    <tr>
                        <th style="padding: 12px; border-bottom: 2px solid #5A3E36">No Resi</th>
                        <th style="padding: 12px; border-bottom: 2px solid #5A3E36">Tanggal</th>
                        <th style="padding: 12px; border-bottom: 2px solid #5A3E36">Customer</th>
                        <th style="padding: 12px; border-bottom: 2px solid #5A3E36">Kue yang Dipesan</th>
                        <th style="padding: 12px; border-bottom: 2px solid #5A3E36">Total Tagihan</th>
                        <th style="padding: 12px; border-bottom: 2px solid #5A3E36">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($order as $o)
                        <tr style="border-bottom: 1px solid #ddd; background: white;">
                            <td style="padding: 12px; font-weight: bold; color: var(--primary-color);">{{ $o->no_pesanan }}</td>
                            <td style="padding: 12px;">{{ \Carbon\Carbon::parse($o->created_at)->format('d M Y') }}</td>
                            <td style="padding: 12px;">
                                <strong>{{ $o->nama_pemesan }}</strong><br>
                                <small style="color: #666;">{{ $o->no_wa }}</small>
                            </td>
                            <td style="padding: 12px; font-size: 0.9em;">
                                @foreach($o->detail_pesanan as $detail)
                                    - {{ $detail->produk->nama_produk }} <strong style="color: var(--secondary-color);">(x{{ $detail->jumlah }})</strong><br>
                                @endforeach
                            </td>
                            <td style="padding: 12px; font-weight: bold;">Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
                            <td style="padding: 12px;">
                                @php
                                    $warnaBg = '#f8d7da'; $warnaTeks = '#721c24'; // Default Merah (Menunggu Pembayaran)
                                    if($o->status == 'Diproses') { $warnaBg = '#fff3cd'; $warnaTeks = '#856404'; } // Kuning
                                    elseif($o->status == 'Proses Pengantaran' || $o->status == 'Siap Diambil') { $warnaBg = '#cce5ff'; $warnaTeks = '#004085'; } // Biru
                                    elseif($o->status == 'Selesai') { $warnaBg = '#d4edda'; $warnaTeks = '#155724'; } // Hijau
                                @endphp
                                <!-- Tambahan white-space: nowrap; agar tulisan status tidak terlipat -->
                                <span style="background-color: {{ $warnaBg }}; color: {{ $warnaTeks }}; padding: 5px 12px; border-radius: 20px; font-size: 0.8em; font-weight: bold; white-space: nowrap;">
                                    {{ $o->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #888; font-style: italic;">
                                Belum ada orderan masuk saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
