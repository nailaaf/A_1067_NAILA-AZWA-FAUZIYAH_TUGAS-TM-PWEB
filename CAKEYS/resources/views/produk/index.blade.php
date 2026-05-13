@extends('layouts.app')

@section('title', 'Katalog Produk - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-welcome" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h3>Pengelolaan</h3>
            <h1>Katalog Produk</h1>
        </div>
        <a href="{{ route('produk.create') }}" style="background-color: var(--primary-color); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600;">
            + Tambah Produk
        </a>
    </div>

    {{-- @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-top: 20px; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif --}}

    <div class="dashboard-section mt-4">
        <div class="table" style="overflow-x: auto;">
            <table class="table-order" style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: var(--primary-color); color: white;">
                    <tr>
                        <th style="padding: 15px; text-align: left;">Kode</th>
                        <th style="padding: 15px; text-align: left;">Gambar</th>
                        <th style="padding: 15px; text-align: left;">Nama Produk</th>
                        <th style="padding: 15px; text-align: left;">Kategori</th>
                        <th style="padding: 15px; text-align: left;">Harga</th>
                        <th style="padding: 15px; text-align: left;">Stok</th>
                        <th style="padding: 15px; text-align: left;">Status</th>
                        <th style="padding: 15px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $p)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 15px;"><strong>{{ $p->kode_produk }}</strong></td>
                            <td style="padding: 15px;">
                                @if($p->gambar)
                                    <img src="{{ asset($p->gambar) }}" alt="{{ $p->nama_produk }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <span style="color: #999; font-size: 0.8em;">No Image</span>
                                @endif
                            </td>
                            <td style="padding: 15px;">{{ $p->nama_produk }}</td>
                            <td style="padding: 15px; text-transform: capitalize;">{{ $p->kategori }}</td>
                            <td style="padding: 15px;">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td style="padding: 15px;">{{ $p->stok }}</td>
                            <td style="padding: 15px;">
                                @if($p->is_available)
                                    <span class="status-badge badge-selesai" style="background-color: #d4edda; color: #155724; padding: 5px 10px; border-radius: 20px; font-size: 0.8em;">Tersedia</span>
                                @else
                                    <span class="status-badge badge-dikirim" style="background-color: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 20px; font-size: 0.8em;">Kosong</span>
                                @endif
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="{{ route('produk.show', $p->id) }}" style="padding: 5px 10px; background-color: #17a2b8; color: white; border-radius: 4px; text-decoration: none; font-size: 0.8em;">Detail</a>
                                    <a href="{{ route('produk.edit', $p->id) }}" style="padding: 5px 10px; background-color: #ffc107; color: #333; border-radius: 4px; text-decoration: none; font-size: 0.8em;">Edit</a>

                                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $p->nama_produk }}?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 0.8em;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding: 20px; text-align: center; color: #888; font-style: italic;">Belum ada produk di katalog.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
            <p style="color: #666; font-size: 0.9em;">
                Menampilkan {{ $produks->firstItem() }} sampai {{ $produks->lastItem() }}
                dari {{ $produks->total() }} Produk CAKEYS
            </p>

            <div>
                {{ $produks->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<style>
    /* 1. Menyembunyikan SEMUA teks bawaan Laravel (Tailwind maupun Bootstrap) agar tidak dobel */
    nav .hidden.sm\:flex-1,
    nav p.leading-5,
    nav .small.text-muted { display: none !important; }

    /* 2. Menyembunyikan tombol Previous (ujung kiri) dan Next (ujung kanan) */
    .pagination li:first-child,
    .pagination li:last-child {
        display: none !important;
    }

    /* 3. Desain Kotak Angka Pagination */
    .pagination {
        display: flex !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
        gap: 8px !important;
        align-items: center !important;
    }

    .pagination li {
        margin: 0 !important;
        padding: 0 !important;
        display: inline-block !important;
    }

    /* Target khusus angka */
    .pagination li a,
    .pagination li span {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 35px !important;
        height: 35px !important;
        padding: 0 12px !important;
        border-radius: 8px !important;
        background-color: #fff !important;
        color: var(--primary-color) !important;
        border: 1px solid #ddd !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        font-size: 0.9em !important;
        transition: all 0.3s ease !important;
    }

    /* Warna saat angka aktif (halaman saat ini) */
    .pagination li.active span {
        background-color: var(--primary-color) !important;
        color: white !important;
        border-color: var(--primary-color) !important;
    }

    /* Efek hover untuk angka yang bisa diklik */
    .pagination li a:hover {
        background-color: var(--primary-color) !important;
        color: white !important;
        border-color: var(--primary-color) !important;
        opacity: 0.9 !important;
    }
</style>
@endsection
