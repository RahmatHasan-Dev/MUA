<header>
    <style>
        /* Override Bootstrap active state untuk Sidebar agar Hijau */
        #sidebarMenu .list-group-item.active {
            background-color: #10b981;
            /* Warna Hijau MUA */
            border-color: #10b981;
            color: white;
        }
    </style>

    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- 1. Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
                </a>

                <!-- 2. Beranda -->
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-home fa-fw me-3"></i><span>Beranda</span>
                </a>

                <!-- 3. Laporan Pemasukan -->
                <a href="{{ route('admin.pemasukan') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.pemasukan') ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-usd fa-fw me-3"></i><span>Pemasukan</span>
                </a>

                <!-- 4. Tarik Dana -->
                <a href="{{ route('admin.withdrawal') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.withdrawal') ? 'active' : '' }}">
                    <i class="fas fa-money-bill-wave fa-fw me-3"></i><span>Tarik Dana</span>
                </a>

                <!-- 5. Laporan Pengeluaran -->
                <a href="{{ route('admin.pengeluaran') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.pengeluaran') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar fa-fw me-3"></i><span>Pengeluaran</span>
                </a>

                <!-- 6. Kelola Users -->
                <a href="{{ route('admin.users') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fas fa-users fa-fw me-3"></i><span>Kelola Users</span>
                </a>

                <!-- 6. Kelola Campaign -->
                <a href="{{ route('admin.campaign') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.campaign') ? 'active' : '' }}">
                    <i class="fas fa-map-location fa-fw me-3"></i><span>Kelola Campaign</span>
                </a>

                <!-- 6. Kelola Berita -->
                <a href="{{ route('admin.berita') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.berita') ? 'active' : '' }}">
                    <i class="fas fa-solid fa-newspaper fa-fw me-3"></i><span>Kelola Berita</span>
                </a>

                <!-- Kelola Partnership -->
                <a href="{{ route('admin.partnerships.index') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.partnerships.*') ? 'active' : '' }}">
                    <i class="fas fa-handshake fa-fw me-3"></i><span>Kelola Partnership</span>
                </a>

                <!-- Kelola Visi Misi -->
                <a href="{{ route('admin.visimisi.index') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.visimisi.*') ? 'active' : '' }}">
                    <i class="fas fa-eye fa-fw me-3"></i><span>Kelola Visi Misi</span>
                </a>

                <!-- 6. Kelola Berita -->
                <a href="{{ route('admin.funfact') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.funfact') ? 'active' : '' }}">
                    <i class="fas fa-solid fa-newspaper fa-fw me-3"></i><span>Kelola Fun Fact</span>
                </a>

                <!-- 7. Bukti Transfer -->
                <a href="{{ route('admin.bukti') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.bukti') ? 'active' : '' }}">
                    <i class="fas fa-receipt fa-fw me-3"></i><span>Bukti Transfer</span>
                </a>

                <!-- 8. Tools -->
                <a href="{{ route('admin.tools') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.tools') ? 'active' : '' }}">
                    <i class="fas fa-tools fa-fw me-3"></i><span>Tools</span>
                </a>

                <!-- 9. Export Data -->
                <a href="{{ route('admin.export.view') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.export.view') ? 'active' : '' }}">
                    <i class="fas fa-file-export fa-fw me-3"></i><span>Export Data</span>
                </a>

                <!-- 10. Logout -->
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="list-group-item list-group-item-action py-2 ripple text-danger"
                        style="border: none; background: none; width: 100%; text-align: left;">
                        <i class="fas fa-sign-out-alt fa-fw me-3"></i><span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <i class="fas fa-tree text-success fa-lg me-2"></i>
                <span class="fw-bold text-success">MUA Admin</span>
            </a>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <!-- Notification Bell -->
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="{{ route('admin.pemasukan') }}">
                        <i class="fas fa-bell"></i>
                        @php
                            $pendingCount = isset($donasiPending)
                                ? $donasiPending
                                : \App\Models\Donasi::where('status', 'pending')->count();
                        @endphp
                        @if ($pendingCount > 0)
                            <span class="badge rounded-pill badge-notification bg-danger">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>

                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                        id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=10b981&color=fff"
                            class="rounded-circle" height="25" alt="Avatar" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">My profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navbar -->
</header>
