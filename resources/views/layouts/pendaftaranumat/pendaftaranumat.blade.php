@extends('layouts.pendaftaranumat.layoutUmum')

@section('judul-hero')
    <H5>CEK STATUS</H5>
    <h1 class="mb-4 display-4">PENDAFTARAN UMAT PAROKI KATEDRAL</h1>
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

    <div class="container">
        <!-- Judul Halaman -->
        <h2 class="mb-4 text-center section-heading">Pendaftaran Umat</h2>

        <!-- Deskripsi Pendaftaran -->
        <div class="mb-4 row">
        <div class="col-md-12">
            <p class="text-center">
            Silahkan Masukan email anda agar mendapatkan email yang berisi link formulir pendaftaran umat.
            </p>
        </div>
        </div>

        <!-- Form Pencarian email -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="shadow-sm card">
                    <div class="card-body">
                        <h4 class="text-center card-title">Mulai Mendaftar</h4>
                        {{-- ini from nya --}}
                        <form action="{{ route('pendaftaran-umat.mail') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Masukkan Email Anda</label>
                                <input type="text" class="form-control" id="email" name='email' placeholder="Masukkan email" required>
                            </div>
                            <div class="text-center">
                                    <button type="submit" class="btn btn-dark">Kirim Formulir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Hasil Pencarian -->
        {{-- <div class="mt-4 row justify-content-center">
        <div class="col-md-8">
            <div class="text-center alert alert-info" id="statusAlert" style="display: none;">
            <strong>Status: </strong><span id="statusMessage"></span>
            </div>
            <div class="text-center" id="pendaftaranButton" style="display: none;">
            <a href="{{ route('pendaftaran-umat.create') }}" class="btn btn-dark">Klik untuk Mendaftar</a>
            </div>
        </div>
        </div> --}}
    </div>
@endsection

@push('pendaftaran-umat-after-script')
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

        $(document).ready(function(){
            $('#cekemail').on('click', function(){
                var email = document.getElementById('email').value; //masukan nilai dari input berdasarkan id

                // Validasi dulu
                if (email === '') {
                    statusAlert.style.display = 'block';
                    statusMessage.textContent = 'email tidak boleh kosong.';
                    statusMessage.classList.remove('text-success', 'text-primary');
                    statusMessage.classList.add('text-danger');
                    pendaftaranButton.style.display = 'none';
                    return;
                }

                if (email.length !== 16) {
                    statusAlert.style.display = 'block';
                    statusMessage.textContent = 'email harus terdiri dari 16 angka.';
                    statusMessage.classList.remove('text-success', 'text-primary');
                    statusMessage.classList.add('text-danger');
                    pendaftaranButton.style.display = 'none';
                    return;
                }

                if (!/^\d+$/.test(email)) {
                    statusAlert.style.display = 'block';
                    statusMessage.textContent = 'email hanya boleh berisi angka.';
                    statusMessage.classList.remove('text-success', 'text-primary');
                    statusMessage.classList.add('text-danger');
                    pendaftaranButton.style.display = 'none';
                    return;
                }

                // cari email
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ url('api/cek_email') }}",
                    type: "POST",
                    data: {
                        email :email,
                    },
                    dataType: 'json',
                    success: function(result){
                        if (result.status === 'not_found') {
                            statusAlert.style.display = 'block';
                            statusMessage.textContent = 'email tidak ditemukan. Silakan melakukan pendaftaran umat.';
                            statusMessage.classList.remove('text-success', 'text-danger');
                            statusMessage.classList.add('text-primary');
                            pendaftaranButton.style.display = 'block';
                        } else {
                            statusAlert.style.display = 'block';
                            statusMessage.textContent = 'email ditemukan! Anda telah terdaftar sebagai umat';
                            statusMessage.classList.remove('text-primary', 'text-danger');
                            statusMessage.classList.add('text-success');
                            pendaftaranButton.style.display = 'none';
                        }
                    }
                });
            });
        })
    </script>
@endpush
