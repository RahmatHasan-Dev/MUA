<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
            <a href="{{ route('admin.dashboard') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('admin.pemasukan') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.pemasukan') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave fa-fw me-3"></i><span>Pemasukan</span>
            </a>
            <a href="{{ route('admin.withdrawal') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.withdrawal') ? 'active' : '' }}">
                <i class="fas fa-hand-holding-usd fa-fw me-3"></i><span>Tarik Dana</span>
            </a>
            <a href="{{ route('admin.pengeluaran') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.pengeluaran') ? 'active' : '' }}">
                <i class="fas fa-file-invoice-dollar fa-fw me-3"></i><span>Pengeluaran</span>
            </a>
            <a href="{{ route('admin.users') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="fas fa-users fa-fw me-3"></i><span>Kelola Users</span>
            </a>
            <a href="{{ route('admin.campaign') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.campaign') ? 'active' : '' }}">
                <i class="fas fa-map-marked-alt fa-fw me-3"></i><span>Kelola Campaign</span>
            </a>
            <a href="{{ route('admin.berita') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.berita') ? 'active' : '' }}">
                <i class="fas fa-newspaper fa-fw me-3"></i><span>Kelola Berita</span>
            </a>
            <a href="{{ route('admin.partnerships.index') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.partnerships.*') ? 'active' : '' }}">
                <i class="fas fa-handshake fa-fw me-3"></i><span>Kelola Partnership</span>
            </a>
            <a href="{{ route('admin.visimisi.index') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.visimisi.*') ? 'active' : '' }}">
                <i class="fas fa-bullseye fa-fw me-3"></i><span>Kelola Visi Misi</span>
            </a>
            <a href="{{ route('admin.funfact') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.funfact') ? 'active' : '' }}">
                <i class="fas fa-lightbulb fa-fw me-3"></i><span>Kelola Fun Fact</span>
            </a>
            <a href="{{ route('admin.laporan.index') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}">
                <i class="fas fa-comments fa-fw me-3"></i><span>Laporan Komentar</span>
            </a>
            <a href="{{ route('admin.bukti') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.bukti') ? 'active' : '' }}">
                <i class="fas fa-receipt fa-fw me-3"></i><span>Bukti Transfer</span>
            </a>
            <a href="{{ route('admin.tools') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.tools') ? 'active' : '' }}">
                <i class="fas fa-tools fa-fw me-3"></i><span>Tools</span>
            </a>
            <a href="{{ route('admin.export.view') }}"
                class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.export.view') ? 'active' : '' }}">
                <i class="fas fa-file-export fa-fw me-3"></i><span>Export Data</span>
            </a>
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
