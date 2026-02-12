<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kwitansi Pengeluaran #{{ $pengeluaran->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            border: 2px solid #333;
            margin: 0;
        }

        .header {
            text-align: center;
            border-bottom: 2px double #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            text-transform: uppercase;
            color: #d9534f;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 8px;
            vertical-align: top;
        }

        .label {
            width: 150px;
            font-weight: bold;
        }

        .colon {
            width: 10px;
        }

        .nominal-box {
            background-color: #f8f9fa;
            border: 2px dashed #333;
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
        }

        .ttd-box {
            float: right;
            width: 200px;
            text-align: center;
        }

        .ttd-line {
            border-bottom: 1px solid #000;
            margin-top: 60px;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.05);
            z-index: -1;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="watermark">PENGELUARAN</div>

    <div class="header">
        <h2>Bukti Pengeluaran Kas</h2>
        <p>Menadah Untuk Alam (MUA) - Platform Donasi Lingkungan</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">No. Transaksi</td>
            <td class="colon">:</td>
            <td>OUT-{{ str_pad($pengeluaran->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal</td>
            <td class="colon">:</td>
            <td>{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td class="label">Kategori</td>
            <td class="colon">:</td>
            <td>{{ $pengeluaran->kategori }}</td>
        </tr>
        <tr>
            <td class="label">Judul / Keperluan</td>
            <td class="colon">:</td>
            <td>{{ $pengeluaran->judul }}</td>
        </tr>
        @if ($pengeluaran->keterangan)
            <tr>
                <td class="label">Keterangan Detail</td>
                <td class="colon">:</td>
                <td>{{ $pengeluaran->keterangan }}</td>
            </tr>
        @endif
    </table>

    <div class="nominal-box">
        Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}
    </div>

    <div class="footer">
        <div class="ttd-box">
            <p>Disetujui Oleh,</p>
            <div class="ttd-line"></div>
            <p>Admin Keuangan</p>
        </div>
    </div>
</body>

</html>
