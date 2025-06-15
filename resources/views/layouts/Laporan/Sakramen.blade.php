@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Laporan Penerimaan Sakramen</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('pastorparoki.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Sakramen</li>
    </ol>

    <!-- Summary Card -->
    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card bg-primary text-white h-100 shadow">
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
                            <h1 class="display-4 mb-0">{{ $totalPenerimaan }}</h1>
                            <div class="small text-white-75">Orang</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-filter me-1"></i>
                    Filter Data
                </div>
                <div class="d-flex gap-3">
                    <form action="{{ route('pastorparoki.laporan.sakramen') }}" method="GET" class="d-flex gap-2">
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
    </div>

    <!-- Data Table -->
    <div class="card mb-4">
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
                            <th>Tempat</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penerimaan as $index => $umat)
                            @if($umat->sakramenYangDiterima->isNotEmpty())
                                @foreach($umat->sakramenYangDiterima as $sakramen)
                                <tr>
                                    <td>{{ $penerimaan->firstItem() + $index }}</td>
                                    <td>{{ $umat->nama_lengkap }}</td>
                                    <td>{{ $umat->lingkungan }}</td>
                                    <td>{{ $sakramen->nama_sakramen }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sakramen->pivot->tanggal_terima)->format('d/m/Y') }}</td>
                                    <td>{{ $sakramen->pivot->tempat_terima }}</td>
                                    <td>{{ $sakramen->pivot->keterangan ?: '-' }}</td>
                                </tr>
                                @endforeach
                            @endif
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

            @if($penerimaan->hasPages())
            <div class="mt-3">
                {{ $penerimaan->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection