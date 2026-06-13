@extends('layouts.app')

@section('title', 'Kelola Pesanan - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-welcome" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h3>Dashboard Owner</h3>
            <h1>Daftar Pesanan Masuk</h1>
        </div>
    </div>

    <div class="dashboard-section mt-4">
        <div class="table" style="overflow-x: auto;">
            <table class="table-order" style="width: 100%; border-collapse: collapse; min-width: 900px;">
                <thead style="background-color: var(--primary-color); color: white;">
                    <tr>
                        <th style="padding: 15px; text-align: left;">Tgl Order</th>
                        <th style="padding: 15px; text-align: left;">No Resi</th>
                        <th style="padding: 15px; text-align: left;">Nama Pelanggan</th>
                        <th style="padding: 15px; text-align: left;">Total Harga</th>
                        <th style="padding: 15px; text-align: left;">Status</th>
                        <th style="padding: 15px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $p)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 15px;">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</td>
                            <td style="padding: 15px;"><strong>{{ $p->no_pesanan }}</strong></td>
                            <td style="padding: 15px;">{{ $p->nama_pemesan }}</td>
                            <td style="padding: 15px;">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                            <td style="padding: 15px;">
                                @php
                                    $warnaBg = '#f8d7da'; $warnaTeks = '#721c24'; // Default Merah (Menunggu Pembayaran)
                                    if($p->status == 'Diproses') { $warnaBg = '#fff3cd'; $warnaTeks = '#856404'; } // Kuning
                                    elseif($p->status == 'Proses Pengantaran' || $p->status == 'Siap Diambil') { $warnaBg = '#cce5ff'; $warnaTeks = '#004085'; } // Biru
                                    elseif($p->status == 'Selesai') { $warnaBg = '#d4edda'; $warnaTeks = '#155724'; } // Hijau
                                @endphp
                                <span style="background-color: {{ $warnaBg }}; color: {{ $warnaTeks }}; padding: 5px 10px; border-radius: 20px; font-size: 0.8em; font-weight: bold; white-space: nowrap;">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="{{ route('pesanan.show', $p->id) }}" style="padding: 5px 10px; background-color: #17a2b8; color: white; border-radius: 4px; text-decoration: none; font-size: 0.8em;">Detail</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 20px; text-align: center; color: #888; font-style: italic;">
                                Belum ada pesanan masuk saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pesanans->hasPages())
        <div class="pagination-wrapper" style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <p style="color: #666; font-size: 0.9em; margin: 0;">
                Menampilkan {{ $pesanans->firstItem() }} sampai {{ $pesanans->lastItem() }}
                dari {{ $pesanans->total() }} Pesanan
            </p>
            <div>
                {{ $pesanans->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    /* CSS Pagination Persis Bawaan Produk */
    nav .hidden.sm\:flex-1,
    nav p.leading-5,
    nav .small.text-muted { display: none !important; }

    .pagination li:first-child,
    .pagination li:last-child {
        display: none !important;
    }

    .pagination {
        display: flex !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
        gap: 8px !important;
        align-items: center !important;
        flex-wrap: wrap; /* Pastikan nomor halaman bisa melipat kalau kepanjangan */
    }

    .pagination li {
        margin: 0 !important;
        padding: 0 !important;
        display: inline-block !important;
    }

    .pagination li a,
    .pagination li span {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 35px !important;
        height: 35px !important;
        padding: 0 12px !important;
        border-radius: 8px !important;
        background-color: #fff !important; /* Terang default */
        color: var(--primary-color) !important;
        border: 1px solid #ddd !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        font-size: 0.9em !important;
        transition: all 0.3s ease !important;
    }

    .pagination li.active span {
        background-color: var(--primary-color) !important;
        color: white !important;
        border-color: var(--primary-color) !important;
    }

    .pagination li a:hover {
        background-color: var(--primary-color) !important;
        color: white !important;
        border-color: var(--primary-color) !important;
        opacity: 0.9 !important;
    }

    /* PERBAIKAN 4: CSS Responsif Khusus HP */
    @media (max-width: 768px) {
        .pagination-wrapper {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endsection
