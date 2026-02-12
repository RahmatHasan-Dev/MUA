<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Donasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Midtrans Snap JS -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- SweetAlert2 & Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        :root {
            --primary-green: #10b981;
            --secondary-green: #059669;
            --dark-green: #065f46;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            --text-light: #ecfdf5;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at center, #059669 0%, #064e3b 100%);
            color: #fff;
            margin: 0;
            padding: 0;
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
            filter: brightness(0.4) contrast(1.1);
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
            padding-top: 120px;
            padding-bottom: 80px;
            background: linear-gradient(to bottom, transparent 0%, rgba(6, 78, 59, 0.8) 30%, #064e3b 100%);
        }

        h2 {
            text-align: center;
            color: #fff;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 0 20px rgba(16, 185, 129, 0.5);
            font-size: 2.5rem;
        }

        .section {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            max-width: 1100px;
            margin: auto;
            background: transparent;
            padding: 20px;
        }

        .active {
            display: block;
        }

        .visible {
            opacity: 1;
        }

        .donasi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 30px;
            margin-top: 40px;
            padding: 10px;
        }

        .donasi-item {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 24px;
            overflow: hidden;
            transition: box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            position: relative;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        /* Glossy Glare Effect */
        .donasi-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 100%;
            height: 100%;
            background: linear-gradient(115deg, transparent 40%, rgba(255, 255, 255, 0.15) 50%, transparent 60%);
            transform: skewX(-20deg);
            transition: 0.5s;
            pointer-events: none;
            z-index: 10;
        }

        .donasi-item:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(16, 185, 129, 0.5);
        }

        .donasi-item:hover::before {
            left: 150%;
            transition: 0.7s;
        }

        .donasi-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.1s ease-out;
        }

        /* Hover scale handled by JS Parallax */

        .donasi-item-content {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .donasi-item h3,
        .donasi-item p {
            margin: 0 0 10px;
        }

        .donasi-item h3 {
            color: #fff;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .donasi-item p {
            color: #d1d5db;
            font-size: 0.95rem;
            line-height: 1.6;
            flex-grow: 1;
        }

        input,
        select,
        .btn {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            background: rgba(0, 0, 0, 0.3);
            color: #fff;
            cursor: pointer;
            box-sizing: border-box;
        }

        /* Button Styling */
        .donasi-item button,
        .btn-glow {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 50px;
            /* Glassmorphism Green Glowing */
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
        }

        .donasi-item button:hover,
        .btn-glow:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
            box-shadow: 0 0 25px rgba(16, 185, 129, 0.6);
            color: white;
        }

        .btn-detail {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #d1fae5;
            margin-top: 10px;
            box-shadow: none;
        }

        .btn-detail:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: #fff;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary-green);
            background: rgba(0, 0, 0, 0.5);
        }

        /* Progress Bar Styles */
        .progress-container {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            height: 12px;
            width: 100%;
            margin: 15px 0 10px;
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            background: linear-gradient(90deg, #34d399, #10b981);
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease-in-out;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
        }

        .progress-text {
            font-size: 0.85rem;
            color: #a7f3d0;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }

        /* Top Donatur / Leaderboard Styles */
        .leaderboard-container {
            margin-top: 50px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        }

        .leaderboard-title {
            text-align: center;
            color: #fff;
            margin-bottom: 25px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .leaderboard-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .leaderboard-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .leaderboard-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: scale(1.02) translateX(5px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.1);
            border-color: var(--primary-green);
        }

        .rank-badge {
            width: 35px;
            height: 35px;
            background: #2d6a4f;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
        }

        .rank-1 {
            background: #FFD700;
            color: #555;
        }

        /* Gold */
        .rank-2 {
            background: #C0C0C0;
            color: #555;
        }

        /* Silver */
        .rank-3 {
            background: #CD7F32;
            color: white;
        }

        /* Bronze */

        .donor-info {
            flex-grow: 1;
        }

        .donor-name {
            font-weight: bold;
            color: #fff;
            margin: 0;
        }

        .donor-amount {
            font-size: 0.9rem;
            color: #6ee7b7;
            margin: 0;
        }

        /* General Button for Forms */
        button {
            font-family: 'Poppins', sans-serif;
        }

        .btn-submit:hover,
        .section button:not(.donasi-item button):hover {
            background: var(--dark-green);
            color: white;
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
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.2);
            color: #d1d5db;
        }

        .payment-card-box i {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: var(--primary-green);
        }

        .payment-card-label input:checked+.payment-card-box {
            border-color: var(--primary-green);
            background-color: rgba(16, 185, 129, 0.1);
            box-shadow: 0 8px 20px rgba(45, 106, 79, 0.15);
            transform: translateY(-3px);
            color: #fff;
            font-weight: bold;
        }

        /* Styling Input File Custom */
        .custom-file-upload {
            display: block;
            padding: 20px;
            border: 2px dashed rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            color: #d1d5db;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .custom-file-upload:hover {
            border-color: var(--primary-green);
            background: rgba(16, 185, 129, 0.1);
            color: #fff;
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

        /* Glow Blob Decoration */
        .glow-blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
        }

        @keyframes floatUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }

            50% {
                opacity: 0.8;
            }

            100% {
                transform: translateY(-100px) translateX(50px);
                opacity: 0;
            }
        }

        /* Rain Effect */
        .rain-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .raindrop {
            position: absolute;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.4));
            width: 1px;
            height: 80px;
            top: -100px;
        }

        @keyframes rain-fall {
            0% {
                transform: translateY(-100px);
            }

            100% {
                transform: translateY(900px);
            }
        }

        .nominal-presets {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .preset-btn {
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(0, 0, 0, 0.2);
            color: #d1fae5;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 700;
            font-size: 0.9rem;
            text-align: center;
            width: 100%;
        }

        .preset-btn:hover {
            border-color: var(--primary-green);
            background: rgba(16, 185, 129, 0.1);
            transform: translateY(-2px);
        }

        .preset-btn.active {
            background: var(--primary-green);
            color: white;
            border-color: var(--primary-green);
            box-shadow: 0 4px 10px rgba(45, 106, 79, 0.3);
        }

        /* Animation Fade In Up */
        .fade-in {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease-out, transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading Overlay */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        #loading-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #d1fae5;
            border-top: 5px solid #10b981;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Detail Section Styles */
        .detail-header {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .detail-header img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }

        .detail-content {
            background: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .detail-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            color: #a7f3d0;
            font-size: 0.9rem;
        }

        .recent-donors-list {
            margin-top: 20px;
            border-top: 1px dashed #e5e7eb;
            padding-top: 20px;
        }

        .recent-donor-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* --- Social Share Buttons (Glowing & Elegant) --- */
        .share-container {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .share-label {
            font-size: 0.9rem;
            color: #d1d5db;
            margin-bottom: 10px;
            display: block;
            font-weight: 500;
        }

        .share-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-share {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px;
            border-radius: 12px;
            text-decoration: none;
            color: white;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-share:hover {
            transform: translateY(-3px);
            filter: brightness(1.1);
            color: white;
        }

        .share-wa {
            background: linear-gradient(135deg, #25D366, #128C7E);
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        }

        .share-fb {
            background: linear-gradient(135deg, #1877F2, #1659b1);
            box-shadow: 0 4px 15px rgba(24, 119, 242, 0.3);
        }

        .share-x {
            background: linear-gradient(135deg, #000000, #333333);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* --- Form Enhancements (New) --- */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.3);
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
            margin-bottom: 0 !important;
            /* Override default input margin */
        }

        .form-control:focus {
            background: rgba(0, 0, 0, 0.5);
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            outline: none;
        }

        .form-control[readonly] {
            background-color: rgba(255, 255, 255, 0.05);
            color: #9ca3af;
            border-color: rgba(255, 255, 255, 0.1);
            cursor: default;
        }

        /* Form Actions (Buttons) */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }

        .btn-primary-action {
            flex: 2;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
            filter: brightness(1.05);
        }

        .btn-secondary-action {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 16px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-secondary-action:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border-color: #fff;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    @include('navbar')

    <!-- Loading Animation Overlay -->
    <div id="loading-overlay">
        <div class="spinner"></div>
    </div>

    <!-- Parallax Background -->
    <div class="parallax-wrapper"></div>

    <!-- Main Content Wrapper -->
    <div class="content-wrapper">
        <!-- Decorative Glows -->
        <div class="glow-blob" style="top: 10%; left: -10%;"></div>
        <div class="glow-blob" style="bottom: 20%; right: -10%; width: 600px; height: 600px;"></div>

        <!-- Header -->
        <div class="section active visible" style="text-align: center; margin-bottom: 40px;">
            <h1
                style="font-size: 3.5rem; font-weight: 800; color: #fff; margin-bottom: 10px; text-shadow: 0 0 20px rgba(16, 185, 129, 0.3);">
                <i class="bi bi-tree-fill" style="color: #6ee7b7;"></i> Berbagi Untuk Alam
            </h1>
            <p style="font-size: 1.2rem; color: #d1fae5; max-width: 800px; margin: 0 auto;">
                Setiap rupiah yang Anda donasikan adalah langkah nyata untuk melestarikan keanekaragaman hayati dan masa
                depan bumi kita.
            </p>
        </div>

        <div class="section active visible" id="section-penjelasan">
            <h2>Dukung Program Donasi Kami</h2>
            <p style="text-align: center; color: #a7f3d0; margin-bottom: 30px;">Pilih program yang ingin kamu bantu:</p>

            <div class="donasi-grid">
                <!-- Skeleton Loader (Tampil saat memuat) -->
                <div id="skeleton-container" style="display: contents;">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="skeleton-card"
                            style="background: rgba(255,255,255,0.1); border-radius: 24px; overflow: hidden;">
                            <div class="skeleton" style="width: 100%; height: 220px;"></div>
                            <div style="padding: 25px; flex-grow: 1;">
                                <div class="skeleton" style="width: 70%; height: 24px; margin-bottom: 15px;"></div>
                                <div class="skeleton" style="width: 100%; height: 16px; margin-bottom: 8px;"></div>
                                <div class="skeleton" style="width: 90%; height: 16px; margin-bottom: 8px;"></div>
                                <div class="skeleton" style="width: 60%; height: 16px; margin-bottom: 20px;"></div>
                                <div class="skeleton" style="width: 100%; height: 45px; border-radius: 50px;"></div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div id="real-campaigns" style="display: contents; display: none;">
                    @foreach ($campaigns as $campaign)
                        <div class="donasi-item fade-in">
                            <img src="{{ $campaign->gambar ? asset('storage/' . $campaign->gambar) : asset('img/default.jpg') }}"
                                alt="{{ $campaign->judul }}" />

                            <div class="donasi-item-content">
                                <h3>{{ $campaign->judul }}</h3>
                                <p>{{ Str::limit($campaign->deskripsi, 100) }}</p>

                                <!-- Donasi Button -->
                                <button onclick="pilihProgram({{ $campaign->id_campaign }}, {{ $campaign->nominal }})">
                                    Donasi
                                </button>

                                <!-- Detail Button -->
                                <button class="donasi-item button btn-detail"
                                    onclick="lihatDetail({{ $campaign->id_campaign }})">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Donatur Section -->
            @if ($topDonatur->count() > 0)
                <div class="leaderboard-container">
                    <h3 class="leaderboard-title"><i class="bi bi-trophy-fill" style="color: #FFD700;"></i> Pahlawan
                        Alam
                        Teratas</h3>
                    <div class="leaderboard-list">
                        @foreach ($topDonatur as $index => $donatur)
                            <div class="leaderboard-item">
                                <div class="rank-badge rank-{{ $index + 1 }}">{{ $index + 1 }}</div>
                                <div style="margin-right: 15px;">
                                    <i class="bi bi-person-circle" style="font-size: 2rem; color: #aaa;"></i>
                                </div>
                                <div class="donor-info">
                                    <p class="donor-name">{{ $donatur->user->nama }}</p>
                                    <p class="donor-amount">Total Donasi: <strong>Rp
                                            {{ number_format($donatur->total_donasi, 0, ',', '.') }}</strong></p>
                                </div>
                                <i class="bi bi-award"
                                    style="font-size: 1.5rem; color: var(--primary-green); opacity: 0.8;"></i>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Detail Campaign Section (New) -->
        <div class="section" id="section-detail">
            <button onclick="showSection('section-penjelasan')"
                style="width: auto; margin-bottom: 20px; background: transparent; color: #d1fae5; border: 1px solid rgba(255,255,255,0.3); border-radius: 50px; padding: 8px 20px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>

            <div class="detail-header">
                <img id="detail-img" src="" alt="Campaign Image">
            </div>

            <div class="detail-content">
                <h2 id="detail-title" style="text-align: left; font-size: 2rem; color: #fff;">Judul Campaign</h2>

                <!-- Progress Bar -->
                <div class="progress-text">
                    <span id="detail-terkumpul">Terkumpul: Rp 0</span>
                    <span id="detail-target">Target: Rp 0</span>
                </div>
                <div class="progress-container">
                    <div id="detail-progress-bar" class="progress-bar" style="width: 0%"></div>
                </div>

                <p id="detail-desc" style="margin-top: 20px; line-height: 1.8; color: #d1d5db;">Deskripsi lengkap...</p>

                <div style="margin-top: 30px;">
                    <!-- Donasi Button (Reused Logic) -->
                    <button id="detail-btn-donasi" class="btn-glow">
                        Donasi Sekarang
                    </button>
                </div>

                <!-- Social Share Section -->
                <div class="share-container">
                    <span class="share-label"><i class="bi bi-share-fill"></i> Bagikan Kebaikan Ini:</span>
                    <div class="share-buttons">
                        <a href="#" id="share-wa" target="_blank" class="btn-share share-wa">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="#" id="share-fb" target="_blank" class="btn-share share-fb">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="#" id="share-x" target="_blank" class="btn-share share-x">
                            <i class="bi bi-twitter-x"></i> Twitter
                        </a>
                    </div>
                </div>

                <div class="recent-donors-list">
                    <h4 style="color: #fff;"><i class="bi bi-clock-history"></i> Donatur Terbaru</h4>
                    <div id="detail-donors"></div>
                </div>
            </div>
        </div>

        <div class="section" id="section-formulir"
            style="background: rgba(255,255,255,0.05); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); padding: 40px; max-width: 800px;">
            <h2 style="text-align: center; margin-bottom: 10px; font-size: 2rem; color: #fff;">Formulir Donatur</h2>
            <p style="text-align: center; color: #a7f3d0; margin-bottom: 40px;">Lengkapi data di bawah ini untuk
                melanjutkan
                kebaikan Anda.</p>

            @if (session('error'))
                <div
                    style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="form-donasi" action="{{ route('donasi.submit') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Hidden Inputs -->
                <input type="hidden" name="id_campaign" id="id_campaign">
                <input type="hidden" name="id_user" value="{{ Auth::check() ? Auth::user()->id : null }}">
                <input type="hidden" name="jenis" id="program">

                <!-- Donor Info -->
                <div class="form-group">
                    <label class="form-label">Nama Donatur</label>
                    <input type="text" class="form-control"
                        value="{{ Auth::check() ? Auth::user()->nama : 'Guest / Donatur Tamu' }}" readonly />
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control"
                        value="{{ Auth::check() ? Auth::user()->email : 'guest@mua.com' }}" readonly />
                </div>

                <!-- Nominal -->
                <div class="form-group">
                    <label class="form-label">Pilih Nominal Donasi</label>
                    <div class="nominal-presets">
                        <div class="preset-btn" onclick="setNominal(50000, this)">Rp 50rb</div>
                        <div class="preset-btn" onclick="setNominal(100000, this)">Rp 100rb</div>
                        <div class="preset-btn" onclick="setNominal(200000, this)">Rp 200rb</div>
                        <div class="preset-btn" onclick="setNominal(500000, this)">Rp 500rb</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nominal Lainnya (Rp)</label>
                    <input type="number" name="nominal" id="nominal" class="form-control"
                        placeholder="Contoh: 50000" required min="10000"
                        style="font-weight: bold; color: #059669;" />
                </div>

                <!-- Payment Method -->
                <div class="form-group">
                    <label class="form-label">Metode Pembayaran</label>
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
                            <input type="radio" name="payment_method" value="qris"
                                onchange="updatePaymentInfo()">
                            <div class="payment-card-box">
                                <i class="bi bi-qr-code-scan"></i>
                                <span>QRIS</span>
                            </div>
                        </label>

                        <label class="payment-card-label">
                            <input type="radio" name="payment_method" value="ewallet"
                                onchange="updatePaymentInfo()">
                            <div class="payment-card-box">
                                <i class="bi bi-wallet2"></i>
                                <span>E-Wallet</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Optional Bukti Transfer -->
                <div class="form-group">
                    <label class="form-label">Bukti Transfer (Opsional)</label>
                    <label class="custom-file-upload">
                        <input type="file" name="bukti_transfer" accept="image/*" style="display: none;"
                            onchange="document.getElementById('file-name').innerText = this.files[0].name">
                        <i class="bi bi-cloud-upload"
                            style="font-size: 1.5rem; display: block; margin-bottom: 5px; color: var(--primary-green);"></i>
                        <span id="file-name">Klik untuk unggah bukti transfer</span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-secondary-action" onclick="showSection('section-penjelasan')">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </button>
                    <button type="submit" class="btn-primary-action">
                        Simpan & Lanjut Pembayaran <i class="bi bi-arrow-right-circle"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="section" id="section-pembayaran"
            style="background: rgba(255,255,255,0.05); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.2);">
            <h2>Instruksi Pembayaran</h2>
            <p style="color: #d1d5db;">
                <strong>Terima kasih, <span id="out-nama"></span>!</strong>
            </p>
            <p style="color: #d1d5db;">
                Donasi untuk <span id="out-program"></span> sebesar
                <strong>Rp <span id="out-nominal"></span></strong>
            </p>

            <div id="payment-instruction-content"
                style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 10px; margin: 15px 0; color: #fff;">
                <!-- Isi instruksi akan berubah via JS -->
            </div>

            <button onclick="konfirmasiDonasi()">Konfirmasi</button>
            <button type="button" onclick="showSection('section-formulir')">
                Kembali
            </button>
        </div>
    </div> <!-- End Content Wrapper -->


    @include('partials.footer')

    <script>
        // Data Campaign dari Controller (untuk Detail View)
        const campaignsData = @json($campaigns);

        // --- Counter Animation Function ---
        function animateValue(obj, start, end, duration, prefix = "") {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);

                // Easing function (easeOutExpo) for smooth effect
                const easeOut = 1 - Math.pow(2, -10 * progress);

                const currentVal = Math.floor(easeOut * (end - start) + start);

                // Format Rupiah
                obj.innerHTML = prefix + new Intl.NumberFormat('id-ID').format(currentVal);

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    obj.innerHTML = prefix + new Intl.NumberFormat('id-ID').format(end);
                }
            };
            window.requestAnimationFrame(step);
        }

        // --- Preset Nominal Function ---
        function setNominal(amount, element) {
            document.getElementById('nominal').value = amount;
            document.querySelectorAll('.preset-btn').forEach(btn => btn.classList.remove('active'));
            if (element) element.classList.add('active');
        }

        // --- Smooth Section Switching with Loading Animation ---
        function showSection(id) {
            const overlay = document.getElementById('loading-overlay');
            const currentSection = document.querySelector('.section.active');
            const nextSection = document.getElementById(id);

            // 1. Show Loading
            overlay.classList.add('active');

            // 2. Fade out current section
            if (currentSection) {
                currentSection.classList.remove('visible');
            }

            // 3. Wait for transition, then switch
            setTimeout(() => {
                document.querySelectorAll(".section").forEach((s) => {
                    s.classList.remove("active");
                });

                nextSection.classList.add("active");

                // Scroll to top of section
                nextSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // 4. Fade in new section & Hide Loading
                setTimeout(() => {
                    nextSection.classList.add('visible');
                    overlay.classList.remove('active');
                }, 300);
            }, 500);
        }

        function pilihProgram(campaignId, nominal) {
            document.getElementById("program").value = campaignId;
            document.getElementById("nominal").value = nominal;
            showSection("section-formulir");
            updatePaymentInfo();
        }

        // --- Detail View Logic ---
        function lihatDetail(id) {
            const campaign = campaignsData.find(c => c.id_campaign == id);
            if (!campaign) return;

            // Populate Data
            document.getElementById('detail-title').innerText = campaign.judul;
            document.getElementById('detail-desc').innerText = campaign.deskripsi;
            document.getElementById('detail-img').src = campaign.gambar ? "{{ asset('storage') }}/" + campaign.gambar :
                "{{ asset('img/default.jpg') }}";

            // Progress Bar
            const percent = campaign.percent || 0;
            document.getElementById('detail-progress-bar').style.width = percent + '%';

            // Jalankan Animasi Counter pada "Terkumpul"
            const elTerkumpul = document.getElementById('detail-terkumpul');
            animateValue(elTerkumpul, 0, campaign.terkumpul, 2000, "Terkumpul: Rp ");

            document.getElementById('detail-target').innerText = 'Target: Rp ' + new Intl.NumberFormat('id-ID').format(
                campaign.target);

            // Set Donasi Button Action
            const btnDonasi = document.getElementById('detail-btn-donasi');
            btnDonasi.onclick = function() {
                pilihProgram(campaign.id_campaign, campaign.nominal || 0);
            };

            // --- Update Share Links ---
            const currentUrl = window.location.href; // Atau URL spesifik campaign jika ada route detail
            const shareText = `Ayo bantu program "${campaign.judul}" di Menadah Untuk Alam! Donasi sekarang:`;

            document.getElementById('share-wa').href =
                `https://wa.me/?text=${encodeURIComponent(shareText + ' ' + currentUrl)}`;
            document.getElementById('share-fb').href =
                `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;
            document.getElementById('share-x').href =
                `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(currentUrl)}`;


            // Recent Donors List
            const donorsList = document.getElementById('detail-donors');
            donorsList.innerHTML = '';
            if (campaign.recent_donors && campaign.recent_donors.length > 0) {
                campaign.recent_donors.forEach(d => {
                    const div = document.createElement('div');
                    div.className = 'recent-donor-item';
                    div.innerHTML =
                        `<span><i class="bi bi-person-fill"></i> ${d.user ? d.user.nama : 'Hamba Allah'}</span> <span style="color:#10b981; font-weight:bold;">Rp ${new Intl.NumberFormat('id-ID').format(d.nominal)}</span>`;
                    donorsList.appendChild(div);
                });
            } else {
                donorsList.innerHTML = '<p style="color:#888; font-style:italic;">Belum ada donatur terbaru.</p>';
            }

            showSection('section-detail');
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

        // Handle Skeleton & Real Content Switch
        window.addEventListener('load', function() {
            const skeletons = document.getElementById('skeleton-container');
            const real = document.getElementById('real-campaigns');

            // Simulasi loading sebentar agar skeleton terlihat (smooth transition)
            setTimeout(() => {
                if (skeletons) skeletons.style.display = 'none';
                if (real) real.style.display = 'contents';
            }, 1000);
        });

        // --- 2. Card Tilt & Parallax Effect ---
        const cards = document.querySelectorAll('.donasi-item');
        cards.forEach(card => {
            const img = card.querySelector('img');

            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                // Hitung rotasi (Max 5 derajat - lebih kalem)
                const rotateX = ((y - centerY) / centerY) * -5;
                const rotateY = ((x - centerX) / centerX) * 5;

                // Terapkan Transformasi ke Card
                card.style.transform =
                    `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;

                // Efek Parallax pada Gambar (Gerak berlawanan arah)
                if (img) {
                    const moveX = ((x - centerX) / centerX) * -15;
                    const moveY = ((y - centerY) / centerY) * -15;
                    img.style.transform = `scale(1.1) translateX(${moveX}px) translateY(${moveY}px)`;
                }
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale(1) translateY(0)';
                if (img) img.style.transform = 'scale(1)';
            });

            // Smooth transition handling
            card.addEventListener('mouseenter', () => {
                // Keep box-shadow smooth, but make transform instant for responsiveness
                card.style.transition =
                    'box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease, transform 0.1s linear';
                if (img) img.style.transition = 'transform 0.1s linear';
            });

            card.addEventListener('mouseleave', () => {
                // Restore smooth transition for reset
                card.style.transition =
                    'box-shadow 0.4s ease, background 0.4s ease, border-color 0.4s ease, transform 0.5s ease';
                if (img) img.style.transition = 'transform 0.5s ease';
            });
        });

        // --- Validasi Client-Side (Cegah 0 Rupiah) ---
        document.getElementById('form-donasi').addEventListener('submit', function(e) {
            const nominal = document.getElementById('nominal').value;
            // Validasi minimal 10.000 (sesuai min attribute) atau > 0
            if (!nominal || nominal < 10000) {
                e.preventDefault();
                alert("Mohon maaf, minimal donasi adalah Rp 10.000 agar transaksi dapat diproses.");
                return false;
            }
        });

        // Trigger Snap Popup jika ada session snap_token
        @if (session('snap_token'))
            window.onload = function() {
                pay('{{ session('snap_token') }}');
            };
        @endif

        // Trigger Success Modal & Confetti jika ada session show_success_modal
        @if (session('show_success_modal'))
            document.addEventListener('DOMContentLoaded', function() {
                // 0. Mainkan Suara Efek (Tring!)
                var audio = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3');
                audio.volume = 0.5;
                audio.play().catch(function(error) {
                    console.log("Audio play failed (browser policy): ", error);
                });

                // 1. Tampilkan Confetti (Kertas Warna-Warni)
                var duration = 3 * 1000;
                var animationEnd = Date.now() + duration;
                var defaults = {
                    startVelocity: 30,
                    spread: 360,
                    ticks: 60,
                    zIndex: 10000
                };

                function randomInRange(min, max) {
                    return Math.random() * (max - min) + min;
                }

                var interval = setInterval(function() {
                    var timeLeft = animationEnd - Date.now();

                    if (timeLeft <= 0) {
                        return clearInterval(interval);
                    }

                    var particleCount = 50 * (timeLeft / duration);
                    confetti(Object.assign({}, defaults, {
                        particleCount,
                        origin: {
                            x: randomInRange(0.1, 0.3),
                            y: Math.random() - 0.2
                        }
                    }));
                    confetti(Object.assign({}, defaults, {
                        particleCount,
                        origin: {
                            x: randomInRange(0.7, 0.9),
                            y: Math.random() - 0.2
                        }
                    }));
                }, 250);

                // 2. Tampilkan SweetAlert Popup
                Swal.fire({
                    title: '<span style="color: #065f46; font-weight: 800; font-size: 1.8rem;">Terima Kasih!</span>',
                    html: `
                        <div style="margin-bottom: 15px;">
                            <img src="https://cdn-icons-png.flaticon.com/512/4148/4148517.png" style="width: 100px; animation: floatUp 2s infinite ease-in-out;">
                        </div>
                        <p style="font-size: 1.1rem; color: #4b5563; margin-bottom: 5px;">Kebaikan Anda telah kami terima.</p>
                        <p style="font-size: 0.95rem; color: #6b7280;">ID Donasi: <b style="color: #10b981; font-family: monospace;">#{{ session('donasi_id') ?? 'BARU' }}</b></p>
                        <div style="background: #f0fdf4; padding: 15px; border-radius: 12px; margin-top: 15px; border: 1px dashed #10b981;">
                            <p style="margin:0; font-size: 0.9rem; color: #064e3b; font-style: italic;">
                                "Setiap rupiah adalah nafas baru bagi alam Indonesia." 🌿
                            </p>
                        </div>
                    `,
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText: 'Sama-sama! 💚',
                    confirmButtonColor: '#10b981',
                    background: '#ffffff',
                    backdrop: `rgba(0,0,0,0.6)`,
                    customClass: {
                        popup: 'rounded-4 shadow-lg',
                        confirmButton: 'btn-glow' // Menggunakan style tombol yang sudah ada
                    }
                });
            });
        @endif

        function pay(token) {
            snap.pay(token, {
                onSuccess: function(result) {
                    // Redirect ke route khusus yang akan memicu popup sukses
                    // Kita kirim order_id agar bisa ditampilkan di popup
                    window.location.href = "{{ route('donasi.sukses') }}?order_id=" + result.order_id;
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
