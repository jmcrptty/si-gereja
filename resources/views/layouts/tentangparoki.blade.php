<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tentang Paroki Katedral</title>
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
@include('layouts.navbarutama')

<!-- Hero -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="d-block w-100 hero-slide" style="background-image: url('/img/guamaria.jpg');"></div>
    </div>
  </div>

  <div class="overlay"></div>
  <div class="hero-content position-absolute top-50 start-50 translate-middle text-center text-white">
    <H5>TENTANG PAROKI KATEDRAL</H1>
    <h1 class="display-4 mb-4">SEJARAH</h1>
  </div>
</div>

<!-- Content Section -->
<section id="tentang-paroki" class="py-5 bg-light">
  <div class="container">
    <!-- Judul Halaman -->
    <h2 class="text-center section-heading mb-4">Tentang Paroki St. Fransiskus Xaverius</h2>

    <!-- Deskripsi Sejarah Paroki -->
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card shadow-sm border-light">
          <div class="card-body">
            <h4 class="card-title">Sejarah Paroki</h4>
            <p class="card-text">
              Misionaris Katolik pertama tiba di Merauke pada awal abad ke-20, sekitar tahun 1905. Mereka berasal dari ordo Misionaris Hati Kudus Yesus (Missionarii Sacratissimi Cordis, MSC). Rombongan pertama MSC yang tiba di Merauke tanggal 14 Agustus 1905 adalah Pastor Henri Nollen MSC, Pastor Philipus Braun MSC, Bruder Andrian van Roesel MSC dan Bruder Melchior Oomen MSC. Mereka mendirikan gereja kecil di Kampung Wendu di pesisir pantai lalu berpindah ke Kampung Buti.<br>
              <br>Pada tahun 1922, Paroki St. Fransiskus Xaverius Merauke resmi didirikan. Nama paroki diambil dari St. Fransiskus Xaverius, seorang misionaris besar dari abad ke-16 yang dikenal karena karyanya dalam menyebarkan agama Katolik di Asia. Paroki ini menjadi salah satu paroki pertama di wilayah Papua, menandai tonggak penting dalam sejarah perkembangan gereja Katolik di Indonesia bagian timur.Pada tahun 1966, status Paroki St. Fransiskus Xaverius Merauke ditingkatkan menjadi pusat dari Keuskupan Agung Merauke yaitu Katedral Merauke. Keuskupan ini mencakup wilayah yang sangat luas di Papua, termasuk beberapa paroki dan stasi misi lainnya. Dengan status baru ini, Katedral Merauke menjadi pusat administrasi dan kegiatan keuskupan.<br>
              <br>Paroki Katedral Merauke saat ini dipimpin oleh Seorang Pastor Paroki yaitu Reverendus Pater Hendrikus Kariwop, MSC. Paroki Katedral terletak di Jalan Raya Mandala No. 30, Merauke, Papua Selatan. Jumlah umat paroki diperkirakan 5.588 jiwa berdasarkan data statistik keuskupan agung Merauke tahun 2024.Luas wilayah paroki Katedral yang cukup besar terbagi menjadi 6 Wilayah Kecil, yaitu St. Hermanus, St. Jakobus, St. Nicholas, St. Philipus, St. Petrus, dan St. Benediktus. Masing-masing wilayah kecil ini kemudian dibagi lagi menjadi 18 Lingkungan atau Basis Doa, yaitu Santo Paulus, Santa Anna, Santa Bernadetha, Santo Yoseph, Ratu Rosario Bunda Allah (RRBA), Ratu Rosari Semesta Alam (RRSA), Santo Kornelis, Santo Agustinus, Santo Marselino, Santa Agnes, Eusebius Damianus, Santo Petrus, Regina Pacis, Stella Maris, Santo Hermanus, Santo Don Bosco, Santo Anthonius, dan St. Fransiskus Xaverius. Pembagian wilayah ini bertujuan untuk memudahkan pelayanan kepada umat dan memastikan semua jemaat terlayani dengan baik.

            </p>
          </div>
        </div>
      </div>
    </div>

<!-- Visi dan Misi -->
<div class="row mb-4">
  <div class="col-md-12">
    <div class="card shadow-sm border-light">
      <div class="card-body">
        <h4 class="card-title">Visi dan Misi Paroki</h4>
        <h5 class="mt-3">Visi</h5>
        <p class="card-text">
         “Menjadi Gereja Lokal yang Mandiri, Partisipatif dan Mengutamakan Persaudaraan”
        </p>
        <h5 class="mt-3">Misi</h5>
        <ul class="ms-4">
          <li></i>Meningkatkan kemandirian secara finansial dan pengelolaannya; kemandirian SDM (ketenagaan: baik calon imam maupun para imam yang bersedia melayani di Keuskupan Agung Merauke bekerjasama dengan Keuskupan Amboina dan beberapa Kongregasi Religius); kemandirian sarana dan prasarana; kemandirian pola berpastoral yang sesuai dengan konteks Papua, khusus Keuskupan Agung Merauke.</li>
          <li></i>Meningkatkan partisipasi dan persekutuan umat dalam panca tugas Gereja (Leiturgia, Koinonia, Diakonia, Martyria dan Kerygma).</li>
          <li></i>Membangun dan merawat persaudaraan internal (antara uskup dan para imam, dan dengan semua umat beriman di Keuskupan Agung Merauke) dan juga eksternal (dengan umat beragama lain).</li>

        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Lingkungan-Lingkungan Paroki -->
<!-- Lingkungan-Lingkungan Paroki -->
<div class="row mb-4">
  <div class="col-md-12">
    <div class="card shadow-sm border-light">
      <div class="card-body">
        <h4 class="card-title">Lingkungan-Lingkungan Paroki</h4>
        <p class="card-text">
          Paroki St. Fransiskus Xaverius memiliki 18 lingkungan atau basis doa yang tersebar di seluruh wilayah pelayanan. Setiap lingkungan berperan sebagai komunitas dasar umat untuk membangun iman, kebersamaan, dan pelayanan.
        </p>

        <div class="row">
          <div class="col-md-6">
            <ul class="list-unstyled ms-3">
              <li><i class="bi bi-check-circle text-primary me-1"></i> Eusebius Damianus</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Regina Pacis</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Ratu Rosari Bunda Allah (RRBA)</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Ratu Rosari Semesta Alam (RRSA)</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santa Agnes</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santa Anna</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santa Bernadetha</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santo Agustinus</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santo Anthonius</li>
            </ul>
          </div>

          <div class="col-md-6">
            <ul class="list-unstyled ms-3">
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santo Yohanes Don Bosco</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santo Hermanus</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santo Kornelis</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santo Marselino</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santo Paulus</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santo Petrus</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Santo Yoseph</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> St. Fransiskus Xaverius</li>
              <li><i class="bi bi-check-circle text-primary me-1"></i> Stella Maris</li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


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