<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi & Misi | MUA</title>

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
            background-image: url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=2560&auto=format&fit=crop');
            /* Misty Forest */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* Key for CSS Parallax */
            filter: brightness(0.6) contrast(1.1);
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
            padding-top: 100px;
            /* Space for Navbar */
            padding-bottom: 80px;
            background: linear-gradient(to bottom, transparent 0%, rgba(5, 150, 105, 0.8) 30%, #065f46 100%);
        }

        /* --- Typography & Titles --- */
        .page-title {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }

        .page-title h1 {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(to right, #6ee7b7, #fff, #6ee7b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 30px rgba(16, 185, 129, 0.3);
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .page-title p {
            font-size: 1.1rem;
            color: #a7f3d0;
            font-weight: 300;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* --- Glass Cards --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            box-shadow: var(--glass-shadow);
            transition: box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
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

        /* --- Visi Section --- */
        .visi-section {
            max-width: 900px;
            margin: 0 auto 80px;
            text-align: center;
        }

        .visi-icon {
            font-size: 4rem;
            color: var(--primary-green);
            margin-bottom: 20px;
            filter: drop-shadow(0 0 15px rgba(16, 185, 129, 0.6));
            animation: float 6s ease-in-out infinite;
        }

        .visi-text {
            font-size: 1.5rem;
            line-height: 1.8;
            font-weight: 500;
            color: #fff;
            font-style: italic;
        }

        .visi-label {
            display: inline-block;
            padding: 8px 20px;
            background: rgba(16, 185, 129, 0.2);
            border-radius: 50px;
            color: #6ee7b7;
            font-weight: 700;
            margin-bottom: 20px;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        /* --- Misi Grid --- */
        .misi-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-header {
            margin-bottom: 40px;
            border-left: 5px solid var(--primary-green);
            padding-left: 20px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            margin: 0;
            color: #fff;
        }

        .misi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 50px;
            /* Jarak antar kartu diperlebar agar tidak mepet */
            padding: 20px;
            /* Ruang tambahan untuk efek bayangan hover */
        }

        .misi-card {
            display: flex;
            flex-direction: column;
        }

        .misi-icon-box {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(6, 78, 59, 0.2));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border: 1px solid rgba(16, 185, 129, 0.3);
            transition: 0.3s;
        }

        .misi-card:hover .misi-icon-box {
            background: var(--primary-green);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.6);
            transform: rotate(10deg);
        }

        .misi-icon-box i {
            font-size: 1.8rem;
            color: #6ee7b7;
            transition: 0.3s;
        }

        .misi-card:hover .misi-icon-box i {
            color: #fff;
        }

        .misi-card h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: #fff;
            font-weight: 600;
        }

        .misi-card p {
            color: #d1d5db;
            line-height: 1.7;
            font-size: 0.95rem;
            flex-grow: 1;
        }

        /* --- Animations --- */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .fade-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- Decorative Elements --- */
        .glow-blob {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 2.5rem;
            }

            .visi-text {
                font-size: 1.2rem;
            }

            .glass-card {
                padding: 25px;
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
        <div class="glow-blob" style="top: 10%; left: -10%;"></div>
        <div class="glow-blob" style="bottom: 20%; right: -10%; width: 600px; height: 600px;"></div>

        <!-- Header -->
        <div class="container page-title fade-up">
            <p>Menadah Untuk Alam</p>
            <h1>Visi & Misi</h1>
        </div>

        <!-- Visi Section -->
        <div class="container visi-section fade-up">
            <div class="glass-card">
                <div class="visi-label">VISI KAMI</div>
                <div class="visi-icon">
                    <i class="bi bi-globe-americas"></i>
                </div>
                <div class="visi-text">
                    "{{ $visi->deskripsi ?? 'Menjadi pelopor pelestarian alam yang berkelanjutan demi masa depan bumi yang lebih hijau.' }}"
                </div>
            </div>
        </div>

        <!-- Misi Section -->
        <div class="misi-container">
            <div class="section-header fade-up">
                <h2>Misi Kami</h2>
                <p style="color: #a7f3d0; margin: 0;">Langkah nyata yang kami lakukan untuk bumi.</p>
            </div>

            <div class="misi-grid">
                @foreach ($misi as $index => $item)
                    <div class="glass-card misi-card fade-up" style="transition-delay: {{ $index * 100 }}ms;">
                        <div class="misi-icon-box">
                            <!-- Gunakan icon dari database, fallback jika kosong -->
                            <i class="{{ $item->icon ?? 'bi bi-tree' }}"></i>
                        </div>
                        <h3>{{ $item->judul }}</h3>
                        <p>{{ $item->deskripsi }}</p>
                    </div>
                @endforeach
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
        const cards = document.querySelectorAll('.glass-card');

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
