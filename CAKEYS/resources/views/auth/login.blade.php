@extends('layouts.guest')

@section('content')
<div class="login-card">
    <div class="login-form-box">
        <img src="{{ asset('images/opsi-logo-2.png') }}" alt="Logo Cakeys">
        <h3>Ayo Masuk</h3>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email anda" required autofocus>
            </div>

            <div class="input-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" placeholder="Masukkan kata sandi anda" required>
            </div>

            <button type="submit" class="btn-login">Login</button>

            <p class="auth-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </p>
        </form>
    </div>
</div>
@endsection
