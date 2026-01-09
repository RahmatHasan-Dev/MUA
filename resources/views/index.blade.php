<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MUA - Konservasi Alam Indonesia</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        :root {
            --primary-green: #10b981;
            --secondary-green: #059669;
            --dark-green: #065f46;
            --light-green: #d1fae5;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --white: #ffffff;
            --background: #f9fafb;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Header Styles */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-green);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 1.5rem;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary-green);
            background: var(--light-green);
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            cursor: pointer;
        }

        .dropdown-content {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--white);
            min-width: 220px;
            box-shadow: var(--shadow);
            border-radius: var(--border-radius);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            z-index: 1000;
            border: 1px solid #e5e7eb;
            padding: 0.5rem 0;
        }

        .dropdown:hover .dropdown-content,
        .dropdown.active .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-content li {
            list-style: none;
        }

        .dropdown-content a {
            display: flex;
            padding: 0.8rem 1.2rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
            border-radius: 0;
            background: transparent;
            width: 100%;
            box-sizing: border-box;
        }

        .dropdown-content a:hover {
            background: var(--light-green);
            color: var(--primary-green);
            padding-left: 1.5rem;
        }

        /* Mobile Menu */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
            gap: 4px;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background: var(--text-dark);
            transition: var(--transition);
            border-radius: 2px;
        }

        .menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }

            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: var(--white);
                flex-direction: column;
                padding: 1rem 0;
                box-shadow: var(--shadow);
                opacity: 0;
                visibility: hidden;
                transform: translateY(-20px);
                transition: var(--transition);
            }

            .nav-links.active {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .nav-links li {
                width: 100%;
                text-align: center;
            }

            .nav-links a {
                justify-content: center;
                width: 90%;
                margin: 0 auto;
            }

            .dropdown-content {
                position: static;
                box-shadow: none;
                border: none;
                background: #f9fafb;
                display: none;
                opacity: 1;
                visibility: visible;
                transform: none;
                width: 100%;
            }

            .dropdown.active .dropdown-content {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- Header/Navbar -->
    <header id="header">
        <nav class="container">
            <a href="{{ url('/') }}" class="logo">
                <i class="bi bi-tree"></i>
                Menadah Untuk Alam
            </a>
            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links" id="navLinks">
                <li>
                    <a href="{{ url('/#home') }}">
                        <i class="bi bi-house"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ url('/#program') }}">
                        <i class="bi bi-clipboard-check"></i>
                        Program
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="bi bi-info-circle"></i>
                        Tentang
                        <i class="bi bi-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i>
                    </a>
                    <ul class="dropdown-content">
                        <li><a href="{{ route('about') }}"><i class="bi bi-people"></i> Tentang Kami</a></li>
                        <li><a href="{{ route('visimisi') }}"><i class="bi bi-eye"></i> Visi & Misi</a></li>
                        <li><a href="{{ route('kegiatan') }}"><i class="bi bi-calendar-event"></i> Kegiatan</a></li>
                        <li><a href="{{ route('fun-fact') }}"><i class="bi bi-lightbulb"></i> Fun Fact</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('partnership') }}">
                        <i class="bi bi-person-up"></i>
                        Partnership
                    </a>
                </li>
                <li>
                    <a href="{{ route('donasi') }}">
                        <i class="bi bi-heart"></i>
                        Donasi
                    </a>
                </li>
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->nama }}
                            <i class="bi bi-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i>
                        </a>
                        <ul class="dropdown-content">
                            <li><a href="{{ route('profile.edit') }}"><i class="bi bi-pencil-square"></i> Edit Profil</a>
                            </li>
                            <li><a href="#"><i class="bi bi-gear"></i> Pengaturan</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button type="submit"
                                        style="background:none; border:none; color:inherit; cursor:pointer; font:inherit; padding: 0.8rem 1.2rem; text-align: left; width: 100%; display: flex; align-items: center; gap: 0.5rem;"><i
                                            class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                    <li><a href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Selamatkan Bumi, Lestarikan Keanekaragaman Hayati</h1>
            <p>
                MUA berkomitmen untuk konservasi alam dan pemberdayaan masyarakat demi
                masa depan yang berkelanjutan.
            </p>
            <a href="#program" class="btn">
                <i class="bi bi-arrow-down-circle"></i>
                Pelajari Lebih Lanjut
            </a>
            <a href="{{ route('kegiatan') }}" class="btn btn-outline">
                <i class="bi bi-camera"></i>
                Kegiatan Kami
            </a>
        </div>
        <div class="scroll-indicator">
            <i class="bi bi-chevron-double-down"></i>
        </div>
    </section>

    <!-- Program Section -->
    <section class="section" id="program">
        <div class="container">
            <h2 class="section-title fade-in">Program Kami</h2>
            <div class="program-grid">
                <div class="program-card fade-in">
                    <i class="bi bi-tree-fill"></i>
                    <h3>Konservasi Hutan</h3>
                    <p>
                        Program perlindungan dan restorasi ekosistem hutan untuk menjaga
                        keseimbangan alam dan mencegah deforestasi.
                    </p>
                </div>
                <div class="program-card fade-in">
                    <i class="bi bi-people-fill"></i>
                    <h3>Pemberdayaan Masyarakat</h3>
                    <p>
                        Meningkatkan kapasitas masyarakat dalam pengelolaan sumber daya
                        alam berkelanjutan dan ramah lingkungan.
                    </p>
                </div>
                <div class="program-card fade-in">
                    <i class="bi bi-book-fill"></i>
                    <h3>Pendidikan Lingkungan</h3>
                    <p>
                        Edukasi komprehensif untuk generasi muda tentang pentingnya
                        pelestarian alam dan keanekaragaman hayati.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="program-card fade-in">
                    <i class="bi bi-cash-coin"></i>
                    <span class="stat-number">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</span>
                    <span class="stat-label">Total Donasi Terkumpul</span>
                </div>
                <div class="program-card fade-in">
                    <i class="bi bi-person-hearts"></i>
                    <span class="stat-number">{{ number_format($jumlahTransaksi, 0, ',', '.') }}</span>
                    <span class="stat-label">Donasi Berhasil</span>
                </div>
                <div class="program-card fade-in">
                    <i class="bi bi-clipboard-data"></i>
                    <span class="stat-number">25+</span>
                    <span class="stat-label">Program Aktif</span>
                </div>
                <div class="program-card fade-in">
                    <i class="bi bi-award"></i>
                    <span class="stat-number">10+</span>
                    <span class="stat-label">Tahun Pengalaman</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <h4>
                        <i class="bi bi-tree"></i>
                        Menadah Untuk Alam
                    </h4>
                    <p>
                        Organisasi nirlaba yang berfokus pada konservasi keanekaragaman
                        hayati dan pemberdayaan masyarakat Indonesia.
                    </p>
                </div>
                <div class="footer-col">
                    <h4>
                        <i class="bi bi-link-45deg"></i>
                        Tautan Cepat
                    </h4>
                    <ul>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="{{ route('about') }}">Tentang Kami</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="{{ route('visimisi') }}">Visi Misi</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="{{ route('kegiatan') }}">Kegiatan</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="{{ route('fun-fact') }}">Fun Fact</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>
                        <i class="bi bi-telephone"></i>
                        Kontak Kami
                    </h4>
                    <ul>
                        <li>
                            <i class="bi bi-envelope"></i>
                            novandidirobi@students.amikom.ac.id
                        </li>
                        <li>
                            <i class="bi bi-phone"></i>
                            +62 123 4567 890
                        </li>
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            Daerah Istimewa Yogyakarta, Indonesia
                        </li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 MUA. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById("menuToggle");
        const navLinks = document.getElementById("navLinks");

        menuToggle.addEventListener("click", () => {
            menuToggle.classList.toggle("active");
            navLinks.classList.toggle("active");
        });

        // Dropdown functionality
        const dropdowns = document.querySelectorAll(".dropdown");

        dropdowns.forEach((dropdown) => {
            const toggle = dropdown.querySelector(".dropdown-toggle");

            toggle.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Toggle dropdown (berlaku untuk mobile & desktop)
                dropdown.classList.toggle("active");

                // Close other dropdowns
                dropdowns.forEach((otherDropdown) => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.remove("active");
                    }
                });
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener("click", function(e) {
            if (!e.target.closest(".dropdown")) {
                dropdowns.forEach((dropdown) => {
                    dropdown.classList.remove("active");
                });
            }
        });

        // Close mobile menu when clicking on a link
        navLinks.addEventListener("click", (e) => {
            if (
                e.target.tagName === "A" &&
                !e.target.classList.contains("dropdown-toggle")
            ) {
                menuToggle.classList.remove("active");
                navLinks.classList.remove("active");
                // Close all dropdowns
                dropdowns.forEach((dropdown) => {
                    dropdown.classList.remove("active");
                });
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach((anchor) => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute("href"));
                if (target) {
                    target.scrollIntoView({
                        behavior: "smooth",
                        block: "start",
                    });
                }
            });
        });

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px",
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                }
            });
        }, observerOptions);

        document.querySelectorAll(".fade-in").forEach((el) => {
            observer.observe(el);
        });

        // Active navigation link
        window.addEventListener("scroll", () => {
            const sections = document.querySelectorAll("section[id]");
            const navLinks = document.querySelectorAll(".nav-links a");

            let current = "";
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute("id");
                }
            });

            navLinks.forEach((link) => {
                link.classList.remove("active");
                if (link.getAttribute("href") === "#" + current) {
                    link.classList.add("active");
                }
            });
        });
    </script>
</body>

</html>
