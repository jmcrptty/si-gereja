<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container d-flex align-items-center">

    <img src="/img/LOGO.png" alt="Logo" class="d-none d-lg-block me-2 rounded-circle" style="width: 40px; height: 40px;">
    
    <a class="navbar-brand fw-bold site-title" href="#">
      ST. FRANSISKUS XAVERIUS
    </a>

    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end mt-3 mt-lg-0" id="navbarNav">
      <ul class="navbar-nav ms-lg-auto text-center text-lg-start">
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
    </div>
  </div>
</nav>

<!-- ✅ CSS Tambahan -->
<style>
  #mainNavbar {
    background-color: transparent;
    transition: background-color 0.3s ease;
    z-index: 999;
  }

  .site-title {
    font-size: 1.2rem;
  }

  @media (max-width: 768px) {
    .site-title {
      font-size: 1rem;
    }
  }

  @media (max-width: 576px) {
    .site-title {
      font-size: 0.9rem;
    }
  }

  /* Optional: jika ingin efek blur pada background navbar */
  /* #mainNavbar {
    backdrop-filter: blur(6px);
    background-color: rgba(0, 0, 0, 0.2); 
  } */
</style
