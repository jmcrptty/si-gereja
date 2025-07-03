<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="{{ route('dashboard') }}" style="font-family: 'Lora', serif;">PAROKI KATEDRAL</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>

    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link nav-link">
                    <i class="fas fa-sign-out-alt"> </i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
