<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pendaftaran Umat</title>
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
      </ul>
      
      <a href="http://si_gereja.test/login" class="nav-link d-flex align-items-center ms-3" style="color: white;">
        <i class="bi bi-box-arrow-in-right fs-5 me-1"></i>
        <span>Masuk</span>
      </a>
  
    </div>
  </div>
</nav>

<!-- Hero -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="d-block w-100 hero-slide" style="background-image: url('/img/patung.png');"></div>
    </div>
  </div>

  <div class="overlay"></div>
  <div class="hero-content position-absolute top-50 start-50 translate-middle text-center text-white">
    <H5>CEK STATUS</H5>
    <h1 class="display-4 mb-4">PENDAFTARAN UMAT PAROKI KATEDRAL</h1>
  </div>
</div>

<!-- Content Section -->
<section id="pendaftaran-umat" class="py-5 bg-light">
  <div class="container">
    <!-- Judul Halaman -->
    <h2 class="text-center section-heading mb-4">Pendaftaran Umat</h2>

    <!-- Deskripsi Pendaftaran -->
    <div class="row mb-4">
      <div class="col-md-12">
        <p class="text-center">
          Untuk memastikan status pendaftaran Anda, masukkan NIK di bawah ini. Sistem kami akan memeriksa apakah NIK Anda sudah terdaftar sebagai umat paroki atau belum.
        </p>
      </div>
    </div>

    <!-- Form Pencarian NIK -->
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title text-center">Cek Status Pendaftaran</h4>
            <form id="formPendaftaran" onsubmit="return checkNIK(event)">
              <div class="mb-4">
                <label for="nikInput" class="form-label">Masukkan NIK Anda</label>
                <input type="text" class="form-control" id="nikInput" placeholder="Masukkan NIK" required>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-dark">Cek Status</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Hasil Pencarian Status -->
    <div class="row justify-content-center mt-4">
      <div class="col-md-8">
        <div class="alert alert-info text-center" id="statusAlert" style="display: none;">
          <strong>Status: </strong><span id="statusMessage"></span>
        </div>
        <div class="text-center" id="pendaftaranButton" style="display: none;">
          <a href="pendaftaran_form_url_here" class="btn btn-dark">Klik untuk Pendaftaran Umat</a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Mock Database
  const database = [
    { nik: '1234567890123456', status: 'Terdaftar' },
    { nik: '9876543210987654', status: 'Belum Terdaftar' }
  ];

  // Function to check NIK
  function checkNIK(event) {
    event.preventDefault();

    const nikInput = document.getElementById('nikInput').value;
    const statusAlert = document.getElementById('statusAlert');
    const statusMessage = document.getElementById('statusMessage');
    const pendaftaranButton = document.getElementById('pendaftaranButton');
    
    // Reset previous status
    statusAlert.style.display = 'none';
    pendaftaranButton.style.display = 'none';

    // Simulate database search
    const userRecord = database.find(record => record.nik === nikInput);

    if (userRecord) {
      // If NIK found, show status
      statusAlert.style.display = 'block';
      statusMessage.textContent = userRecord.status;

      if (userRecord.status === 'Terdaftar') {
        statusMessage.classList.remove('text-danger');
        statusMessage.classList.add('text-success');
      } else {
        statusMessage.classList.remove('text-success');
        statusMessage.classList.add('text-danger');
        pendaftaranButton.style.display = 'block'; // Show the registration button
      }
    } else {
      // If NIK not found, show message
      statusAlert.style.display = 'block';
      statusMessage.textContent = 'NIK tidak ditemukan. Silakan melakukan pendaftaran umat.';
      statusMessage.classList.remove('text-success');
      statusMessage.classList.add('text-danger');
      pendaftaranButton.style.display = 'block';
    }
  }
</script>



<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 footer-column">
        <div class="footer-logo">GEREJA KATEDRAL ST. FRANSISKUS XAVERIUS</div>
        <p class="mb-4">Melayani dengan kasih dan ketulusan untuk mewartakan Kabar Gembira bagi seluruh umat di Tanah Papua.</p>
        <div class="footer-social">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-youtube"></i></a>
          <a href="#"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>
      <div class="col-lg-4 footer-column">
        <h4 class="footer-heading">Kontak Kami</h4>
        <ul class="footer-contact">
          <li><i class="bi bi-geo-alt"></i> Jl. Raya Mandala, Merauke, Papua</li>
          <li><i class="bi bi-telephone"></i> (0971) 321-456</li>
          <li><i class="bi bi-envelope"></i> info@katedralmerauke.or.id</li>
          <li><i class="bi bi-clock"></i> Senin - Jumat: 08.00 - 16.00 WIT</li>
        </ul>
      </div>
      <div class="col-lg-4 footer-column">
        <h4 class="footer-heading">Tautan Cepat</h4>
        <ul class="footer-links">
          <li><a href="#">Jadwal Misa</a></li>
          <li><a href="#">Pendaftaran Baptis</a></li>
          <li><a href="#">Pendaftaran Pernikahan</a></li>
          <li><a href="#">Komunitas</a></li>
          <li><a href="#">Kontak Darurat</a></li>
        </ul>
      </div>
    </div>
    <div class="text-center footer-bottom">
      <p class="mb-0">&copy; 2025 Paroki St. Fransiskus Xaverius Katedral Merauke. Hak Cipta Dilindungi.</p>
    </div>
  </div>
</footer>

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