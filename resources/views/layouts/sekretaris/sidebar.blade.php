<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="{{ route('sekretaris.dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        Dashboard
                    </a>

                    <div class="sb-sidenav-menu-heading">Menu</div>

                    <a class="nav-link" href="{{ route('sekretaris.umat.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Data Umat
                    </a>

                    <a class="nav-link" href="{{ route('sekretaris.pengumuman') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                        Pengumuman Paroki
                    </a>

                    <a class="nav-link" href="{{ route('sekretaris.informasi_misa') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                        Jadwal Misa
                    </a>

                    <a class="nav-link" href="{{ route('sekretaris.forum') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                        Forum umat
                    </a>

                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                        manajemen sakramen
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('sekretaris.pendaftaransakramen') }}">Pendaftaran Sakramen</a>
                            <a class="nav-link" href="{{ route('sekretaris.penerimaansakramen') }}">Penerimaan Sakramen</a>
                            <a class="nav-link" href="{{ route('sekretaris.pengaturan_sakramen') }}">Pembukaan Sakramen</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                        Laporan
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="laporan-sakramen.html">Penerimaan Sakramen</a>
                            <a class="nav-link" href="laporan-umat.html">Data Umat</a>
                        </nav>
                    </div>

                </div>
            </div>
        </nav>
    </div>
</div>
