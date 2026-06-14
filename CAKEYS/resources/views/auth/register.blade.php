@extends('layouts.guest')

@section('content')
<div class="login-card">
    <div class="login-form-box">
        <img src="{{ asset('images/opsi-logo-2-baru.png') }}" alt="Logo Cakeys">
        <h3>Daftar Owner</h3>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="input-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" autofocus>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email anda">
            </div>

            <div class="input-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter">
            </div>

            <div class="input-group" style="margin-bottom: 8px;">
                <label>Konfirmasi Sandi</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi">
            </div>

            @if($errors->any())
                @php
                    $semuaError = strtolower(implode(' ', $errors->all()));

                    // Cek jenis error apa yang dikembalikan Laravel
                    if(str_contains($semuaError, 'required') || str_contains($semuaError, 'wajib')) {
                        $pesanError = 'Harap isi semua data';
                    } elseif (str_contains($semuaError, 'confirm') || str_contains($semuaError, 'cocok') || str_contains($semuaError, 'match')) {
                        $pesanError = 'Konfirmasi kata sandi tidak cocok';
                    } elseif (str_contains($semuaError, 'taken') || str_contains($semuaError, 'sudah ada') || str_contains($semuaError, 'terdaftar')) {
                        $pesanError = 'Email tersebut sudah terdaftar';
                    } elseif (str_contains($semuaError, 'least') || str_contains($semuaError, 'minimal') || str_contains($semuaError, 'characters')) {
                        $pesanError = 'Kata sandi minimal 8 karakter';
                    } else {
                        $pesanError = 'Data tidak valid, silakan periksa kembali';
                    }
                @endphp

                <div style="text-align: center; color: #DC3545; font-size: 0.85rem; margin-top: 15px; margin-bottom: 5px; font-weight: 600;">
                    {{ $pesanError }}
                </div>
            @endif

            <button type="submit" class="btn-login" style="margin-top: 15px;">Daftar Sekarang</button>

            <p class="auth-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </p>
        </form>
    </div>
</div>
@endsection
