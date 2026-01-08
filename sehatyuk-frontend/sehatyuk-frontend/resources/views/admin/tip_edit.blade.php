@extends('layouts.layout')

@section('title', 'Edit Artikel')

@section('content')
    <h2>Edit Artikel</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.tips.update', $tip['id']) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $tip['judul']) }}" required>
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label">Isi Artikel</label>
            <textarea class="form-control" id="isi" name="isi" rows="6" required>{{ old('isi', $tip['isi']) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Artikel</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
