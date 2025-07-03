@extends('layouts.app')
@section('title', 'Lingkungan')

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Persetujuan Umat</h1>
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item active">Verifikasi dan Konfirmasi Data Umat</li>
            </ol>

            @if (session('status'))
            <!-- Setuju Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="border-0 shadow modal-content">
                    <div class="pb-0 border-0 modal-header">
                        <h5 class="modal-title fw-bold text-success" id="successModalLabel"><i class="fas fa-check-circle"></i> Success</h5>
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
                        <h3>{{ session('status') }}</h3>
                    </div>
                    <div class="pt-0 border-0 modal-footer">
                        <button type="button" class="btn btn-success btn-lg" data-bs-dismiss="modal">OK</button>
                    </div>
                    </div>
                </div>
            </div>
            @endif

            @if (session('delete_success'))
            <div class="modal fade" id="deleteSuccessModal" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="border-0 shadow modal-content">
                    <div class="pb-0 border-0 modal-header">
                        <h5 class="modal-title fw-bold text-success" id="deleteSuccessModalLabel"><i class="fas fa-check-circle"></i> Success</h5>
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
                        <h3>{{ session('delete_success') }}</h3>
                    </div>
                    <div class="pt-0 border-0 modal-footer">
                        <button type="button" class="btn btn-success btn-lg" data-bs-dismiss="modal">OK</button>
                    </div>
                    </div>
                </div>
            </div>
            @endif

            @include('layouts.ketualingkungan.umat.persetujuan.tabel_persetujuan')

            @include('layouts.ketualingkungan.umat.persetujuan.tabel_ditolak')
        </div>
    </main>
@endsection

@push('ketua-lingkungan-after-script')
    <script>
        @if (session('status'))
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif

        @if (session('delete_success'))
            const successModal = new bootstrap.Modal(document.getElementById('deleteSuccessModal'));
            successModal.show();
            myModal.show();
        @endif
    </script>
@endpush