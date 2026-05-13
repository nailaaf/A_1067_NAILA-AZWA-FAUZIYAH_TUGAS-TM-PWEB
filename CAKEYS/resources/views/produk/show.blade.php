@extends('layouts.app')

@section('title', 'Detail Produk - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-welcome">
        <h3>Pengelolaan</h3>
        <h1>Detail Produk</h1>
    </div>

    <div class="dashboard-section mt-4" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">

        <div style="display: grid; grid-template-columns: 350px 1fr; gap: 40px; align-items: start;">

            <div style="width: 100%; height: 350px; border-radius: 12px; overflow: hidden; background-color: #f9f9f9; display: flex; justify-content: center; align-items: center; border: 1px solid #ddd;">
                @if($produk->gambar)
                    <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama_produk }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <span style="color: #999; font-style: italic;">Belum ada foto produk</span>
                @endif
            </div>

            <div>
                <h2 style="margin-top: 0; color: var(--primary-color); margin-bottom: 25px; font-size: 2em;">{{ $produk->nama_produk }}</h2>

                <table style="width: 100%; border-collapse: collapse; font-size: 1.1em;">
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 0; font-weight: 600; color: #555; width: 180px;">Kode Produk</td>
                        <td style="padding: 12px 0; color: #333;">: <strong>{{ $produk->kode_produk }}</strong></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 0; font-weight: 600; color: #555;">Kategori</td>
                        <td style="padding: 12px 0; color: #333; text-transform: capitalize;">: {{ $produk->kategori }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 0; font-weight: 600; color: #555;">Harga</td>
                        <td style="padding: 12px 0; color: #333;">: Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 0; font-weight: 600; color: #555;">Stok Tersedia</td>
                        <td style="padding: 12px 0; color: #333;">: {{ $produk->stok }} Pcs</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 0; font-weight: 600; color: #555;">Status</td>
                        <td style="padding: 12px 0;">:
                            @if($produk->is_available)
                                <span style="background-color: #d4edda; color: #155724; padding: 6px 15px; border-radius: 20px; font-size: 0.85em; font-weight: bold;">Tersedia</span>
                            @else
                                <span style="background-color: #f8d7da; color: #721c24; padding: 6px 15px; border-radius: 20px; font-size: 0.85em; font-weight: bold;">Kosong</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div style="margin-top: 40px; display: flex; gap: 15px;">
                    <a href="{{ route('produk.index') }}" style="background-color: #6c757d; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-weight: bold;">⬅ Kembali ke Katalog</a>
                    <a href="{{ route('produk.edit', $produk->id) }}" style="background-color: #ffc107; color: #333; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-weight: bold;">Edit Produk</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
