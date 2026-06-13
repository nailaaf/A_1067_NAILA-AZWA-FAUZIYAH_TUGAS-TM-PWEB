@extends('layouts.app')

@section('title', 'Profil Saya - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-welcome">
        <h3>Pengaturan Akun</h3>
        <h1>Profil Saya</h1>
    </div>

    <div class="dashboard-section mt-4" style="background: var(--surface-color); padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; gap: 40px; flex-wrap: wrap; align-items: flex-start;">

        <div style="text-align: center; flex: 1; min-width: 250px; padding-right: 30px; border-right: 2px dashed #EFE8DF;">
            <div style="width: 150px; height: 150px; background-color: var(--primary-color); color: white; font-size: 4rem; font-weight: bold; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; box-shadow: 0 10px 25px rgba(90, 62, 54, 0.2);">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <h2 style="margin: 0 0 5px 0; color: var(--primary-color); font-size: 1.8rem;">{{ Auth::user()->name }}</h2>
            <span style="display: inline-block; background-color: var(--primary-color); color: white; padding: 5px 20px; border-radius: 20px; font-weight: bold; font-size: 0.9rem;">Admin / Owner</span>
        </div>

        <div style="flex: 2; min-width: 300px;">
            <h3 style="color: var(--primary-color); border-bottom: 2px solid #EFE8DF; padding-bottom: 10px; margin-bottom: 25px;">Informasi Pribadi</h3>

            <div class="grid-info" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 25px; margin-bottom: 40px;">
                <div>
                    <label style="display: block; color: var(--secondary-color); font-size: 0.9rem; font-weight: 600; margin-bottom: 5px;">Nama Lengkap</label>
                    <p style="margin: 0; font-weight: bold; font-size: 1.1rem; color: var(--text-color);">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <label style="display: block; color: var(--secondary-color); font-size: 0.9rem; font-weight: 600; margin-bottom: 5px;">Alamat Email</label>
                    <p style="margin: 0; font-weight: bold; font-size: 1.1rem; color: var(--text-color);">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <label style="display: block; color: var(--secondary-color); font-size: 0.9rem; font-weight: 600; margin-bottom: 5px;">No. Telepon</label>
                    <p style="margin: 0; font-weight: bold; font-size: 1.1rem; color: var(--text-color);">0812-3456-7890</p>
                </div>
                <div>
                    <label style="display: block; color: var(--secondary-color); font-size: 0.9rem; font-weight: 600; margin-bottom: 5px;">Alamat Utama</label>
                    <p style="margin: 0; font-weight: bold; font-size: 1.1rem; color: var(--text-color);">Bondowoso, Jawa Timur</p>
                </div>
            </div>

            <div class="action-buttons" style="display: flex; gap: 15px; flex-wrap: wrap;">
                <a href="{{ route('profile.edit') }}" style="padding: 12px 30px; background-color: var(--primary-color); color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-family: inherit; font-size: 1rem; transition: 0.3s; display: inline-block; text-align: center;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    Edit Profil
                </a>
                <button type="button" onclick="openLogoutModal()" style="padding: 12px 30px; background-color: #DC3545; color: white; border: none; border-radius: 8px; font-weight: bold; font-family: inherit; font-size: 1rem; cursor: pointer; transition: 0.3s; text-align: center;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    Logout
                </button>
            </div>
        </div>
    </div>
</div>

<div id="logoutModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 99999; justify-content: center; align-items: center; animation: fadeIn 0.3s forwards;">
    <div style="background-color: var(--surface-color); padding: 40px; border-radius: 15px; text-align: center; max-width: 400px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: 1px solid var(--border-color); transform: translateY(20px); animation: slideUp 0.4s forwards ease-out;">

        <h2 style="color: var(--primary-color); margin-bottom: 15px;">Yakin Ingin Keluar?</h2>
        <p style="color: var(--text-color); margin-bottom: 30px; font-size: 0.95rem;">Kamu harus login kembali untuk masuk ke Dashboard Cakeys.</p>

        <div style="display: flex; gap: 15px; justify-content: center;">
            <button type="button" onclick="closeLogoutModal()" style="padding: 12px 25px; border-radius: 8px; border: 1px solid var(--border-color); background: var(--background-color); color: var(--text-color); cursor: pointer; font-weight: bold; transition: 0.2s;" onmouseover="this.style.backgroundColor='var(--surface-color)'">Batal</button>

            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" style="padding: 12px 25px; border-radius: 8px; background-color: #DC3545; color: white; border: none; font-weight: bold; cursor: pointer; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3); transition: 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Ya, Logout</button>
            </form>
        </div>

    </div>
</div>

<style>
    @keyframes fadeIn { to { opacity: 1; } }
    @keyframes slideUp { to { transform: translateY(0); } }

    /* ================= CSS RESPONSIVE PROFILE ================= */
    @media (max-width: 768px) {
        .dashboard-section {
            flex-direction: column !important;
            text-align: center;
        }

        /* Merubah garis batas dari samping menjadi ke bawah */
        .dashboard-section > div:first-child {
            border-right: none !important;
            padding-right: 0 !important;
            border-bottom: 2px dashed #EFE8DF;
            padding-bottom: 30px;
            width: 100%;
        }

        .dashboard-section > div:last-child {
            width: 100%;
        }

        /* Memaksa grid info pribadi menjadi 1 kolom penuh di HP */
        .grid-info {
            grid-template-columns: 1fr !important;
            gap: 15px !important;
        }

        /* Memaksa tombol untuk menumpuk dan memenuhi lebar layar */
        .action-buttons {
            flex-direction: column;
        }
        .action-buttons a, .action-buttons button {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>

<script>
    function openLogoutModal() {
        const modal = document.getElementById('logoutModal');
        modal.style.display = 'flex';
    }
    function closeLogoutModal() {
        const modal = document.getElementById('logoutModal');
        modal.style.display = 'none';
    }
</script>
@endsection
