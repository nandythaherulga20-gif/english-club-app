<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - English Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <style>
        body { background-color: #f4f6f9; }

        /* SIDEBAR */
        .sidebar {
            min-height: 100vh;
            background-color: #1e2a38;
            color: #fff;
            width: 240px;
            flex-shrink: 0;
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            overflow-x: hidden;
        }
        .sidebar.collapsed {
            width: 0;
        }
        .sidebar a {
            color: #c9d3dc;
            text-decoration: none;
            display: block;
            padding: 10px 16px;
            border-radius: 6px;
            margin-bottom: 2px;
            white-space: nowrap;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #2e3f53;
            color: #fff;
        }
        .sidebar .brand {
            font-weight: 600;
            font-size: 1.1rem;
            padding: 16px;
            border-bottom: 1px solid #2e3f53;
            white-space: nowrap;
        }

        /* MAIN CONTENT */
        .main-wrapper {
            margin-left: 240px;
            transition: all 0.3s ease;
            min-height: 100vh;
            width: calc(100% - 240px);
        }
        .main-wrapper.expanded {
            margin-left: 0;
            width: 100%;
        }
        .main-content { padding: 24px; }

        /* TOPBAR */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e3e6ea;
            padding: 12px 24px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        /* BURGER BUTTON */
        .burger-btn {
            background: none;
            border: none;
            color: #1e2a38;
            font-size: 1.4rem;
            cursor: pointer;
            padding: 0 8px 0 0;
            line-height: 1;
        }
        .burger-btn:hover {
            color: #2e3f53;
        }

        /* OVERLAY untuk mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 999;
        }
        .sidebar-overlay.show {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
            }
            .sidebar.open {
                width: 240px;
            }
            .main-wrapper {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
    @yield('extra_css')
</head>
<body>

    <!-- Overlay untuk mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <div class="brand d-flex align-items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo English Club" style="width: 28px; height: 28px;">
            <span>English Club</span>
        </div>
        <div class="p-2">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <x-icon name="speedometer2" /> Dashboard
            </a>
            <a href="{{ route('inventaris.index') }}" class="{{ request()->routeIs('inventaris.*') ? 'active' : '' }}">
                <x-icon name="box-seam" /> Inventaris Barang
            </a>
            <a href="{{ route('barang-hibah.index') }}" class="{{ request()->routeIs('barang-hibah.*') ? 'active' : '' }}">
                <x-icon name="gift" /> Barang Hibah
            </a>
            <a href="{{ route('surat-masuk.index') }}" class="{{ request()->routeIs('surat-masuk.*') ? 'active' : '' }}">
                <x-icon name="envelope-arrow-down" /> Surat Masuk
            </a>
            <a href="{{ route('surat-keluar.index') }}" class="{{ request()->routeIs('surat-keluar.*') ? 'active' : '' }}">
                <x-icon name="envelope-arrow-up" /> Surat Keluar
            </a>
            <a href="{{ route('peminjaman.index') }}" class="{{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                <x-icon name="arrow-left-right" /> Peminjaman Barang
            </a>
        </div>
    </div>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper" id="mainWrapper">

        <!-- TOPBAR -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <button class="burger-btn" onclick="toggleSidebar()" title="Toggle Sidebar">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">
                    {{ auth()->user()->nama }}
                    <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : 'secondary' }}">{{ auth()->user()->role }}</span>
                </span>
                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">
                        <x-icon name="box-arrow-right" /> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="main-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainWrapper = document.getElementById('mainWrapper');
        const overlay = document.getElementById('sidebarOverlay');
        const isMobile = () => window.innerWidth <= 768;

        function toggleSidebar() {
            if (isMobile()) {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                mainWrapper.classList.toggle('expanded');
            }
        }

        window.addEventListener('resize', () => {
            if (!isMobile()) {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            }
        });
    </script>

    @yield('extra_js')
</body>
</html>