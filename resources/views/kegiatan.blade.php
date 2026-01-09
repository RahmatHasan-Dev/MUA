<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUA - Konservasi Alam Indonesia</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <li><a href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        Beranda
                    </a></li>
                <li><a href="{{ route('kegiatan') }}">
                        <i class="bi bi-clipboard-check"></i>
                        Kegiatan
                    </a></li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle">
                        <i class="bi bi-info-circle"></i>
                        Tentang
                    </a>
                    <ul class="dropdown-content">
                        <li><a href="{{ route('about') }}">
                                <i class="bi bi-people"></i>
                                Tentang Kami
                            </a></li>
                        <li><a href="{{ route('visimisi') }}">
                                <i class="bi bi-eye"></i>
                                Visi & Misi
                            </a></li>
                        <li><a href="{{ route('kegiatan') }}">
                                <i class="bi bi-calendar-event"></i>
                                Kegiatan
                            </a></li>
                        <li><a href="{{ route('fun-fact') }}">
                                <i class="bi bi-lightbulb"></i>
                                Fun Fact
                            </a></li>
                    </ul>
                </li>
                <li><a href="{{ route('partnership') }}">
                        <i class="bi bi-person-up"></i>
                        Partnership
                    </a></li>
                <li><a href="{{ route('donasi') }}">
                        <i class="bi bi-heart"></i>
                        Donasi
                    </a></li>
            </ul>
        </nav>
    </header>

    <!-- Kegiatan Section -->
    <section class="kegiatan">
        <div class="container">
            <h2 class="section-title fade-in" id="kegiatan">Kegiatan Kami</h2>

            <div class="activity-grid">
                <div class="activity-card fade-in">
                    <div class="activity-image">
                        <img src="https://jatengprov.go.id/wp-content/uploads/2021/09/IMG-20210923-WA0053.jpg"
                            alt="">
                    </div>
                    <div class="activity-content">
                        <div class="activity-date">15 Mar 2024</div>
                        <h3 class="activity-title">Penanaman Pohon Mangrove</h3>
                        <p class="activity-description">Kegiatan penanaman 100 bibit mangrove di kawasan pesisir untuk
                            menjaga ekosistem laut dan mencegah abrasi pantai.</p>
                        <div class="activity-meta">
                            <div class="activity-location">
                                <span>Pantai Trisik</span>
                            </div>
                            <div class="activity-participants">
                                <span>65 Peserta</span>
                            </div>
                        </div>
                        <div class="activity-tags">
                            <span class="activity-tag">Konservasi</span>
                            <span class="activity-tag">Mangrove</span>
                            <span class="activity-tag">Komunitas</span>
                        </div>
                    </div>
                </div>

                <div class="activity-card fade-in">
                    <div class="activity-image">
                        <img src="https://media.suara.com/pictures/653x366/2023/03/21/59690-ecoprint.jpg"
                            alt="">
                    </div>
                    <div class="activity-content">
                        <div class="activity-date">08 Mar 2025</div>
                        <h3 class="activity-title">Workshop Eco-Printing</h3>
                        <p class="activity-description">Pelatihan pembuatan kain ramah lingkungan menggunakan pewarna
                            alami dari daun dan bunga untuk pemberdayaan masyarakat.</p>
                        <div class="activity-meta">
                            <div class="activity-location">
                                <span>Yogyakarta</span>
                            </div>
                            <div class="activity-participants">
                                <span>25 Peserta</span>
                            </div>
                        </div>
                        <div class="activity-tags">
                            <span class="activity-tag">Workshop</span>
                            <span class="activity-tag">Eco</span>
                            <span class="activity-tag">Pemberdayaan</span>
                        </div>
                    </div>
                </div>

                <div class="activity-card fade-in">
                    <div class="activity-image">
                        <img src="https://img.antarafoto.com/cache/1200x799/2022/08/17/sosialisasi-dan-edukasi-kesehatan-di-lingkungan-sekolah-11lc9-dom.webp"
                            alt="">
                    </div>
                    <div class="activity-content">
                        <div class="activity-date">22 Feb 2025</div>
                        <h3 class="activity-title">Edukasi Lingkungan di Sekolah</h3>
                        <p class="activity-description">Program edukasi tentang pentingnya menjaga lingkungan dan
                            keanekaragaman hayati untuk siswa-siswi sekolah dasar.</p>
                        <div class="activity-meta">
                            <div class="activity-location">
                                <span>SDN 1 Bantul</span>
                            </div>
                            <div class="activity-participants">
                                <span>40 Siswa</span>
                            </div>
                        </div>
                        <div class="activity-tags">
                            <span class="activity-tag">Edukasi</span>
                            <span class="activity-tag">Sekolah</span>
                            <span class="activity-tag">Anak-anak</span>
                        </div>
                    </div>
                </div>

                <div class="activity-card fade-in">
                    <div class="activity-image">
                        <img src="https://cilacapkab.go.id/v3/wp-content/uploads/2021/10/IMG_6038-scaled.jpg"
                            alt="">
                    </div>
                    <div class="activity-content">
                        <div class="activity-date">28 Des 2024</div>
                        <h3 class="activity-title">Bersih Pantai Bersama</h3>
                        <p class="activity-description">Aksi bersih pantai untuk mengurangi sampah plastik dan menjaga
                            ekosistem laut bersama relawan dan masyarakat lokal.</p>
                        <div class="activity-meta">
                            <div class="activity-location">
                                <span>Pantai Baru</span>
                            </div>
                            <div class="activity-participants">
                                <span>50 Relawan</span>
                            </div>
                        </div>
                        <div class="activity-tags">
                            <span class="activity-tag">Bersih Pantai</span>
                            <span class="activity-tag">Sampah</span>
                            <span class="activity-tag">Relawan</span>
                        </div>
                    </div>
                </div>

                <div class="activity-card fade-in">
                    <div class="activity-image">
                        <img src="https://images-tm.tempo.co/all/2021/11/20/787806/787806_1200.jpg" alt="">
                    </div>
                    <div class="activity-content">
                        <div class="activity-date">2 Jan 2025</div>
                        <h3 class="activity-title">Monitoring Satwa Langka</h3>
                        <p class="activity-description">Kegiatan penelitian dan monitoring populasi satwa langka di
                            Taman Nasional untuk mendukung upaya konservasi.</p>
                        <div class="activity-meta">
                            <div class="activity-location">
                                <span>TN Gunung Merapi</span>
                            </div>
                            <div class="activity-participants">
                                <span>15 Peneliti</span>
                            </div>
                        </div>
                        <div class="activity-tags">
                            <span class="activity-tag">Penelitian</span>
                            <span class="activity-tag">Satwa</span>
                            <span class="activity-tag">Monitoring</span>
                        </div>
                    </div>
                </div>

                <div class="activity-card fade-in">
                    <div class="activity-image">
                        <img src="https://www.arutmin.com/uploads/2021/04/2936dc6fe8123dd4734277246e47efad_6cca4345ca3a499e6a72485732bdccda.jpeg"
                            alt="">
                    </div>
                    <div class="activity-content">
                        <div class="activity-date">5 April 2024</div>
                        <h3 class="activity-title">Pelatihan Budidaya Organik</h3>
                        <p class="activity-description">Workshop budidaya tanaman organik untuk petani lokal guna
                            meningkatkan hasil panen yang ramah lingkungan.</p>
                        <div class="activity-meta">
                            <div class="activity-location">
                                <span>Desa Bunder Kulon</span>
                            </div>
                            <div class="activity-participants">
                                <span>20 Petani</span>
                            </div>
                        </div>
                        <div class="activity-tags">
                            <span class="activity-tag">Pertanian</span>
                            <span class="activity-tag">Organik</span>
                            <span class="activity-tag">Pelatihan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photo Gallery -->
            <div class="photo-gallery" id="doksli">
                <h3 class="gallery-title fade-in">Galeri Foto Kegiatan</h3>
                <div class="photo-grid">
                    <div class="photo-item fade-in">
                        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiMMuzpkaDmwjyo6gLayLBdzUSI2l9wMNe2Ao2a6FseQdLJfHdzq8485BjNo9Slam6aRZ_h9P-I85ZasHKwLpeqGOVSUa0ZOjNnCFcULKBRdTVRfWIWGJqTUk75iHFolthmwvqK2CGtoR8k/s1280/WhatsApp+Image+2021-07-22+at+10.32.58.jpeg"
                            alt="">
                        <div class="photo-overlay">
                        </div>
                    </div>
                    <div class="photo-item fade-in">
                        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhXUtO5Jz0GzG9n1qSj9_HGMnwJgGT2fsPcYimMDTV_ldiNSG1xOZGqEgGuuTuJp3pV-MKH8IJ1rg-gkBUdjupHdjd2UAizAwmQHSIO4IyWX1Z7qr_naYNtBoyxcjWLObFpzjNJpHGkgM4/s2048/1.+IMG_20210326_081835-min.jpg"
                            alt="">
                        <div class="photo-overlay">
                        </div>
                    </div>
                    <div class="photo-item fade-in">
                        <img src="https://nagasepaha-buleleng.desa.id/assets/files/artikel/sedang_1543808684IMG-20181202-WA0009.jpg"
                            alt="">
                        <div class="photo-overlay">
                        </div>
                    </div>
                    <div class="photo-item fade-in">
                        <img src="https://dlh.lumajangkab.go.id/uploads/berita/WhatsApp_Image_2025-03-18_at_08_15_01.jpeg"
                            alt="">
                        <div class="photo-overlay">
                        </div>
                    </div>
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
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');

        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            navLinks.classList.toggle('active');
        });

        // Dropdown functionality
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.dropdown-toggle');

            toggle.addEventListener('click', function(e) {
                e.preventDefault();

                // On mobile, toggle the dropdown
                if (window.innerWidth <= 768) {
                    dropdown.classList.toggle('active');

                    // Close other dropdowns
                    dropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            otherDropdown.classList.remove('active');
                        }
                    });
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        });

        // Close mobile menu when clicking on a link
        navLinks.addEventListener('click', (e) => {
            if (e.target.tagName === 'A' && !e.target.classList.contains('dropdown-toggle')) {
                menuToggle.classList.remove('active');
                navLinks.classList.remove('active');
                // Close all dropdowns
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Active navigation link
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-links a');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>
