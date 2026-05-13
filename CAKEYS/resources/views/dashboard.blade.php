@extends('layouts.app')

@section('title', 'Dashboard Owner - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-welcome">
        <h3>Cakeys's Dashboard</h3>
        <h1>Halo, {{ Auth::user()->name }}! Selamat Datang...</h1>
    </div>

    <div class="dashboard-section mt-4">
        <h2>Overview Produk</h2>
        <div class="grid-container">
            @forelse ($overview as $data)
                <x-stat-card
                    :judul="$data['judul']"
                    :nilai="$data['nilai']"
                    :ikon="$data['ikon']"
                    :warna="$data['warna']"
                />
            @empty
                <p style="text-align: center; grid-column: span 3; color: #888;">Data statistik belum tersedia saat ini.</p>
            @endforelse
        </div>
    </div>

    <div class="dashboard-section">
        <h2>Ringkasan Pesanan</h2>
        <div class="grid-container">
            @forelse ($ringkasan_pesanan as $data)
                <x-stat-card
                    :judul="$data['judul']"
                    :nilai="$data['nilai']"
                    :ikon="$data['ikon']"
                    :warna="$data['warna']"
                />
            @empty
                <p style="text-align: center; grid-column: span 4;">Data ringkasan pesanan belum tersedia.</p>
            @endforelse
        </div>
    </div>

    <div class="dashboard-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h2>Orderan Masuk Terbaru</h2>
            <a href="{{ route('pesanan') }}" style="color: #F9F6F0; font-weight: 600; background-color:#5A3E36; border-radius: 8px; padding: 10px">Lihat Semua</a>
        </div>
        <div class="table">
            <table class="table-order">
                <thead class="thead-order" style="background-color: #f4e8e1; text-align: left;">
                    <tr>
                        <th style="padding: 10px; border-bottom: 2px solid #5A3E36">ID Order</th>
                        <th style="padding: 10px; border-bottom: 2px solid #5A3E36">Tanggal</th>
                        <th style="padding: 10px; border-bottom: 2px solid #5A3E36">Customer</th>
                        <th style="padding: 10px; border-bottom: 2px solid #5A3E36">Nama Produk</th>
                        <th style="padding: 10px; border-bottom: 2px solid #5A3E36">Subtotal</th>
                        <th style="padding: 10px; border-bottom: 2px solid #5A3E36">Status Pesanan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($order as $o)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;"><strong>{{ $o['id_order'] }}</strong></td>
                            <td style="padding: 10px;">{{ $o['tanggal_order'] }}</td>
                            <td style="padding: 10px;">
                                <strong>{{ $o['nama_cust'] }}</strong><br>
                                <small style="color: #666;">{{ $o['no_telp'] }}</small>
                            </td>
                            <td style="padding: 10px;">{{ $o['nama_produk'] }} (x{{ $o['jumlah'] }})</td>
                            <td style="padding: 10px;">Rp {{ number_format($o['subtotal'], 0, ',', '.') }}</td>
                            <td style="padding: 10px;">
                                <span class="status-badge badge-{{ strtolower($o['status']) }}">
                                    {{ $o['status'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 20px; text-align: center; color: #888; font-style: italic;">
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
