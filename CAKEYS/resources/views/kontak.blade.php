@extends('layouts.app')

@section('title', 'Kontak Kami - Cakeys')

@section('content')
<div class="main-content dashboard-wrapper">
    <div class="dashboard-welcome">
        <h3>Butuh Bantuan?</h3>
        <h1>Hubungi Kami</h1>
    </div>

    <div class="dashboard-section" style="padding: 40px; text-align: center;">
        <h2 style="color: var(--primary-color);">Punya Pertanyaan atau Ingin Custom Kue?</h2>
        <p style="margin-bottom: 30px; font-size: 1.1rem; color: #555;">Tim Cakeys selalu siap sedia membantu mewujudkan kue impianmu. Silakan hubungi kami melalui kontak di bawah ini.</p>

        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
            <div class="card" style="width: 250px;">
                <h3 style="font-size: 1.2rem;">📍 Alamat</h3>
                <p style="font-weight: 600; color: var(--primary-color);">Bondowoso, Jawa Timur</p>
            </div>
            <div class="card" style="width: 250px;">
                <h3 style="font-size: 1.2rem;">✉️ Email</h3>
                <p style="font-weight: 600; color: var(--primary-color);">cakeys@gmail.com</p>
            </div>
            <div class="card" style="width: 250px;">
                <h3 style="font-size: 1.2rem;">📞 Telepon</h3>
                <p style="font-weight: 600; color: var(--primary-color);">0812-3456-7890</p>
            </div>
        </div>
    </div>
</div>
@endsection
