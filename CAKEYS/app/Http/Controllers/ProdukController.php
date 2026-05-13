<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahan wajib untuk mengecek user yang login

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::where('user_id', Auth::id())->paginate(10);

        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_produk' => 'required|string|max:50|unique:produks',
            'nama_produk' => 'required|string|min:3|max:255',
            'kategori'    => 'required|in:cake,brownies,cupcake,pies',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'kode_produk.required' => 'Kode produk wajib diisi ya.',
            'kode_produk.unique'   => 'Ups! Kode produk ini sudah terpakai.',
            'nama_produk.required' => 'Nama produk tidak boleh kosong.',
            'nama_produk.min'      => 'Nama produk minimal 3 karakter.',
            'kategori.required'    => 'Tolong pilih salah satu kategori.',
            'kategori.in'          => 'Kategori tidak valid.',
            'harga.required'       => 'Harga produk harus diisi.',
            'stok.required'        => 'Stok awal tidak boleh kosong.',
            'gambar.image'         => 'File harus berupa gambar.',
            'gambar.mimes'         => 'Format gambar harus jpeg, png, atau jpg.',
            'gambar.max'           => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validatedData['is_available'] = $request->stok > 0 ? true : false;

        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Simpan ke folder public/images
            $image->move(public_path('images'), $imageName);
            // Simpan path ke database
            $validatedData['gambar'] = 'images/' . $imageName;
        }

        Produk::create($validatedData);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        // (Opsional Keamanan Tambahan): Cegah user melihat detail produk milik orang lain
        if ($produk->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        return view('produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        // (Opsional Keamanan Tambahan): Cegah user mengedit produk milik orang lain
        if ($produk->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        if ($produk->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        $validatedData = $request->validate([
            'kode_produk' => 'required|string|max:50|unique:produks,kode_produk,' . $produk->id,
            'nama_produk' => 'required|string|min:3|max:255',
            'kategori'    => 'required|in:cake,brownies,cupcake,pies',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'kode_produk.required' => 'Kode produk wajib diisi ya.',
            'kode_produk.unique'   => 'Ups! Kode produk ini sudah dipakai oleh produk lain.',
            'nama_produk.required' => 'Nama produk tidak boleh kosong.',
            'nama_produk.min'      => 'Nama produk minimal 3 karakter.',
            'kategori.required'    => 'Tolong pilih salah satu kategori.',
            'kategori.in'          => 'Kategori tidak valid.',
            'harga.required'       => 'Harga produk harus diisi.',
            'stok.required'        => 'Stok produk tidak boleh kosong.',
            'gambar.image'         => 'File harus berupa gambar.',
            'gambar.mimes'         => 'Format gambar harus jpeg, png, atau jpg.',
            'gambar.max'           => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validatedData['is_available'] = $request->stok > 0 ? true : false;

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validatedData['gambar'] = 'images/' . $imageName;
        }

        $produk->update($validatedData);

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        if ($produk->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil dihapus!');
    }
}
