@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <div class="container" style="padding-top: 100px; padding-bottom: 80px;">
        
        {{-- Judul Halaman --}}
        <h1 class="page-title" style="font-family: 'Poppins', sans-serif;">Pengaturan Profil</h1>
        
        <div class="profile-layout">
            {{-- Kartu 1: Update Info --}}
            <div class="profile-card">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Kartu 2: Update Password --}}
            <div class="profile-card">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Kartu 3: Delete Account (Opsional, disamakan stylenya) --}}
            <div class="profile-card">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection