@extends('layouts.app')

@section('title', 'Edit Profil & Keamanan - Cakeys')

@section('content')
<div class="dashboard-wrapper" style="max-width: 800px; margin: 0 auto; padding-bottom: 50px;">

    <div class="dashboard-welcome" style="margin-bottom: 30px; border-bottom: 2px solid #EFE8DF; padding-bottom: 20px;">
        <a href="{{ route('profile.index') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; font-size: 0.95rem; transition: 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">&larr; Kembali ke Profil Saya</a>
        <h1 style="margin-top: 15px; font-size: 2.2rem;">Edit Profil & Keamanan</h1>
    </div>

    <div style="display: flex; flex-direction: column; gap: 30px;">

        <div class="dashboard-section" style="background: var(--surface-color); padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #EFE8DF;">
            <h2 style="color: var(--primary-color); margin-top: 0; margin-bottom: 10px; font-size: 1.5rem;">Informasi Profil</h2>
            <p style="color: #666; font-size: 0.95rem; margin-bottom: 30px;">Perbarui nama dan alamat email akun Cakeys Anda.</p>

            <form method="post" action="{{ route('profile.update') }}" onsubmit="confirmAction(event, 'profile')">
                @csrf
                @method('patch')

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333;">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" style="width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc; color: #333; font-family: inherit; font-size: 1rem; box-sizing: border-box; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.backgroundColor='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.backgroundColor='#f8fafc';">
                    @error('name') <span style="color: #DC3545; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333;">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" style="width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc; color: #333; font-family: inherit; font-size: 1rem; box-sizing: border-box; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.backgroundColor='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.backgroundColor='#f8fafc';">
                    @error('email') <span style="color: #DC3545; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <button type="submit" style="padding: 12px 30px; background-color: var(--primary-color); color: white; border: none; border-radius: 8px; font-weight: bold; font-family: inherit; font-size: 1rem; cursor: pointer; transition: 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">Simpan Perubahan</button>
            </form>
        </div>

        <div class="dashboard-section" style="background: var(--surface-color); padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #EFE8DF;">
            <h2 style="color: var(--primary-color); margin-top: 0; margin-bottom: 10px; font-size: 1.5rem;">Perbarui Password</h2>
            <p style="color: #666; font-size: 0.95rem; margin-bottom: 30px;">Pastikan akun Anda menggunakan kata sandi panjang dan acak agar tetap aman.</p>

            <form method="post" action="{{ route('password.update') }}" onsubmit="confirmAction(event, 'password')">
                @csrf
                @method('put')

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333;">Password Saat Ini</label>
                    <input type="password" name="current_password" placeholder="Masukkan password lama..." style="width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc; color: #333; font-family: inherit; font-size: 1rem; box-sizing: border-box; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.backgroundColor='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.backgroundColor='#f8fafc';">
                    @error('current_password', 'updatePassword') <span style="color: #DC3545; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333;">Password Baru</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter..." style="width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc; color: #333; font-family: inherit; font-size: 1rem; box-sizing: border-box; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.backgroundColor='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.backgroundColor='#f8fafc';">
                    @error('password', 'updatePassword') <span style="color: #DC3545; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333;">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang password baru..." style="width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc; color: #333; font-family: inherit; font-size: 1rem; box-sizing: border-box; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.backgroundColor='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.backgroundColor='#f8fafc';">
                </div>

                <button type="submit" style="padding: 12px 30px; background-color: var(--primary-color); color: white; border: none; border-radius: 8px; font-weight: bold; font-family: inherit; font-size: 1rem; cursor: pointer; transition: 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">Update Password</button>
            </form>
        </div>

        <div class="dashboard-section" style="background: var(--surface-color); padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #fecaca;">
            <h2 style="color: #DC3545; margin-top: 0; margin-bottom: 10px; font-size: 1.5rem;">Hapus Akun</h2>
            <p style="color: #666; font-size: 0.95rem; margin-bottom: 30px;">Setelah akun dihapus, semua sumber daya dan data Anda akan dihapus secara permanen dari server Cakeys.</p>

            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="confirmAction(event, 'delete')">
                @csrf
                @method('delete')

                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333;">Masukkan Password Anda</label>
                    <input type="password" name="password" placeholder="Password untuk konfirmasi penghapusan..." style="width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid #fecaca; background-color: #fef2f2; color: #333; font-family: inherit; font-size: 1rem; box-sizing: border-box; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='#DC3545'; this.style.backgroundColor='#fff';" onblur="this.style.borderColor='#fecaca'; this.style.backgroundColor='#fef2f2';">
                    @error('password', 'userDeletion') <span style="color: #DC3545; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <button type="submit" style="padding: 12px 30px; background-color: transparent; color: #DC3545; border: 2px solid #DC3545; border-radius: 8px; font-weight: bold; font-family: inherit; font-size: 1rem; cursor: pointer; transition: 0.3s;" onmouseover="this.style.backgroundColor='#DC3545'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#DC3545';">Hapus Akun Permanen</button>
            </form>
        </div>

    </div>
</div>

