<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Gereja Katolik | Paroki St. Fransiskus Xaverius</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-dark:  #800020;
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

        .btn-burgundy {
            background-color: var(--accent-burgundy);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
        }

        @media (max-width: 576px) {
            .btn-burgundy {
                width: 100%;
                margin-top: 1rem;
            }
        }

        .btn-burgundy:hover {
            background-color: var(--accent-gold);
            color: var(--primary-dark);
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        .header-title {
            font-size: 2.5rem;
        }

        @media (max-width: 768px) {
            .header-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .header-title {
                font-size: 1.5rem;
            }
        }

        .card-img-container {
            position: relative;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
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

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .card-subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Simple Header -->
    <div class="bg-burgundy py-4 py-md-5 mb-4">
        <div class="container text-center text-white px-3">
            <img src="{{ asset('img/logo1.png') }}" alt="Logo Gereja" class="img-fluid mb-3 mb-md-4 header-logo">
            <h1 class="header-title mb-2">Pengumuman Mingguan</h1>
            <p class="lead text-gold mb-0">Paroki St. Fransiskus Xaverius Katedral Merauke</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-3 py-md-4">
        <div class="row justify-content-center">
            @forelse($pengumuman['mingguan'] as $item)
                <div class="col-12 col-lg-10 mb-4">
                    <div class="card">
                        @if($item->image)
                            <div class="card-img-container">
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                     alt="{{ $item->title }}"
                                     onerror="this.src='/img/default-image.jpg'">
                            </div>
                        @endif

                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                <span class="badge bg-burgundy mb-2 mb-md-0">Pengumuman Mingguan</span>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3"></i> 
                                    {{ $item->created_at->isoFormat('dddd, D MMMM Y') }}
                                </small>
                            </div>

                            <h2 class="card-title h3 mb-3">{{ $item->title }}</h2>
                            <h5 class="card-subtitle text-muted mb-4">{{ $item->sub }}</h5>

                            <div class="card-text mb-4">
                                {!! $item->content !!}
                            </div>

                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mt-4 pt-3 border-top">
                                <small class="text-muted mb-2 mb-md-0">
                                    <i class="bi bi-clock"></i> 
                                    Diperbarui: {{ $item->updated_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 col-lg-10">
                    <div class="alert alert-info text-center p-4">
                        <i class="bi bi-info-circle-fill fs-1 d-block mb-3"></i>
                        <h4>Tidak ada pengumuman mingguan saat ini.</h4>
                        <p class="mb-0">Silakan kembali lagi nanti.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-4 mt-md-5">
            <a href="{{ route('welcome') }}" class="btn btn-burgundy">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>