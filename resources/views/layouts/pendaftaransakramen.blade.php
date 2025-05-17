@extends('layouts.app')

@section('title', 'Pendaftaran Sakramen')

@section('styles')
<style>
  /* Styling untuk card dan tabel */
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

  /* Menambahkan jarak antar card */
  .row.g-4 {
    margin-bottom: 2rem;
  }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3" style="color: #2d3748; font-weight: 700;">Pendaftaran Sakramen</h1>

    {{-- Tombol untuk konfirmasi dan hapus --}}
    <div class="actions-btns" id="actionBtns" style="display: none;">
        <button class="btn btn-success" id="confirmButton" disabled>Konfirmasi Penerimaan Sakramen</button>
        <button class="btn btn-danger" id="deleteButton" disabled>Hapus Pendaftaran</button>
    </div>

    {{-- Card for each Sakramen --}}
    @foreach (['Baptis', 'Komuni Pertama', 'Krisma', 'Pernikahan'] as $sakramen)
    <div class="row g-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    Pendaftaran Sakramen {{ $sakramen }}
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $pendaftaranSakramen = [
                                ['nama' => 'Andi Setiawan', 'hp' => '08123456789', 'sakramen' => $sakramen],
                                ['nama' => 'Budi Santoso', 'hp' => '08987654321', 'sakramen' => $sakramen],
                                ['nama' => 'Citra Dewi', 'hp' => '08567654321', 'sakramen' => $sakramen],
                                ['nama' => 'Dewi Putri', 'hp' => '08765432100', 'sakramen' => $sakramen],
                            ];
                            @endphp

                            @foreach ($pendaftaranSakramen as $index => $pendaftar)
                            <tr>
                                <td>
                                    <input type="checkbox" 
                                           class="form-check-input selectRowCheckbox_{{ strtolower(str_replace(' ', '', $sakramen)) }}"
                                           data-id="{{ $index }}">
                                </td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pendaftar['nama'] }}</td>
                                <td>{{ $pendaftar['hp'] }}</td>
                                <td class="btn-actions">
                                    <a href="#" class="btn btn-sm btn-success">Sudah Menerima</a>
                                    <a href="#" class="btn btn-sm btn-danger">Hapus</a>
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
            actionBtns.style.display = 'flex'; // Menampilkan tombol
            confirmButton.disabled = false;
            deleteButton.disabled = false;
        } else {
            actionBtns.style.display = 'none'; // Menyembunyikan tombol
            confirmButton.disabled = true;
            deleteButton.disabled = true;
        }
    }

    // Initialize event listeners for each sakramen type
    ['baptis', 'komuni', 'krisma', 'pernikahan'].forEach(sakramen => {
        handleSelectAll(sakramen);
        
        // Add change event listeners to individual checkboxes
        document.querySelectorAll(`.selectRowCheckbox_${sakramen}`).forEach(checkbox => {
            checkbox.addEventListener('change', toggleActionButtons);
        });
    });

    // Add event listeners to action buttons
    document.getElementById('confirmButton').addEventListener('click', function() {
        if(confirm('Apakah Anda yakin ingin mengkonfirmasi pendaftaran yang dipilih?')) {
            // Add your confirmation logic here
            console.log('Konfirmasi pendaftaran');
        }
    });

    document.getElementById('deleteButton').addEventListener('click', function() {
        if(confirm('Apakah Anda yakin ingin menghapus pendaftaran yang dipilih?')) {
            // Add your deletion logic here
            console.log('Hapus pendaftaran');
        }
    });
</script>
@endsection
