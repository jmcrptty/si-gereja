<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forum Umat - Katedral Merauke</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lora:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui@4/material-ui.css" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #2d3748;
            --primary-light: #f8f9fa;
            --accent-gold: #d4af37;
            --accent-burgundy: #800020;
            --text-dark: #333;
            --text-light: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #2d3748 0%, #4a5568 50%);
            --gradient-light: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(128, 0, 32, 0.05) 100%);
        }

        body {
            font-family: 'Lora', serif;
            color: var(--text-dark);
            background: linear-gradient(145deg, #f8f9fa 0%, #e9ecef 100%);
            line-height: 1.7;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Cinzel', serif;
        }

        /* Navbar Styles - Using from document 2 */
        .navbar {
            transition: all 0.4s ease;
            padding: 15px 0;
            background: transparent;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            padding-left: 1rem;
            padding-right: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: var(--accent-gold);
        }

        .navbar-dark .navbar-nav .nav-link.active {
            color: var(--accent-gold);
        }

        .navbar-scrolled {
            background-color: rgba(45, 55, 72, 0.98) !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background-color: rgba(212, 175, 55, 0.1);
            color: var(--accent-burgundy);
        }

        /* Hero Section */
        .hero-section {
            background: var(--gradient-primary);
            min-height: 60vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.02)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.6;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, #ffffff, var(--accent-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        /* Content Section */
        .content-section {
            padding: 5rem 0;
            position: relative;
        }

        /* Search Section */
        .search-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .search-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .search-input {
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: var(--gradient-light);
        }

        .search-input:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
            background: white;
        }

        .btn-search {
            background: var(--gradient-primary);
            border: none;
            padding: 1rem 2rem;
            border-radius: 15px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            color: white;
        }

        /* Question Cards */
        .question-card {
            background: white;
            border: none;
            border-radius: 12px;
            margin-bottom: 1.2rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            position: relative;
        }

        .question-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .question-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .question-card:hover::before {
            transform: scaleX(1);
        }

        .question-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
            padding: 0;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.8rem;
            color: white;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .user-info h6 {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.1rem;
            font-size: 0.95rem;
        }

        .question-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.8rem;
            line-height: 1.4;
        }

        .answer-section {
            background: var(--gradient-light);
            border-left: 3px solid var(--accent-gold);
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 0 8px 8px 0;
            position: relative;
        }

        .answer-section::before {
            content: '"';
            position: absolute;
            top: -5px;
            left: 10px;
            font-size: 1.8rem;
            color: var(--accent-gold);
            font-family: 'Cinzel', serif;
        }

        .answer-label {
            color: var(--accent-burgundy);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.4rem;
        }

        /* Form Section */
        .form-section {
            background: white;
            border-radius: 25px;
            padding: 3rem;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--gradient-primary);
        }

        .form-title {
            font-size: 2rem;
            color: var(--primary-dark);
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--accent-gold);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--gradient-light);
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
            background: white;
        }

        .btn-submit {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 1rem 3rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
            border: 1px solid rgba(40, 167, 69, 0.2);
            border-radius: 15px;
            color: #155724;
        }

        /* Pagination */
        .pagination {
            justify-content: center;
            margin-top: 3rem;
        }

        .page-link {
            border: none;
            color: var(--primary-dark);
            margin: 0 0.2rem;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background-color: var(--accent-gold);
            color: white;
            transform: translateY(-2px);
        }

        .page-item.active .page-link {
            background-color: var(--accent-burgundy);
            border-color: var(--accent-burgundy);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .navbar {
                background-color: rgba(45, 55, 72, 0.98) !important;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .content-section {
                padding: 3rem 0;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .form-section {
                padding: 2rem 1.5rem;
            }
            
            .search-section {
                padding: 1.5rem;
            }
        }

        .colored-toast.swal2-icon-success {
            background-color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            border-left: 4px solid #28a745 !important;
            padding: 1rem !important;
            border-radius: 8px !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            border-left: 4px solid #dc3545 !important;
            padding: 1rem !important;
            border-radius: 8px !important;
        }

        .colored-toast .swal2-title {
            color: var(--primary-dark) !important;
            font-size: 1.1rem !important;
            font-family: 'Lora', serif !important;
            margin-bottom: 0.25rem !important;
        }

        .colored-toast .swal2-html-container {
            color: #6c757d !important;
            font-size: 0.9rem !important;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <img src="/img/logo.png" alt="Logo" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
        <a class="navbar-brand" href="#">ST. FRANSISKUS XAVERIUS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tentang-paroki') }}">Tentang Paroki</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button" data-bs-toggle="dropdown">
                        Layanan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('baptis') }}">Baptis</a></li>
                        <li><a class="dropdown-item" href="{{ route('komuni-pertama') }}">Komuni Pertama</a></li>
                        <li><a class="dropdown-item" href="{{ route('krisma') }}">Krisma</a></li>
                        <li><a class="dropdown-item" href="{{ route('pernikahan') }}">Pernikahan</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('forum.index') }}">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
                </li>
            </ul>
            
            <a href="http://si_gereja.test/login" class="nav-link d-flex align-items-center ms-3" style="color: white;">
                <i class="bi bi-box-arrow-in-right fs-5 me-1"></i>
                <span>Masuk</span>
            </a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content floating">
                    <h1 class="hero-title">Forum Umat</h1>
                    <p class="hero-subtitle text-white">Tanya jawab seputar kegiatan Gereja Katedral St. Fransiskus Xaverius</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="content-section">
    <div class="container">
        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            <!-- Questions List -->
            <div class="col-lg-8">
                <!-- Search Section -->
                <div class="search-section">
                    <form method="GET" action="{{ route('forum.index') }}">
                        <div class="input-group">
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control search-input" 
                                placeholder="Cari pertanyaan yang ingin Anda ketahui..." 
                                value="{{ old('search', $search ?? '') }}"
                                autocomplete="off"
                            >
                            <button class="btn btn-search" type="submit">
                                <i class="bi bi-search me-2"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>

                <h4 class="mb-4 text-center" style="color: var(--primary-dark); font-weight: 600;">Pertanyaan & Jawaban Terbaru</h4>
                
                @forelse($questions as $q)
                <div class="question-card">
                    <div class="card-body p-3">
                        <div class="question-header">
                            <div class="user-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="user-info">
                                <h6>{{ $q->name }}</h6>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $q->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                        <h5 class="question-title">{{ $q->question }}</h5>
                        
                        @if($q->answer)
                        <div class="answer-section">
                            <div class="answer-label">Jawaban:</div>
                            <p class="mb-1">{{ $q->answer }}</p>
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>{{ $q->answered_at->format('d M Y, H:i') }}
                            </small>
                        </div>
                        @else
                        <div class="text-muted small">
                            <i class="bi bi-hourglass-split me-2"></i>Menunggu jawaban...
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="bi bi-chat-dots"></i>
                    <h5>Belum ada pertanyaan</h5>
                    <p>Jadilah yang pertama mengajukan pertanyaan di forum ini.</p>
                </div>
                @endforelse

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $questions->links() }}
                </div>
            </div>

            <!-- Ask Question Form -->
            <div class="col-lg-4">
                <div class="form-section">
                    <h4 class="form-title">Ajukan Pertanyaan</h4>
                    <form method="POST" action="{{ route('forum.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-person me-2"></i>Nama Lengkap
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name') }}" 
                                required
                                placeholder="Masukkan nama lengkap Anda"
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-chat-question me-2"></i>Pertanyaan
                            </label>
                            <textarea 
                                name="question" 
                                class="form-control @error('question') is-invalid @enderror" 
                                rows="5" 
                                required
                                placeholder="Tulis pertanyaan Anda seputar kegiatan gereja..."
                            >{{ old('question') }}</textarea>
                            @error('question')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-send me-2"></i>Kirim Pertanyaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Navbar scroll effect
    const navbar = document.getElementById('mainNavbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('navbar-scrolled', window.scrollY > 50);
    });
    
    // Initialize Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });

    // Smooth form validation feedback
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Success notification
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            position: 'top-end',
            background: '#fff',
            iconColor: '#28a745',
            customClass: {
                popup: 'colored-toast'
            }
        });
    @endif

    // Error notification
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            position: 'top-end',
            background: '#fff',
            iconColor: '#dc3545',
            customClass: {
                popup: 'colored-toast'
            }
        });
    @endif
</script>
</body>
</html>