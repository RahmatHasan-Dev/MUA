<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Donasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- Midtrans Snap JS -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <style>
        body {
            font-family: sans-serif;
            background: white;
            color: rgb(8, 8, 8);
            margin: 0;
            padding: 0;
            padding-top: 120px;
        }

        h2 {
            text-align: center;
        }

        .section {
            display: none;
            max-width: 900px;
            margin: auto;
            background: #f0fff4;
            padding: 40px;
            border-radius: 10px;
        }

        .active {
            display: block;
        }

        .donasi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .donasi-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            transition: 0.3s ease;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .donasi-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: #2d6a4f;
        }

        .donasi-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .donasi-item-content {
            padding: 15px;
        }

        .donasi-item h3,
        .donasi-item p {
            margin: 0 0 10px;
            color: #555;
        }

        .donasi-item h3 {
            color: #2d6a4f;
        }

        input,
        select,
        button,
        .btn {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #d8f3dc;
            border-radius: 5px;
            background: white;
            color: #333;
            cursor: pointer;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #2d6a4f;
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
        }

        button:hover,
        .btn:hover {
            background: #1b4332;
        }

        ul {
            padding-left: 20px;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .section {
                padding: 15px;
            }

            button,
            input,
            select {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 20px;
            }

            .donasi-item img {
                height: 140px;
            }

            button,
            input,
            select {
                font-size: 13px;
                padding: 9px;
            }
        }

        /* Styling Baru untuk Metode Pembayaran (Grid Card) */
        .payment-methods-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .payment-card-label {
            cursor: pointer;
            position: relative;
        }

        .payment-card-label input {
            display: none;
            /* Sembunyikan radio button asli */
        }

        .payment-card-box {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: white;
            color: #666;
        }

        .payment-card-box i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #2d6a4f;
        }

        .payment-card-label input:checked+.payment-card-box {
            border-color: #2d6a4f;
            background-color: #f0fff4;
            box-shadow: 0 8px 20px rgba(45, 106, 79, 0.15);
            transform: translateY(-3px);
            color: #1b4332;
            font-weight: bold;
        }

        /* Styling Input File Custom */
        .custom-file-upload {
            display: block;
            padding: 20px;
            border: 2px dashed #a8d5ba;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            background: #fcfdfd;
            transition: 0.3s;
            color: #555;
            margin-bottom: 20px;
        }

        .custom-file-upload:hover {
            border-color: #2d6a4f;
            background: #f0fff4;
        }

        /* Filter Dropdown */
        .filter-select {
            padding: 8px 15px;
            border-radius: 20px;
            border: 1px solid #2d6a4f;
            color: #2d6a4f;
            background: white;
            cursor: pointer;
            font-size: 12px;
            /* Ukuran font lebih kecil */
            outline: none;
            font-weight: 600;
            width: auto;
            /* Lebar menyesuaikan konten */
            margin: 0;
            /* Reset margin default input */
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
                <li>
                    <a href="{{ url('/#home') }}">
                        <i class="bi bi-house"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ url('/#program') }}">
                        <i class="bi bi-clipboard-check"></i>
                        Program
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="bi bi-info-circle"></i>
                        Tentang
                        <i class="bi bi-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i>
                    </a>
                    <ul class="dropdown-content">
                        <li><a href="{{ route('about') }}"><i class="bi bi-people"></i> Tentang Kami</a></li>
                        <li><a href="{{ route('visimisi') }}"><i class="bi bi-eye"></i> Visi & Misi</a></li>
                        <li><a href="{{ route('kegiatan') }}"><i class="bi bi-calendar-event"></i> Kegiatan</a></li>
                        <li><a href="{{ route('fun-fact') }}"><i class="bi bi-lightbulb"></i> Fun Fact</a></li>
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
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->nama }}
                            <i class="bi bi-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i>
                        </a>
                        <ul class="dropdown-content">
                            <li><a href="{{ route('profile.edit') }}"><i class="bi bi-pencil-square"></i> Edit Profil</a>
                            </li>
                            <li><a href="#"><i class="bi bi-gear"></i> Pengaturan</a></li>
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

    <div class="section active" id="section-penjelasan" style="margin: top 20px;">
        <h2>Dukung Program Donasi kami</h2>
        <p style="text-align: center">Pilih program yang ingin kamu bantu:</p>
        <div class="donasi-grid">
            <div class="donasi-item">
                <img src="satwa.jpeg" alt="satwa" />
                <div class="donasi-item-content">
                    <h3>🐒 Satwa Endemik - Rp 150.000</h3>
                    <p>Bantu pelestarian satwa yang hampir punah.</p>
                    <button onclick="pilihProgram('satwa', 150000)">Donasi</button>
                </div>
            </div>
            <div class="donasi-item">
                <img src="th.jpeg" alt="terumbu karang" />
                <div class="donasi-item-content">
                    <h3>🌊 Terumbu Karang - Rp 200.000</h3>
                    <p>Bantu pelestarian ekosistem laut Indonesia.</p>
                    <button onclick="pilihProgram('karang', 200000)">Donasi</button>
                </div>
            </div>
            <div class="donasi-item">
                <img src="bakau.jpeg" alt="bakau" />
                <div class="donasi-item-content">
                    <h3>🌳 Pohon Bakau - Rp 300.000</h3>
                    <p>Tanam dan rawat pohon bakau untuk hutan pesisir.</p>
                    <button onclick="pilihProgram('bakau', 300000)">Donasi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="section" id="section-formulir">
        <h2>Formulir Donatur</h2>

        @if (session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('donasi.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Nama</label>
            <input type="text" value="{{ Auth::check() ? Auth::user()->nama : 'Guest / Donatur Tamu' }}" readonly
                style="background-color: #e0e0e0; cursor: not-allowed;" />

            <label>Email</label>
            <input type="email" value="{{ Auth::check() ? Auth::user()->email : 'guest@mua.com' }}" readonly
                style="background-color: #e0e0e0; cursor: not-allowed;" />

            <label>Nominal (Rp)</label>
            <input type="number" name="nominal" id="nominal" required min="10000" />

            <input type="hidden" name="jenis" id="program" />

            <label>Metode Pembayaran</label>
            <div class="payment-methods-grid">
                <label class="payment-card-label">
                    <input type="radio" name="payment_method" value="bca" checked
                        onchange="updatePaymentInfo()">
                    <div class="payment-card-box">
                        <i class="bi bi-bank"></i>
                        <span>Bank BCA</span>
                    </div>
                </label>

                <label class="payment-card-label">
                    <input type="radio" name="payment_method" value="qris" onchange="updatePaymentInfo()">
                    <div class="payment-card-box">
                        <i class="bi bi-qr-code-scan"></i>
                        <span>QRIS</span>
                    </div>
                </label>

                <label class="payment-card-label">
                    <input type="radio" name="payment_method" value="ewallet" onchange="updatePaymentInfo()">
                    <div class="payment-card-box">
                        <i class="bi bi-wallet2"></i>
                        <span>E-Wallet</span>
                    </div>
                </label>
            </div>

            <label>Bukti Transfer (Opsional)</label>
            <label class="custom-file-upload">
                <input type="file" name="bukti_transfer" accept="image/*" style="display: none;"
                    onchange="document.getElementById('file-name').innerText = this.files[0].name">
                <i class="bi bi-cloud-upload"
                    style="font-size: 1.5rem; display: block; margin-bottom: 5px; color: #2d6a4f;"></i>
                <span id="file-name">Klik untuk unggah bukti transfer</span>
            </label>

            <div class="payment-methods">
            </div>

            <button type="submit" class="btn-submit"
                style="margin-top: 40px; background-color: #2d6a4f; color: white; font-weight: bold;">Simpan & Lanjut
                Pembayaran</button>
            <button type="button" onclick="showSection('section-penjelasan')">Kembali</button>
        </form>
    </div>

    <div class="section" id="section-pembayaran">
        <h2>Instruksi Pembayaran</h2>
        <p>
            <strong>Terima kasih, <span id="out-nama"></span>!</strong>
        </p>
        <p>
            Donasi untuk <span id="out-program"></span> sebesar
            <strong>Rp <span id="out-nominal"></span></strong>
        </p>

        <div id="payment-instruction-content"
            style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin: 15px 0;">
            <!-- Isi instruksi akan berubah via JS -->
        </div>

        <button onclick="konfirmasiDonasi()">Konfirmasi</button>
        <button type="button" onclick="showSection('section-formulir')">
            Kembali
        </button>
    </div>

    <!-- Riwayat Donasi Section -->
    @if (Auth::check())
        <div class="section active" style="margin-top: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h2 style="margin: 0; font-size: 1.2rem;">Riwayat Donasi</h2>
                <select id="statusFilter" class="filter-select" onchange="filterHistory()">
                    <option value="all">Semua Status</option>
                    <option value="berhasil">Berhasil</option>
                    <option value="pending">Pending</option>
                    <option value="gagal">Gagal</option>
                </select>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                    <thead>
                        <tr style="background: #2d6a4f; color: white;">
                            <th style="padding: 10px;">Tanggal</th>
                            <th style="padding: 10px;">Program</th>
                            <th style="padding: 10px;">Nominal</th>
                            <th style="padding: 10px;">Status</th>
                            <th style="padding: 10px;">Catatan</th>
                        </tr>
                    </thead>
                    <tbody id="historyTableBody">
                        @forelse($riwayat as $d)
                            <tr class="history-row" data-status="{{ strtolower($d->status) }}"
                                style="border-bottom: 1px solid #ddd;">
                                <td style="padding: 10px;">{{ \Carbon\Carbon::parse($d->tanggal)->format('d M Y') }}
                                </td>
                                <td style="padding: 10px; text-transform: capitalize;">{{ $d->jenis }}</td>
                                <td style="padding: 10px;">Rp {{ number_format($d->nominal, 0, ',', '.') }}</td>
                                <td style="padding: 10px;">
                                    <span
                                        style="padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold; 
                                background: {{ $d->status == 'berhasil' ? '#d1e7dd' : ($d->status == 'pending' ? '#fff3cd' : '#f8d7da') }};
                                color: {{ $d->status == 'berhasil' ? '#0f5132' : ($d->status == 'pending' ? '#856404' : '#721c24') }};">
                                        {{ ucfirst($d->status) }}
                                    </span>
                                    @if ($d->status == 'pending' && $d->snap_token)
                                        <button type="button" onclick="pay('{{ $d->snap_token }}')"
                                            style="margin-left: 8px; padding: 4px 10px; font-size: 11px; background-color: #e9c46a; border: none; border-radius: 15px; cursor: pointer; color: #264653; font-weight: bold;">
                                            <i class="bi bi-credit-card"></i> Bayar
                                        </button>
                                    @endif
                                </td>
                                <td style="padding: 10px; font-size: 0.9em; color: #555;">{{ $d->catatan ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 20px; text-align: center;">Belum ada riwayat
                                    donasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Footer -->
    <footer>
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
            // --- Navbar Functionality (Added) ---
            const menuToggle = document.getElementById("menuToggle");
            const navLinks = document.getElementById("navLinks");

            if (menuToggle && navLinks) {
                menuToggle.addEventListener("click", () => {
                    menuToggle.classList.toggle("active");
                    navLinks.classList.toggle("active");
                });
            }

            const dropdowns = document.querySelectorAll(".dropdown");
            dropdowns.forEach((dropdown) => {
                const toggle = dropdown.querySelector(".dropdown-toggle");
                if (toggle) {
                    toggle.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        dropdown.classList.toggle("active");
                        dropdowns.forEach((other) => {
                            if (other !== dropdown) other.classList.remove("active");
                        });
                    });
                }
            });

            document.addEventListener("click", function(e) {
                if (!e.target.closest(".dropdown")) {
                    dropdowns.forEach((d) => d.classList.remove("active"));
                }
            });

            if (navLinks) {
                navLinks.addEventListener("click", (e) => {
                    if (e.target.tagName === "A" && !e.target.classList.contains("dropdown-toggle")) {
                        if (menuToggle) menuToggle.classList.remove("active");
                        navLinks.classList.remove("active");
                        dropdowns.forEach((d) => d.classList.remove("active"));
                    }
                });
            }
            // --- End Navbar Functionality ---

            function filterHistory() {
                const filter = document.getElementById('statusFilter').value;
                const rows = document.querySelectorAll('.history-row');

                rows.forEach(row => {
                    if (filter === 'all' || row.getAttribute('data-status') === filter) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            function showSection(id) {
                document
                    .querySelectorAll(".section")
                    .forEach((s) => s.classList.remove("active"));
                document.getElementById(id).classList.add("active");
            }

            function pilihProgram(program, nominal) {
                document.getElementById("program").value = program;
                document.getElementById("nominal").value = nominal;
                showSection("section-formulir");
                updatePaymentInfo();
            }

            function updatePaymentInfo() {
                const method = document.querySelector('input[name="payment_method"]:checked').value;
                const content = document.getElementById('payment-instruction-content');

                let html = '';
                if (method === 'bca') {
                    html =
                        '<p>Silakan transfer ke <strong>Bank BCA</strong>:</p><h3>1234-5678-90</h3><p>a.n Yayasan Menadah Untuk Alam</p><p>Sertakan berita transfer: <em>Donasi MUA</em></p>';
                } else if (method === 'qris') {
                    html =
                        '<p>Scan QRIS berikut menggunakan Gopay, OVO, Dana, atau Mobile Banking:</p><div style="text-align:center; margin: 10px;"><img src="barcode.jpeg" alt="QRIS Code" style="max-width: 200px; border: 1px solid #ddd;"></div>';
                } else if (method === 'ewallet') {
                    html =
                        '<p>Kirim saldo ke nomor E-Wallet (Dana/OVO/Gopay):</p><h3>0812-3456-7890</h3><p>a.n Didi Novan Robi</p>';
                }
                content.innerHTML = html;
            }

            function konfirmasiDonasi() {
                alert("Terima kasih! Silakan cek email Anda atau halaman riwayat untuk status donasi.");
                window.location.href = "{{ route('donasi') }}";
            }

            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(anchor => {
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

            // Trigger Snap Popup jika ada session snap_token
            @if (session('snap_token'))
                window.onload = function() {
                    pay('{{ session('snap_token') }}');
                };
            @endif

            function pay(token) {
                snap.pay(token, {
                    onSuccess: function(result) {
                        alert("Pembayaran Berhasil!");
                        window.location.reload();
                    },
                    onPending: function(result) {
                        alert("Menunggu Pembayaran!");
                        window.location.reload();
                    },
                    onError: function(result) {
                        alert("Pembayaran Gagal!");
                        window.location.reload();
                    },
                    onClose: function() {
                        // User menutup popup
                    }
                });
            }
        </script>
</body>

</html>
