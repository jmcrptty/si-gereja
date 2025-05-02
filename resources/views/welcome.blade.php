<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gereja Katetdral Merauke</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
  <!-- Tambahkan di head jika belum -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Noto Serif', serif;
    }

    .navbar {
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .navbar-scrolled {
      background-color: #343a40 !important;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar .nav-link {
      color: white !important;
    }

    .dropdown-menu {
      background-color: rgba(255, 255, 255, 0.95);
    }

    .dropdown-item:hover {
      background-color: #f8f9fa;
    }

    .hero-slide {
      height: 100vh;
      background-size: cover;
      background-position: center;
    }

    .carousel-fade .carousel-item {
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .carousel-fade .carousel-item.active {
      opacity: 1;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.4);
      position: absolute;
      top: 0; bottom: 0; left: 0; right: 0;
      z-index: 2;
    }

    .hero-content {
      z-index: 3;
    }

    .btn-elegant {
      background-color: rgba(255, 255, 255, 0.1);
      border: 1px solid white;
      color: white;
    }

    .btn-elegant:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }

    .card-img-top {
      height: 250px;
      object-fit: cover;
    }

    @media (max-width: 768px) {
      .card-img-top {
        height: 200px;
      }
    }

    footer {
      background-color: #343a40;
      color: white;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">PAROKI KATEDRAL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarNav">
      <ul class="navbar-nav me-2">
        <li class="nav-item">
          <a class="nav-link active" href="#">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Tentang Paroki</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button" data-bs-toggle="dropdown">
            Layanan
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Sakramen Baptis</a></li>
            <li><a class="dropdown-item" href="#">Komuni Pertama</a></li>
            <li><a class="dropdown-item" href="#">Krisma</a></li>
            <li><a class="dropdown-item" href="#">Pernikahan</a></li>
            <li><a class="dropdown-item" href="#">Minyak Suci</a></li>
          </ul>

          <li class="nav-item">
            <a class="nav-link" href="#">Pendaftaran Umat</a>
          </li>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Kontak</a>
        </li>
      </ul>

      <!-- Ikon Login -->
      <a href="{{ route('login') }}" class="nav-link d-flex align-items-center px-2 ms-2" style="color: white;">
        <i class="bi bi-box-arrow-in-right fs-5"></i>
      </a>
    </div>
  </div>
</nav>





<!-- Hero -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="d-block w-100 hero-slide" style="background-image: url('/img/gereja.jpg');"></div>
    </div>
    <div class="carousel-item">
      <div class="d-block w-100 hero-slide" style="background-image: url('/img/gereja2.png');"></div>
    </div>
    <div class="carousel-item">
      <div class="d-block w-100 hero-slide" style="background-image: url('/img/gereja3.png');"></div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
  <div class="overlay"></div>
  <div class="hero-content position-absolute top-50 start-50 translate-middle text-center text-white">
    <h5 class="display-4 fw-bold">Paroki St. Fransiskus Xaverius Katedral Merauke</h5>
    <a href="#pengumuman-section" class="btn btn-elegant mt-3">Pengumuman Gereja</a>
  </div>
</div>

<!-- Pengumuman -->
<section id="pengumuman-section" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold">PENGUMUMAN GEREJA</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow">
          <img src="/img/pengumuman1.png" class="card-img-top" alt="Bible Camp">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold">Bulan Rosario</h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, ipsa!</p>
            <div class="mt-auto">
              <a href="#" class="btn btn-dark w-100">Baca Pengumuman</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow">
          <img src="/img/pengumuman2.png" class="card-img-top" alt="Pengumuman 1">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold">Pembukaan Bulan Maria 2025</h5>
            <p class="card-text">Syallom, mari hadiri misa pembukaan Bulan Maria tanggal 1 Mei 2025 pukul 19.00 WIB di Gereja Maria Kusuma Karmel. Diakhiri dengan Rosario bersama.</p>
            <div class="mt-auto">
              <a href="#" class="btn btn-dark w-100">Baca Pengumuman</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow">
          <img src="/img/pengumuman3.png" class="card-img-top" alt="Brain Gym">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold">Bulan Kitab Suci</h5>
            <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio tenetur similique blanditiis ipsum temporibus, possimus porro nostrum consectetur quia aperiam.</p>
            <div class="mt-auto">
              <a href="#" class="btn btn-dark w-100">Baca Pengumuman</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section

<!-- Jadwal Misa -->
<section class="py-5 bg-white">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">JADWAL MISA</h2>
    <div class="row justify-content-center gy-4">
      <div class="col-lg-5 d-flex">
        <div class="me-3 fs-1">🌅</div>
        <div>
          <h5 class="fw-bold mb-1">Misa Harian</h5>
          <p class="mb-1">Hari Senin - Sabtu</p>
          <p class="mb-0">• 05.30 WIB</p>
        </div>
      </div>
      <div class="col-lg-5 d-flex">
        <div class="me-3 fs-1">🕊️</div>
        <div>
          <h5 class="fw-bold mb-1">Misa Jumat Pertama</h5>
          <p class="mb-1">Hari Jumat Pertama Setiap Bulan</p>
          <p class="mb-0">• 19.30 WIB</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-4">
      <div class="col-lg-10 d-flex">
        <div class="me-3 fs-1">👨‍👩‍👧‍👦</div>
        <div>
          <h5 class="fw-bold mb-1">Misa Minggu</h5>
          <p class="mb-1">Hari Sabtu</p>
          <p class="mb-2">• 16.30 WIB</p>
          <p class="mb-1">Hari Minggu</p>
          <ul class="list-unstyled mb-0">
            <li>• 06.00 WIB</li>
            <li>• 08.30 WIB</li>
            <li>• 11.00 WIB</li>
            <li>• 16.30 WIB</li>
            <li><em>• 19.00 WIB - Misa Bernuansa Karismatik (tiap Minggu Ke-3)</em></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="py-4">
  <div class="container text-center">
    <p class="mb-1">&copy; 2025 Paroki Katedral Merauke</p>
    <small class="">Jl. Raya Mandala, Merauke | Email: info@katedralmerauke.or.id</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const navbar = document.getElementById('mainNavbar');
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('navbar-scrolled', window.scrollY > 50);
  });
</script>
</body>
</html>