<div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 99999; justify-content: center; align-items: center; animation: fadeIn 0.3s forwards;">
    <div style="background-color: var(--surface-color); padding: 40px; border-radius: 15px; text-align: center; max-width: 400px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: 1px solid var(--border-color); transform: translateY(20px); animation: slideUp 0.4s forwards ease-out;">

        {{-- <div id="confirmIcon" style="font-size: 4rem; margin-bottom: 10px;">🤔</div> --}}
        <h2 id="confirmTitle" style="color: var(--primary-color); margin-bottom: 15px;">Konfirmasi</h2>
        <p id="confirmDesc" style="color: var(--text-color); margin-bottom: 30px; font-size: 0.95rem;">Apakah Anda yakin?</p>

        <div style="display: flex; gap: 15px; justify-content: center;">
            <button type="button" onclick="closeConfirmModal()" style="padding: 12px 25px; border-radius: 8px; border: 1px solid var(--border-color); background: var(--background-color); color: var(--text-color); font-family: inherit; font-weight: bold; cursor: pointer; transition: 0.2s;" onmouseover="this.style.backgroundColor='var(--surface-color)'">Batal</button>

            <button type="button" id="btnConfirmYa" onclick="executeForm()" style="padding: 12px 25px; border-radius: 8px; background-color: var(--primary-color); color: white; border: none; font-family: inherit; font-weight: bold; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.2); transition: 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Ya, Lanjutkan</button>
        </div>
    </div>
</div>

@if (session('status') === 'profile-updated' || session('status') === 'password-updated')
<div id="successModal" style="display: flex; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 99999; justify-content: center; align-items: center; animation: fadeIn 0.3s forwards;">
    <div style="background-color: var(--surface-color); padding: 40px; border-radius: 15px; text-align: center; max-width: 400px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: 1px solid #16A34A; transform: translateY(20px); animation: slideUp 0.4s forwards ease-out;">

        {{-- <div style="font-size: 4rem; margin-bottom: 10px;">🎉</div> --}}
        <h2 style="color: #16A34A; margin-bottom: 15px;">Berhasil!</h2>
        <p style="color: var(--text-color); margin-bottom: 30px; font-size: 0.95rem;">
            {{ session('status') === 'profile-updated' ? 'Informasi profil Anda berhasil diperbarui.' : 'Password akun Anda berhasil diubah.' }}
        </p>

        <button type="button" onclick="document.getElementById('successModal').style.display='none'" style="padding: 12px 35px; border-radius: 8px; background-color: #16A34A; color: white; border: none; font-family: inherit; font-weight: bold; cursor: pointer; box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3); transition: 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Selesai</button>
    </div>
</div>
@endif

<style>
    @keyframes fadeIn { to { opacity: 1; } }
    @keyframes slideUp { to { transform: translateY(0); } }
</style>

<script>
    let currentForm = null;

    // Fungsi memunculkan pop-up konfirmasi
    function confirmAction(e, type) {
        e.preventDefault(); // Tahan dulu formnya, jangan langsung dikirim
        currentForm = e.target; // Simpan form mana yang sedang diklik

        const modal = document.getElementById('confirmModal');
        const title = document.getElementById('confirmTitle');
        const desc = document.getElementById('confirmDesc');
        const icon = document.getElementById('confirmIcon');
        const btnYa = document.getElementById('btnConfirmYa');

        // Ubah teks dan warna pop-up sesuai dengan tombol apa yang ditekan
        if (type === 'profile') {
            // icon.innerText = '📝';
            title.innerText = 'Simpan Perubahan?';
            title.style.color = 'var(--primary-color)';
            desc.innerText = 'Apakah Anda yakin ingin menyimpan perubahan informasi profil ini?';
            btnYa.innerText = 'Ya, Simpan';
            btnYa.style.backgroundColor = 'var(--primary-color)';
        } else if (type === 'password') {
            // icon.innerText = '🔒';
            title.innerText = 'Update Password?';
            title.style.color = 'var(--primary-color)';
            desc.innerText = 'Apakah Anda yakin ingin mengubah password akun Anda?';
            btnYa.innerText = 'Ya, Update';
            btnYa.style.backgroundColor = 'var(--primary-color)';
        } else if (type === 'delete') {
            // icon.innerText = '⚠️';
            title.innerText = 'Hapus Akun Permanen?';
            title.style.color = '#DC3545';
            desc.innerText = 'Peringatan: Tindakan ini tidak dapat dibatalkan. Semua data Anda akan lenyap. Yakin?';
            btnYa.innerText = 'Ya, Hapus Akun';
            btnYa.style.backgroundColor = '#DC3545';
        }

        modal.style.display = 'flex'; // Tampilkan Modal
    }

    // Fungsi menutup pop-up konfirmasi (batal)
    function closeConfirmModal() {
        document.getElementById('confirmModal').style.display = 'none';
        currentForm = null;
    }

    // Fungsi untuk benar-benar mengirim data (jika diklik YA)
    function executeForm() {
        if (currentForm) {
            currentForm.submit();
        }
    }
</script>
@endsection
