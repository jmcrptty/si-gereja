@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary: #1a1f2c;
        --primary-dark: #131720;
        --success: #2c614f;
        --success-dark: #1f4437;
        --warning: #c5a028;
        --warning-hover: #d4af37;
        --light: #f8f9fa;
        --dark: #2d3748;
        --gray-100: #f7fafc;
        --gray-200: #edf2f7;
    }

    body {
        font-family: 'Lora', serif;
        background-color: var(--gray-100);
    }

    .container-fluid {
        padding: 2rem 2.5rem;
    }

    h1.mt-4 {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 1.5rem;
        font-size: 2.25rem;
    }

    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        transition: all 0.3s ease;
        border-radius: 0.75rem;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .bg-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
    }

    .bg-success {
        background: linear-gradient(135deg, var(--success), var(--success-dark)) !important;
    }

    .badge.bg-warning {
        background: linear-gradient(135deg, var(--warning), var(--warning-hover)) !important;
        color: var(--dark) !important;
        font-family: 'Lora', serif;
        font-weight: 600;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }

    .list-group-item {
        border: none;
        padding: 1.25rem;
        margin-bottom: 0.5rem;
        border-radius: 0.5rem !important;
        background-color: rgba(255, 255, 255, 0.1) !important;
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
    }

    h1, h2, h5 {
        font-family: 'Lora', serif;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-title {
        font-size: 1.25rem;
        margin-bottom: 1.25rem;
        opacity: 0.9;
    }

    .card-text {
        font-weight: 700;
        letter-spacing: 0.5px;
        font-size: 2rem;
    }

    .welcome-card {
        background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
        border-left: 5px solid var(--primary);
    }

    .welcome-card .card-body {
        padding: 1.5rem;
        color: var(--primary);
    }

    .stats-container {
        margin-top: 2rem;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .text-white {
        color: rgba(255, 255, 255, 0.95) !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    
    <div class="card mb-4 welcome-card">
        <div class="card-body">
            <h5 class="mb-0">Selamat Datang, {{ Auth::user()->name }}!</h5>
            <p class="text-muted mb-0">{{ Auth::user()->role }}</p>
        </div>
    </div>

    {{-- Card Statistik Utama --}}
    <div class="row stats-container">
        {{-- Total Umat Terdaftar --}}
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Umat Terdaftar</h5>
                    <h2 class="card-text">{{ $totalUmat ?? 0 }} Umat</h2>
                </div>
            </div>
        </div>

        {{-- Total Penerima Sakramen per Tahun --}}
        <div class="col-md-8 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Penerima Sakramen Tahun {{ date('Y') }}</h5>
                    <ul class="list-group list-group-flush text-white">
                        <li class="list-group-item bg-success d-flex justify-content-between align-items-center">
                            Sakramen Baptis
                            <span class="badge bg-warning rounded-pill">{{ $sakramen['baptis'] ?? 0 }} Umat</span>
                        </li>
                        <li class="list-group-item bg-success d-flex justify-content-between align-items-center">
                            Sakramen Komuni Pertama
                            <span class="badge bg-warning rounded-pill">{{ $sakramen['komuni'] ?? 0 }} Umat</span>
                        </li>
                        <li class="list-group-item bg-success d-flex justify-content-between align-items-center">
                            Sakramen Krisma
                            <span class="badge bg-warning rounded-pill">{{ $sakramen['krisma'] ?? 0 }} Umat</span>
                        </li>
                        <li class="list-group-item bg-success d-flex justify-content-between align-items-center">
                            Sakramen Pernikahan
                            <span class="badge bg-warning rounded-pill">{{ $sakramen['pernikahan'] ?? 0 }} Umat</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection