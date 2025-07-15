<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>

                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href={{ route('dashboard') }}>
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <a class="nav-link {{ Request::is('ketualingkungan.umat.index') ? 'active' : '' }}" href="{{ route('ketualingkungan.umat.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Kelola Data Umat
                    </a>

                    @php
                        $jumlahPendingUmat = \App\Models\Umat::when(Auth::user()->role === 'ketua lingkungan', function ($query) {
                            return $query->where('lingkungan', Auth::user()->lingkungan);
                        })->where('status_pendaftaran', 'Pending')->count();
                    @endphp

                    <a class="nav-link {{ Request::is('umat/persetujuan') ? 'active' : '' }}" href="{{ route('ketualingkungan.umat.persetujuan') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>
                        Persetujuan
                        @if ($jumlahPendingUmat > 0)
                            <span class="badge bg-danger ms-2">{{ $jumlahPendingUmat }}</span>
                        @endif
                    </a>

                    <a class="nav-link {{ Request::is('ketualingkungan.manajemen_akun') ? 'active' : '' }}" href="{{ route('ketualingkungan.edit.akun', Auth::user()->id ) }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                        Pengaturan
                    </a>

                    <div class="collapse {{ Request::is('umat') ? 'show' : '' }} {{ Request::is('umat/persetujuan') ? 'show' : '' }}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Request::is('umat') ? 'active' : '' }}" href="{{ route('ketualingkungan.umat.index') }}">Kelola Data Umat</a>
                        </nav>
                    </div>

                </div>
            </div>
        </nav>
    </div>
</div>
