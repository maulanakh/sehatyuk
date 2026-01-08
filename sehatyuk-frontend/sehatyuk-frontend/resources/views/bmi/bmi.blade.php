@extends('layouts.layout')

@section('title', 'Hitung BMI')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-weight me-2"></i>Hitung BMI</h5>
            </div>

            <div class="card-body" style="background-color: #f8f9fa;">
                <form id="bmi-form" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" selected disabled>- Pilih -</option>
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="age" class="form-label">Umur</label>
                        <input type="number" class="form-control" id="age" name="age" placeholder="Umur (tahun)"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="weight" class="form-label">Berat</label>
                        <input type="number" class="form-control" id="weight" name="weight" placeholder="Berat (kg)"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="height" class="form-label">Tinggi</label>
                        <input type="number" class="form-control" id="height" name="height" placeholder="Tinggi (cm)"
                            required>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success px-4">Hitung BMI</button>
                    </div>
                </form>

                <div class="mt-5 text-center">
                    <h4 id="bmi-result-text" class="text-success"></h4>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const form = document.getElementById('bmi-form');
        const resultText = document.getElementById('bmi-result-text');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const weight = parseFloat(this.weight.value);
            const height = parseFloat(this.height.value) / 100;
            const bmi = (weight / (height * height)).toFixed(2);
            const gender = this.gender.value;
            const age = parseInt(this.age.value);

            let status = '';
            let color = '';
            let advice = '';

            if (bmi < 18.5) {
                status = 'Kurus';
                color = 'text-warning';
                advice =
                    'Perbanyak konsumsi makanan bernutrisi tinggi dan seimbang. Konsultasikan ke ahli gizi jika berat badan sulit naik.';
            } else if (bmi < 25) {
                status = 'Normal';
                color = 'text-success';
                advice = 'Selamat! BMI Anda normal. Pertahankan gaya hidup sehat dan rutin berolahraga.';
            } else if (bmi < 30) {
                status = 'Kelebihan Berat';
                color = 'text-warning';
                advice =
                    'Mulailah mengurangi makanan tinggi gula dan lemak, serta lakukan olahraga ringan secara teratur.';
            } else {
                status = 'Obesitas';
                color = 'text-danger';
                advice =
                    'Disarankan untuk berkonsultasi dengan dokter atau ahli gizi. Ubah pola makan secara bertahap dan mulai beraktivitas fisik ringan.';
            }

            resultText.className = color + ' fw-bold';
            resultText.innerHTML = `
                <strong>${gender.toUpperCase()}</strong> usia ${age} tahun<br>
                BMI Anda: <strong>${bmi}</strong> (${status})<br>
                <div class="mt-2">${advice}</div>
            `;

            Swal.fire({
                title: 'Hasil BMI',
                html: `
        BMI Anda: <strong>${bmi}</strong><br>
        Status: <strong>${status}</strong><br><br>
        <em>${advice}</em>
    `,
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endsection
