<header id="header">
    <nav class="container">
        <a href="{{ route('home') }}" class="logo">
            <i class="bi bi-tree"></i>
            Menadah Untuk Alam
        </a>
        <div class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}"><i class="bi bi-house"></i> Beranda</a></li>
            <li><a href="{{ route('kegiatan') }}"><i class="bi bi-clipboard-check"></i> Kegiatan</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle"><i class="bi bi-info-circle"></i> Tentang</a>
                <ul class="dropdown-content">
                    <li><a href="{{ route('about') }}"><i class="bi bi-people"></i> Tentang Kami</a></li>
                    <li><a href="{{ route('visimisi') }}"><i class="bi bi-eye"></i> Visi & Misi</a></li>
                    <li><a href="{{ route('kegiatan') }}"><i class="bi bi-calendar-event"></i> Kegiatan</a></li>
                    <li><a href="{{ route('fun-fact') }}"><i class="bi bi-lightbulb"></i> Fun Fact</a></li>
                </ul>
            </li>
            <li><a href="{{ route('partnership') }}"><i class="bi bi-person-up"></i> Partnership</a></li>

            @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="bi bi-person-circle"></i>
                        {{ Auth::user()->nama }}
                    </a>
                    <ul class="dropdown-content">
                        <li><a href="{{ route('profile.edit') }}">Edit Profil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li><a href="{{ route('donasi') }}"><i class="bi bi-heart"></i> Donasi</a></li>
                <li><a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
            @endauth
        </ul>
    </nav>
</header>
