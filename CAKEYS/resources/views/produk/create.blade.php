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
            <div style="display: grid; grid-template-columns: 250px 1fr; gap: 30px;">

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

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; align-content: start;">
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
                <a href="{{ route('produk.index') }}" style="background-color: #6c757d; color: white; padding: 10px 25px; border-radius: 6px; text-decoration: none; font-weight: bold;">Batal</a>
                <button type="submit" style="background-color: var(--primary-color); color: white; padding: 10px 25px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

<script>
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
</script>
@endsection
