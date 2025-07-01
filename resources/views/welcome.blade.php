<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gereja Katedral St. Fransiskus Xaverius Merauke</title>
  <link rel="icon" href="/img/logo.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lora:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-dark: #2d3748;
      --primary-light: #f8f9fa;
      --accent-gold: #d4af37;
      --accent-burgundy: #800020;
      --text-dark: #333;
      --text-light: #f8f9fa;
    }

    body {
      font-family: 'Lora', serif;
      color: var(--text-dark);
      line-height: 1.7;
    }

    h1, h2, h3, h4, h5, h6, .navbar-brand {
      font-family: 'Cinzel', serif;
    }

    .navbar {
      transition: all 0.4s ease;
      padding: 15px 0;
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

    .navbar-scrolled {
      background-color: rgba(45, 55, 72, 0.98) !important;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      padding: 10px 0;
    }

    .dropdown-menu {
      border: none;
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
      border-radius: 0.25rem;
    }

    .dropdown-item {
      padding: 0.5rem 1.5rem;
      font-weight: 500;
    }

    .dropdown-item:hover {
      background-color: rgba(212, 175, 55, 0.1);
      color: var(--accent-burgundy);
    }

    .hero-slide {
      height: 100vh;
      background-size: cover;
      background-position: center;
    }

    .carousel-fade .carousel-item {
      opacity: 0;
      transition: opacity 1s ease;
    }

    .carousel-fade .carousel-item.active {
      opacity: 1;
    }

    .carousel-control-prev, .carousel-control-next {
      width: 8%;
      opacity: 0.7;
    }

    .carousel-control-prev-icon, .carousel-control-next-icon {
      width: 40px;
      height: 40px;
    }

    .overlay {
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
      position: absolute;
      top: 0; bottom: 0; left: 0; right: 0;
      z-index: 2;
    }

    .hero-content {
      z-index: 3;
    }

    .hero-content h1 {
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      font-weight: 700;
      letter-spacing: 1px;
    }

    .btn-elegant {
      background-color: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.6);
      color: white;
      padding: 12px 30px;
      font-weight: 500;
      letter-spacing: 1px;
      transition: all 0.3s ease;
    }

    .btn-elegant:hover {
      background-color: rgba(255, 255, 255, 0.25);
      border-color: #fff;
      color: white;
      transform: translateY(-2px);
    }

    .section-heading {
      position: relative;
      padding-bottom: 15px;
      margin-bottom: 30px;
    }

    .section-heading::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background-color: var(--accent-gold);
    }

    .card {
      border: none;
      overflow: hidden;
      transition: all 0.3s ease;
      border-radius: 10px;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
      height: 250px;
      object-fit: cover;
      transition: all 0.5s ease;
    }

    .card:hover .card-img-top {
      transform: scale(1.05);
    }

    .card-body {
      padding: 1.5rem;
    }

    .card-title {
      font-weight: 600;
      margin-bottom: 15px;
      color: var(--primary-dark);
    }

    .card-text {
      color: #666;
      margin-bottom: 1.5rem;
    }

    .btn-dark {
      background-color: var(--primary-dark);
      border: none;
      padding: 10px 25px;
      transition: all 0.3s ease;
    }

    .btn-dark:hover {
      background-color: var(--accent-burgundy);
      transform: translateY(-2px);
    }

    .misa-icon {
      font-size: 2.5rem;
      color: var(--accent-gold);
      margin-right: 20px;
    }

    .misa-item {
      background-color: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      height: 100%;
    }

    .misa-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .misa-title {
      font-weight: 600;
      color: var(--primary-dark);
      margin-bottom: 10px;
    }

    .misa-detail {
      font-size: 1rem;
      color: #666;
    }

    .misa-schedule {
      margin-top: 8px;
      padding-left: 0;
    }

    .misa-schedule li {
      list-style: none;
      margin-bottom: 5px;
      color: #555;
    }

    .misa-schedule li::before {
      content: "•";
      color: var(--accent-gold);
      font-weight: bold;
      display: inline-block;
      width: 1em;
      margin-left: -1em;
    }

    .misa-special {
      font-style: italic;
      color: var(--accent-burgundy);
    }

    footer {
      background-color: var(--primary-dark);
      color: white;
      padding-top: 50px;
      padding-bottom: 30px;
    }

    .footer-logo {
      font-family: 'Cinzel', serif;
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      letter-spacing: 1px;
    }

    .footer-heading {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 20px;
      color: var(--accent-gold);
    }

    .footer-contact {
      list-style: none;
      padding-left: 0;
    }

    .footer-contact li {
      margin-bottom: 10px;
      display: flex;
      align-items: center;
    }

    .footer-contact i {
      margin-right: 10px;
      color: var(--accent-gold);
    }

    .footer-links {
      list-style: none;
      padding-left: 0;
    }

    .footer-links li {
      margin-bottom: 10px;
    }

    .footer-links a {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .footer-links a:hover {
      color: var(--accent-gold);
      padding-left: 5px;
    }

    .footer-social a {
      color: rgba(255, 255, 255, 0.8);
      font-size: 1.2rem;
      margin-right: 15px;
      transition: all 0.3s ease;
    }

    .footer-social a:hover {
      color: var(--accent-gold);
      transform: translateY(-3px);
    }

    .footer-bottom {
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding-top: 20px;
      margin-top: 30px;
    }

    @media (max-width: 992px) {
      .navbar {
        background-color: rgba(45, 55, 72, 0.98) !important;
      }

      .hero-content h1 {
        font-size: 2.5rem;
      }

      .misa-item {
        margin-bottom: 20px;
      }
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2rem;
      }

      .card-img-top {
        height: 200px;
      }

      .footer-column {
        margin-bottom: 30px;
      }
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
          <a class="nav-link active" href="/">Beranda</a>
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
          <a class="nav-link" href="{{ route('pendaftaran-umat') }}">Pendaftaran Umat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
        </li>
          <li class="nav-item">
          <a class="nav-link" href="{{ route('forum.index') }}">Forum Umat</a>
        </li>
      </ul>

      {{-- <a href="http://si_gereja.test/login" class="nav-link d-flex align-items-center ms-3" style="color: white;">
        <i class="bi bi-box-arrow-in-right fs-5 me-1"></i>
        <span>Masuk</span>
      </a> --}}

    </div>
  </div>
</nav>

<!-- Hero -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="d-block w-100 hero-slide" style="background-image: url('/img/gereja4.jpg');"></div>
    </div>
    <div class="carousel-item">
      <div class="d-block w-100 hero-slide" style="background-image: url('/img/gereja2.jpg');"></div>
    </div>
    <div class="carousel-item">
      <div class="d-block w-100 hero-slide" style="background-image: url('/img/guamaria.jpg');"></div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    {{-- <span class="carousel-control-prev-icon"></span> --}}
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    {{-- <span class="carousel-control-next-icon"></span> --}}
  </button>
  <div class="overlay"></div>
  <div class="text-center text-white hero-content position-absolute top-50 start-50 translate-middle">
    <h1 class="mb-4 display-4">Paroki St. Fransiskus Xaverius<br>Katedral Merauke</h1>
    <p class="mb-4 lead">Menjadi Komunitas Iman yang Bersaudara, Melayani dan Bersaksi</p>
    <a href="#pengumuman-section" class="btn btn-elegant">Pengumuman Gereja</a>
  </div>
</div>

<!-- Pengumuman -->
<section id="pengumuman-section" class="py-5 bg-light">
  <div class="container py-4">
    <h2 class="text-center section-heading">PENGUMUMAN GEREJA</h2>
    <div class="row g-4">
      <div class="col-md-4">
    <div class="shadow-sm card h-100">
        <div class="overflow-hidden">
            @if(isset($pengumuman['mingguan'][0]))
                <img src="{{ asset('storage/' . $pengumuman['mingguan'][0]->image) }}"
                     class="card-img-top"
                     alt="{{ $pengumuman['mingguan'][0]->title }}"
                     style="height: 200px; object-fit: cover;"
                     onerror="this.onerror=null; this.src='/img/default-image.jpg';">
            @else
                <img src="/img/default-image.jpg"
                     class="card-img-top"
                     alt="Default Image"
                     style="height: 200px; object-fit: cover;">
            @endif
        </div>
        <div class="card-body d-flex flex-column">
            <!-- Judul kategori - paling besar -->
            <h4 class="mb-3 card-title fw-bold">Pengumuman Mingguan</h4>

            <!-- Judul pengumuman - ukuran sedang -->
            <h5 class="mb-2 h5 text-muted">
                {{ isset($pengumuman['mingguan'][0]) ? $pengumuman['mingguan'][0]->title : 'Belum ada pengumuman' }}
            </h5>

            <!-- Deskripsi - ukuran terkecil -->
            <p class="card-text small">
                {{ isset($pengumuman['mingguan'][0]) ? Str::limit($pengumuman['mingguan'][0]->sub, 150) : 'Belum ada detail pengumuman mingguan.' }}
            </p>

            <!-- Tombol di bagian bawah -->
            <div class="mt-auto">
                <a href="{{ route('pengumuman.show', 'mingguan') }}" class="btn btn-dark w-100">
                    <i></i>Baca Selengkapnya
                </a>
            </div>
        </div>
    </div>
</div>

      <div class="col-md-4">
        <div class="shadow-sm card h-100">
          <div class="overflow-hidden">
            @if(isset($pengumuman['laporan_keuangan'][0]))
              <img src="{{ asset('storage/' . $pengumuman['laporan_keuangan'][0]->image) }}"
                   class="card-img-top"
                   alt="{{ $pengumuman['laporan_keuangan'][0]->title }}"
                   style="height: 200px; object-fit: cover;"
                   onerror="this.onerror=null; this.src='/img/default-image.jpg';">
            @else
              <img src="/img/default-image.jpg"
                   class="card-img-top"
                   alt="Default Image"
                   style="height: 200px; object-fit: cover;">
            @endif
          </div>
          <div class="card-body d-flex flex-column">

             <h4 class="mb-3 card-title fw-bold">Pengumuman Keuangan</h4>

            <h5 class="mb-2 h5 text-muted">
              {{ isset($pengumuman['laporan_keuangan'][0]) ? $pengumuman['laporan_keuangan'][0]->title : 'Laporan Keuangan' }}
            </h5>

            <p class="card-text small">
              {{ isset($pengumuman['laporan_keuangan'][0]) ? Str::limit($pengumuman['laporan_keuangan'][0]->sub, 150) : 'Belum ada laporan keuangan.' }}
            </p>
            <div class="mt-auto">
              <a href="{{ route('pengumuman.show', 'laporan-keuangan') }}" class="btn btn-dark w-100">Baca Selengkapnya</a>
            </div>
          </div>
        </div>
      </div>

<!-- Perbaikan bagian pengumuman lainnya -->
<div class="col-md-4">
    <div class="shadow-sm card h-100">
        <div class="overflow-hidden">
            @if(isset($pengumuman['pengumuman_lainnya'][0]))
                <img src="{{ asset('storage/' . $pengumuman['pengumuman_lainnya'][0]->image) }}"
                     class="card-img-top"
                     alt="{{ $pengumuman['pengumuman_lainnya'][0]->title }}"
                     style="height: 200px; object-fit: cover;"
                     onerror="this.onerror=null; this.src='/img/default-image.jpg';">
            @else
                <img src="/img/default-image.jpg"
                     class="card-img-top"
                     alt="Default Image"
                     style="height: 200px; object-fit: cover;">
            @endif
        </div>
        <div class="card-body d-flex flex-column">

           <h4 class="mb-3 card-title fw-bold">Pengumuman Lainnya</h4>

            <h5 class="mb-2 h5 text-muted">
                {{ isset($pengumuman['pengumuman_lainnya'][0]) ? $pengumuman['pengumuman_lainnya'][0]->title : 'Pengumuman Lainnya' }}
            </h5>
            <p class="card-text small">
                {{ isset($pengumuman['pengumuman_lainnya'][0]) ? Str::limit($pengumuman['pengumuman_lainnya'][0]->sub, 150) : 'Belum ada pengumuman lainnya.' }}
            </p>
            <div class="mt-auto">
                <a href="{{ route('pengumuman.show', 'pengumuman-lainnya') }}" class="btn btn-dark w-100">
                    <i></i>Baca Selengkapnya
                </a>
            </div>
        </div>
    </div>
</div>

</section>


<!-- Jadwal Misa -->
<section class="py-5 bg-white">
  <div class="container py-4">
    <h2 class="text-center section-heading">JADWAL MISA</h2>
    <div class="row g-4">
      <!-- Misa Harian -->
      <div class="col-md-4">
        <div class="shadow-sm card h-100">
          <div class="card-body d-flex flex-column">
            <div class="mb-3 misa-icon">
              <i class="bi bi-brightness-alt-high"></i>
            </div>
            <h5 class="mb-2 h5 text-muted">
              {{ isset($informasiMisa['Harian']) ? $informasiMisa['Harian']->jenis_misa : 'tidak ada' }}
            </h5>
            <p class="card-text small">
              {{ isset($informasiMisa['Harian']) ? $informasiMisa['Harian']->jadwal_misa : '05:30 WIT' }}
            </p>
          </div>
        </div>
      </div>

      <!-- Misa Jumat Pertama -->
      <div class="col-md-4">
        <div class="shadow-sm card h-100">
          <div class="card-body d-flex flex-column">
            <div class="mb-3 misa-icon">
              <i class="bi bi-heart"></i>
            </div>
            <h5 class="mb-2 h5 text-muted">
              {{ isset($informasiMisa['Jumat_Pertama']) ? $informasiMisa['Jumat_Pertama']->jenis_misa : 'Jumat Pertama' }}
            </h5>
            <p class="card-text small">
              {{ isset($informasiMisa['Jumat_Pertama']) ? $informasiMisa['Jumat_Pertama']->jadwal_misa : '19:30 WIT' }}
            </p>
          </div>
        </div>
      </div>

      <!-- Misa Minggu -->
      <div class="col-md-4">
        <div class="shadow-sm card h-100">
          <div class="card-body d-flex flex-column">
            <div class="mb-3 misa-icon">
              <i class="bi bi-people-fill"></i>
            </div>
            <h5 class="mb-2 h5 text-muted">
              {{ isset($informasiMisa['Minggu']) ? $informasiMisa['Minggu']->jenis_misa : 'Minggu' }}
            </h5>
            <p class="card-text small">
              {{ isset($informasiMisa['Minggu']) ? $informasiMisa['Minggu']->jadwal_misa : '06:00 WIT, 08:30 WIT, 16:30 WIT' }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Footer -->
@section('footer')
  @include('layouts.footerutama')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
</script>
</body>
</html>
