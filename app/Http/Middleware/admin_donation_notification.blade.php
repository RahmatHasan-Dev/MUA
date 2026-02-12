<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Notifikasi Donasi Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 10px;
        }

        .header {
            background-color: #10b981;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
        }

        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #10b981;
            margin: 10px 0;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .details-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .details-table td:first-child {
            font-weight: bold;
            width: 120px;
            color: #555;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin:0;">Donasi Baru Diterima!</h2>
        </div>
        <div class="content">
            <p>Halo Admin,</p>
            <p>Sistem telah menerima pembayaran donasi baru via Midtrans dengan rincian sebagai berikut:</p>

            <div class="amount">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</div>

            <table class="details-table">
                <tr>
                    <td>ID Donasi</td>
                    <td>#{{ $donasi->id_donasi }}</td>
                </tr>
                <tr>
                    <td>Donatur</td>
                    <td>{{ $donasi->user->nama ?? 'Guest' }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $donasi->user->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Program</td>
                    <td>{{ ucfirst($donasi->jenis) }}</td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>{{ \Carbon\Carbon::parse($donasi->tanggal)->format('d M Y H:i') }}</td>
                </tr>
            </table>

            <p style="margin-top: 20px;">Silakan cek dashboard untuk detail lebih lanjut.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Menadah Untuk Alam System
        </div>
    </div>
</body>

</html>
