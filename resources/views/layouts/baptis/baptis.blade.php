@extends('layouts.layoutUmum')

@section('judul-halaman')
    Pendaftaran Sakramen Baptis
@endsection

@section('gambar-hero')
    <div class="d-block w-100 hero-slide" style="background-image: url('/img/baptis1.png');"></div>
@endsection

@section('judul-hero')
    <h1 class="mb-4 display-4">Persyaratan Baptis <br>Katedral Merauke</h1>
@endsection

@section('content')
    @if (session('success'))
        <!-- Success Modal -->
        <div class="modal fade" id="successModalOutside" tabindex="-1" aria-labelledby="successModalOutsideLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="border-0 shadow modal-content">
                <div class="pb-0 border-0 modal-header">
                    <h5 class="modal-title fw-bold text-success" id="successModalOutsideLabel"><i class="fas fa-check-circle"></i> Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="pt-1 text-center modal-body">
                    <dotlottie-player
                        src="https://lottie.host/35bcd08c-aecb-4e73-b942-e9e501e9150c/XouVHMEGf5.lottie"
                        background="transparent"
                        speed="1"
                        style="width: 200px; height: 200px; display: block; margin: 0 auto;"
                        autoplay
                    ></dotlottie-player>
                    <h3>{{ session('success') }}</h3>
                </div>
                <div class="pt-0 border-0 modal-footer">
                    <button type="button" class="btn btn-success btn-lg" data-bs-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('Pemberitahuan'))
        <!-- Success Modal -->
        <div class="modal fade" id="pemberitahuanModalOutside" tabindex="-1" aria-labelledby="pemberitahuanModalOutsideLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="border-0 shadow modal-content">
                <div class="pb-0 border-0 modal-header">
                    <h5 class="modal-title fw-bold text-primary" id="pemberitahuanModalOutsideLabel"><i class="fas fa-check-circle"></i> Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="pt-1 text-center modal-body">
                    <dotlottie-player
                        src="https://lottie.host/5bd5a5af-8846-4de0-be5c-1d14c6093e61/Y8dZXXk9GH.lottie"
                        background="transparent"
                        speed="1"
                        style="width: 200px; height: 200px; display: block; margin: 0 auto;"
                        autoplay
                    ></dotlottie-player>
                    <h3>{{ session('Pemberitahuan') }}</h3>
                </div>
                <div class="pt-0 border-0 modal-footer">
                    <button type="button" class="btn btn-primary btn-lg" data-bs-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="container">
        <h3 class="mb-4 text-center">Syarat Penerimaan Sakramen Baptis</h3>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Wali Baptis -->
                <h5 class="mb-3">1. Wali Baptis</h5>
                <p>
                    Wali Baptis bukan saudara kandung dari Orang Tua Calon Baptis. Wali Baptis bisa seorang pria atau seorang wanita atau pria dan wanita. Umur wali baptis sebaiknya tidak berbeda lebih dari 30 tahun dengan umur calon baptis.
                </p>

                <!-- Orang Tua dan Wali Baptis -->
                <h5 class="mb-3">2. Orang Tua dan Wali Baptis</h5>
                <p>
                    Orang tua (suami dan isteri) dan wali baptis wajib mengikuti pembekalan/rekoleksi sebelum pembaptisan.
                </p>

                <!-- Jadwal Pembekalan/Rekoleksi -->
                <h5 class="mb-3">3. Jadwal Pembekalan/Rekoleksi</h5>
                <p>
                    Jadwal pembekalan/rekoleksi bisa disesuaikan dengan ketersediaan waktu orang tua dan wali baptis.
                </p>

                <!-- Catatan -->
                <h4 class="mt-4 text-center">Catatan</h4>
                <ul class="list-unstyled ms-4">
                    <li><i class="bi bi-check-circle text-primary"></i> Pendaftaran dan penyerahan dokumen syarat administratif dapat dilakukan langsung melalui tombol Daftar <strong>Online</strong> di bawah ini.</li>
                    <li><i class="bi bi-check-circle text-primary"></i> Surat Baptis akan diberikan pada saat Penerimaan Sakramen Baptis.</li>
                </ul>

                <!-- Syarat Administratif -->
                <h5 class="mt-4">Syarat Administratif</h5>
                <ul class="list-unstyled ms-4">
                    <li><i class="bi bi-dot text-primary me-2"></i>Fotokopi Akta Kelahiran</li>
                    <li><i class="bi bi-dot text-primary me-2"></i>Fotokopi KTP Orang Tua</li>
                    <li><i class="bi bi-dot text-primary me-2"></i>Surat Nikah Gereja Orang Tua</li>
                    <li><i class="bi bi-dot text-primary me-2"></i>Data Wali Baptis (Katolik)</li>
                    <li><i class="bi bi-dot text-primary me-2"></i>Mengikuti Katekese Baptis</li>
                    <li><i class="bi bi-dot text-primary me-2"></i>Pas Foto 3x4 (2 lembar)</li>
                </ul>
            </div>
        </div>

        <br>

        {{-- Pendaftaran Baptis --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="shadow-sm card">
                    <div class="card-body">
                        <h4 class="text-center card-title">Daftar   </h4>
                        {{-- ini from nya --}}
                        <form action="{{ route('baptis.mail') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Masukkan email anda untuk memulai pendaftaran</label>
                                <input type="text" class="form-control" id="email" name='email' placeholder="Masukkan email" required>
                            </div>
                            <div class="text-center">
                                    <button type="submit" class="btn btn-dark">Cek Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('baptis-after-script')
    <script>
        @if (session('success'))
        document.addEventListener("DOMContentLoaded", function () {
            const successModalOutside = new bootstrap.Modal(document.getElementById('successModalOutside'));
            successModalOutside.show();
        });
    @endif

    @if (session('Pemberitahuan'))
        document.addEventListener("DOMContentLoaded", function () {
            const pemberitahuanModalOutside = new bootstrap.Modal(document.getElementById('pemberitahuanModalOutside'));
            pemberitahuanModalOutside.show();
        });
    @endif
    </script>
@endpush
