@extends('layouts.layout')

@section('title', 'Daftar')

@section('content')
    <h2>Daftar Akun Baru</h2>
    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    @endif
    <form id="register-form">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button class="btn btn-success" type="submit"><i class="fas fa-user-plus me-1"></i> Daftar</button>
    </form>

    <div class="mt-3 text-center">
        <p>Sudah punya akun? Silakan <a href="/login">Login</a></p>
    </div>
@endsection

@section('scripts')
    <script>
        $('#register-form').submit(function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('register.submit') }}",
                method: "POST",
                data: formData,
                headers: {
                    'Accept': 'application/json' // penting!
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Pendaftaran berhasil. Silakan login.',
                        showConfirmButton: false,
                        timer: 2500
                    }).then(() => {
                        window.location.href = "{{ url('/login') }}";
                    });
                },
                error: function(xhr) {
                    let res = xhr.responseJSON;

                    let errors = res?.errors ?? {
                        error: ['Gagal mendaftar.']
                    };
                    let errorMsg = Object.values(errors).map(err => err.join(' ')).join('\n');

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMsg
                    });
                }
            });

        });
    </script>
@endsection
