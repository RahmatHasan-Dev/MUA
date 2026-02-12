<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Fact | MUA</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-green: #10b981;
            --dark-green: #064e3b;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            --text-light: #ecfdf5;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at center, #065f46 0%, #022c22 100%);
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
            background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?q=80&w=2070&auto=format&fit=crop');
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
            background: linear-gradient(to bottom, transparent 0%, rgba(6, 78, 59, 0.8) 30%, #064e3b 100%);
        }

        /* --- Typography --- */
        .page-title {
            text-align: center;
            margin-bottom: 60px;
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

        /* --- Fun Fact Grid --- */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .funfact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .funfact-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px 30px;
            box-shadow: var(--glass-shadow);
            text-align: center;
            transition: box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .funfact-card:hover {
            border-color: rgba(16, 185, 129, 0.6);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        /* Glossy Glare Effect */
        .funfact-card::before {
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
        }

        .funfact-card:hover::before {
            left: 150%;
            transition: 0.7s;
        }

        .ff-emoji {
            font-size: 4rem;
            margin-bottom: 20px;
            display: inline-block;
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3));
            animation: float 4s ease-in-out infinite;
        }

        .ff-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-green);
            margin-bottom: 10px;
            text-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
        }

        .ff-headline {
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 15px;
        }

        .ff-desc {
            font-size: 0.95rem;
            color: #d1d5db;
            line-height: 1.6;
        }

        /* --- Animations --- */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
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
            <p>Tahukah Kamu?</p>
            <h1>Fakta Unik Alam</h1>
        </div>

        <!-- Fun Fact Grid -->
        <div class="container">
            <div class="funfact-grid">
                @foreach ($funfact as $index => $item)
                    <div class="funfact-card fade-up" style="transition-delay: {{ $index * 100 }}ms;">
                        <div class="ff-emoji">{{ $item->emoji }}</div>
                        <div class="ff-number">{{ $item->angka }}</div>
                        <div class="ff-headline">{{ $item->headline }}</div>
                        <div class="ff-desc">{{ $item->deskripsi }}</div>
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
        const cards = document.querySelectorAll('.funfact-card');

        cards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                // Hitung rotasi (Max 15 derajat)
                const rotateX = ((y - centerY) / centerY) * -15;
                const rotateY = ((x - centerX) / centerX) * 15;

                card.style.transform =
                    `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
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
