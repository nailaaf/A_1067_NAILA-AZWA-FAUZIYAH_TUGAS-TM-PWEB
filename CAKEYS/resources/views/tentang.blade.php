@extends('layouts.app')

@section('title', 'Tentang Kami - Cakeys')

@section('content')
<div class="main-content dashboard-wrapper">

    <div class="dashboard-welcome">
        <h3>Kenali Kami Lebih Dekat</h3>
        <h1>Tentang Cakeys</h1>
    </div>

    <div class="dashboard-section" style="padding: 40px 50px;">
        <div style="text-align: center; margin-bottom: 40px;">
            <img src="{{ asset('images/opsi-logo-2.png') }}" alt="Logo Cakeys" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; margin-bottom: 15px; border: 4px solid #EFE8DF; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
            <h2 style="font-size: 2.2rem; color: var(--primary-color); margin-bottom: 5px;">Cakeys</h2>
            <p style="color: var(--accent-color); font-weight: 600; font-size: 1.2rem;">Create Your Own Cake</p>
        </div>

        <div style="line-height: 1.8; color: var(--primary-color); font-size: 1.1rem; text-align: justify;">
            <p style="margin-bottom: 20px;">
                Selamat datang di <strong>Cakeys</strong>! Kami adalah toko kue spesialis yang berdedikasi untuk mewujudkan kue impianmu menjadi kenyataan. Berawal dari kecintaan kami pada seni memanggang dan menghias kue, Cakeys hadir untuk menemani setiap momen spesial dalam hidupmu.
            </p>
            <p style="margin-bottom: 20px;">
                Di Cakeys, kami sangat menghargai kreativitas. Oleh karena itu, kami menawarkan pengalaman <em>"Create Your Own Cake"</em>, di mana kamu bisa bebas mengkreasikan rasa, desain, dan ukuran kue sesuai dengan selera serta kebutuhan acaramu. Mulai dari ulang tahun, pernikahan, hingga perayaan kecil bersama orang tersayang.
            </p>
            <p style="margin-bottom: 20px;">
                Berlokasi di Bondowoso, Jawa Timur, kami selalu menggunakan bahan-bahan premium pilihan untuk memastikan setiap gigitan tidak hanya terlihat indah secara visual, tetapi juga memanjakan lidah.
            </p>
            <p style="text-align: center; font-weight: bold; margin-top: 40px; color: var(--secondary-color);">
                Terima kasih telah mempercayakan momen manismu bersama Cakeys! 🎂✨
            </p>
        </div>
    </div>

</div>
@endsection
