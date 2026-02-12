<!DOCTYPE html>
<html>

<head>
    <title>Laporan Donasi MUA</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        /* Kop Surat */
        .header {
            width: 100%;
            border-bottom: 3px solid #10b981;
            /* Hijau MUA */
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo-container {
            float: left;
            width: 80px;
        }

        .logo {
            width: 100%;
            height: auto;
        }

        .company-details {
            text-align: center;
            margin-left: 90px;
            /* Memberi ruang agar tidak menabrak logo */
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .company-address {
            font-size: 11px;
            color: #555;
            line-height: 1.4;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #10b981;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        /* Badge Status */
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-berhasil {
            color: #10b981;
        }

        .status-pending {
            color: #fbbf24;
        }

        .status-gagal {
            color: #ef4444;
        }

        /* Footer Total */
        .total-row {
            background-color: #e8f5e9;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div class="header">
        <div class="logo-container">
            @php
                $path = public_path('images/logo.png');
            @endphp
            {{-- Cek GD extension agar tidak error 500 --}}
            @if (file_exists($path) && extension_loaded('gd'))
                @php
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);

                    // Deteksi jika file sebenarnya adalah SVG (meski ekstensi .png)
                    if (strpos($data, '<svg') !== false) {
                        $type = 'svg+xml';
                    }

                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <img src="{{ $base64 }}" class="logo" alt="Logo">
            @endif
        </div>
        <div class="company-details">
            <div class="company-name">MENADAH UNTUK ALAM (MUA)</div>
            <div class="company-address">
                Jl. Ring Road Utara, Condong Catur, Sleman, Yogyakarta<br>
                Email: admin@mua.com | Telp: (021) 123-4567<br>
                Website: www.menadahuntukalam.com
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>

    <h3 class="text-center">LAPORAN DONASI</h3>
    <p class="text-center" style="margin-top: -10px; font-size: 11px; color: #666;">
        Periode: {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('d M Y') : 'Awal' }}
        s/d
        {{ request('end_date') ? \Carbon\Carbon::parse(request('end_date'))->format('d M Y') : 'Sekarang' }}
    </p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="25%">Donatur</th>
                <th width="15%">Program</th>
                <th width="15%">Status</th>
                <th width="25%">Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($donations as $index => $donasi)
                @php $total += $donasi->nominal; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($donasi->tanggal)->format('d/m/Y') }}</td>
                    <td>
                        <strong>{{ $donasi->user->nama ?? 'Guest' }}</strong><br>
                        <span style="font-size: 10px; color: #777;">{{ $donasi->user->email ?? '-' }}</span>
                    </td>
                    <td class="text-center">{{ ucfirst($donasi->jenis) }}</td>
                    <td class="text-center">
                        <span class="badge status-{{ $donasi->status }}">{{ ucfirst($donasi->status) }}</span>
                    </td>
                    <td class="text-right">{{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="5" class="text-right">TOTAL DONASI</td>
                <td class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 40px; float: right; text-align: center; width: 200px;">
        <p>Jakarta, {{ date('d F Y') }}</p>
        <br><br><br>
        <p style="border-bottom: 1px solid #333; padding-bottom: 5px;"><strong>Administrator</strong></p>
    </div>
</body>

</html>
