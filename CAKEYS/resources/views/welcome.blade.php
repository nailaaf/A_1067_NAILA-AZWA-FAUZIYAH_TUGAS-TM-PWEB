@extends('layouts.customer')

@section('title', 'Beranda - Cakeys')

@section('content')
    <section id="weather-info" style="background-color: var(--background-light); padding: 12px 15px; text-align: center; border-bottom: 1px solid #EFE8DF; font-size: 0.95rem;">
        <p style="margin: 0; color: var(--secondary-color); font-weight: 500;">
            ⏳ Mengambil data cuaca sekitar UNEJ Jember...
        </p>
    </section>

    <section style="display: flex; align-items: center; justify-content: space-between; padding: 40px 5%; background-color: var(--surface-color); min-height: 70vh;">
        <div style="flex: 1; padding-right: 40px;">
            <h1 style="font-size: 3rem; color: var(--primary-color); line-height: 1.2; margin-bottom: 20px;">
                CAKEYS <br>
                <span style="color: var(--accent-color);">Create Your Own Cake 🎂</span>
            </h1>
            <p style="font-size: 1.1rem; color: var(--secondary-color); margin-bottom: 30px;">
                Sistem Pemesanan Kue Custom Berbasis Web. Wujudkan desain kue impianmu bersama kami dengan bahan premium yang lezat!
            </p>
            <a href="{{ url('/katalog') }}" style="background-color: var(--primary-color); color: white; padding: 12px 30px; border-radius: 30px; font-weight: bold; font-size: 1.1rem; display: inline-block;">Lihat Katalog</a>
        </div>
        <div style="flex: 1; text-align: right;">
            <img src="{{ asset('images/choco-strawberry-landscape(1).png') }}" alt="cakeys cake" style="max-width: 100%; height: auto; border-radius: 20px; box-shadow: var(--shadow-md);">
        </div>
    </section>

    <section style="padding: 60px 5%; text-align: center; background-color: var(--surface-color);">
        <h2 style="font-size: 2rem; color: var(--primary-color); margin-bottom: 10px;">Mengapa Memilih Cakeys?</h2>
        <p style="color: var(--secondary-color); margin-bottom: 40px;">Alasan kenapa kuemu harus dari kami</p>

        <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
            <div style="background: var(--background-light); padding: 30px; border-radius: 15px; width: 300px; box-shadow: var(--shadow-sm); border: 1px solid #EFE8DF;">
                <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 15px;">🍰 Bahan Premium</h3>
                <p style="color: var(--text-color); font-size: 0.95rem;">Kami hanya menggunakan bahan-bahan berkualitas tinggi untuk rasa yang tak terlupakan.</p>
            </div>
            <div style="background: var(--background-light); padding: 30px; border-radius: 15px; width: 300px; box-shadow: var(--shadow-sm); border: 1px solid #EFE8DF;">
                <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 15px;">✨ Custom Desain</h3>
                <p style="color: var(--text-color); font-size: 0.95rem;">Wujudkan kue impianmu dengan desain yang sepenuhnya bisa dikustomisasi.</p>
            </div>
            <div style="background: var(--background-light); padding: 30px; border-radius: 15px; width: 300px; box-shadow: var(--shadow-sm); border: 1px solid #EFE8DF;">
                <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 15px;">🚚 Pengiriman Aman</h3>
                <p style="color: var(--text-color); font-size: 0.95rem;">Dikirim langsung ke rumah/kampus dengan aman agar kue tetap utuh sempurna.</p>
            </div>
        </div>
    </section>

    <section class="dashboard-section" style="max-width: 900px; margin: 40px auto; text-align: center;">
        <h2 style="color: var(--primary-color); margin-bottom: 25px;">📊 Statistik Kunjungan Anda</h2>

        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-bottom: 30px;">
            <div class="card" style="flex: 1; min-width: 220px;">
                <h3 style="font-size: 1rem;">Total Kunjungan</h3>
                <p class="angka" style="font-size: 2.5rem; margin-top: 10px;">{{ $visits }}</p>
                <p style="font-size: 0.85rem; color: var(--secondary-color);">Kali dilihat</p>
            </div>

            <div class="card" style="flex: 1; min-width: 220px;">
                <h3 style="font-size: 1rem;">Kunjungan Pertama</h3>
                <p class="teks" style="font-size: 1.1rem; margin-top: 15px;">{{ $waktu_pertama }}</p>
            </div>

            <div class="card" style="flex: 1; min-width: 220px;">
                <h3 style="font-size: 1rem;">Kunjungan Terakhir</h3>
                <p class="teks" style="font-size: 1.1rem; margin-top: 15px;">{{ $waktu_terakhir }}</p>
            </div>
        </div>

        <form action="{{ route('kunjungan.reset') }}" method="POST">
            @csrf
            <button type="submit" style="background-color: #E11D48; color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 1rem; transition: 0.3s;">
                🔄 Reset Hitungan
            </button>
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetchWeather();
        });

        async function fetchWeather() {
            const weatherContainer = document.getElementById('weather-info');

            try {
                const response = await fetch('https://wttr.in/Jember?format=j1');
                if (!response.ok) throw new Error('Gagal memuat data');
                const data = await response.json();

                const tempC = data.current_condition[0].temp_C;
                const desc = data.current_condition[0].weatherDesc[0].value;
                const city = data.nearest_area[0].areaName[0].value;

                weatherContainer.innerHTML = `
                    <p style="margin: 0; color: var(--primary-color); font-weight: 600; font-size: 1rem;">
                        🌤️ Cuaca di ${city} saat ini: <span style="color: var(--accent-color); font-weight: 700;">${tempC}°C</span> (${desc}).
                        <span style="font-weight: 400; font-size: 0.95rem; color: var(--secondary-color); margin-left: 10px;">Cuaca yang pas buat nikmatin kue CAKEYS!</span>
                    </p>
                `;
            } catch (error) {
                console.error(error);
                weatherContainer.innerHTML = '<p style="margin: 0; color: #E11D48; font-weight: 500;">❌ Gagal memuat info cuaca, tapi CAKEYS tetap siap melayanimu!</p>';
            }
        }
    </script>
@endsection
