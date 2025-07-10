@extends('layouts.layoutUmum')

@section('judul-halaman')
    Pendaftaran Sakramen Krisma
@endsection

@section('gambar-hero')
    <div class="d-block w-100 hero-slide" style="background-image: url('/img/krisma1.png');"></div>
@endsection

@section('judul-hero')
    <h1 class="mb-4 display-4">Persyaratan Krisma <br>Katedral Merauke</h1>

     <a href="#info-krisma" class="btn btn-outline-light btn-lg rounded-pill px-4">
    Lihat Informasi Krisma
</a>
@endsection

@section('content')
    @if (session('success'))
        <!-- Success Modal -->
        <div class="modal fade" id="successModalOutside" tabindex="-1" aria-labelledby="successModalOutsideLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="border-0 shadow modal-content">
                <div class="pb-0 border-0 modal-header">
                    <h5 class="modal-title fw-bold text-success" id="successModalOutsideLabel"><i class="fas fa-check-circle"></i> berhasil</h5>
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

  <div class="container" id="info-krisma">
    <h3 class="mb-4 text-center">Syarat Penerimaan Sakramen Krisma</h3>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Syarat Wajib -->
            <h5 class="mb-3">1. Persyaratan Berkas yang Perlu Disiapkan</h5>
            <ul class="list-unstyled ms-4">
                <li><i class="bi bi-dot text-primary me-2"></i>Fotokopi Akta Kelahiran</li>
                <li><i class="bi bi-dot text-primary me-2"></i>Surat Baptis </li>
                <li><i class="bi bi-dot text-primary me-2"></i>Surat Komuni Pertama</li>
                <li><i class="bi bi-dot text-primary me-2"></i>Fotokopi Kartu Keluarga</li>
                <li><i class="bi bi-dot text-primary me-2"></i>Surat Nikah Katolik Orang Tua</li>
              
            </ul>

            <!-- Informasi Penting -->
            <h5 class="mb-3 mt-4">2. Informasi Penting</h5>
            <ul class="list-unstyled ms-4">
                <li>
                        <i class="bi bi-check-circle text-primary"></i>
                        Untuk dapat mendaftar sakramen, Anda diwajibkan terlebih dahulu terdaftar sebagai umat.
                        <strong><a href="{{ route('pendaftaran-umat') }}">Klik di sini</a></strong> untuk pendaftaran umat.
                </li>
                <li><i class="bi bi-check-circle text-primary"></i> Calon penerima krisma harus sudah dibaptis dan menerima komuni pertama.</li>
                <li><i class="bi bi-check-circle text-primary"></i> Nama calon krisma harus sesuai dengan dokumen resmi (akte/surat baptis).</li>
                <li><i class="bi bi-check-circle text-primary"></i> Peserta wajib mengikuti pembekalan atau katekese sebelum penerimaan krisma.</li>
                <li><i class="bi bi-check-circle text-primary"></i> Proses pendaftaran dapat dilakukan melalui form <strong>Daftar krisma</strong> di bawah.</li>
            </ul>
        </div>
    </div>

    <br>

    <!-- Form Pendaftaran -->
    <div class="row justify-content-center" id="info-krisma">
        <div class="col-md-8">
            <div class="shadow-sm card">
                <div class="text-center card-body">
                    @if($pendaftaran_dibuka)
                        <h4 class="text-center card-title" >Daftar Krisma</h4>
                        <form action="{{ route('krisma.mail') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Masukkan email anda untuk memulai pendaftaran</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark">Kirim</button>
                            </div>
                        </form>
                    @else
                        <h4 class="text-center card-title">Informasi</h4>
                        <p class="mt-3">Pendaftaran Krisma saat ini <strong>belum dibuka</strong>.<br>
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
