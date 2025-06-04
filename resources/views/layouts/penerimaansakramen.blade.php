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
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3" style="color: #2d3748; font-weight: 700;">Penerimaan Sakramen</h1>

    {{-- Action Buttons --}}
    <div class="actions-btns" id="actionBtns" style="display: none;">
        <button class="btn btn-success" id="confirmButton" disabled>Konfirmasi Penerimaan Sakramen</button>
        <button class="btn btn-danger" id="deleteButton" disabled>Hapus Penerimaan</button>
    </div>

    {{-- Loop through each Sakramen --}}
    @foreach (['Baptis', 'Komuni Pertama', 'Krisma', 'Pernikahan'] as $sakramen)
    <div class="row g-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    Penerimaan Sakramen {{ $sakramen }}
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>
                                    <input type="checkbox" 
                                           id="selectAllCheckbox_{{ strtolower(str_replace(' ', '', $sakramen)) }}"
                                           class="form-check-input">
                                </th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor HP</th>
                                <th>Status Penerimaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            // Default data for each sakramen type
                            $penerimaanSakramen = [
                                ['id' => 1, 'nama' => 'Andi Setiawan', 'hp' => '08123456789', 'status' => 'Belum Dikonfirmasi'],
                                ['id' => 2, 'nama' => 'Budi Santoso', 'hp' => '08987654321', 'status' => 'Belum Dikonfirmasi'],
                                ['id' => 3, 'nama' => 'Citra Dewi', 'hp' => '08567654321', 'status' => 'Belum Dikonfirmasi'],
                                ['id' => 4, 'nama' => 'Dewi Putri', 'hp' => '08765432100', 'status' => 'Belum Dikonfirmasi'],
                            ];
                            @endphp

                            @foreach ($penerimaanSakramen as $index => $pendaftar)
                            <tr>
                                <td>
                                    <input type="checkbox" 
                                           class="form-check-input selectRowCheckbox_{{ strtolower(str_replace(' ', '', $sakramen)) }}"
                                           data-id="{{ $pendaftar['id'] }}">
                                </td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pendaftar['nama'] }}</td>
                                <td>{{ $pendaftar['hp'] }}</td>
                                <td>{{ $pendaftar['status'] }}</td>  <!-- Displaying the default status -->
                                <td class="btn-actions">
                                    @if($pendaftar['status'] == 'Belum Dikonfirmasi')
                                    <a href="#" class="btn btn-sm btn-success" data-id="{{ $pendaftar['id'] }}" onclick="confirmReception({{ $pendaftar['id'] }})">Sudah Menerima</a>
                                    @else
                                    <span class="badge badge-success">Dikonfirmasi</span>
                                    @endif
                                    <a href="#" class="btn btn-sm btn-danger" data-id="{{ $pendaftar['id'] }}" onclick="deleteReception({{ $pendaftar['id'] }})">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

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
