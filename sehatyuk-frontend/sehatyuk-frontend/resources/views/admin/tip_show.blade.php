@extends('layouts.layout')

@section('title', 'Detail Artikel')

@section('content')
    <h2>{{ $tip['judul'] }}</h2>
    <p><small>Dipost pada: {{ \Carbon\Carbon::parse($tip['tanggal_post'])->translatedFormat('d M Y H:i') }}</small></p>
    <hr>
    <p>{!! nl2br(e($tip['isi'])) !!}</p>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
