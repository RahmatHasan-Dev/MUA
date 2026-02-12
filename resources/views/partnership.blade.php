<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partnership | MUA - Konservasi Alam Indonesia</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #10b981;
            --secondary-green: #059669;
            --dark-green: #065f46;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            --text-light: #ecfdf5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
            background-image: url('https://images.unsplash.com/photo-1518173946687-a4c8892bbd9f?q=80&w=2500&auto=format&fit=crop');
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
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

        /* --- Hero Section (Integrated) --- */
        .hero-section {
            text-align: center;
            margin-bottom: 80px;
            padding: 0 20px;
        }

        .hero-description {
            max-width: 800px;
            margin: 0 auto 40px;
            font-size: 1.2rem;
            line-height: 1.8;
            color: #d1fae5;
        }

        .btn-glow {
            display: inline-block;
            padding: 12px 35px;
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
            transform: translateY(-3px);
            box-shadow: 0 0 25px rgba(16, 185, 129, 0.6);
            color: white;
        }

        /* --- Partner Lines --- */
        .line {
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 60px;
        }

        .tag {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 15px 40px;
            border-radius: 50px;
            min-width: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .partnertag {
            margin: 0;
            font-size: 1.3rem;
        }

        .tag.tagright {
            order: 2;
            margin-left: auto;
        }

        .tag.tagleft {
            margin-right: auto;
        }

        /* Marquee Container */
        .marquee-container {
            flex: 1;
            overflow: hidden;
            position: relative;
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            padding: 30px 0;
        }

        .marquee-track {
            display: flex;
            width: max-content;
            animation: scroll 15s linear infinite;
            will-change: transform;
        }

        .marquee-track:hover {
            animation-play-state: paused;
        }

        .marquee-reverse .marquee-track {
            animation-direction: reverse;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Partner Items */
        .partner-item {
            cursor: pointer;
            margin-right: 40px;
            background: rgba(255, 255, 255, 0.1);
            /* Glassmorphism Light */
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 24px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 10px 0 rgba(0, 0, 0, 0.2);
            transform-style: preserve-3d;
            perspective: 1000px;
            transition: box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease;
        }

        /* Efek Kilau (Glare) */
        .partner-item::before {
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

        .partner-item:hover::before {
            left: 150%;
            transition: 0.7s;
        }

        .partnernormal {
            width: 180px;
            height: 110px;
        }

        .partnerexclusive {
            width: 260px;
            height: 150px;
            background: rgba(255, 255, 255, 0.15);
            /* Slightly lighter for exclusive */
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .partnerlicense {
            width: 180px;
            height: 110px;
        }

        .partner-item:hover {
            border-color: rgba(16, 185, 129, 0.6);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.3);
        }

        .partner-item img {
            max-width: 85%;
            max-height: 85%;
            object-fit: contain;
            transition: transform 0.6s ease;
            filter: brightness(0) invert(1);
            /* Make logos white for dark theme */
        }

        .partner-item:hover img {
            transform: scale(1.1);
            filter: brightness(1);
            /* Show original color on hover */
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            background: rgba(20, 20, 20, 0.9);
            backdrop-filter: blur(25px);
            padding: 40px;
            border-radius: 30px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            position: relative;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            transform: scale(0.9) translateY(20px);
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #fff;
        }

        .modal.show .modal-content {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close:hover {
            color: var(--primary-green);
        }

        .modal-logo {
            height: 100px;
            object-fit: contain;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 10px;
        }

        .modal-content h3 {
            color: #fff;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .modal-content p {
            color: #d1d5db;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        /* Animations */
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

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .line {
                flex-direction: column;
                gap: 20px;
                margin-bottom: 40px;
            }

            .tag {
                width: 80%;
                border-radius: 50px;
                order: -1 !important;
                margin: 0 auto;
            }

            .page-title h1 {
                font-size: 2rem;
            }

            .partnertag.desktop {
                display: none;
            }

            .partnertag.mobile {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .partnertag.mobile {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Header/Navbar -->
    @include('partials.navbar')

    <!-- Parallax Background -->
    <div class="parallax-wrapper"></div>

    <!-- Main Content -->
    <div class="content-wrapper">

        <!-- Decorative Glows -->
        <div class="glow-blob" style="top: 0; left: -10%;"></div>
        <div class="glow-blob" style="bottom: 10%; right: -10%;"></div>

        <!-- Hero Section (Integrated) -->
        <div class="container hero-section fade-up">
            <div class="page-title">
                <p>Kolaborasi Untuk Alam</p>
                <h1>Partner Kami</h1>
            </div>

            <h2 class="hero-headline">Bersama-sama Melestarikan Keanekaragaman Hayati</h2>
            <p class="hero-description">
                Seperti koloni semut yang mengangkut makanannya, kami selalu bekerjasama dengan banyak pihak luar biasa
                lainnya untuk menjaga keanekaragaman hayati alam kita.
            </p>

            <a href="#partnership-list" class="btn-glow">
                <i class="bi bi-arrow-down-circle"></i>
                Siapa saja mereka?
            </a>
        </div>

        <!-- Partners List -->
        <div class="container" id="partnership-list">
            @if (isset($partnerships))
                @php
                    // Mengelompokkan partner berdasarkan kategori untuk efisiensi
                    $groupedPartners = $partnerships->groupBy(function ($item) {
                        return strtolower(trim($item->kategori));
                    });

                    $regulerPartners = $groupedPartners->get('reguler', collect());
                    $eksklusifPartners = $groupedPartners->get('eksklusif', collect());
                    $pengawasanPartners = $groupedPartners->get('pengawasan', collect());
                @endphp

                <!-- Partner Reguler -->
                @if ($regulerPartners->isNotEmpty())
                    <div class="line fade-up">
                        <div class="tag">
                            <p class="partnertag">Partner Reguler</p>
                        </div>
                        <div class="marquee-container">
                            <div class="marquee-track">
                                @foreach (range(1, 2) as $_)
                                    {{-- Duplikasi untuk marquee --}}
                                    @foreach ($regulerPartners as $partnership)
                                        @php
                                            $logoUrl = \Illuminate\Support\Str::startsWith(
                                                $partnership->logo,
                                                'images/',
                                            )
                                                ? asset($partnership->logo)
                                                : asset('storage/' . $partnership->logo);
                                        @endphp
                                        <div class="partnernormal partner-item" onclick="openPartnerModal(this)"
                                            data-name="{{ $partnership->name }}"
                                            data-desc="{{ $partnership->description ?? 'Partner konservasi alam Indonesia' }}"
                                            data-id="{{ $partnership->id }}"
                                            data-link="{{ $partnership->website_url ?? '#' }}"
                                            data-img="{{ $logoUrl }}">
                                            <img src="{{ $logoUrl }}" alt="{{ $partnership->name }}">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Partner Eksklusif -->
                @if ($eksklusifPartners->isNotEmpty())
                    <div class="line marquee-reverse fade-up">
                        <div class="tag tagright">
                            <p class="partnertag desktop">Partner Eksklusif</p>
                        </div>
                        <div class="marquee-container">
                            <div class="marquee-track">
                                @foreach (range(1, 2) as $_)
                                    {{-- Duplikasi untuk marquee --}}
                                    @foreach ($eksklusifPartners as $partnership)
                                        @php
                                            $logoUrl = \Illuminate\Support\Str::startsWith(
                                                $partnership->logo,
                                                'images/',
                                            )
                                                ? asset($partnership->logo)
                                                : asset('storage/' . $partnership->logo);
                                        @endphp
                                        <div class="partnerexclusive partner-item" onclick="openPartnerModal(this)"
                                            data-name="{{ $partnership->name }}"
                                            data-desc="{{ $partnership->description ?? 'Partner Eksklusif MUA' }}"
                                            data-id="{{ $partnership->id }}"
                                            data-link="{{ $partnership->website_url ?? '#' }}"
                                            data-img="{{ $logoUrl }}">
                                            <img src="{{ $logoUrl }}" alt="{{ $partnership->name }}">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Dibawah Pengawasan -->
                @if ($pengawasanPartners->isNotEmpty())
                    <div class="line fade-up">
                        <div class="tag tagleft">
                            <p class="partnertag">Dibawah Pengawasan</p>
                        </div>
                        <div class="marquee-container">
                            <div class="marquee-track">
                                @foreach (range(1, 2) as $_)
                                    {{-- Duplikasi untuk marquee --}}
                                    @foreach ($pengawasanPartners as $partnership)
                                        @php
                                            $logoUrl = \Illuminate\Support\Str::startsWith(
                                                $partnership->logo,
                                                'images/',
                                            )
                                                ? asset($partnership->logo)
                                                : asset('storage/' . $partnership->logo);
                                        @endphp
                                        <div class="partnerlicense partner-item" onclick="openPartnerModal(this)"
                                            data-name="{{ $partnership->name }}"
                                            data-desc="{{ $partnership->description ?? 'Dibawah Pengawasan' }}"
                                            data-id="{{ $partnership->id }}"
                                            data-link="{{ $partnership->website_url ?? '#' }}"
                                            data-img="{{ $logoUrl }}">
                                            <img src="{{ $logoUrl }}" alt="{{ $partnership->name }}">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Partner Detail Modal -->
    <div id="partnerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePartnerModal()">&times;</span>
            <img id="modalLogo" src="" alt="Partner Logo" class="modal-logo">
            <h3 id="modalName"></h3>
            <p id="modalDesc"></p>
            <a id="modalLink" href="#" target="_blank" class="btn-glow">
                <i class="bi bi-box-arrow-up-right"></i>
                Kunjungi Website
            </a>
        </div>
    </div>

    <script>
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

        document.querySelectorAll(".fade-up").forEach((el) => {
            observer.observe(el);
        });

        // 3D Tilt Effect Script
        const cards = document.querySelectorAll('.partner-item');

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

        // Modal Script
        const modal = document.getElementById('partnerModal');

        function openPartnerModal(element) {
            const name = element.getAttribute('data-name');
            const desc = element.getAttribute('data-desc');
            const link = element.getAttribute('data-link');
            const img = element.getAttribute('data-img');
            const id = element.getAttribute('data-id');

            document.getElementById('modalName').innerText = name;
            document.getElementById('modalDesc').innerText = desc;
            document.getElementById('modalLink').href = link;
            document.getElementById('modalLogo').src = img;

            modal.style.display = "flex";
            setTimeout(() => modal.classList.add('show'), 10);
        }

        function closePartnerModal() {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = "none";
            }, 300);
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                closePartnerModal();
            }
        }
    </script>
</body>
