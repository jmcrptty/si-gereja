@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-body p-3 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div>
                        <h2 class="h4 fw-bold text-dark mb-2">Dashboard</h2>
                        <p class="text-muted mb-0">
                            <i class="bi bi-person-circle me-2"></i>
                            Selamat datang, {{ Auth::user()->name }}
                        </p>
                    </div>
                    <form method="GET" action="{{ route('dashboard') }}" class="mt-3 mt-md-0">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-0">
                                <i class="bi bi-calendar3 text-primary"></i>
                            </span>
                            <select name="year" class="form-select border-0 shadow-sm fw-semibold" onchange="this.form.submit()">
                                @foreach ($availableYears as $availableYear)
                                    <option value="{{ $availableYear }}" {{ $availableYear == $year ? 'selected' : '' }}>
                                        {{ $availableYear }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Umat (besar) + Sakramen (kanan) -->
    <div class="row g-3 mb-4">
        <!-- Total Umat -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <div class="mb-2 text-primary" style="font-size: 2.5rem;">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h6 class="text-muted fw-semibold">Total Umat Terdaftar</h6>
                <h2 class="fw-bold text-primary mb-1" style="font-size: 2.8rem;">{{ number_format($totalUmat ?? 0) }}</h2>
                <small class="text-muted">
                    <i class="bi bi-calendar-check me-1"></i>
                    Tahun {{ $year }}
                </small>
            </div>
        </div>

        <!-- Sakramen Cards -->
        <div class="col-md-6">
            <div class="row g-2">
                @php
                    $sakramenData = [
                        ['icon' => 'bi-droplet-fill', 'label' => 'Baptis', 'color' => 'info', 'jumlah' => $sakramen['baptis'] ?? 0],
                        ['icon' => 'bi-cup-fill', 'label' => 'Komuni', 'color' => 'success', 'jumlah' => $sakramen['komuni'] ?? 0],
                        ['icon' => 'bi-fire', 'label' => 'Krisma', 'color' => 'warning', 'jumlah' => $sakramen['krisma'] ?? 0],
                        ['icon' => 'bi-heart-fill', 'label' => 'Pernikahan', 'color' => 'danger', 'jumlah' => $sakramen['pernikahan'] ?? 0],
                    ];
                @endphp

                @foreach ($sakramenData as $sak)
                <div class="col-6">
                    <div class="card border-0 shadow-sm text-center p-2 h-100">
                        <div class="text-{{ $sak['color'] }}" style="font-size: 1.5rem;">
                            <i class="bi {{ $sak['icon'] }}"></i>
                        </div>
                        <h6 class="text-muted fw-semibold mb-1" style="font-size: 0.9rem;">{{ $sak['label'] }}</h6>
                        <h5 class="fw-bold text-{{ $sak['color'] }} mb-0" style="font-size: 1.4rem;">{{ $sak['jumlah'] }}</h5>
                        <small class="text-muted">umat</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Ringkasan -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 p-3">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                        Ringkasan Sakramen Tahun {{ $year }}
                    </h6>
                </div>
                <div class="card-body p-3">
                    @php
                        $totalSakramen = array_sum(array_column($sakramenData, 'jumlah'));
                    @endphp
                    <div class="row text-center g-3">
                        <div class="col-md-3 border-end">
                            <h4 class="fw-bold text-primary mb-0">{{ number_format($totalSakramen) }}</h4>
                            <small class="text-muted">Total Penerima</small>
                        </div>
                        <div class="col-md-9">
                            <div class="row text-center">
                                @foreach ($sakramenData as $sak)
                                <div class="col-6 col-sm-3">
                                    <div class="progress mb-1" style="height: 6px;">
                                        <div class="progress-bar bg-{{ $sak['color'] }}" style="width: {{ $totalSakramen > 0 ? ($sak['jumlah'] / $totalSakramen) * 100 : 0 }}%"></div>
                                    </div>
                                    <h6 class="fw-bold text-{{ $sak['color'] }} mb-0">{{ $sak['jumlah'] }}</h6>
                                    <small class="text-muted">{{ $sak['label'] }}</small>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
@media (max-width: 768px) {
    .display-3 {
        font-size: 2rem;
    }

    .h2, h2 {
        font-size: 1.75rem;
    }

    .h5, h5 {
        font-size: 1.25rem;
    }
}
</style>
@endsection
