<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan | MUA</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-green: #10b981;
            --dark-green: #065f46;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
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
            background-image: url('https://png.pngtree.com/background/20230425/original/pngtree-beautiful-green-forest-path-picture-image_2470041.jpg');
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

        .activity-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .activity-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--glass-shadow);
            transition: box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            position: relative;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .activity-card:hover {
            border-color: rgba(16, 185, 129, 0.6);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        /* Glossy Glare Effect */
        .activity-card::before {
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

        .activity-card:hover::before {
            left: 150%;
            transition: 0.7s;
        }

        .activity-image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .activity-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .activity-card:hover .activity-image img {
            transform: scale(1.1);
        }

        .activity-content {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .activity-date {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--primary-green);
            margin-bottom: 8px;
            text-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
        }

        .activity-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            margin: 0 0 10px;
            line-height: 1.3;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
        }

        .activity-description {
            color: #d1d5db;
            line-height: 1.5;
            font-size: 0.95rem;
            margin-bottom: 15px;
            flex-grow: 1;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .activity-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: #a7f3d0;
            font-weight: 500;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
        }

        .activity-tags {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .activity-tag {
            background: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
            border: 1px solid rgba(16, 185, 129, 0.3);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* --- Filter Buttons --- */
        .filter-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .filter-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #a7f3d0;
            padding: 10px 25px;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-green);
            color: #fff;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
            border-color: var(--primary-green);
        }

        /* Gallery Section */
        .photo-gallery {
            margin-top: 100px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 20px;
        }

        .gallery-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 50px;
            text-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .photo-item {
            border-radius: 24px;
            overflow: hidden;
            height: 350px;
            position: relative;
            box-shadow: var(--glass-shadow);
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .photo-item:hover img {
            transform: scale(1.15);
        }

        .photo-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .photo-item:hover .photo-overlay {
            opacity: 1;
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

        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 2.5rem;
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

        <!-- Header -->
        <div class="container page-title fade-up">
            <p>Jejak Langkah Kami</p>
            <h1>Kegiatan & Aksi</h1>
        </div>

        <!-- Filter Section -->
        <div class="container fade-up">
            <div class="filter-container">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="Konservasi">Konservasi</button>
                <button class="filter-btn" data-filter="Edukasi">Edukasi</button>
                <button class="filter-btn" data-filter="Sosial">Sosial</button>
            </div>
        </div>

        <!-- Activity Grid -->
        <div class="container">
            <div class="activity-grid">
                @foreach ($kegiatan as $index => $item)
                    <a href="{{ route('kegiatan.detail', $item->id_berita) }}" class="activity-card fade-up"
                        style="transition-delay: {{ $index * 100 }}ms;">
                        <div class="activity-image">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                        </div>

                        <div class="activity-content">
                            <div class="activity-date">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                            </div>

                            <h3 class="activity-title">{{ $item->judul }}</h3>

                            <p class="activity-description">
                                {{ Str::limit($item->deskripsi, 120) }}
                            </p>

                            <div class="activity-meta">
                                <div class="activity-location">
                                    <i class="bi bi-geo-alt-fill"></i> {{ $item->lokasi }}
                                </div>
                                <div class="activity-participants">
                                    <i class="bi bi-people-fill"></i> {{ $item->peserta }}
                                </div>
                            </div>

                            <div class="activity-tags">
                                @if ($item->tag1)
                                    <span class="activity-tag">{{ $item->tag1 }}</span>
                                @endif
                                @if ($item->tag2)
                                    <span class="activity-tag">{{ $item->tag2 }}</span>
                                @endif
                                @if ($item->tag3)
                                    <span class="activity-tag">{{ $item->tag3 }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Photo Gallery -->
        <div class="photo-gallery fade-up">
            <h3 class="gallery-title">Galeri Foto</h3>
            <div class="photo-grid">
                <div class="photo-item">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiMMuzpkaDmwjyo6gLayLBdzUSI2l9wMNe2Ao2a6FseQdLJfHdzq8485BjNo9Slam6aRZ_h9P-I85ZasHKwLpeqGOVSUa0ZOjNnCFcULKBRdTVRfWIWGJqTUk75iHFolthmwvqK2CGtoR8k/s1280/WhatsApp+Image+2021-07-22+at+10.32.58.jpeg"
                        alt="Galeri 1">
                    <div class="photo-overlay">
                        <span style="color: white; font-weight: 600;"><i class="bi bi-camera"></i> Dokumentasi
                            Lapangan</span>
                    </div>
                </div>
                <div class="photo-item">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhXUtO5Jz0GzG9n1qSj9_HGMnwJgGT2fsPcYimMDTV_ldiNSG1xOZGqEgGuuTuJp3pV-MKH8IJ1rg-gkBUdjupHdjd2UAizAwmQHSIO4IyWX1Z7qr_naYNtBoyxcjWLObFpzjNJpHGkgM4/s2048/1.+IMG_20210326_081835-min.jpg"
                        alt="Galeri 2">
                    <div class="photo-overlay">
                        <span style="color: white; font-weight: 600;"><i class="bi bi-camera"></i> Aksi Nyata</span>
                    </div>
                </div>
                <div class="photo-item">
                    <img src="https://nagasepaha-buleleng.desa.id/assets/files/artikel/sedang_1543808684IMG-20181202-WA0009.jpg"
                        alt="Galeri 3">
                    <div class="photo-overlay">
                        <span style="color: white; font-weight: 600;"><i class="bi bi-camera"></i> Gotong Royong</span>
                    </div>
                </div>
                <div class="photo-item">
                    <img src="https://dlh.lumajangkab.go.id/uploads/berita/WhatsApp_Image_2025-03-18_at_08_15_01.jpeg"
                        alt="Galeri 4">
                    <div class="photo-overlay">
                        <span style="color: white; font-weight: 600;"><i class="bi bi-camera"></i> Edukasi</span>
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

        // Filter Script
        const filterBtns = document.querySelectorAll('.filter-btn');
        const activityCards = document.querySelectorAll('.activity-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                btn.classList.add('active');

                const filterValue = btn.getAttribute('data-filter');

                activityCards.forEach(card => {
                    // Get text content of tags inside the card
                    const tags = card.querySelector('.activity-tags').innerText;

                    if (filterValue === 'all' || tags.includes(filterValue)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // 3D Tilt Effect Script
        const cards = document.querySelectorAll('.activity-card');

        cards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                // Hitung rotasi (Max 10 derajat agar tidak terlalu ekstrim)
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
