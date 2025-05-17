<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Lainnya | Paroki St. Fransiskus Xaverius</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-dark: #800020;
            --accent-burgundy: #2d3748;
            --accent-gold: #d4af37;
        }

        body {
            font-family: 'Georgia', serif;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            body {
                font-size: 14px;
            }
        }

        .bg-burgundy {
            background-color: var(--accent-burgundy) !important;
        }

        .text-gold {
            color: var(--accent-gold) !important;
        }

        .header-logo {
            max-height: 120px;
            width: auto;
            border-radius: 50%;
            padding: 5px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .header-logo:hover {
            transform: scale(1.05);
        }

        @media (max-width: 576px) {
            .header-logo {
                max-height: 80px;
            }
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-img-container {
            position: relative;
            padding-top: 56.25%;
            overflow: hidden;
        }

        .card-img-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-burgundy {
            background-color: var(--accent-burgundy);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-burgundy:hover {
            background-color: var(--accent-gold);
            color: var(--primary-dark);
            transform: translateY(-2px);
        }

        @media (max-width: 576px) {
            .btn-burgundy {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="bg-burgundy py-4 py-md-5 mb-4">
        <div class="container text-center text-white px-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Gereja" class="img-fluid mb-3 mb-md-4 header-logo">
            <h1 class="display-5 mb-2">Pengumuman Lainnya</h1>
            <p class="lead text-gold mb-0">Paroki St. Fransiskus Xaverius Katedral Merauke</p>
        </div>
    </div>

    <!-- Main Content -->
<div class="container py-3 py-md-4">
    <div class="row justify-content-center">
        @forelse($pengumuman['pengumuman_lainnya'] as $item)
                <div class="col-12 col-lg-10 mb-4">
                    <div class="card">
                        @if($item->image)
                            <div class="card-img-container">
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                     alt="{{ $item->title }}"
                                     class="img-fluid"
                                     onerror="this.src='/img/default-image.jpg'">
                            </div>
                        @endif

                        <div class="card-body p-4">
                            <!-- Header Info -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-burgundy">Pengumuman Lainnya</span>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3"></i> 
                                    {{ $item->created_at->isoFormat('dddd, D MMMM Y') }}
                                </small>
                            </div>

                            <!-- Title & Subtitle -->
                            <h2 class="card-title h4">{{ $item->title }}</h2>
                            <p class="text-muted mb-4">{{ $item->sub }}</p>

                            <!-- Content -->
                            <div class="card-text">
                                {!! $item->content !!}
                            </div>

                            <!-- Footer Info -->
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> 
                                    Terakhir diperbarui: {{ $item->updated_at->diffForHumans() }}
                                </small>
                                @if($item->file)
                                    <a href="{{ asset('storage/' . $item->file) }}" 
                                       class="btn btn-sm btn-burgundy" 
                                       download>
                                        <i class="bi bi-download me-1"></i>
                                        Download Lampiran
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        @empty
            <div class="col-12 col-lg-10">
                <div class="alert alert-info text-center p-4">
                    <i class="bi bi-info-circle-fill fs-1 d-block mb-3"></i>
                    <h4>Belum ada pengumuman yang dipublikasikan</h4>
                    <p class="mb-0">Silakan periksa kembali di lain waktu.</p>
                </div>
            </div>
        @endforelse

        <!-- Back Button -->
        <div class="text-center mt-4 mt-md-5">
            <a href="{{ route('welcome') }}" class="btn btn-burgundy">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>