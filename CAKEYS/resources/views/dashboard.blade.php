@extends('layouts.app')

@section('title', 'Dashboard Owner - Cakeys')

@section('content')
<div class="dashboard-welcome">
    <h3>Cakeys's Dashboard</h3>
    <h1>Halo, {{ $username }}! Selamat Datang...</h1>
</div>

<div class="dashboard-section mt-4">
    <h2>Overview Produk</h2>
    <div class="grid-container">
        <div class="card">
            <h3>Total Produk</h3>
            <p class="angka">{{ $overview['total_produk'] }}</p>
        </div>
        <div class="card">
            <h3>Produk Terlaris</h3>
            <p class="teks">{{ $overview['produk_terlaris'] }}</p>
        </div>
        <div class="card">
            <h3>Stok Menipis</h3>
            <p class="angka">{{ $overview['stok_menipis'] }} Produk</p>
        </div>
    </div>
</div>

<div class="dashboard-section">
    <h2>Ringkasan Pesanan</h2>
    <div class="grid-container">
        <div class="card">
            <h3>Total Order</h3>
            <p class="angka">{{ $ringkasan_pesanan['total_order'] }}</p>
        </div>
        <div class="card">
            <h3>Produk Diorder</h3>
            <p class="angka">{{ $ringkasan_pesanan['total_produkorder'] }}</p>
        </div>

        <div class="card-status">
            <div>
                <h3>Diproses</h3>
                <p class="angka">{{ $ringkasan_pesanan['order_diproses'] }}</p>
            </div>
            <div>
                <h3>Dikirim</h3>
                <p class="angka">{{ $ringkasan_pesanan['order_dikirim'] }}</p>
            </div>
            <div>
                <h3>Selesai</h3>
                <p class="angka">{{ $ringkasan_pesanan['order_selesai'] }}</p>
            </div>
        </div>

        <div class="card">
            <h3>Total Pendapatan</h3>
            <p class="angka-uang">{{ $ringkasan_pesanan['income'] }}</p>
        </div>
    </div>
</div>

<div class="dashboard-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h2>Orderan Masuk Terbaru</h2>
        <a href="{{ route('pesanan') }}" style="color: var(--accent-color); font-weight: 600;">Lihat Semua ➔</a>
    </div>

    <div class="table">
        <table class="table-order">
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Customer</th>
                    <th>Produk</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $o)
                    <tr>
                        <td><strong>{{ $o['id_order'] }}</strong></td>
                        <td>
                            <strong>{{ $o['nama_cust'] }}</strong><br>
                            <small style="color: #888;">{{ $o['no_telp'] }}</small>
                        </td>
                        <td>{{ $o['nama_produk'] }} (x{{ $o['jumlah'] }})</td>
                        <td style="font-weight: 600; color: var(--primary-color);">Rp {{ number_format($o['subtotal'], 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge badge-{{ strtolower($o['status']) }}">
                                {{ $o['status'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
