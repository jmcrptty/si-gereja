@extends('layouts.app')

@section('title', 'Laporan Data Umat')

@section('content')
<div class="px-4 container-fluid">
    <h1 class="mt-4">Laporan Data Umat</h1>
    <ol class="mb-4 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route(auth()->user()->role === 'pastor paroki' ? 'pastorparoki.dashboard' : 'sekretaris.dashboard') }}">Dashboard</a>
        </li>

        <li class="breadcrumb-item active">Laporan Data Umat</li>
    </ol>

    <div class="mb-4 row">
        <div class="col-xl-12">
            <div class="text-white shadow card bg-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Total Umat Diterima</div>
                            <div class="text-lg fw-bold">Tahun {{ $tahun }}</div>
                        </div>
                        <div>
                            <h1 class="mb-0 display-4">{{ $totalUmat }}</h1>
                            <div class="small text-white-75">Orang</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Filter + Table Section -->
<div class="mb-4 card">
    <div class="card-header">
        <div class="row gy-2 gx-3">
            <!-- Label -->
            <div class="col-12">
                <div class="d-flex align-items-center filter-label">
                    <i class="fas fa-table me-2"></i>
                    <strong>Data Umat Diterima Tahun {{ $tahun }}</strong>
                </div>
            </div>

            <!-- Form dan Tombol -->
            <div class="col-12">
                <div class="row gx-2 gy-2">
                    <!-- Form Filter -->
                    <div class="col-12 col-lg-9">
                        <form 
                            action="{{ route(auth()->user()->role === 'pastor paroki' ? 'pastorparoki.laporan.umat' : 'sekretaris.laporan.umat') }}" 
                            method="GET"
                            class="row gx-2 gy-2 align-items-center">

                            <!-- Input Search -->
                            <div class="col-12 col-md">
                                <div class="input-group">
                                    <input type="text"
                                           name="search"
                                           class="form-control"
                                           placeholder="Cari umat"
                                           autocomplete="off"
                                           value="{{ request('search') }}">
                                           
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tahun -->
                            <div class="col-12 col-md-auto">
                                <select name="tahun" class="form-select form-select-auto w-100" onchange="this.form.submit()">
                                    @for($y = date('Y'); $y >= 2020; $y--)
                                        <option value="{{ $y }}" {{ (int) request('tahun', date('Y')) === $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Tombol Download -->
                    <div class="col-12 col-lg-3 text-lg-end">
                        <button class="btn btn-danger w-100 w-lg-auto" data-bs-toggle="modal" data-bs-target="#modalDownloadPDF">
                            <i class="fas fa-file-pdf me-1"></i> Download PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Lengkap</th>
                        <th>Lingkungan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($umat as $index => $u)
                    <tr>
                        <td>{{ $umat->firstItem() + $index }}</td>
                        <td>{{ $u->nama_lengkap }}</td>
                        <td>{{ $u->lingkungan }}</td>
                        <td class="text-center">
                            <a href="{{ route(auth()->user()->role === 'pastor paroki' ? 'pastorparoki.umat.show' : 'sekretaris.umat.show', $u->id) }}"
                               class="btn btn-sm bg-primary"
                               title="Lihat">
                                <i class="fa-solid fa-eye"></i> Lihat
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data umat diterima untuk tahun {{ $tahun }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($umat->hasPages())
        <div class="mt-3">
            {{ $umat->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>


<!-- Modal Konfirmasi -->
<div class="modal fade" id="modalDownloadPDF" tabindex="-1" aria-labelledby="modalDownloadPDFLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDownloadPDFLabel">Konfirmasi Download</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Anda yakin ingin mengunduh laporan umat tahun {{ $tahun }} dalam bentuk PDF?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

        @php
            $role = Auth::user()->role;
            $routePrefix = $role === 'sekretaris' ? 'sekretaris' : 'pastorparoki';
        @endphp

        <form id="formDownloadPDF"
              action="{{ route($routePrefix . '.laporan.umat.download') }}"
              method="POST"
              target="_blank"
              onsubmit="closeModal()">
            @csrf
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Ya, Unduh</button>
        </form>
      </div>
    </div>
  </div>
</div>


@push('styles')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 0.75rem;
        margin-left: 2px;
        border: 1px solid #dee2e6;
        background-color: #fff;
        color: #0d6efd;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
        color: #0a58ca !important;
    }
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        display: none;
    }
    /* Dropdown select ukuran dinamis */
.form-select-auto {
  width: auto;
  min-width: 120px;
}

/* Responsif filter di mobile */
@media (max-width: 991.98px) {
  .form-select-auto {
    width: 100%;
  }

  .filter-label {
    margin-bottom: 0.5rem;
  }
}

@media (max-width: 576px) \
  .card-header form {
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 0.75rem;
  }

  .w-lg-auto {
    width: 100% !important;
  }
  
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            },
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
        });
    });

    function closeModal() {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalDownloadPDF'));
        if (modal) {
            modal.hide();
        }
    }
</script>
@endpush

@endsection
