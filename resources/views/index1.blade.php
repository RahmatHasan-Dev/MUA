<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | MUA - Menadah Untuk Alam</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" />
    <style>
        /* --- Base & Variables --- */
        :root {
            --primary-green: #10b981;
            --dark-green: #065f46;
            --light-green: #d1fae5;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --white: #ffffff;
            --background: #f9fafb;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* --- Hero Section --- */
        .hero-section {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            top: -5%;
            left: -5%;
            width: 110%;
            height: 110%;
            background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2232&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            z-index: 1;
            transition: transform 0.2s ease-out;
            animation: slow-zoom 40s infinite alternate;
        }

        @keyframes slow-zoom {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(6, 95, 70, 0.7));
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            max-width: 800px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            animation: float-up 6s ease-in-out infinite;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
            font-weight: 800;
        }

        .hero-content p {
            font-size: 1.25rem;
            margin-bottom: 30px;
            line-height: 1.7;
            opacity: 0.9;
        }

        .btn-cta {
            padding: 15px 40px;
            background: var(--primary-green);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            transition: var(--transition);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-cta:hover {
            background: var(--dark-green);
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.5);
        }

        @keyframes float-up {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* --- Content Sections --- */
        .content-section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.8rem;
            color: var(--dark-green);
            margin-bottom: 60px;
            font-weight: 800;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--primary-green);
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* Stats Section */
        .stats-section {
            margin-top: -120px;
            position: relative;
            z-index: 10;
            padding-bottom: 80px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
        }

        .stat-card i {
            font-size: 3rem;
            color: var(--primary-green);
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-green);
            margin: 10px 0;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Program Section */
        .program-section {
            background: linear-gradient(to bottom, var(--background), var(--light-green));
        }

        .program-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .program-card {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            transition: var(--transition);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            border: 1px solid #eee;
        }

        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
        }

        .program-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--primary-green);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .program-card:hover::before {
            transform: scaleX(1);
        }

        .program-card i {
            font-size: 2rem;
            color: var(--primary-green);
            margin-bottom: 15px;
        }

        .program-card h3 {
            color: var(--dark-green);
            margin-top: 0;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .program-card p {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* --- Animations & Responsive --- */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 2.8rem;
            }
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .stats-section {
                margin-top: -100px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background" id="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Menadah Untuk Alam</h1>
            <p>
                Bersama kita jaga kelestarian alam Indonesia. Setiap kontribusi Anda adalah nafas baru bagi hutan dan
                satwa kita.
            </p>
            <a href="{{ route('donasi') }}" class="btn-cta">
                <i class="bi bi-heart-fill"></i> Mulai Donasi
            </a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card fade-in">
                    <i class="bi bi-cash-stack"></i>
                    <div class="stat-number">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</div>
                    <div class="stat-label">Donasi Terkumpul</div>
                </div>
                <div class="stat-card fade-in" style="transition-delay: 0.1s;">
                    <i class="bi bi-receipt"></i>
                    <div class="stat-number">{{ number_format($jumlahTransaksi) }}</div>
                    <div class="stat-label">Transaksi Kebaikan</div>
                </div>
                <div class="stat-card fade-in" style="transition-delay: 0.2s;">
                    <i class="bi bi-people-fill"></i>
                    <div class="stat-number">{{ number_format($jumlahUser) }}</div>
                    <div class="stat-label">Pahlawan Alam</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Section -->
    <section class="program-section content-section">
        <div class="container">
            <h2 class="section-title">Program Utama Kami</h2>
            <div class="program-grid">
                <div class="program-card fade-in">
                    <i class="bi bi-tree"></i>
                    <h3>Konservasi Hutan</h3>
                    <p>Program perlindungan dan restorasi ekosistem hutan untuk menjaga keseimbangan alam dan mencegah
                        deforestasi.</p>
                </div>
                <div class="program-card fade-in" style="transition-delay: 0.1s;">
                    <i class="bi bi-shield-shaded"></i>
                    <h3>Perlindungan Satwa</h3>
                    <p>Menyelamatkan, merehabilitasi, dan melindungi satwa liar terancam dari perburuan dan kehilangan
                        habitat.</p>
                </div>
                <div class="program-card fade-in" style="transition-delay: 0.2s;">
                    <i class="bi bi-book"></i>
                    <h3>Pendidikan Lingkungan</h3>
                    <p>Edukasi untuk generasi muda tentang pentingnya pelestarian alam dan keanekaragaman hayati
                        Indonesia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const heroBg = document.getElementById('hero-bg');

            // 3. Elegant Parallax on Mouse Move (for desktop)
            if (window.innerWidth > 1024) {
                document.addEventListener('mousemove', (e) => {
                    const x = (window.innerWidth - e.pageX * 2) / 100;
                    const y = (window.innerHeight - e.pageY * 2) / 100;
                    heroBg.style.transform = `translateX(${x}px) translateY(${y}px)`;
                });
            }

            // 4. Fade-in animation on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px",
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-in').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>
