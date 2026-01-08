@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
    
    <h2>Halo, {{ session('user.name') }} 👋</h2>
    {{-- <p>Peran Anda: {{ session('user.role') }}</p> --}}

    <p>Selamat datang di platform edukasi hidup sehat!</p>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-robot fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Chatbot Gemini</h5>
                    <p class="card-text">Tanya jawab seputar gaya hidup sehat.</p>
                    <a href="/chatbot" class="btn btn-outline-success">Buka Chatbot</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-weight fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Hitung BMI</h5>
                    <p class="card-text">Cek apakah berat badanmu ideal.</p>
                    <a href="/bmi" class="btn btn-outline-success">Hitung BMI</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-newspaper fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Tips & Berita</h5>
                    <p class="card-text">Baca info hidup sehat terkini.</p>
                    <a href="/berita" class="btn btn-outline-success">Lihat Berita</a>
                </div>
            </div>
        </div>
    </div>
@endsection
