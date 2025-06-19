@extends('layouts.app')

@section('title', 'Penerimaan Sakramen')

@section('styles')
<style>
    /* Custom Styles for Card and Table */
    .card-header {
        font-weight: 700;
        font-size: 1.2rem;
        background-color: #800020; /* accent-burgundy */
        color: #fff;
    }

    .badge-success {
        background-color: #28a745 !important;
        color: #fff;
    }

    .badge-secondary {
        background-color: #6c757d !important;
        color: #fff;
    }

    .badge-warning {
        background-color: #ffc107 !important;
        color: #2d3748 !important;
    }

    .card-body {
        background-color: #f8f9fa;
        color: #333;
        padding: 1.5rem;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .table td, .table th {
        text-align: center;
    }

    .actions-btns {
        display: flex;
        justify-content: flex-start;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    /* Adding spacing between cards */
    .row.g-4 {
        margin-bottom: 2rem;
    }
</style>
@endsection

@section('content')
<div class="px-4 container-fluid">
    <h1 class="mt-4 mb-3" style="color: #2d3748; font-weight: 700;">Penerimaan Sakramen</h1>

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

    {{-- Action Buttons --}}
    <div class="actions-btns" id="actionBtns" style="display: none;">
        <button class="btn btn-success" id="confirmButton" disabled>Konfirmasi Penerimaan Sakramen</button>
        <button class="btn btn-danger" id="deleteButton" disabled>Hapus Penerimaan</button>
    </div>

    {{-- Loop through each Sakramen --}}
    {{-- Card for each Sakramen --}}
    <div class="row g-4">
        <div class="col-md-12">

            @include('layouts.sekretaris.sakramen.baptisPenerimaanTable')

            <br>

            @include('layouts.sekretaris.sakramen.komuniPenerimaanTable')

            <br>

            @include('layouts.sekretaris.sakramen.krismaPenerimaanTable')

            <br>

            @include('layouts.sekretaris.sakramen.pernikahanPenerimaanTable')

        </div>
    </div>
</div>

@endsection

@push('sekretaris-after-script')
    <script>
        @if (session('status'))
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif

        @if (session('status_error'))
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            myModal.show();
        @endif
    </script>
@endpush

@section('scripts')
<script>
    // Function to handle the "Select All" checkbox for each sakramen type
    function handleSelectAll(sakramenType) {
        const selectAllCheckbox = document.querySelector(`#selectAllCheckbox_${sakramenType}`);
        const checkboxes = document.querySelectorAll(`.selectRowCheckbox_${sakramenType}`);

        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            toggleActionButtons();
        });
    }

    // Function to toggle action buttons visibility
    function toggleActionButtons() {
        const selectedCheckboxes = document.querySelectorAll('.selectRowCheckbox_baptis:checked, .selectRowCheckbox_komuni:checked, .selectRowCheckbox_krisma:checked, .selectRowCheckbox_pernikahan:checked');
        const actionBtns = document.getElementById('actionBtns');
        const confirmButton = document.getElementById('confirmButton');
        const deleteButton = document.getElementById('deleteButton');

        if (selectedCheckboxes.length > 0) {
            actionBtns.style.display = 'flex'; // Show buttons
            confirmButton.disabled = false;
            deleteButton.disabled = false;
        } else {
            actionBtns.style.display = 'none'; // Hide buttons
            confirmButton.disabled = true;
            deleteButton.disabled = true;
        }
    }

    // Function to confirm sacrament reception
    function confirmReception(id) {
        if (confirm('Apakah Anda yakin ingin mengkonfirmasi penerimaan sakramen?')) {
            // Logic to update the status to "Sudah Menerima"
            alert('Penerimaan Sakramen telah dikonfirmasi');
            // Optionally send AJAX request to update the status in the backend
        }
    }

    // Function to delete a reception record
    function deleteReception(id) {
        if (confirm('Apakah Anda yakin ingin menghapus penerimaan sakramen ini?')) {
            // Logic to delete the reception record
            alert('Penerimaan Sakramen telah dihapus');
            // Optionally send AJAX request to delete the reception record from the backend
        }
    }

    // Handle select all checkbox and individual checkbox change
    ['baptis', 'komuni', 'krisma', 'pernikahan'].forEach(sakramen => {
        handleSelectAll(sakramen);

        // Add change event listeners to individual checkboxes
        document.querySelectorAll(`.selectRowCheckbox_${sakramen}`).forEach(checkbox => {
            checkbox.addEventListener('change', toggleActionButtons);
        });
    });
</script>
@endsection
