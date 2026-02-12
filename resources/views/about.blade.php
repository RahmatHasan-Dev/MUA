<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | MUA</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-green: #10b981;
            --dark-green: #064e3b;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
            --text-light: #ecfdf5;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at center, #059669 0%, #064e3b 100%);
            color: #fff;
            overflow-x: hidden;
        }

        /* --- Parallax Background Wrapper --- */
        .parallax-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
            /* Menggunakan gambar hutan yang sedikit berbeda namun senada */
            background-image: url('https://images.unsplash.com/photo-1472214103451-9374bd1c798e?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            filter: brightness(0.5) contrast(1.1);
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
            padding-top: 120px;
            padding-bottom: 80px;
            background: linear-gradient(to bottom, transparent 0%, rgba(5, 150, 105, 0.8) 30%, #065f46 100%);
        }

        /* --- Typography --- */
        .page-title {
            text-align: center;
            margin-bottom: 70px;
        }

        .page-title h1 {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(to right, #6ee7b7, #fff, #6ee7b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 30px rgba(16, 185, 129, 0.3);
            margin-bottom: 10px;
        }

        .page-title p {
            font-size: 1.1rem;
            color: #a7f3d0;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* --- Glass Cards --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 50px;
            box-shadow: var(--glass-shadow);
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease;
        }

        /* Glossy Glare Effect */
        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 100%;
            height: 100%;
            background: linear-gradient(115deg, transparent 40%, rgba(255, 255, 255, 0.2) 50%, transparent 60%);
            transform: skewX(-20deg);
            transition: 0.5s;
            pointer-events: none;
            z-index: 10;
        }

        .glass-card:hover::before {
            left: 150%;
            transition: 0.7s;
        }

        .glass-card:hover {
            border-color: rgba(16, 185, 129, 0.6);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        /* --- Content Sections --- */
        .about-intro {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .about-intro p {
            font-size: 1.2rem;
            line-height: 1.9;
            color: #d1fae5;
        }

        .highlight-text {
            color: #34d399;
            font-weight: 600;
        }

        /* --- Values Grid --- */
        .values-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }

        .value-card {
            text-align: center;
            padding: 40px 30px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.3s;
        }

        .value-card:hover {
            transform: translateY(-10px);
            background: rgba(16, 185, 129, 0.1);
            border-color: var(--primary-green);
        }

        .value-icon {
            font-size: 3rem;
            color: #6ee7b7;
            margin-bottom: 20px;
            display: inline-block;
        }

        .value-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #fff;
        }

        .value-card p {
            color: #a7f3d0;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* --- Stats Row --- */
        .stats-row {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-green);
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* --- Animations --- */
        .fade-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .glow-blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 2.5rem;
            }

            .glass-card {
                padding: 30px;
            }
        }

        /* --- New Styles for Story --- */
        .btn-glow {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(16, 185, 129, 0.6);
            color: white;
        }

        .character-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .character-card:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary-green);
        }

        .character-img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #10b981;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .slogan-box {
            background: rgba(16, 185, 129, 0.1);
            padding: 30px;
            border-radius: 15px;
            border: 1px dashed #10b981;
            margin-top: 40px;
        }

        .story-text {
            text-align: left;
            font-size: 1.1rem;
            line-height: 1.8;
            color: #e0e7ff;
            margin-bottom: 20px;
        }

        /* --- Timeline Styles --- */
        .timeline-section {
            position: relative;
            max-width: 1000px;
            margin: 80px auto;
            padding: 20px;
        }

        .timeline-section::after {
            content: '';
            position: absolute;
            width: 4px;
            background: rgba(16, 185, 129, 0.3);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
            border-radius: 2px;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
            box-sizing: border-box;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            right: -12px;
            background-color: #064e3b;
            border: 4px solid #10b981;
            top: 25px;
            border-radius: 50%;
            z-index: 1;
            box-shadow: 0 0 10px #10b981;
            transition: 0.3s;
        }

        .timeline-item:hover::after {
            background-color: #10b981;
            transform: scale(1.2);
            box-shadow: 0 0 20px #10b981;
        }

        .left {
            left: 0;
        }

        .right {
            left: 50%;
        }

        .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 28px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid rgba(255, 255, 255, 0.1);
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent rgba(255, 255, 255, 0.1);
        }

        .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 28px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid rgba(255, 255, 255, 0.1);
            border-width: 10px 10px 10px 0;
            border-color: transparent rgba(255, 255, 255, 0.1) transparent transparent;
        }

        .right::after {
            left: -12px;
        }

        .timeline-content {
            padding: 25px 30px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            border-radius: 15px;
            transition: 0.3s;
        }

        .timeline-content:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #10b981;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .timeline-year {
            font-size: 3rem;
            font-weight: 800;
            color: rgba(255, 255, 255, 0.05);
            position: absolute;
            top: 5px;
            right: 20px;
            line-height: 1;
            pointer-events: none;
        }

        .timeline-content h3 {
            margin-top: 0;
            color: #fff;
            font-size: 1.3rem;
        }

        .timeline-content p {
            margin-bottom: 0;
            color: #d1fae5;
            font-size: 0.95rem;
        }

        @media screen and (max-width: 768px) {
            .timeline-section::after {
                left: 31px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .timeline-item::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            .left::after,
            .right::after {
                left: 19px;
            }

            .right {
                left: 0%;
            }

            .left::before,
            .right::before {
                border-width: 10px 10px 10px 0;
                border-color: transparent rgba(255, 255, 255, 0.1) transparent transparent;
                left: 60px;
                right: auto;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('navbar')

    <!-- Parallax Background -->
    <div class="parallax-wrapper"></div>

    <!-- Main Content -->
    <div class="content-wrapper">

        <!-- Decorative Glows -->
        <div class="glow-blob" style="top: 0; left: -10%;"></div>
        <div class="glow-blob" style="bottom: 10%; right: -10%;"></div>

        <!-- Header -->
        <div class="container page-title fade-up">
            <p>Mengenal Lebih Dekat</p>
            <h1>Tentang Kami</h1>
        </div>

        <!-- Intro Section -->
        <div class="container about-intro fade-up">
            <div class="glass-card">
                <!-- Latar Belakang (Hook) -->
                <div style="text-align: center; margin-bottom: 50px;">
                    <h2 style="margin-bottom: 20px; color: #fff;">Latar Belakang Kami!</h2>
                    <p style="font-size: 1.2rem; margin-bottom: 30px; color: #d1fae5;">
                        "Kancil punya cerita pas dia ngakalin harimau. Kami juga punya cerita kami sendiri dengan
                        satwa-satwa liar—bahkan harimau! Kami nyelamatin mereka kok, nggak ngakalin 😊"
                    </p>
                    <a href="#cerita-kami" class="btn-glow">Aku mau baca!</a>
                </div>

                <hr style="border-color: rgba(255,255,255,0.1); margin: 40px 0;">

                <!-- Cerita Kami -->
                <div id="cerita-kami" style="scroll-margin-top: 100px;">
                    <h2 style="text-align: center; margin-bottom: 40px; color: #fff;">Tentang Kami</h2>

                    <p class="story-text">
                        Melihat kebakaran hutan di Kalimantan pada tahun 2015, mata hati kami tergerak untuk mengulurkan
                        tangan dan menyelamatkan satwa-satwa malang yang terdampak akibat kehilangan habitatnya.
                    </p>

                    <p class="story-text">
                        Kami awalnya hanya dapat menyelamatkan dua satwa; seekor kucing hutan bernama
                        <strong>Manis</strong>, dan seekor orang utan bernama <strong>Rembo</strong>.
                    </p>

                    <!-- Character Cards -->
                    <div class="row"
                        style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; margin: 40px 0;">
                        <!-- Rembo -->
                        <div class="character-card" style="flex: 1; min-width: 280px; max-width: 350px;">
                            <img src="https://images4.alphacoders.com/903/903475.jpg" alt="Rembo"
                                class="character-img">
                            <h3 style="color: #fff; margin-bottom: 5px;">Rembo</h3>
                            <p style="color: #a7f3d0;">Orang Utan yang Tangguh</p>
                        </div>
                        <!-- Manis -->
                        <div class="character-card" style="flex: 1; min-width: 280px; max-width: 350px;">
                            <img src="https://images.unsplash.com/photo-1533738363-b7f9aef128ce?q=80&w=1000&auto=format&fit=crop"
                                alt="Manis" class="character-img">
                            <h3 style="color: #fff; margin-bottom: 5px;">Manis</h3>
                            <p style="color: #a7f3d0;">Kucing Hutan yang Lincah</p>
                        </div>
                    </div>

                    <p class="story-text">
                        Saat itu, kami rasa tugas kami sudah selesai. Tepat pada saat kami ingin menarik tangan kami,
                        tibalah segelintir bantuan yang ingin bekerjasama dengan kami untuk menyelamatkan dan
                        mengevakuasi penghuni hutan lainnya. Iktikad baik tersebut pun kami terima.
                    </p>

                    <p class="story-text">
                        Alhasil, kami pun dapat mendirikan pusat konservasi alam kami. Tempat yang dulu hanya dapat
                        menampung Manis dan Rembo kini telah menjadi area seluas 50 hektar persegi yang dihuni oleh
                        teman-teman mereka. Kami berjanji untuk menjaga satwa-satwa yang berada di konservasi kami dari
                        kepunahan, agar keberadaan mereka tidak hanya menjadi kisah bagi anak dan cucu kami.
                    </p>

                    <div class="slogan-box text-center">
                        <h3 class="highlight-text" style="text-align: center; margin: 0; font-style: italic;">
                            "Selamatkan burung! Jangan potong hutan kamu!"</h3>
                    </div>

                    <!-- Timeline Section -->
                    <div class="timeline-section fade-up">
                        <h2 style="text-align: center; margin-bottom: 50px; color: #fff;">Perjalanan Kami</h2>

                        <!-- 2015 -->
                        <div class="timeline-item left">
                            <div class="timeline-content">
                                <div class="timeline-year">2015</div>
                                <h3>Awal Mula</h3>
                                <p>Kebakaran hebat melanda hutan Kalimantan. Kami turun tangan untuk pertama kalinya,
                                    menyelamatkan Manis dan Rembo dari habitat yang terbakar.</p>
                            </div>
                        </div>

                        <!-- 2018 -->
                        <div class="timeline-item right">
                            <div class="timeline-content">
                                <div class="timeline-year">2018</div>
                                <h3>Kolaborasi & Harapan</h3>
                                <p>Bantuan mulai berdatangan. Kami menjalin kerjasama dengan komunitas lokal dan relawan
                                    untuk memperluas jangkauan penyelamatan satwa.</p>
                            </div>
                        </div>

                        <!-- 2024 -->
                        <div class="timeline-item left">
                            <div class="timeline-content">
                                <div class="timeline-year">2024</div>
                                <h3>Rumah Baru</h3>
                                <p>Berdirinya Pusat Konservasi MUA seluas 50 hektar. Kini menjadi rumah aman bagi
                                    puluhan satwa liar yang telah kami rehabilitasi.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Timeline -->

                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="values-section">
            <div class="glass-card fade-up">
                <h2 style="text-align: center; margin-bottom: 10px; color: #fff;">Nilai Inti Kami</h2>
                <p style="text-align: center; color: #a7f3d0;">Prinsip yang menjadi nafas setiap langkah kami.</p>

                <div class="values-grid">
                    <div class="value-card">
                        <i class="bi bi-shield-check value-icon"></i>
                        <h3>Integritas</h3>
                        <p>Kami menjunjung tinggi transparansi dalam setiap donasi yang kami terima dan salurkan.</p>
                    </div>
                    <div class="value-card">
                        <i class="bi bi-infinity value-icon"></i>
                        <h3>Keberlanjutan</h3>
                        <p>Fokus pada solusi jangka panjang, bukan sekadar perbaikan sementara bagi alam.</p>
                    </div>
                    <div class="value-card">
                        <i class="bi bi-people-fill value-icon"></i>
                        <h3>Kolaborasi</h3>
                        <p>Percaya bahwa kekuatan besar lahir dari kerjasama antara masyarakat, pemerintah, dan alam.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    @include('partials.footer')

    <script>
        // Scroll Animation Script
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
        });

        // 3D Tilt Effect Script
        const cards = document.querySelectorAll('.character-card');

        cards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                // Hitung rotasi (Max 10 derajat)
                const rotateX = ((y - centerY) / centerY) * -10;
                const rotateY = ((x - centerX) / centerX) * 10;

                card.style.transform =
                    `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
            });

            card.addEventListener('mouseenter', () => {
                card.style.transition =
                    'box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease, transform 0.1s linear';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transition =
                    'box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease, transform 0.5s ease';
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale(1)';
            });
        });
    </script>
</body>

</html>
