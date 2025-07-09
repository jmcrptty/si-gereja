<nav class="sb-topnav navbar navbar-expand-lg navbar-dark bg-dark">
    {{-- Brand --}}
    <a class="navbar-brand ps-3" href="{{ route('dashboard') }}" style="font-family: 'Lora', serif;">
        PAROKI KATEDRAL
    </a>

    {{-- Sidebar toggle --}}
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    {{-- Logout (selalu tampil, teks disembunyikan di mobile) --}}
    <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center">
                @csrf
                <button type="submit" class="btn btn-link nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="d-none d-lg-inline">Logout</span>
                </button>
            </form>
        </li>
    </ul>
</nav>
