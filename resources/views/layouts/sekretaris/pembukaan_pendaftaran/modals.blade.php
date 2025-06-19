<!-- Success Alert -->
@if(session('success'))
<div class="shadow-sm alert alert-success alert-dismissible fade show" role="alert" style="border-left: 4px solid var(--accent-gold);">
    <div class="d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-3" style="color: var(--accent-gold); font-size: 1.2rem;"></i>
        <div>
            <strong>Berhasil!</strong> {{ session('success') }}
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Error Alert -->
@if(session('error'))
<div class="shadow-sm alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 4px solid var(--accent-burgundy);">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-3" style="color: var(--accent-burgundy); font-size: 1.2rem;"></i>
        <div>
            <strong>Gagal!</strong> {{ session('error') }}
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Validation Error Alert -->
@if($errors->any())
<div class="shadow-sm alert alert-warning alert-dismissible fade show" role="alert" style="border-left: 4px solid #ffc107;">
    <div class="d-flex align-items-start">
        <i class="mt-1 bi bi-info-circle-fill me-3" style="color: #ffc107; font-size: 1.2rem;"></i>
        <div>
            <strong>Perhatian!</strong> Harap perbaiki kesalahan berikut:
            <ul class="mt-2 mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

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

@if (session('status_error'))
    <!-- error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="border-0 shadow modal-content">
            <div class="pb-0 border-0 modal-header">
                <h5 class="modal-title fw-bold text-danger" id="errorModalLabel"><i class="fas fa-check-circle"></i> Failed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="pt-1 text-center modal-body">
                <dotlottie-player
                    src="https://lottie.host/73f09fa7-54a7-418a-ab54-1242df96a0d6/zaAzYRFgsU.lottie"
                    background="transparent"
                    speed="1"
                    style="width: 200px; height: 200px; margin: 0 auto;"
                    loop
                    autoplay
                ></dotlottie-player>
                <h3>{{ session('status_error') }}</h3>
            </div>
            <div class="pt-0 border-0 modal-footer">
                <button type="button" class="btn btn-success btn-danger btn-lg" data-bs-dismiss="modal">OK</button>
            </div>
            </div>
        </div>
    </div>
@endif
