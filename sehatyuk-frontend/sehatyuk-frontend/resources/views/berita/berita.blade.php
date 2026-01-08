@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Tips & Berita Hidup Sehat</h2>

    @if(count($tips) > 0)
        @foreach($tips as $tip)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">{{ $tip['judul'] }}</h5>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($tip['tanggal_post'])->translatedFormat('d F Y H:i') }}</small>
                </div>
                <div class="card-body">
                    <p>{{ $tip['isi'] }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p>Tidak ada tips tersedia.</p>
    @endif
</div>
@endsection
