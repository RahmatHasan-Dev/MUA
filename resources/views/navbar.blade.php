@include('partials.navbar')

<style>
    :root {
        /* Palette adapted from Footer (Dark Green Glowing Theme) */
        --primary-color: #10b981;
        --primary-dark: #059669;
        --nav-bg: rgba(15, 41, 30, 0.85);
        /* Dark green transparent */
        --nav-scrolled-bg: rgba(5, 17, 13, 0.95);
        /* Darker on scroll */
        --nav-backdrop: blur(15px);
        --text-color: #d1fae5;
        /* Light green text */
        --text-hover: #ffffff;
        --glow-color: rgba(16, 185, 129, 0.6);
        --shadow-soft: 0 4px 30px rgba(0, 0, 0, 0.1);
    }

    /* Navbar Container */
    #header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background: var(--nav-bg);
        backdrop-filter: var(--nav-backdrop);
        -webkit-backdrop-filter: var(--nav-backdrop);
        border-bottom: 1px solid rgba(16, 185, 129, 0.1);
        box-shadow: var(--shadow-soft);
        transition: all 0.4s ease;
    }

    #header.scrolled {
        background: var(--nav-scrolled-bg);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        border-bottom: 1px solid rgba(16, 185, 129, 0.2);
    }

    /* Glowing Bottom Line */
    #header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.5), transparent);
        opacity: 0.5;
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Logo */
    .logo {
        font-size: 1.6rem;
        font-weight: 800;
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        transition: transform 0.3s ease;
        letter-spacing: -0.5px;
        text-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
    }

    .logo i {
        font-size: 1.8rem;
        color: var(--primary-color);
        filter: drop-shadow(0 0 8px var(--glow-color));
    }

    .logo:hover {
        transform: translateY(-1px);
    }

    /* Nav Links */
    .nav-links {
        display: flex;
        gap: 2.5rem;
        list-style: none;
        margin: 0;
        padding: 0;
        align-items: center;
    }

    .nav-item a {
        color: var(--text-color);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        padding: 0.5rem 0;
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-item a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 50%;
        background-color: var(--primary-color);
        transition: all 0.3s ease;
        transform: translateX(-50%);
        box-shadow: 0 0 10px var(--glow-color);
        border-radius: 2px;
    }

    .nav-item a:hover,
    .nav-item a.active {
        color: var(--text-hover);
        text-shadow: 0 0 10px rgba(16, 185, 129, 0.4);
    }

    .nav-item a:hover::after,
    .nav-item a.active::after {
        width: 100%;
    }

    /* Dropdown */
    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
    }

    .dropdown-menu {
        position: absolute;
        top: 150%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(15, 41, 30, 0.95);
        /* Dark background */
        backdrop-filter: blur(15px);
        min-width: 220px;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        padding: 0.8rem 0;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        top: 120%;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.8rem 1.5rem;
        color: var(--text-color);
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .dropdown-item i {
        color: var(--primary-color);
        font-size: 1.1rem;
        transition: 0.3s;
    }

    .dropdown-item:hover {
        background: rgba(16, 185, 129, 0.1);
        color: #fff;
        padding-left: 1.8rem;
    }

    .dropdown-item:hover i {
        text-shadow: 0 0 8px var(--primary-color);
    }

    /* Auth Buttons */
    .auth-buttons {
        display: flex;
        gap: 1rem;
    }

    .btn-login {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--text-color);
        background: transparent;
    }

    .btn-login:hover {
        border-color: var(--primary-color);
        color: #fff;
        box-shadow: 0 0 15px rgba(16, 185, 129, 0.2);
    }

    .btn-register {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        background: var(--primary-color);
        color: white;
        border: 1px solid var(--primary-color);
        box-shadow: 0 0 15px var(--glow-color);
    }

    .btn-register:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 0 25px var(--glow-color);
    }

    /* Mobile Menu */
    .menu-toggle {
        display: none;
        flex-direction: column;
        gap: 6px;
        cursor: pointer;
        z-index: 1001;
    }

    .bar {
        width: 30px;
        height: 3px;
        background-color: #fff;
        border-radius: 3px;
        transition: all 0.3s ease;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    }

    @media (max-width: 992px) {
        .menu-toggle {
            display: flex;
        }

        .nav-links {
            position: fixed;
            top: 0;
            right: -100%;
            /* Slide from right */
            width: 80%;
            max-width: 300px;
            height: 100vh;
            background: rgba(5, 17, 13, 0.98);
            /* Very dark green */
            flex-direction: column;
            padding: 6rem 2rem 2rem;
            gap: 1.5rem;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.5);
            transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            align-items: flex-start;
            border-left: 1px solid rgba(16, 185, 129, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-links.active {
            right: 0;
        }

        /* Overlay for mobile menu */
        .nav-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(3px);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s;
        }

        .nav-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .dropdown-menu {
            position: static;
            transform: none;
            box-shadow: none;
            border: none;
            background: rgba(255, 255, 255, 0.03);
            padding-left: 1rem;
            display: none;
            opacity: 1;
            visibility: visible;
            width: 100%;
            margin-top: 10px;
            border-radius: 8px;
        }

        .dropdown.active .dropdown-menu {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-buttons {
            flex-direction: column;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-login,
        .btn-register {
            text-align: center;
            width: 100%;
        }

        .nav-item {
            width: 100%;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 10px;
        }

        .nav-item a {
            font-size: 1.1rem;
            justify-content: space-between;
        }

        .nav-item a::after {
            display: none;
        }
    }
</style>

<!-- Mobile Overlay -->
<div class="nav-overlay" id="nav-overlay"></div>

<header id="header">
    <div class="navbar-container">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">
            <i class="bi bi-tree-fill"></i>
            <span>MUA</span>
        </a>

        <!-- Mobile Toggle -->
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <!-- Navigation -->
        <ul class="nav-links">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/#program') }}">Program</a>
            </li>

            <!-- Dropdown Tentang -->
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle">
                    Tentang <i class="bi bi-chevron-down" style="font-size: 0.8em;"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('about') }}" class="dropdown-item">
                        <i class="bi bi-people"></i> Tentang Kami
                    </a>
                    <a href="{{ route('visimisi') }}" class="dropdown-item">
                        <i class="bi bi-eye"></i> Visi & Misi
                    </a>
                    <a href="{{ route('kegiatan') }}" class="dropdown-item">
                        <i class="bi bi-calendar-event"></i> Kegiatan
                    </a>
                    <a href="{{ route('funfact') }}" class="dropdown-item">
                        <i class="bi bi-lightbulb"></i> Fun Fact
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a href="{{ route('partnership') }}"
                    class="{{ request()->routeIs('partnership') ? 'active' : '' }}">Partnership</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('donasi') }}" class="{{ request()->routeIs('donasi') ? 'active' : '' }}">Donasi</a>
            </li>

            <!-- Auth Section -->
            @auth
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle" style="display: flex; align-items: center; gap: 8px;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=10b981&color=fff"
                            alt="User"
                            style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid var(--primary-color);">
                        <span>{{ Str::limit(Auth::user()->nama, 10) }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="bi bi-person-gear"></i> Edit Profil
                        </a>
                        <a href="{{ route('settings') }}" class="dropdown-item">
                            <i class="bi bi-gear"></i> Pengaturan
                        </a>
                        <div style="border-top: 1px solid #eee; margin: 5px 0;"></div>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item"
                                style="width: 100%; background: none; border: none; cursor: pointer; font-family: inherit;">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            @else
                <li class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-register">Daftar</a>
                </li>
            @endauth
        </ul>
    </div>
</header>

<script>
    // Navbar Scroll Effect
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Mobile Menu Toggle
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.querySelector('.nav-links');

    mobileMenu.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        // Animate bars
        const bars = mobileMenu.querySelectorAll('.bar');
        if (navLinks.classList.contains('active')) {
            bars[0].style.transform = 'rotate(45deg) translate(5px, 6px)';
            bars[1].style.opacity = '0';
            bars[2].style.transform = 'rotate(-45deg) translate(5px, -6px)';
        } else {
            bars[0].style.transform = 'none';
            bars[1].style.opacity = '1';
            bars[2].style.transform = 'none';
        }
    });

    // Mobile Dropdown Toggle
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', (e) => {
            if (window.innerWidth <= 992) {
                // e.preventDefault(); // Optional: prevent link navigation if clicking the text
                dropdown.classList.toggle('active');
            }
        });
    });
</script>
@include('partials.navbar')
