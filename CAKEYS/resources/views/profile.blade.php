@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <h1>Profil {{ $username }}</h1>
    </div>

    <div class="profile-content">
        <div class="profile-card">

            {{-- KOLOM KIRI: AVATAR --}}
            <div class="profile-avatar-section">
                <div class="avatar-circle">
                    {{ strtoupper(substr($username, 0, 1)) }}
                </div>
                <h2>{{ $username }}</h2>
                <span class="role-tag">Owner</span>
            </div>

            <div class="profile-info-section">

                <div class="profile-details">
                    <div class="detail-group">
                        <label>Email</label>
                        <p>{{ strtolower(str_replace(' ', '', $username)) }}@gmail.com</p>
                    </div>

                    <div class="no-telp">
                        <label>No. Telepon</label>
                        <p>08**********</p>
                    </div>

                    <div class="alamat">
                        <label>Alamat</label>
                        <p>Bondowoso, Jawa Timur</p>
                    </div>
                </div>

                <div class="profile-footer">
                    <button class="btn-edit-profile">Edit Profil</button>
                    {{-- <a href="{{ route('login') }}" class="btn-logout">Logout</a> --}}
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
