<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin | MUA')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar styles adjustment */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .card-ecommerce {
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .card-ecommerce:hover {
            transform: translateY(-5px);
        }
    </style>
    @yield('styles')
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="{{ route('admin.dashboard') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
                    </a>
                    {{-- Link Beranda DIHAPUS sesuai permintaan --}}

                    <a href="{{ route('admin.pemasukan') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.pemasukan') ? 'active' : '' }}">
                        <i class="fas fa-money-bill-wave fa-fw me-3"></i><span>Laporan Pemasukan</span>
                    </a>
                    <a href="{{ route('admin.pengeluaran') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.pengeluaran') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice-dollar fa-fw me-3"></i><span>Laporan Pengeluaran</span>
                    </a>
                    <a href="{{ route('admin.users') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="fas fa-users fa-fw me-3"></i><span>Kelola Users</span>
                    </a>
                    <a href="{{ route('admin.partnerships.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.partnerships.*') ? 'active' : '' }}">
                        <i class="fas fa-handshake fa-fw me-3"></i><span>Partnership</span>
                    </a>
                    <a href="{{ route('admin.bukti') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.bukti') ? 'active' : '' }}">
                        <i class="fas fa-images fa-fw me-3"></i><span>Bukti Transfer</span>
                    </a>
                    <a href="{{ route('admin.tools') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.tools') ? 'active' : '' }}">
                        <i class="fas fa-tools fa-fw me-3"></i><span>Tools</span>
                    </a>
                    <a href="{{ route('admin.export') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.export') ? 'active' : '' }}">
                        <i class="fas fa-file-export fa-fw me-3"></i><span>Export Data</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#">
                    <i class="fas fa-tree text-success fa-lg me-2"></i>
                    <span class="fw-bold text-success">MUA Admin</span>
                </a>
            </div>
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!-- Main layout -->
    <main style="margin-top: 58px;">
        @yield('content')
    </main>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    @yield('scripts')
</body>

</html>
