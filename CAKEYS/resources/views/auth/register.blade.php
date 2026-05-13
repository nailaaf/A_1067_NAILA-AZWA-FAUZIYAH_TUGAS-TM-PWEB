@extends('layouts.guest')

@section('content')
<div class="login-card">
    <div class="login-form-box">
        <img src="{{ asset('images/opsi-logo-2.png') }}" alt="Logo Cakeys">
        <h3>Daftar Owner</h3>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="input-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required>
                @error('name') <small style="color: #740A03; font-weight: bold;">{{ $message }}</small> @enderror
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email anda" required>
                @error('email') <small style="color: #740A03; font-weight: bold;">{{ $message }}</small> @enderror
            </div>

            <div class="input-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                @error('password') <small style="color: #740A03; font-weight: bold;">{{ $message }}</small> @enderror
            </div>

            <div class="input-group">
                <label>Konfirmasi Sandi</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required>
            </div>

            <button type="submit" class="btn-login">Daftar Sekarang</button>

            <p class="auth-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </p>
        </form>
    </div>
</div>
@endsection
