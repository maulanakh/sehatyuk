@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')

    {{-- <h2>Halo, {{ session('user.name') }} 👋</h2> --}}
    <h2>halo admin</h2>

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

    <hr class="my-5">

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h4>Manajemen Tips & Artikel</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTipModal">
            <i class="fas fa-plus"></i> Tambah Artikel
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table id="tipsTable" class="table table-bordered table-striped">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tips as $index => $tip)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tip['judul'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($tip['tanggal_post'])->translatedFormat('d M Y H:i') }}</td>
                    <td class="text-center">
                        <a href="{{ url('/admin/tips/' . $tip['id']) }}" class="btn btn-sm btn-info me-1" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ url('/admin/tips/' . $tip['id'] . '/edit') }}" class="btn btn-sm btn-warning me-1"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ url('/admin/tips/' . $tip['id']) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-delete-tip" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Add Tip -->
    <div class="modal fade" id="addTipModal" tabindex="-1" aria-labelledby="addTipModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="addTipForm" method="POST" action="{{ url('/admin/tips/add') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTipModalLabel">Tambah Artikel / Tips Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Artikel</label>
                            <textarea class="form-control" id="isi" name="isi" rows="6" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Artikel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable sekali saja
            $('#tipsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });

            // Konfirmasi hapus dengan SweetAlert
            $('.btn-delete-tip').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data artikel tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection

