<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>

    {{-- Styles --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lora:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    {{-- Custom Theme Styles --}}
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
            background-color: var(--primary-light);
            color: var(--text-dark);
            font-family: 'Georgia', serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Lora', serif;
        }

        .sb-nav-fixed .sb-topnav {
            background-color: var(--primary-dark) !important;
        }

        .sb-sidenav-dark {
            background-color: var(--primary-dark);
        }

        .sb-sidenav-dark .nav-link {
            color: var(--text-light);
        }

        .sb-sidenav-dark .nav-link:hover,
        .sb-sidenav-dark .nav-link.active {
            background-color: rgba(128, 0, 32, 0.2);
            color: var(--accent-gold);
        }

        .sb-sidenav-menu-heading {
            color: var(--accent-gold);
        }

        .navbar-dark .navbar-nav .nav-link {
            color: var(--text-light);
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: var(--accent-gold);
        }

        .breadcrumb {
            background-color: #e9e9e9;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #ccc;
        }

        footer.bg-light {
            background-color: #eeeeee !important;
        }

        a {
            color: var(--accent-burgundy);
        }

        a:hover {
            color: var(--accent-gold);
        }

        .btn-primary {
            background-color: var(--accent-burgundy);
            border-color: var(--accent-burgundy);
        }

        .btn-primary:hover {
            background-color: var(--accent-gold);
            border-color: var(--accent-gold);
            color: var(--text-dark);
        }
    </style>
</head>

<body class="sb-nav-fixed">
    {{-- Navbar --}}
    @include('layouts.navbar')

    <div id="layoutSidenav">
        {{-- Sidebar --}}
        @if(Auth::check())
            @php $role = strtolower(Auth::user()->role); @endphp
            @if($role === 'pastor paroki')
                @include('layouts.pastor.sidebar')
            @elseif($role === 'sekretaris')
                @include('layouts.sekretaris.sidebar')
            @elseif($role === 'ketua lingkungan')
                @include('layouts.ketualingkungan.sidebar')
            @endif
        @endif

        {{-- Main Content --}}
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
</body>
</html>
