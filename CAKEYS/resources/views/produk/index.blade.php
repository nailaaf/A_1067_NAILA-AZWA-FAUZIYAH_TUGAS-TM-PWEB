@extends('layouts.app')

@section('title', 'Katalog Produk - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-welcome" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h3>Pengelolaan</h3>
            <h1>Katalog Produk</h1>
        </div>
        <a href="{{ route('produk.create') }}" style="background-color: var(--primary-color); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-family: inherit;">
            + Tambah Produk
        </a>
    </div>

    <!-- ================= FILTER & PENCARIAN ================= -->
    <div style="background-color: var(--surface-color); padding: 20px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.02); margin-bottom: 20px;">
        <form action="{{ route('produk.index') }}" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; margin: 0;">

            <!-- Input Pencarian -->
            <div style="flex: 1; min-width: 250px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama produk..." style="width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid var(--border-color); background: var(--background-color); color: var(--text-color); font-family: inherit; font-size: 0.95rem; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary-color)'" onblur="this.style.borderColor='var(--border-color)'">
            </div>

            <!-- Dropdown Kategori -->
            <div style="min-width: 180px;">
                <select name="kategori" style="width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid var(--border-color); background: var(--background-color); color: var(--text-color); font-family: inherit; font-size: 0.95rem; outline: none; transition: 0.3s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'" onblur="this.style.borderColor='var(--border-color)'">
                    <option value="">Semua Kategori</option>
                    <option value="cake" {{ request('kategori') == 'cake' ? 'selected' : '' }}>Cake</option>
                    <option value="brownies" {{ request('kategori') == 'brownies' ? 'selected' : '' }}>Brownies</option>
                    <option value="cupcake" {{ request('kategori') == 'cupcake' ? 'selected' : '' }}>Cupcake</option>
                    <option value="pies" {{ request('kategori') == 'pies' ? 'selected' : '' }}>Pies</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="padding: 12px 25px; background-color: var(--primary-color); color: white; border: none; border-radius: 8px; font-family: inherit; font-weight: bold; cursor: pointer; transition: 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">Filter Produk</button>

                <!-- Tombol Reset hanya muncul jika sedang melakukan pencarian -->
                @if(request('search') || request('kategori'))
                    <a href="{{ route('produk.index') }}" style="padding: 12px 25px; background-color: transparent; color: #DC3545; border: 2px solid #DC3545; text-decoration: none; border-radius: 8px; font-family: inherit; font-weight: bold; transition: 0.3s;" onmouseover="this.style.backgroundColor='#DC3545'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#DC3545';">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- ================= TABEL PRODUK ================= -->
    <div class="dashboard-section">
        <div class="table" style="overflow-x: auto;">
            {{-- <table class="table-order" style="width: 100%; border-collapse: collapse;"> --}}
            <table class="table-order" style="width: 100%; border-collapse: collapse; min-width: 900px;">
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
                                    <a href="{{ route('produk.show', $p->id) }}" style="padding: 5px 10px; background-color: #17a2b8; color: white; border-radius: 4px; text-decoration: none; font-size: 0.8em; font-family: inherit;">Detail</a>
                                    <a href="{{ route('produk.edit', $p->id) }}" style="padding: 5px 10px; background-color: #ffc107; color: #333; border-radius: 4px; text-decoration: none; font-size: 0.8em; font-family: inherit;">Edit</a>

                                    <button type="button" onclick="openDeleteModal('{{ $p->id }}', '{{ addslashes($p->nama_produk) }}')" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 0.8em; font-family: inherit;">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding: 30px; text-align: center; color: var(--secondary-color);">
                                <div style="font-size: 3rem; margin-bottom: 10px;">🕵️‍♀️</div>
                                <strong>Produk tidak ditemukan!</strong><br>Coba gunakan kata kunci atau kategori lain.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <p style="color: var(--secondary-color); font-size: 0.9em; margin: 0;">
                Menampilkan {{ $produks->firstItem() ?? 0 }} sampai {{ $produks->lastItem() ?? 0 }}
                dari {{ $produks->total() }} Produk
            </p>
            <div>
                {{ $produks->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL KONFIRMASI HAPUS PRODUK ================= -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 99999; justify-content: center; align-items: center; animation: fadeIn 0.3s forwards;">
    <div style="background-color: var(--surface-color); padding: 40px; border-radius: 15px; text-align: center; max-width: 400px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: 1px solid #DC3545; transform: translateY(20px); animation: slideUp 0.4s forwards ease-out;">

        <div style="font-size: 4rem; margin-bottom: 10px;">🗑️</div>
        <h2 style="color: #DC3545; margin-bottom: 15px;">Hapus Produk?</h2>

        <p style="color: var(--text-color); margin-bottom: 30px; font-size: 0.95rem; line-height: 1.5;">
            Apakah Anda yakin ingin menghapus produk <br>
            <strong id="deleteProductName" style="color: var(--primary-color); font-size: 1.2rem; display: block; margin: 10px 0;"></strong>
            Tindakan ini permanen dan tidak dapat dibatalkan.
        </p>

        <div style="display: flex; gap: 15px; justify-content: center;">
            <button type="button" onclick="closeDeleteModal()" style="padding: 12px 25px; border-radius: 8px; border: 1px solid var(--border-color); background: var(--background-color); color: var(--text-color); font-family: inherit; font-weight: bold; cursor: pointer; transition: 0.2s;" onmouseover="this.style.backgroundColor='var(--surface-color)'">Batal</button>

            <form id="deleteForm" method="POST" action="" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" style="padding: 12px 25px; border-radius: 8px; background-color: #DC3545; color: white; border: none; font-family: inherit; font-weight: bold; cursor: pointer; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3); transition: 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn { to { opacity: 1; } }
    @keyframes slideUp { to { transform: translateY(0); } }

    nav .hidden.sm\:flex-1, nav p.leading-5, nav .small.text-muted { display: none !important; }
    .pagination li:first-child, .pagination li:last-child { display: none !important; }
    .pagination { display: flex !important; list-style: none !important; padding: 0 !important; margin: 0 !important; gap: 8px !important; align-items: center !important; flex-wrap: wrap; }
    .pagination li { margin: 0 !important; padding: 0 !important; display: inline-block !important; }
    .pagination li a, .pagination li span { display: flex !important; align-items: center !important; justify-content: center !important; min-width: 35px !important; height: 35px !important; padding: 0 12px !important; border-radius: 8px !important; background-color: var(--surface-color) !important; color: var(--primary-color) !important; border: 1px solid var(--border-color) !important; text-decoration: none !important; font-weight: 600 !important; font-size: 0.9em !important; transition: all 0.3s ease !important; }
    .pagination li.active span { background-color: var(--primary-color) !important; color: white !important; border-color: var(--primary-color) !important; }
    .pagination li a:hover { background-color: var(--primary-color) !important; color: white !important; border-color: var(--primary-color) !important; opacity: 0.9 !important; }
    /* ================= RESPONSIVE UNTUK HALAMAN PRODUK ================= */
    @media (max-width: 768px) {
        /* 1. Rapikan Header & Tombol Tambah Produk */
        .dashboard-welcome {
            flex-direction: column;
            align-items: stretch !important;
            gap: 15px;
        }
        .dashboard-welcome a {
            text-align: center;
        }

        /* 2. Rapikan Baris Pencarian & Filter */
        form[action*="produk"] {
            flex-direction: column;
            align-items: stretch !important;
        }
        form[action*="produk"] > div {
            width: 100%;
        }
        form[action*="produk"] button,
        form[action*="produk"] a {
            flex: 1;
            text-align: center;
        }
    }
</style>

<script>
    function openDeleteModal(id, namaProduk) {
        document.getElementById('deleteProductName').innerText = namaProduk;
        let baseUrl = "{{ url('produk') }}";
        document.getElementById('deleteForm').action = baseUrl + '/' + id;
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>
@endsection
