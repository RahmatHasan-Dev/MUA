<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partnership | MUA - Menadah Untuk Alam</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
        }

        /* Header & Nav (Konsisten dengan halaman lain) */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #10b981;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            color: #1f2937;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #10b981;
        }

        /* Hero Section */
        .hero-partnership {
            padding: 120px 0 60px;
            text-align: center;
            background: linear-gradient(to bottom, #f0fdf4, #f9fafb);
        }

        .hero-partnership h1 {
            font-size: 2.5rem;
            color: #065f46;
            margin-bottom: 15px;
            font-weight: 800;
        }

        .hero-partnership p {
            color: #6b7280;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Section Styles */
        .partner-section {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .section-title h2 {
            font-size: 2rem;
            color: #1f2937;
            font-weight: 700;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #10b981;
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* Grid Layout */
        .partner-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            justify-content: center;
        }

        /* Card Style (Halus & Bersih) */
        .partner-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #f3f4f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }

        .partner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.1);
            border-color: #d1fae5;
        }

        .partner-logo {
            height: 80px;
            width: 100%;
            object-fit: contain;
            margin-bottom: 20px;
            filter: grayscale(100%);
            opacity: 0.8;
            transition: 0.3s;
        }

        .partner-card:hover .partner-logo {
            filter: grayscale(0%);
            opacity: 1;
        }

        .partner-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .partner-desc {
            font-size: 0.95rem;
            color: #6b7280;
            /* Warna abu-abu, bukan hijau */
            line-height: 1.6;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .btn-visit {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 20px;
            background-color: #f3f4f6;
            color: #4b5563;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-visit:hover {
            background-color: #10b981;
            color: white;
        }

        /* Footer (Sederhana) */
        footer {
            background: white;
            padding: 40px 0;
            text-align: center;
            border-top: 1px solid #eee;
            margin-top: 60px;
            color: #6b7280;
        }

        /* Filter & Pagination Styles */
        .filter-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .form-select,
        .form-input {
            padding: 10px 15px;
            border: 1px solid #e5e7eb;
            border-radius: 50px;
            outline: none;
            color: #374151;
        }

        .btn-search {
            padding: 10px 25px;
            background-color: #10b981;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-search:hover {
            background-color: #059669;
        }

        .pagination-wrapper {
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }

        /* Basic Pagination Styling if Bootstrap not loaded */
        .pagination {
            display: flex;
            list-style: none;
            gap: 5px;
        }

        .page-link {
            padding: 8px 16px;
            border: 1px solid #eee;
            color: #10b981;
            text-decoration: none;
            border-radius: 4px;
        }

        .page-item.active .page-link {
            background-color: #10b981;
            color: white;
            border-color: #10b981;
        }
    </style>
</head>

<body>
    @include('header')

    <!-- Hero -->
    <section class="hero-partnership">
        <div class="container">
            <h1>Partner Kami</h1>
            <p>Bersama membangun ekosistem yang berkelanjutan melalui sinergi dengan berbagai pihak.</p>
        </div>
    </section>

    <div class="container">

        <!-- Filter Section -->
        <form action="{{ route('partnership') }}" method="GET" class="filter-container">
            <select name="kategori" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <option value="reguler" {{ request('kategori') == 'reguler' ? 'selected' : '' }}>Partner Reguler
                </option>
                <option value="eksklusif" {{ request('kategori') == 'eksklusif' ? 'selected' : '' }}>Partner Eksklusif
                </option>
                <option value="pengawasan" {{ request('kategori') == 'pengawasan' ? 'selected' : '' }}>Dibawah
                    Pengawasan</option>
            </select>
            <input type="text" name="search" class="form-input" placeholder="Cari nama partner..."
                value="{{ request('search') }}">
            <button type="submit" class="btn-search">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>

        <!-- 1. Partner Reguler -->
        @if ($partnerships->where('kategori', 'reguler')->count() > 0)
            <section class="partner-section">
                <div class="section-title">
                    <h2>Partner Reguler</h2>
                </div>
                <div class="partner-grid">
                    @foreach ($partnerships->where('kategori', 'reguler') as $partner)
                        <div class="partner-card">
                            @php
                                $logoUrl = \Illuminate\Support\Str::startsWith($partner->logo, 'images/')
                                    ? asset($partner->logo)
                                    : asset('storage/' . $partner->logo);
                            @endphp
                            @if ($partner->logo)
                                <img src="{{ $logoUrl }}" alt="{{ $partner->name }}" class="partner-logo">
                            @else
                                <div class="partner-logo"
                                    style="display:flex; align-items:center; justify-content:center; background:#f9fafb; border-radius:8px;">
                                    <i class="bi bi-building" style="font-size: 2rem; color: #ccc;"></i>
                                </div>
                            @endif
                            <h3 class="partner-name">{{ $partner->name }}</h3>
                            <p class="partner-desc">{{ $partner->description }}</p>

                            <a href="{{ route('partnership.detail', $partner->id) }}" class="btn-visit">
                                Info Lebih Lanjut <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- 2. Partner Eksklusif -->
        @if ($partnerships->where('kategori', 'eksklusif')->count() > 0)
            <section class="partner-section">
                <div class="section-title">
                    <h2>Partner Eksklusif</h2>
                </div>
                <div class="partner-grid">
                    @foreach ($partnerships->where('kategori', 'eksklusif') as $partner)
                        <div class="partner-card">
                            @php
                                $logoUrl = \Illuminate\Support\Str::startsWith($partner->logo, 'images/')
                                    ? asset($partner->logo)
                                    : asset('storage/' . $partner->logo);
                            @endphp
                            @if ($partner->logo)
                                <img src="{{ $logoUrl }}" alt="{{ $partner->name }}" class="partner-logo">
                            @else
                                <div class="partner-logo"
                                    style="display:flex; align-items:center; justify-content:center; background:#f9fafb; border-radius:8px;">
                                    <i class="bi bi-building" style="font-size: 2rem; color: #ccc;"></i>
                                </div>
                            @endif
                            <h3 class="partner-name">{{ $partner->name }}</h3>
                            <p class="partner-desc">{{ $partner->description }}</p>

                            <a href="{{ route('partnership.detail', $partner->id) }}" class="btn-visit">
                                Info Lebih Lanjut <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- 3. Dibawah Pengawasan -->
        @if ($partnerships->where('kategori', 'pengawasan')->count() > 0)
            <section class="partner-section">
                <div class="section-title">
                    <h2>Dibawah Pengawasan</h2>
                </div>
                <div class="partner-grid">
                    @foreach ($partnerships->where('kategori', 'pengawasan') as $partner)
                        <div class="partner-card">
                            @php
                                $logoUrl = \Illuminate\Support\Str::startsWith($partner->logo, 'images/')
                                    ? asset($partner->logo)
                                    : asset('storage/' . $partner->logo);
                            @endphp
                            @if ($partner->logo)
                                <img src="{{ $logoUrl }}" alt="{{ $partner->name }}" class="partner-logo">
                            @else
                                <div class="partner-logo"
                                    style="display:flex; align-items:center; justify-content:center; background:#f9fafb; border-radius:8px;">
                                    <i class="bi bi-shield-check" style="font-size: 2rem; color: #ccc;"></i>
                                </div>
                            @endif
                            <h3 class="partner-name">{{ $partner->name }}</h3>
                            <p class="partner-desc">{{ $partner->description }}</p>

                            <a href="{{ route('partnership.detail', $partner->id) }}" class="btn-visit">
                                Info Lebih Lanjut <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Pagination Links -->
        <div class="pagination-wrapper">
            {{ $partnerships->links('pagination::bootstrap-4') }}
        </div>

    </div>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Menadah Untuk Alam. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
