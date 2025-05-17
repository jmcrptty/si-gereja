<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">               
                    <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <a class="nav-link collapsed {{ Request::is('umat') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Data Umat
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse {{ Request::is('umat') ? 'show' : '' }}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link {{ Request::is('umat') ? 'active' : '' }}" href="{{ route('umat.index') }}">Kelola Data Umat</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Persetujuan</a>
                                </nav>
                            </div>
                            
                            <a class="nav-link collapsed {{ Request::is('lingkungan') ? 'active' : '' }}" href="{{ route('lingkungan.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-house-user"></i></div>
                                Lingkungan
                            </a>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>