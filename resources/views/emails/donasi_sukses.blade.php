<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Berhasil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .header {
            background: url('https://images.unsplash.com/photo-1511497584788-876760111969?q=80&w=1000&auto=format&fit=crop') center/cover no-repeat;
            padding: 60px 20px;
            text-align: center;
            color: white;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.95) 100%);
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
            backdrop-filter: blur(5px);
            display: block;
        }

        .content {
            padding: 40px 30px;
            color: #374151;
        }

        .greeting {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #111827;
            text-align: center;
        }

        .message {
            line-height: 1.6;
            margin-bottom: 30px;
            color: #4b5563;
            text-align: center;
        }

        .card-info {
            background: #f0fdf4;
            border: 1px dashed #10b981;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            color: #6b7280;
        }

        .info-value {
            font-weight: 600;
            color: #1f2937;
        }

        .total-row {
            border-top: 1px solid rgba(16, 185, 129, 0.2);
            margin-top: 15px;
            padding-top: 15px;
        }

        .total-value {
            color: #10b981;
            font-weight: 800;
            font-size: 20px;
        }

        .btn-container {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .footer {
            background-color: #f9fafb;
            padding: 30px 20px;
            text-align: center;
            font-size: 13px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
        }

        .footer a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="icon-circle">🌱</div>
                <h1>Donasi Diterima!</h1>
                <p style="margin: 10px 0 0 0; opacity: 0.9; font-size: 16px;">Terima kasih telah menjadi Pahlawan Alam
                </p>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">Halo, {{ $donasi->user->nama ?? 'Orang Baik' }}!</div>

            <p class="message">
                Kabar baik! Donasi Anda telah kami terima dan verifikasi. <br>
                Kontribusi Anda adalah energi nyata bagi kami untuk terus menjaga kelestarian alam Indonesia.
            </p>

            <!-- Detail Donasi -->
            <div class="card-info">
                <div class="info-row">
                    <span class="info-label">ID Donasi</span>
                    <span class="info-value" style="font-family: monospace;">#{{ $donasi->id_donasi }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($donasi->tanggal)->format('d M Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Program</span>
                    <span class="info-value" style="color: #059669;">{{ ucfirst($donasi->jenis) }}</span>
                </div>
                <div class="info-row total-row">
                    <span class="info-label">Total Donasi</span>
                    <span class="info-value total-value">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</span>
                </div>
            </div>

            <p class="message" style="font-size: 14px; font-style: italic; color: #6b7280;">
                "Alam tidak butuh kita, tapi kita butuh alam. <br>Terima kasih telah peduli."
            </p>

            <div class="btn-container">
                <a href="{{ route('donasi') }}" class="btn">Lihat Riwayat Donasi</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Menadah Untuk Alam (MUA). All rights reserved.</p>
            <p>Jl. Kaliurang KM 14, Yogyakarta, Indonesia</p>
            <p>
                <a href="{{ url('/') }}">Website</a> •
                <a href="{{ url('/about') }}">Tentang Kami</a> •
                <a href="{{ url('/donasi') }}">Donasi</a>
            </p>
        </div>
    </div>
</body>

</html>
