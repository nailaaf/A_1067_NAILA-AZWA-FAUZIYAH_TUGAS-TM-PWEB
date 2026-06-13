@extends('layouts.app')

@section('title', 'Profil Saya - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-welcome">
        <h3>Pengaturan Akun</h3>
        <h1>Profil Saya</h1>
    </div>

    <div class="dashboard-section mt-4" style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; gap: 40px; flex-wrap: wrap; align-items: flex-start;">

        <div style="text-align: center; flex: 1; min-width: 250px; padding-right: 30px; border-right: 2px dashed #EFE8DF;">
            <div style="width: 150px; height: 150px; background-color: var(--primary-color); color: white; font-size: 4rem; font-weight: bold; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; box-shadow: 0 10px 25px rgba(90, 62, 54, 0.2);">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <h2 style="margin: 0 0 5px 0; color: var(--primary-color); font-size: 1.8rem;">{{ Auth::user()->name }}</h2>
            <span style="display: inline-block; background-color: #f4e8e1; color: var(--primary-color); padding: 5px 20px; border-radius: 20px; font-weight: bold; font-size: 0.9rem;">Admin / Owner</span>
        </div>

        <div style="flex: 2; min-width: 300px;">
            <h3 style="color: var(--primary-color); border-bottom: 2px solid #EFE8DF; padding-bottom: 10px; margin-bottom: 25px;">Informasi Pribadi</h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 25px; margin-bottom: 40px;">
                <div>
                    <label style="display: block; color: #888; font-size: 0.9rem; font-weight: 600; margin-bottom: 5px;">Nama Lengkap</label>
                    <p style="margin: 0; font-weight: bold; font-size: 1.1rem; color: #333;">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <label style="display: block; color: #888; font-size: 0.9rem; font-weight: 600; margin-bottom: 5px;">Alamat Email</label>
                    <p style="margin: 0; font-weight: bold; font-size: 1.1rem; color: #333;">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <label style="display: block; color: #888; font-size: 0.9rem; font-weight: 600; margin-bottom: 5px;">No. Telepon</label>
                    <p style="margin: 0; font-weight: bold; font-size: 1.1rem; color: #333;">0812-3456-7890</p>
                </div>
                <div>
                    <label style="display: block; color: #888; font-size: 0.9rem; font-weight: 600; margin-bottom: 5px;">Alamat Utama</label>
                    <p style="margin: 0; font-weight: bold; font-size: 1.1rem; color: #333;">Bondowoso, Jawa Timur</p>
                </div>
            </div>

            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <button style="padding: 12px 30px; background-color: var(--primary-color); color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    Edit Profil
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="padding: 12px 30px; background-color: #DC3545; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<style>
    /* CSS Tambahan khusus agar kolom kiri dan kanan responsif di HP */
    @media (max-width: 768px) {
        .dashboard-section {
            flex-direction: column;
            text-align: center;
        }
        .dashboard-section > div:first-child {
            border-right: none !important;
            padding-right: 0 !important;
            border-bottom: 2px dashed #EFE8DF;
            padding-bottom: 30px;
        }
    }
</style>
@endsection
