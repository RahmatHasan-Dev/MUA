<!DOCTYPE html>
<html>

<head>
    <title>Laporan Donasi MUA</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2d6a4f;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            color: #2d6a4f;
            font-size: 24px;
        }

        .header p {
            margin: 2px 0;
            color: #555;
        }

        .logo {
            position: absolute;
            top: 0;
            left: 0;
            width: 60px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #2d6a4f;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
            color: #666;
        }

        .total-row {
            font-weight: bold;
            background-color: #e8f5e9;
        }
    </style>
</head>

<body>
    <div class="header">
        <!-- Ganti src dengan path absolut atau base64 jika gambar tidak muncul -->
        <!-- <img src="{{ public_path('img/logo.png') }}" class="logo"> -->
        <h1>YAYASAN MENADAH UNTUK ALAM</h1>
        <p>Jl. Kaliurang Km 14, Sleman, Yogyakarta | Telp: (0274) 123456</p>
        <p>Email: info@mua.org | Website: www.mua.org</p>
    </div>

    <h3 style="text-align: center;">LAPORAN RIWAYAT DONASI</h3>
    <p>Dicetak pada: {{ date('d F Y, H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Donatur</th>
                <th>Program</th>
                <th>Status</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($donations as $index => $d)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $d->user->nama ?? 'Guest' }}</td>
                    <td style="text-transform: capitalize;">{{ $d->jenis }}</td>
                    <td>{{ ucfirst($d->status) }}</td>
                    <td style="text-align: right;">Rp {{ number_format($d->nominal, 0, ',', '.') }}</td>
                </tr>
                @php
                    if ($d->status == 'berhasil') {
                        $total += $d->nominal;
                    }
                @endphp
            @endforeach
            <tr class="total-row">
                <td colspan="5" style="text-align: right;">Total Donasi Berhasil</td>
                <td style="text-align: right;">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Yogyakarta, {{ date('d F Y') }}</p>
        <br><br><br>
        <p>Admin Pengelola</p>
    </div>
</body>

</html>
