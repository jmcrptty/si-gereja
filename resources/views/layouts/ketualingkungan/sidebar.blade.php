<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Data Umat
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse {{ Request::is('umat') ? 'show' : '' }} {{ Request::is('umat/persetujuan') ? 'show' : '' }}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link {{ Request::is('umat') ? 'active' : '' }}" href="{{ route('ketualingkungan.umat.index') }}">Kelola Data Umat</a>
                                    <a class="nav-link {{ Request::is('umat/persetujuan') ? 'active' : '' }}" href="{{ route('ketualingkungan.umat.persetujuan') }}">
                                        Persetujuan
                                        @if ($jumlahPending > 0)
                                            <span class="badge bg-danger ms-2">{{ $jumlahPending }}</span>
                                        @endif
                                    </a>
                                </nav>
                            </div>
                </div>
            </div>
        </nav>
    </div>
</div>
