<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | MUA - Konservasi Alam Indonesia</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" />
    <style>
        /* Reset & Base */
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

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

        /* Hero Section */
        .hero {
            background-image: url('https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?q=80&w=2074&auto=format&fit=crop');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 70vh;
            display: flex;
            margin-top: 70px;
            align-items: center;
            justify-content: center;
            position: relative;
            color: white;
            text-align: center;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.4);
            border-radius: 15px;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 35px;
            background-color: #2d6a4f;
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #1b4332;
            transform: translateY(-2px);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0) translateX(-50%);
            }

            40% {
                transform: translateY(-10px) translateX(-50%);
            }

            60% {
                transform: translateY(-5px) translateX(-50%);
            }
        }

        /* About Section */
        #about {
            padding: 80px 0;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 0 20px;
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
            text-align: justify;
            margin-bottom: 30px;
        }

        .about_us_gallery {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin: 50px 0;
        }

        .about_us_picturebox_1 {
            text-align: center;
            max-width: 300px;
        }

        .hewankami {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #d8f3dc;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .hewankami2 {
            width: 100%;
            height: auto;
            max-height: 350px;
            object-fit: cover;
            border-radius: 15px;
            border: 5px solid #d8f3dc;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .hewankami:hover {
            transform: scale(1.05) rotate(3deg);
            border-color: #2d6a4f;
        }

        .about_us_picturebox_description {
            margin-top: 15px;
            color: #2d6a4f;
            font-weight: 600;
            font-size: 1.2rem;
        }

        /* Footer Styles */
        footer {
            background: #fff;
            padding: 50px 0 20px;
            border-top: 1px solid #eee;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-col h4 {
            color: #2d6a4f;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: #666;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-col ul li a:hover {
            color: #2d6a4f;
            padding-left: 5px;
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #888;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .about_us_gallery {
                flex-direction: column;
                align-items: center;
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
                <li><a href="{{ url('/#home') }}"><i class="bi bi-house"></i> Beranda</a></li>
                <li><a href="{{ url('/#program') }}"><i class="bi bi-clipboard-check"></i> Program</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="bi bi-info-circle"></i> Tentang
                        <i class="bi bi-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i>
                    </a>
                    <ul class="dropdown-content">
                        <li><a href="{{ route('about') }}"><i class="bi bi-people"></i> Tentang Kami</a></li>
                        <li><a href="{{ route('visimisi') }}"><i class="bi bi-eye"></i> Visi & Misi</a></li>
                        <li><a href="{{ route('kegiatan') }}"><i class="bi bi-calendar-event"></i> Kegiatan</a></li>
                        <li><a href="{{ route('fun-fact') }}"><i class="bi bi-lightbulb"></i> Fun Fact</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('partnership') }}"><i class="bi bi-person-up"></i> Partnership</a></li>
                <li><a href="{{ route('donasi') }}"><i class="bi bi-heart"></i> Donasi</a></li>
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->nama }}
                            <i class="bi bi-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i>
                        </a>
                        <ul class="dropdown-content">
                            <li><a href="{{ route('profile.edit') }}"><i class="bi bi-pencil-square"></i> Edit Profil</a>
                            </li>
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
            <h1>Latar Belakang Kami!</h1>
            <p>
                Kancil punya cerita pas dia ngakalin harimau. Kami juga punya cerita kami sendiri dengan satwa-satwa
                liar-bahkan harimau! Kami nyelamatin mereka kok, nggak ngakalin 😊
            </p>
            <a href="#about" class="btn">
                <i class="bi bi-arrow-down-circle"></i>
                Aku mau baca!
            </a>
        </div>
        <div class="scroll-indicator">
            <i class="bi bi-chevron-double-down" style="font-size: 2rem; color: white;"></i>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <br><br>
            <h1 style="text-align: center; color: #1b4332; font-weight: 700;">Tentang Kami</h1>
            <br>

            <p class="about-text">Melihat kebakaran hutan di Kalimantan pada tahun 2015(?), mata hati kami tergerak
                untuk mengulurkan tangan dan menyelamatkan satwa-satwa malang yang terdampak akibat kehilangan
                habitatnya</p>

            <br>
            <p class="about-text">Kami awalnya hanya dapat menyelamatkan dua satwa; seekor kucing hutan bernama Manis,
                dan seekor orang utan bernama Rembo.</p>
            <br>
            <div class="about_us_gallery">
                <div class="about_us_picturebox_1">
                    <img class="hewankami" src="{{ asset('rembo.webp') }}" alt="Rembo">
                    <p class="about_us_picturebox_description"><i>Rembo</i></p>
                </div>
                <div class="about_us_picturebox_1">
                    <img class="hewankami" src="{{ asset('bakekok.jpeg') }}" alt="Manis">
                    <p class="about_us_picturebox_description"><i>Manis</i></p>
                </div>
            </div>

            <br>
            <p class="about-text">Saat itu, kami rasa tugas kami sudah selesai. Tepat pada saat kami ingin menarik
                tangan kami, tibalah segelintir bantuan yang ingin bekerjasama dengan kami untuk menyelamatkan dan
                mengevakuasi penghuni hutan lainnya. Iktikad baik tersebut pun kami terima.</p>

            <br>
            <p class="about-text">Alhasil, kami pun dapat mendirikan pusat konservasi alam kami. Tempat yang dulu hanya
                dapat menampung Manis dan Rembo kini telah menjadi are seluas 50 hektar persegi yang dihuni oleh
                teman-teman mereka. Kami berjanji untuk menjaga satwa-satwa yang berada di konservasi kami dari
                kepunahan, agar keberadaan mereka tidak hanya menjadi kisah bagi anak dan cucu kami.</p>

            <div class="about_us_gallery">
                <div class="about_us_picturebox_1" style="max-width: 800px; width: 100%;">
                    <img class="hewankami2" src="{{ asset('manuk.webp') }}" alt="Burung">
                    <p class="about_us_picturebox_description"><i>Selamatkan burung! Jangan potong hutan kamu!</i></p>
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
        // Header scroll effect
        window.addEventListener("scroll", () => {
            const header = document.getElementById("header");
            if (window.scrollY > 100) {
                header.style.background = "rgba(255, 255, 255, 0.98)";
                header.style.boxShadow = "0 5px 20px rgba(0,0,0,0.1)";
            } else {
                header.style.background = "rgba(255, 255, 255, 0.95)";
                header.style.boxShadow = "0 10px 25px rgba(0, 0, 0, 0.1)";
            }
        });

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

                // Toggle dropdown
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
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
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
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            });
        }, observerOptions);

        document.querySelectorAll(".fade-in").forEach((el) => {
            el.style.opacity = "0";
            el.style.transform = "translateY(20px)";
            el.style.transition = "opacity 0.6s ease-out, transform 0.6s ease-out";
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
