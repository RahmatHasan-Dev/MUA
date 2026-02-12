<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kegiatan->judul }} | Kegiatan MUA</title>

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
            background-color: #022c22;
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
            background-image: url('https://images.unsplash.com/photo-1466611653911-95081537e5b7?q=80&w=2070&auto=format&fit=crop');
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
            background: linear-gradient(to bottom, transparent 0%, rgba(2, 44, 34, 0.9) 40%, #022c22 100%);
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* --- Glass Card Style --- */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            box-shadow: var(--glass-shadow);
            margin-bottom: 40px;
        }

        .detail-header {
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
        }

        .detail-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 15px;
            text-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
        }

        .detail-meta {
            display: flex;
            gap: 20px;
            color: #a7f3d0;
            font-size: 1rem;
            flex-wrap: wrap;
        }

        .detail-meta i {
            color: var(--primary-green);
            margin-right: 5px;
        }

        .main-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            margin-bottom: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .content-body {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #d1d5db;
        }

        .tags {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }

        .tag {
            background: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
            border: 1px solid rgba(16, 185, 129, 0.3);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .other-activities {
            margin-top: 60px;
        }

        .other-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #fff;
            border-left: 4px solid var(--primary-green);
            padding-left: 15px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #a7f3d0;
            font-weight: 600;
            margin-bottom: 20px;
            transition: color 0.3s;
            background: rgba(255, 255, 255, 0.05);
            padding: 8px 20px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-back:hover {
            background: rgba(16, 185, 129, 0.2);
            color: #fff;
            border-color: var(--primary-green);
        }

        .comment-section {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .reply-form {
            display: none;
            margin-top: 15px;
            margin-left: 20px;
            padding-left: 15px;
            border-left: 2px solid rgba(255, 255, 255, 0.1);
        }

        .report-form {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background: rgba(239, 68, 68, 0.1);
            border-radius: 8px;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .nested-comment {
            margin-left: 40px;
            margin-top: 10px;
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Form Elements */
        .form-control {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 10px;
            padding: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-green);
            background: rgba(0, 0, 0, 0.5);
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

        /* --- Floating Share Buttons --- */
        .floating-share {
            position: fixed;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 20px;
            z-index: 999;
        }

        .share-btn {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.3rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            text-decoration: none;
            position: relative;
        }

        .share-btn::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 70px;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s;
            white-space: nowrap;
            pointer-events: none;
        }

        .share-btn:hover::after {
            opacity: 1;
            visibility: visible;
            left: 65px;
        }

        .share-btn:hover {
            background: var(--primary-green);
            transform: scale(1.15);
            color: #fff;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.6);
            border-color: var(--primary-green);
        }

        /* Mobile Responsive for Share */
        @media (max-width: 1100px) {
            .floating-share {
                position: fixed;
                bottom: 30px;
                left: 50%;
                top: auto;
                transform: translateX(-50%);
                flex-direction: row;
                background: rgba(15, 41, 30, 0.8);
                padding: 10px 25px;
                border-radius: 50px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            }

            .share-btn {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
                background: transparent;
                border: none;
                box-shadow: none;
            }

            .share-btn::after {
                display: none;
                /* Hide tooltip on mobile */
            }

            .share-btn:hover {
                transform: translateY(-5px);
            }
        }

        /* --- Related Activities Card Styling --- */
        .related-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s ease;
            display: block;
            text-decoration: none;
            height: 100%;
            position: relative;
        }

        .related-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-green);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .related-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .related-card:hover .related-img {
            transform: scale(1.1);
        }

        .related-content {
            padding: 20px;
        }

        /* --- Toast Notification --- */
        .toast-notification {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: rgba(16, 185, 129, 0.95);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 10000;
            display: flex;
            align-items: center;
            gap: 10px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .toast-notification.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        /* --- Campaign Progress Box --- */
        .campaign-progress-box {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .campaign-progress-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-green);
        }

        .progress-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            height: 10px;
            width: 100%;
            overflow: hidden;
            margin: 15px 0;
        }

        .progress-bar {
            background: linear-gradient(90deg, #10b981, #34d399);
            height: 100%;
            border-radius: 10px;
            transition: width 1.5s ease-out;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.6);
            position: relative;
        }

        .btn-donate-sm {
            background: var(--primary-green);
            color: white;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-donate-sm:hover {
            background: #059669;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    @include('navbar')

    <!-- Parallax Background -->
    <div class="parallax-wrapper"></div>

    <!-- Main Content -->
    <div class="content-wrapper">

        <!-- Decorative Glows -->
        <div class="glow-blob" style="top: 10%; left: -10%;"></div>

        <!-- Floating Share Buttons -->
        <div class="floating-share fade-up">
            <button onclick="copyLink()" class="share-btn" data-tooltip="Salin Link">
                <i class="bi bi-link-45deg"></i>
            </button>
            <a href="https://wa.me/?text={{ urlencode($kegiatan->judul . ' ' . route('kegiatan.detail', $kegiatan->id_berita)) }}"
                target="_blank" class="share-btn" data-tooltip="Share ke WhatsApp">
                <i class="bi bi-whatsapp"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('kegiatan.detail', $kegiatan->id_berita)) }}"
                target="_blank" class="share-btn" data-tooltip="Share ke Facebook">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($kegiatan->judul) }}&url={{ urlencode(route('kegiatan.detail', $kegiatan->id_berita)) }}"
                target="_blank" class="share-btn" data-tooltip="Share ke Twitter">
                <i class="bi bi-twitter-x"></i>
            </a>
            <a href="mailto:?subject={{ urlencode($kegiatan->judul) }}&body={{ urlencode(route('kegiatan.detail', $kegiatan->id_berita)) }}"
                class="share-btn" data-tooltip="Share via Email">
                <i class="bi bi-envelope"></i>
            </a>
        </div>

        <div class="container detail-container fade-up">
            <a href="{{ route('kegiatan') }}" class="btn-back"><i class="bi bi-arrow-left"></i> Kembali ke Kegiatan</a>

            <div class="glass-card">
                <div class="detail-header">
                    <h1 class="detail-title">{{ $kegiatan->judul }}</h1>
                    <div class="detail-meta">
                        <span><i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}</span>
                        <span><i class="bi bi-geo-alt"></i> {{ $kegiatan->lokasi }}</span>
                        <span><i class="bi bi-people"></i> {{ $kegiatan->peserta }}</span>
                    </div>
                </div>

                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}"
                    class="main-image">

                <!-- Campaign Progress Bar (Jika Terhubung) -->
                @if (isset($connectedCampaign) && $connectedCampaign)
                    <div class="campaign-progress-box">
                        <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                            <div>
                                <h4 style="margin: 0 0 5px 0; color: #fff; font-size: 1.2rem;">Dukung Kegiatan Ini</h4>
                                <small style="color: #a7f3d0; font-size: 0.9rem;">Campaign:
                                    {{ $connectedCampaign->judul }}</small>
                            </div>
                            <a href="{{ route('donasi') }}" class="btn-donate-sm">Donasi Sekarang</a>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: {{ $connectedCampaign->percent }}%"></div>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.95rem; color: #d1d5db;">
                            <span>Terkumpul: <b style="color: var(--primary-green);">Rp
                                    {{ number_format($connectedCampaign->terkumpul, 0, ',', '.') }}</b></span>
                            <span>Target: Rp {{ number_format($connectedCampaign->target, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endif

                <div class="content-body">
                    <p>{!! nl2br(e($kegiatan->deskripsi)) !!}</p>

                    <div class="tags">
                        @if ($kegiatan->tag1)
                            <span class="tag">#{{ $kegiatan->tag1 }}</span>
                        @endif
                        @if ($kegiatan->tag2)
                            <span class="tag">#{{ $kegiatan->tag2 }}</span>
                        @endif
                        @if ($kegiatan->tag3)
                            <span class="tag">#{{ $kegiatan->tag3 }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="other-activities">
                <h3 class="other-title">Kegiatan Terkait</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px;">
                    @foreach ($otherKegiatan as $other)
                        <a href="{{ route('kegiatan.detail', $other->id_berita) }}" class="related-card">
                            <div style="overflow: hidden;">
                                <img src="{{ asset('storage/' . $other->gambar) }}" class="related-img"
                                    alt="{{ $other->judul }}">
                            </div>
                            <div class="related-content">
                                <div
                                    style="font-size: 0.8rem; color: var(--primary-green); margin-bottom: 5px; font-weight: 600;">
                                    {{ \Carbon\Carbon::parse($other->tanggal)->format('d M Y') }}
                                </div>
                                <h4 style="margin: 0 0 10px; font-size: 1.1rem; color: #fff; line-height: 1.4;">
                                    {{ $other->judul }}
                                </h4>
                                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                    @if ($other->tag1)
                                        <span
                                            style="font-size: 0.7rem; padding: 2px 8px; background: rgba(255,255,255,0.1); border-radius: 4px; color: #a7f3d0;">#{{ $other->tag1 }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Bagian Komentar -->
            <div class="comment-section glass-card" style="padding: 30px;">
                <h3 class="other-title">Komentar ({{ $kegiatan->komentar->count() }})</h3>

                @if (session('error'))
                    <div
                        style="background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Form Komentar -->
                @auth
                    <form action="{{ route('kegiatan.komentar.store', $kegiatan->id_berita) }}" method="POST"
                        style="margin-bottom: 30px;">
                        @csrf
                        <div style="margin-bottom: 15px;">
                            <textarea name="isi" class="form-control" rows="3" placeholder="Tulis komentar Anda..." required></textarea>
                        </div>
                        <button type="submit"
                            style="background: var(--primary-green); color: white; border: none; padding: 10px 25px; border-radius: 50px; cursor: pointer; font-weight: 600;">Kirim
                            Komentar</button>
                    </form>
                @else
                    <div
                        style="background: rgba(16, 185, 129, 0.1); padding: 15px; border-radius: 10px; margin-bottom: 30px; color: #a7f3d0; border: 1px solid rgba(16, 185, 129, 0.2);">
                        Silakan <a href="{{ route('login') }}"
                            style="color: var(--primary-green); font-weight: bold;">Login</a> untuk ikut berdiskusi.
                    </div>
                @endauth

                <!-- Daftar Komentar -->
                @foreach ($kegiatan->komentar->where('parent_id', null) as $komen)
                    <div
                        style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 20px; border-radius: 12px; margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <div>
                                <strong style="color: #fff;">{{ $komen->pengguna->nama ?? 'User Terhapus' }}</strong>
                                @if (auth()->id() == $komen->id_user)
                                    <span
                                        style="font-size: 0.8rem; background: rgba(16, 185, 129, 0.2); color: #6ee7b7; padding: 2px 8px; border-radius: 10px; margin-left: 5px;">Anda</span>
                                @endif
                            </div>
                            <small style="color: #9ca3af;">{{ $komen->created_at->diffForHumans() }}</small>
                        </div>
                        <p style="margin: 0; color: #d1d5db;">{{ $komen->isi }}</p>

                        <!-- Action Buttons (Like, Reply, Delete) -->
                        <div
                            style="margin-top: 15px; display: flex; gap: 15px; align-items: center; font-size: 0.9rem;">

                            <!-- Like Button -->
                            <form action="{{ route('komentar.like', $komen->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @php
                                    $likesCount = \App\Models\KomentarLike::where('id_komentar', $komen->id)->count();
                                    $isLiked =
                                        auth()->check() &&
                                        \App\Models\KomentarLike::where('id_komentar', $komen->id)
                                            ->where('id_user', auth()->id())
                                            ->exists();
                                @endphp
                                <button type="submit"
                                    style="background:none; border:none; cursor:pointer; color: {{ $isLiked ? '#ef4444' : '#9ca3af' }}; display: flex; align-items: center; gap: 5px;">
                                    <i class="bi {{ $isLiked ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                    {{ $likesCount }} Suka
                                </button>
                            </form>

                            <!-- Reply Button -->
                            @auth
                                <button onclick="toggleReplyForm('reply-{{ $komen->id }}')"
                                    style="background:none; border:none; cursor:pointer; color: var(--primary-green); display: flex; align-items: center; gap: 5px;">
                                    <i class="bi bi-reply-fill"></i> Balas
                                </button>
                            @endauth

                            <!-- Report Button -->
                            @auth
                                <button onclick="toggleForm('report-{{ $komen->id }}')"
                                    style="background:none; border:none; cursor:pointer; color: #f59e0b; display: flex; align-items: center; gap: 5px;">
                                    <i class="bi bi-flag-fill"></i> Laporkan
                                </button>
                            @endauth

                            <!-- Delete Button (Only Owner) -->
                            @if (auth()->id() == $komen->id_user)
                                <form action="{{ route('komentar.delete', $komen->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus komentar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background:none; border:none; cursor:pointer; color: #ef4444; display: flex; align-items: center; gap: 5px;">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Form Balasan (Hidden by default) -->
                        <div id="reply-{{ $komen->id }}" class="reply-form">
                            <form action="{{ route('kegiatan.komentar.store', $kegiatan->id_berita) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $komen->id }}">
                                <textarea name="isi" class="form-control" rows="2"
                                    placeholder="Balas komentar {{ $komen->pengguna->nama ?? 'User' }}..." required style="margin-bottom: 10px;"></textarea>
                                <div style="display: flex; gap: 10px;">
                                    <button type="submit"
                                        style="background: var(--primary-green); color: white; border: none; padding: 5px 15px; border-radius: 50px; cursor: pointer; font-size: 0.9rem;">Kirim
                                        Balasan</button>
                                    <button type="button" onclick="toggleForm('reply-{{ $komen->id }}')"
                                        style="background: rgba(255,255,255,0.1); color: #fff; border: none; padding: 5px 15px; border-radius: 50px; cursor: pointer; font-size: 0.9rem;">Batal</button>
                                </div>
                            </form>
                        </div>

                        <!-- Form Report (Hidden by default) -->
                        <div id="report-{{ $komen->id }}" class="report-form">
                            <form action="{{ route('komentar.report', $komen->id) }}" method="POST">
                                @csrf
                                <input type="text" name="alasan" class="form-control"
                                    placeholder="Alasan melaporkan komentar ini..." required
                                    style="margin-bottom: 8px; background: rgba(255,255,255,0.9); color: #000;">
                                <div style="display: flex; gap: 10px;">
                                    <button type="submit"
                                        style="background: #ef4444; color: white; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 0.85rem;">Kirim
                                        Laporan</button>
                                    <button type="button" onclick="toggleForm('report-{{ $komen->id }}')"
                                        style="background: rgba(0,0,0,0.2); color: #fff; border: none; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-size: 0.85rem;">Batal</button>
                                </div>
                            </form>
                        </div>

                        <!-- Menampilkan Balasan (Nested Comments) -->
                        @foreach ($komen->replies as $reply)
                            <div class="nested-comment"
                                style="padding: 15px; border-radius: 10px; border-left: 3px solid var(--primary-green);">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                    <strong
                                        style="color: #fff; font-size: 0.95rem;">{{ $reply->pengguna->nama ?? 'User Terhapus' }}</strong>
                                    <small style="color: #9ca3af;">{{ $reply->created_at->diffForHumans() }}</small>
                                </div>
                                <p style="margin: 0; color: #d1d5db; font-size: 0.95rem;">{{ $reply->isi }}</p>
                            </div>
                        @endforeach

                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast-notification">
        <i class="bi bi-check-circle-fill"></i>
        <span>Link berhasil disalin!</span>
    </div>

    @include('partials.footer')

    <script>
        function toggleForm(id) {
            var form = document.getElementById(id);
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

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

        // Copy Link Function
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const toast = document.getElementById('toast');
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            });
        }
    </script>
</body>

</html>
