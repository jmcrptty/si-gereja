@extends('layouts.app')

@section('content')
<!-- Success Alert -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-left: 4px solid var(--accent-gold);">
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
<div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-left: 4px solid var(--accent-burgundy);">
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
<div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert" style="border-left: 4px solid #ffc107;">
    <div class="d-flex align-items-start">
        <i class="bi bi-info-circle-fill me-3 mt-1" style="color: #ffc107; font-size: 1.2rem;"></i>
        <div>
            <strong>Perhatian!</strong> Harap perbaiki kesalahan berikut:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Main Card with Header Info -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header text-white py-4" style="background-color: var(--primary-dark);">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-event me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h4 class="mb-1">Pengaturan Pendaftaran Sakramen</h4>
                                    <p class="mb-0 opacity-75">Kelola periode waktu pendaftaran untuk setiap sakramen</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background-color: var(--primary-light);">
                                <tr>
                                    <th class="py-3 px-4" style="color: var(--text-dark);">Sakramen</th>
                                    <th class="py-3 text-center" style="color: var(--text-dark);">Tanggal Mulai</th>
                                    <th class="py-3 text-center" style="color: var(--text-dark);">Tanggal Selesai</th>
                                    <th class="py-3 text-center" style="color: var(--text-dark);">Selalu Aktif</th>
                                    <th class="py-3 text-center" style="color: var(--text-dark);">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ([
                                    ['name' => 'Baptis', 'icon' => 'bi-droplet-fill'],
                                    ['name' => 'Krisma', 'icon' => 'bi-star-fill'],
                                    ['name' => 'Pernikahan', 'icon' => 'bi-heart-fill'],
                                    ['name' => 'Komuni', 'icon' => 'bi-cup-fill']
                                ] as $sakramen)
                                <tr class="border-bottom">
                                    <form action="{{ url('/sekretaris/sakramen/atur') }}" method="POST" class="sakramen-form contents">
                                        @csrf
                                        <input type="hidden" name="nama_sakramen" value="{{ $sakramen['name'] }}">
                                        
                                        <td class="py-4 px-4">
                                            <div>
                                                <h6 class="mb-0 fw-semibold" style="color: var(--text-dark);">{{ $sakramen['name'] }}</h6>
                                                <small class="text-muted">Sakramen {{ $sakramen['name'] }}</small>
                                            </div>
                                        </td>
                                        
                                        <td class="py-4 text-center">
                                            <input type="date" name="tanggal_mulai" 
                                                   class="form-control form-control-sm tanggal-mulai mx-auto" 
                                                   style="max-width: 160px;">
                                        </td>
                                        
                                        <td class="py-4 text-center">
                                            <input type="date" name="tanggal_selesai" 
                                                   class="form-control form-control-sm tanggal-selesai mx-auto" 
                                                   style="max-width: 160px;">
                                        </td>
                                        
                                        <td class="py-4 text-center">
                                            <div class="form-check d-flex justify-content-center">
                                                <input type="checkbox" name="selalu_aktif" 
                                                       class="form-check-input selalu-aktif">
                                            </div>
                                        </td>
                                        
                                        <td class="py-4 text-center">
                                            <button type="submit" class="btn btn-sm px-3 text-white" 
                                                    style="background-color: var(--accent-burgundy);">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Simpan
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="card border-0 bg-white bg-opacity-10 rounded-3 p-3">
                                <div class="d-flex">
                                    <i class="bi bi-lightbulb-fill me-3 text-warning" style="font-size: 1.2rem;"></i>
                                    <div class="text">
                                        <h6 class="text-black">💡 Petunjuk</h6>
                                        <small class="opacity-90 d-block">
                                            Centang <strong>"Selalu Aktif"</strong> untuk membuka pendaftaran tanpa batas waktu
                                        </small>
                                        <small class="opacity-90 d-block">
                                           Tanggal Pendaftran akan di abaikan jika <strong>"Selalu Aktif"</strong> dicentang
                                        </small>
                                        <small class="opacity-75 d-block mt-1">
                                            Atau atur periode tanggal untuk membatasi waktu pendaftaran
                                        </small>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Enhanced JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CSS Variables
        const style = document.documentElement.style;
        style.setProperty('--primary-dark', '#2d3748');
        style.setProperty('--primary-light', '#f8f9fa');
        style.setProperty('--accent-gold', '#d4af37');
        style.setProperty('--accent-burgundy', '#800020');
        style.setProperty('--text-dark', '#333');
        style.setProperty('--text-light', '#f8f9fa');

        // Initialize form handlers
        document.querySelectorAll('.sakramen-form').forEach(form => {
            const checkbox = form.querySelector('.selalu-aktif');
            const tanggalMulai = form.querySelector('.tanggal-mulai');
            const tanggalSelesai = form.querySelector('.tanggal-selesai');

            // Set initial state
            updateInputState();

            // Event listener for checkbox changes
            checkbox.addEventListener('change', function() {
                updateInputState();
            });

            function updateInputState() {
                const isChecked = checkbox.checked;
                
                tanggalMulai.disabled = isChecked;
                tanggalSelesai.disabled = isChecked;
                
                // Visual feedback
                if (isChecked) {
                    tanggalMulai.style.backgroundColor = '#e9ecef';
                    tanggalSelesai.style.backgroundColor = '#e9ecef';
                    tanggalMulai.style.cursor = 'not-allowed';
                    tanggalSelesai.style.cursor = 'not-allowed';
                } else {
                    tanggalMulai.style.backgroundColor = '';
                    tanggalSelesai.style.backgroundColor = '';
                    tanggalMulai.style.cursor = '';
                    tanggalSelesai.style.cursor = '';
                }
            }

            // Form validation with better error messages
            form.addEventListener('submit', function(e) {
                if (!checkbox.checked) {
                    if (!tanggalMulai.value || !tanggalSelesai.value) {
                        e.preventDefault();
                        showErrorAlert('Harap lengkapi tanggal mulai dan selesai, atau centang "Selalu Aktif".');
                        return;
                    }
                    
                    if (new Date(tanggalMulai.value) >= new Date(tanggalSelesai.value)) {
                        e.preventDefault();
                        showErrorAlert('Tanggal mulai harus lebih awal dari tanggal selesai.');
                        return;
                    }
                }
            });
        });

        // Function to show error alerts
        function showErrorAlert(message) {
            // Remove existing alerts
            const existingAlert = document.querySelector('.dynamic-alert');
            if (existingAlert) {
                existingAlert.remove();
            }

            // Create new alert
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger alert-dismissible fade show shadow-sm dynamic-alert';
            alertDiv.style.borderLeft = '4px solid var(--accent-burgundy)';
            alertDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-3" style="color: var(--accent-burgundy); font-size: 1.2rem;"></i>
                    <div>
                        <strong>Gagal!</strong> ${message}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

            // Insert alert at the top of container
            const container = document.querySelector('.container');
            const firstChild = container.firstElementChild;
            container.insertBefore(alertDiv, firstChild);

            // Auto hide after 5 seconds
            setTimeout(() => {
                if (alertDiv && alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 5000);

            // Scroll to top to show alert
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>

<style>
    /* Custom styles using the color scheme */
    :root {
        --primary-dark: #2d3748;
        --primary-light: #f8f9fa;
        --accent-gold: #d4af37;
        --accent-burgundy: #800020;
        --text-dark: #333;
        --text-light: #f8f9fa;
    }

    .form-check-input:checked {
        background-color: var(--accent-gold);
        border-color: var(--accent-gold);
    }

    .form-check-input:focus {
        border-color: var(--accent-gold);
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
    }

    .form-control:focus {
        border-color: var(--accent-gold);
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.15);
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(212, 175, 55, 0.05);
    }

    .contents {
        display: contents;
    }

    /* Alert styles */
    .alert {
        border: none;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da, #f1aeb5);
        color: #721c24;
    }

    .alert-warning {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        color: #856404;
    }
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.9rem;
        }
        
        .form-control-sm {
            font-size: 0.8rem;
        }
        
        .btn-sm {
            font-size: 0.8rem;
            padding: 0.25rem 0.75rem;
        }
    }
</style>
@endsection