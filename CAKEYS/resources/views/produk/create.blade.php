@extends('layouts.app')

@section('title', 'Tambah Produk - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-welcome">
        <h3>Pengelolaan</h3>
        <h1>Tambah Produk Baru</h1>
    </div>

    <div class="dashboard-section mt-4" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <div style="display: grid; grid-template-columns: 250px 1fr; gap: 30px;"> --}}
            <div id="form-grid-wrapper" style="display: grid; grid-template-columns: 250px 1fr; gap: 30px;">

                <div style="text-align: center;">
                    <label style="display: block; margin-bottom: 10px; font-weight: 600;">Foto Produk (Opsional)</label>

                    <div style="width: 100%; height: 250px; border: 2px dashed #ddd; border-radius: 12px; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 15px; background-color: #f9f9f9;">
                        <img id="image-preview" src="" alt="Preview Gambar" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                        <span id="placeholder-text" style="color: #999; font-size: 0.9em;">Belum ada foto</span>
                    </div>

                    <input type="file" name="gambar" id="gambar-input" onchange="previewImage(event)" style="width: 100%; padding: 7px; border: 1px solid #ddd; border-radius: 6px; background: #fff;">
                    <small style="color: #666; font-size: 0.8em; display: block; margin-top: 5px;">Format: JPG, JPEG, PNG (Maks 2MB)</small>
                    @error('gambar') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror
                </div>

                {{-- <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; align-content: start;"> --}}
                <div id="form-input-wrapper" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; align-content: start;">
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 600;">Kode Produk</label>
                        <input type="text" name="kode_produk" value="{{ old('kode_produk') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" placeholder="Contoh: C010">
                        @error('kode_produk') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 600;">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" placeholder="Masukkan nama produk">
                        @error('nama_produk') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror
                    </div>

                    <div style="grid-column: span 2;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 600;">Deskripsi Produk</label>
                        <textarea name="deskripsi" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: inherit;" placeholder="Masukkan deskripsi kue secara menarik...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 600;">Kategori</label>
                        <select name="kategori" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="cake" {{ old('kategori') == 'cake' ? 'selected' : '' }}>Cake</option>
                            <option value="brownies" {{ old('kategori') == 'brownies' ? 'selected' : '' }}>Brownies</option>
                            <option value="cupcake" {{ old('kategori') == 'cupcake' ? 'selected' : '' }}>Cupcake</option>
                            <option value="pies" {{ old('kategori') == 'pies' ? 'selected' : '' }}>Pies</option>
                        </select>
                        @error('kategori') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 600;">Harga (Rp)</label>
                        <input type="number" name="harga" value="{{ old('harga') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" placeholder="Contoh: 150000">
                        @error('harga') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 600;">Stok Awal</label>
                        <input type="number" name="stok" value="{{ old('stok') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" placeholder="Contoh: 10">
                        @error('stok') <span style="color: red; font-size: 0.8em;">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; gap: 10px;">
                <a href="{{ route('produk.index') }}" style="background-color: #6c757d; color: white; padding: 10px 25px; border-radius: 6px; text-decoration: none; font-weight: bold; font-family: inherit; font-size: 1rem;">Batal</a>
                <button type="submit" style="background-color: var(--primary-color); color: white; padding: 10px 25px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-family: inherit; font-size: 1rem;">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

{{-- <script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            var placeholder = document.getElementById('placeholder-text');

            output.src = reader.result;
            output.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script> --}}
<script>
    // Fitur Preview Gambar (Bawaan aslimu)
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            var placeholder = document.getElementById('placeholder-text');

            output.src = reader.result;
            output.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // TAMBAHAN BARU: Validasi Formulir Sisi Klien (JavaScript & DOM)
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            // Hapus pesan error JS sebelumnya jika ada (biar tidak menumpuk)
            document.querySelectorAll('.error-js').forEach(el => el.remove());

            let isFormValid = true;

            // Fungsi kecil untuk menampilkan error di bawah input (Manipulasi DOM)
            function showError(inputName, message) {
                const inputElement = document.querySelector(`[name="${inputName}"]`);
                const errorSpan = document.createElement('span');
                errorSpan.className = 'error-js';
                errorSpan.style.color = 'red';
                errorSpan.style.fontSize = '0.8em';
                errorSpan.style.display = 'block';
                errorSpan.style.marginTop = '5px';
                errorSpan.innerText = message;

                // Sisipkan elemen span tepat di bawah elemen input
                inputElement.parentNode.appendChild(errorSpan);
                isFormValid = false; // Tandai form tidak valid
            }

            // 1. Ambil nilai input
            const kode = document.querySelector('input[name="kode_produk"]').value.trim();
            const nama = document.querySelector('input[name="nama_produk"]').value.trim();
            const kategori = document.querySelector('select[name="kategori"]').value;
            const harga = document.querySelector('input[name="harga"]').value;
            const stok = document.querySelector('input[name="stok"]').value;

            // 2. Logika Validasi (Jika kosong/salah, panggil showError)
            if (kode === '') showError('kode_produk', 'Validasi JS: Kode Produk wajib diisi.');
            if (nama === '') showError('nama_produk', 'Validasi JS: Nama Produk tidak boleh kosong.');
            if (kategori === '') showError('kategori', 'Validasi JS: Tolong pilih salah satu kategori.');

            if (harga === '') {
                showError('harga', 'Validasi JS: Harga wajib diisi.');
            } else if (parseInt(harga) < 0) {
                showError('harga', 'Validasi JS: Harga tidak boleh bernilai minus.');
            }

            if (stok === '') {
                showError('stok', 'Validasi JS: Stok awal wajib diisi.');
            } else if (parseInt(stok) < 0) {
                showError('stok', 'Validasi JS: Stok tidak boleh bernilai minus.');
            }

            // 3. Jika form tidak valid, tahan form agar tidak dikirim ke server/Laravel
            if (!isFormValid) {
                e.preventDefault();
            }
        });
    });
</script>
<style>
    /* ================= RESPONSIVE TAMBAH PRODUK ================= */
    @media (max-width: 850px) {
        /* 1. Paksa kolom Foto dan Inputan berbaris atas-bawah */
        #form-grid-wrapper {
            grid-template-columns: 1fr !important;
        }

        /* 2. Paksa setiap kotak inputan turun menjadi 1 kolom (tidak menyamping 1fr 1fr) */
        #form-input-wrapper {
            grid-template-columns: 1fr !important;
        }

        /* 3. Rapikan textarea yang punya "grid-column: span 2" agar tidak error di 1 kolom */
        #form-input-wrapper > div {
            grid-column: span 1 !important;
        }

        /* 4. Ketengahkan tombol Batal & Simpan */
        form > div:last-child {
            flex-direction: column;
            gap: 15px;
        }
        form > div:last-child a, form > div:last-child button {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection
    