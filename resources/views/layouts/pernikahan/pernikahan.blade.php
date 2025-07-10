@extends('layouts.layoutUmum')

@section('judul-halaman')
    Pendaftaran Sakramen Pernikahan
@endsection

@section('gambar-hero')
    <div class="d-block w-100 hero-slide" style="background-image: url('/img/pernikahan.png');"></div>
@endsection

@section('judul-hero')
    <h1 class="mb-4 display-4">Persyaratan Pernikahan <br>Katedral Merauke</h1>
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

 <div class="container" id="info-pernikahan">
    <h3 class="mb-4 text-center">Syarat Penerimaan Sakramen Pernikahan</h3>

    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Penjelasan Umum -->
            <p class="mb-4">
                Berikut adalah berkas-berkas yang perlu disiapkan oleh calon penerima Sakramen Pernikahan (baik pria maupun wanita):
            </p>

            <!-- Syarat Administratif -->
            <h5 class="mb-3">Berkas Administratif</h5>
            <ul class="list-unstyled ms-4 mb-4">
                <li><i class="bi bi-check-circle text-primary me-2"></i> Akta Kelahiran <small class="text-muted">(diunggah)</small></li>

            </ul>

            <!-- Catatan -->
            <h5 class="mt-4 text-center">Catatan</h5>
            <ul class="list-unstyled ms-4">
                <li><i class="bi bi-info-circle text-warning me-2"></i> Pernsyaratan Lainnya akan di kirimkan melalui email jika sudah menyelesaikan pendaftaran online</li>
                <li><i class="bi bi-info-circle text-warning me-2"></i> Semua dokumen wajib diunggah dengan jelas dan dapat terbaca.</li>
                <li><i class="bi bi-info-circle text-warning me-2"></i> Proses pendaftaran dapat dilakukan melalui form <strong>Daftar Pernikahan</strong> di bawah.</li>
            </ul>
        </div>
    </div>

    <br>

    <!-- Pendaftaran Pernikahan -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="shadow-sm card">
                <div class="text-center card-body">
                    @if($pendaftaran_dibuka)
                        <h4 class="text-center card-title">Daftar Pernikahan</h4>
                        <form action="{{ route('pernikahan.mail') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Masukkan email anda untuk memulai pendaftaran</label>
                                <input type="email" class="form-control" id="email" name='email' placeholder="Masukkan email" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark">Kirim</button>
                            </div>
                        </form>
                    @else
                        <h4 class="text-center card-title">Informasi</h4>
                        <p class="mt-3">Pendaftaran Pernikahan saat ini <strong>belum dibuka</strong>.<br>
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
