@extends('layouts.layout')

@section('title', 'Login')

@section('content')
    <h2>Login ke SehatYuk</h2>
    @if (session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success"><i class="fas fa-sign-in-alt me-1"></i> Login</button>
    </form>

    <div class="mt-3 text-center">
        <p>Belum punya akun?  Silakan Daftar <a href="/register">Disini</a></p>
    </div>
@endsection

