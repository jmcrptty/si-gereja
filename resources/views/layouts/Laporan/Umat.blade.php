@extends('layouts.app')

@section('title', 'Laporan Data Umat')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Laporan Data Umat</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('pastorparoki.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Data Umat</li>
    </ol>

    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card bg-primary text-white h-100 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Total Umat Diterima</div>
                            <div class="text-lg fw-bold">Tahun {{ $year }}</div>
                        </div>
                        <div>
                            <h1 class="display-4 mb-0">{{ $totalUmat }}</h1>
                            <div class="small text-white-75">Orang</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Data Umat Diterima Tahun {{ $year }}
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <!-- Search Input -->
                    <form action="{{ route('pastorparoki.laporan.umat') }}" method="GET" class="d-flex gap-2" id="searchForm">
                        <div class="input-group" style="width: 350px;">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Cari umat" 
                                   value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <!-- Year Select with onchange event -->
                        <select name="year" class="form-select" onchange="this.form.submit()">
                            @for($y = date('Y'); $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </form>
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
                                {{-- <a href="{{ route('pastorparoki.laporan.umat.detail', $u->id) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a> --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data umat diterima untuk tahun {{ $year }}</td>
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
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
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

        // Custom search box functionality
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endpush

@endsection