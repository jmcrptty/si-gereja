@extends('layouts.layoutUmum')

@section('judul-halaman')
    Pendaftaran Sakramen Baptis
@endsection

@section('gambar-hero')
    <div class="d-block w-100 hero-slide" style="background-image: url('/img/baptis1.png');"></div>
@endsection

@section('judul-hero')
    <h1 class="mb-4 display-4">Persyaratan Baptis <br>Katedral Merauke</h1>
    
    <a href="#info-baptis" class="btn btn-outline-light btn-lg rounded-pill px-4">
    Lihat Informasi Baptis
</a>
@endsection



@section('content')
    @if (session('success'))
        <!-- Success Modal -->
        <div class="modal fade" id="successModalOutside" tabindex="-1" aria-labelledby="successModalOutsideLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="border-0 shadow modal-content">
                <div class="pb-0 border-0 modal-header">
                    <h5 class="modal-title fw-bold text-success" id="successModalOutsideLabel"><i class="fas fa-check-circle"></i> Berhasil</h5>
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

    <div class="container" id="info-baptis">
    <h3 class="mb-4 text-center">Syarat Penerimaan Sakramen Baptis</h3>

    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Penjelasan Umum -->
            <p class="mb-4">
                Berikut adalah berkas-berkas dan informasi yang perlu disiapkan oleh calon penerima Sakramen Baptis.
            </p>

            <!-- Syarat Administratif -->
            <h5 class="mb-3">1. Berkas Administratif</h5>
            <ul class="list-unstyled ms-4 mb-4">
                <li><i class="bi bi-check-circle text-primary me-2"></i> Akta Kelahiran <small class="text-muted">(diunggah)</small></li>
                <li><i class="bi bi-check-circle text-primary me-2"></i> Kartu Keluarga <small class="text-muted">(diunggah)</small></li>
                <li><i class="bi bi-check-circle text-primary me-2"></i> Surat Nikah Katolik Orang Tua <small class="text-muted">(diunggah)</small></li>
            </ul>

            <!-- Pilihan Wali Baptis -->
            <h5 class="mb-3">2. Wali Baptis</h5>
            <p class="mb-2">
                Pilih salah satu bentuk wali baptis: <strong>1 orang wali</strong> atau <strong>pasangan suami istri</strong>.
            </p>

            <ul class="list-unstyled ms-4 mb-4">
                <li><i class="bi bi-dot text-primary me-2"></i> Jika memilih <strong>1 orang wali baptis</strong>:
                    <ul class="list-unstyled ms-4 mt-1">
                        <li><i class="bi bi-check-circle text-primary me-2"></i> Surat Krisma Wali <small class="text-muted">(diunggah)</small></li>
                    </ul>
                </li>
                <li class="mt-2"><i class="bi bi-dot text-primary me-2"></i> Jika memilih <strong>pasangan suami istri</strong> sebagai wali:
                    <ul class="list-unstyled ms-4 mt-1">
                        <li><i class="bi bi-check-circle text-primary me-2"></i> Surat Nikah Katolik Pasangan Wali <small class="text-muted">(diunggah)</small></li>
                    </ul>
                </li>
            </ul>

            <!-- Kontak -->
            <h5 class="mb-3">3. Kontak</h5>
            <ul class="list-unstyled ms-4">
                <li><i class="bi bi-check-circle text-primary me-2"></i> Nomor WhatsApp aktif untuk dihubungi panitia</li>
            </ul>

            <!-- Catatan -->
            <h5 class="mt-4 text-center">Catatan</h5>
            <ul class="list-unstyled ms-4">
                <li><i class="bi bi-info-circle text-warning me-2"></i> Pastikan semua dokumen yang diunggah jelas dan dapat terbaca.</li>
                <li><i class="bi bi-info-circle text-warning me-2"></i> Pendaftaran bisa dilakukan melalui form <strong>Daftar Baptis</strong> di bawah halaman ini.</li>
            </ul>

        </div>
    </div>
</div>



        <br>

        {{-- Pendaftaran Baptis --}}
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="shadow-sm card">
                    <div class="text-center card-body" >
                        @if($pendaftaran_dibuka)
                            <h4 class="text-center card-title" id="info-baptis">Daftar Baptis</h4>
                            <form action="{{ route('baptis.mail') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="email" class="form-label">Masukkan email anda untuk memulai pendaftaran</label>
                                    <input type="text" class="form-control" id="email" name='email' placeholder="Masukkan email" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark">Kirim</button>
                                </div>
                            </form>
                        @else
                            <h4 class="text-center card-title">Informasi</h4>
                            <p class="mt-3">Pendaftaran Baptis saat ini <strong>belum dibuka</strong>.<br>
                            Silakan tunggu informasi selanjutnya dari Gereja Katedral Merauke.</p>
                        @endif
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
