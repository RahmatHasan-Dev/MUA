<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MUA Konservasi Alam Indonesia</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <!-- Header/Navbar -->
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
                <li>
                    <a href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="#tips">
                        <i class="bi bi-clipboard-check"></i>
                        Tips
                    </a>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle">
                        <i class="bi bi-info-circle"></i>
                        Tentang
                    </a>
                    <ul class="dropdown-content">
                        <li>
                            <a href="{{ route('about') }}">
                                <i class="bi bi-people"></i>
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('visimisi') }}">
                                <i class="bi bi-eye"></i>
                                Visi & Misi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kegiatan') }}">
                                <i class="bi bi-calendar-event"></i>
                                Kegiatan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fun-fact') }}">
                                <i class="bi bi-lightbulb"></i>
                                Fun Fact
                            </a>
                        </li>
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
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>🌿 Fun Facts Konservasi Alam Indonesia</h1>
            <p>
                Temukan fakta-fakta menakjubkan tentang keanekaragaman hayati
                Indonesia yang wajib kamu ketahui!
            </p>
        </div>
        <div class="scroll-indicator"></div>
    </section>
    <br />

    <!-- Main Content -->
    <main id="fanfek">
        <div class="container">
            <!-- Fun Facts Grid -->
            <div class="facts-grid">
                <div class="program-card fade-in">
                    <span class="fact-icon">🦎</span>
                    <h3>Negara Mega Biodiversitas</h3>
                    <span class="highlight-number">17%</span>
                    <p>
                        Indonesia memiliki
                        <strong>17% dari total spesies di dunia</strong> meskipun hanya
                        menempati 1,3% dari luas daratan Bumi. Kita adalah rumah bagi
                        lebih dari 300.000 spesies flora dan fauna!
                    </p>
                </div>

                <div class="program-card fade-in">
                    <span class="fact-icon">🌳</span>
                    <h3>Hutan Hujan Tertua</h3>
                    <span class="highlight-number">130 juta</span>
                    <p>
                        Hutan hujan Indonesia berusia lebih dari
                        <strong>130 juta tahun</strong>, lebih tua dari hutan Amazon!
                        Hutan ini telah menjadi rumah bagi jutaan spesies selama era
                        dinosaurus.
                    </p>
                </div>

                <div class="program-card fade-in">
                    <span class="fact-icon">🐅</span>
                    <h3>Harimau Sumatera Unik</h3>
                    <span class="highlight-number">400</span>
                    <p>
                        Tersisa hanya sekitar
                        <strong>400 ekor Harimau Sumatera</strong> di alam liar. Mereka
                        adalah subspesies harimau terkecil di dunia dan satu-satunya yang
                        masih hidup di Indonesia.
                    </p>
                </div>

                <div class="program-card fade-in">
                    <span class="fact-icon">🦢</span>
                    <h3>Burung Endemik Terbanyak</h3>
                    <span class="highlight-number">381</span>
                    <p>
                        Indonesia memiliki <strong>381 spesies burung endemik</strong>,
                        tertinggi di dunia! Dari Cenderawasih Papua hingga Jalak Bali,
                        setiap pulau memiliki keunikan tersendiri.
                    </p>
                </div>

                <div class="program-card fade-in">
                    <span class="fact-icon">🐟</span>
                    <h3>Segitiga Terumbu Karang</h3>
                    <span class="highlight-number">76%</span>
                    <p>
                        Perairan Indonesia adalah pusat
                        <strong>Coral Triangle</strong> yang memiliki 76% dari semua
                        spesies karang di dunia. Ini adalah "Amazon-nya lautan"!
                    </p>
                </div>

                <div class="program-card fade-in">
                    <span class="fact-icon">🌺</span>
                    <h3>Bunga Raksasa Rafflesia</h3>
                    <span class="highlight-number">1 meter</span>
                    <p>
                        Rafflesia arnoldii, bunga terbesar di dunia dengan diameter hingga
                        <strong>1 meter</strong>, hanya ditemukan di hutan Sumatera.
                        Sayangnya, bunga ini terancam punah karena deforestasi.
                    </p>
                </div>

                <div class="program-card fade-in">
                    <span class="fact-icon">🐒</span>
                    <h3>Orangutan Kalimantan</h3>
                    <span class="highlight-number">104.000</span>
                    <p>
                        Populasi orangutan Kalimantan tersisa sekitar
                        <strong>104.000 individu</strong>. Mereka adalah satu-satunya kera
                        besar di Asia dan berbagi 97% DNA dengan manusia!
                    </p>
                </div>

                <div class="program-card fade-in">
                    <span class="fact-icon">🐢</span>
                    <h3>Penyu Purba</h3>
                    <span class="highlight-number">110 juta</span>
                    <p>
                        Penyu telah hidup di bumi selama <strong>110 juta tahun</strong>.
                        Indonesia adalah rumah bagi 6 dari 7 spesies penyu dunia, termasuk
                        penyu belimbing yang bisa mencapai berat 700 kg!
                    </p>
                </div>

                <div class="program-card fade-in">
                    <span class="fact-icon">🦋</span>
                    <h3>Surga Kupu-kupu</h3>
                    <span class="highlight-number">2.500</span>
                    <p>
                        Indonesia memiliki lebih dari
                        <strong>2.500 spesies kupu-kupu</strong>, termasuk yang terbesar
                        di dunia yaitu Kupu-kupu Sayap Burung dari Papua dengan lebar
                        sayap 28 cm!
                    </p>
                </div>
            </div>

            <!-- Conservation Tips -->
            <div class="interactive-section" id="tips">
                <h2 style="text-align: center;">💡 Tips Konservasi Sederhana</h2><br>
                <div class="facts-grid">
                    <div class="program-card fade-in">
                        <span class="fact-icon">♻️</span>
                        <h3>Kurangi, Gunakan Kembali, Daur Ulang</h3>
                        <p>
                            Terapkan prinsip 3R dalam kehidupan sehari-hari. Mulai dari
                            mengurangi penggunaan plastik sekali pakai hingga mendaur ulang
                            sampah organik menjadi kompos.
                        </p>
                    </div>
                    <div class="program-card fade-in">
                        <span class="fact-icon">🌱</span>
                        <h3>Tanam Pohon Lokal</h3>
                        <p>
                            Pilih tanaman asli Indonesia untuk taman rumahmu. Pohon lokal
                            lebih mudah tumbuh dan menyediakan habitat untuk fauna lokal.
                        </p>
                    </div>
                    <div class="program-card fade-in">
                        <span class="fact-icon">💧</span>
                        <h3>Hemat Air</h3>
                        <p>
                            Indonesia kaya akan air, tapi tetap harus dihemat! Matikan keran
                            saat menyikat gigi dan perbaiki kebocoran sekecil apapun.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

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
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
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

                // On mobile, toggle the dropdown
                if (window.innerWidth <= 768) {
                    dropdown.classList.toggle("active");

                    // Close other dropdowns
                    dropdowns.forEach((otherDropdown) => {
                        if (otherDropdown !== dropdown) {
                            otherDropdown.classList.remove("active");
                        }
                    });
                }
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
                }
            });
        }, observerOptions);

        document.querySelectorAll(".fade-in").forEach((el) => {
            observer.observe(el);
        });

        // Tambahkan efek fade in ke elemen yang diinginkan
        document.querySelectorAll(".fade-in").forEach((element) => {
            observer.observe(element);
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
