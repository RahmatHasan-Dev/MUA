<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi - MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <!-- Catatan: Ganti URL ke https://app.midtrans.com/snap/snap.js untuk Production -->
    <style>
        body {
            background-color: #f9f9f9;
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

        .donasi-container {
            max-width: 1000px;
            margin: 120px auto 60px;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
        }

        @media (max-width: 768px) {
            .donasi-container {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2d6a4f;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8f3dc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .btn-submit {
            background-color: #2d6a4f;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }

        .btn-pay {
            background-color: #e9c46a;
            color: #264653;
            padding: 5px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .history-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .history-item:last-child {
            border-bottom: none;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-berhasil {
            background-color: #d4edda;
            color: #155724;
        }

        /* Hijau untuk sukses */
        .status-gagal {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <!-- Header -->
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

    <div class="donasi-container">
        <!-- Form Donasi -->
        <div class="card">
            <h2 style="color: #2d6a4f; margin-bottom: 20px;">Mulai Donasi</h2>
            @if (session('success'))
                <div
                    style="background: #d1e7dd; color: #0f5132; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('donasi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Jenis Program</label>
                    <select name="jenis" class="form-control" required>
                        <option value="satwa">Konservasi Satwa</option>
                        <option value="karang">Terumbu Karang</option>
                        <option value="bakau">Hutan Bakau</option>
                        <option value="pendidikan">Pendidikan Lingkungan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nominal Donasi (Rp)</label>
                    <input type="number" name="nominal" class="form-control" min="10000" placeholder="Contoh: 50000"
                        required>
                </div>
                <button type="submit" class="btn-submit">Donasi Sekarang</button>
            </form>
        </div>

        <!-- Riwayat Donasi -->
        <div class="card">
            <h2 style="color: #2d6a4f; margin-bottom: 20px;">Riwayat Donasi Anda</h2>
            @if (isset($riwayat) && count($riwayat) > 0)
                @foreach ($riwayat as $d)
                    <div class="history-item">
                        <div>
                            <div style="font-weight: bold; color: #333;">{{ ucfirst($d->jenis) }}</div>
                            <div style="color: #666; font-size: 0.9rem;">{{ $d->tanggal->format('d M Y H:i') }}</div>
                            <div style="color: #2d6a4f; font-weight: bold;">Rp
                                {{ number_format($d->nominal, 0, ',', '.') }}</div>
                        </div>
                        <div style="text-align: right;">
                            <span class="status-badge status-{{ $d->status }}">
                                {{ strtoupper($d->status) }}
                            </span>

                            @if ($d->status == 'pending' && $d->snap_token)
                                <div style="margin-top: 5px;">
                                    <button class="btn-pay" onclick="pay('{{ $d->snap_token }}')">Bayar</button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <p style="color: #666;">Belum ada riwayat donasi.</p>
            @endif
        </div>
    </div>

    <script>
        // Fungsi untuk memicu Snap Popup
        function pay(snapToken) {
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    alert("Pembayaran Berhasil!");
                    location.reload();
                },
                onPending: function(result) {
                    alert("Menunggu Pembayaran!");
                    location.reload();
                },
                onError: function(result) {
                    alert("Pembayaran Gagal!");
                    location.reload();
                },
                onClose: function() {
                    // alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        }

        // Otomatis buka popup jika baru saja submit form (dari session)
        @if (session('snap_token'))
            pay('{{ session('snap_token') }}');
        @endif
    </script>
</body>

</html>
