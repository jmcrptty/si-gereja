@extends('layouts.app')
@section('title', 'Laporan Data Sakramen')

@section('content')
<div class="px-4 container-fluid">
    <h1 class="mt-4">Laporan Penerimaan Sakramen</h1>
    <ol class="mb-4 breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pastorparoki.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Sakramen</li>
    </ol>

    <!-- Summary Card -->
    <div class="mb-4 row">
        <div class="col-xl-12">
            <div class="text-white shadow card bg-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Total Penerimaan Sakramen</div>
                            <div class="text-lg fw-bold">
                                {{ $sakramen_id ? $sakramen_list->find($sakramen_id)->nama_sakramen : 'Semua Sakramen' }}
                                Tahun {{ $year }}
                            </div>
                        </div>
                        <div>
                            <h1 class="mb-0 display-4">{{ $totalPenerimaan }}</h1>
                            <div class="small text-white-75">Penerimaan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="mb-4 card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-filter me-1"></i>
                    Filter Data
                </div>
                <form action="{{ route('pastorparoki.laporan.sakramen') }}" method="GET" class="gap-2 d-flex">
                    <select name="sakramen_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Sakramen</option>
                        @foreach($sakramen_list as $s)
                            <option value="{{ $s->id }}" {{ $sakramen_id == $s->id ? 'selected' : '' }}>
                                {{ $s->nama_sakramen }}
                            </option>
                        @endforeach
                    </select>
                    <select name="year" class="form-select" onchange="this.form.submit()">
                        @for($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Cari umat..."
                               value="{{ $search }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="mb-4 card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Penerimaan Sakramen
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Lingkungan</th>
                            <th>Sakramen</th>
                            <th>Tanggal Terima</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penerimaan as $index => $data)
                            <tr>
                                <td>{{ $penerimaan->firstItem() + $index }}</td>
                                <td>{{ $data->nama_lengkap }}</td>
                                <td>{{ $data->lingkungan }}</td>
                                <td>{{ $data->nama_sakramen }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_terima)->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Tidak ada data penerimaan sakramen untuk periode ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($penerimaan->hasPages())
                <div class="mt-3">
                    {{ $penerimaan->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
