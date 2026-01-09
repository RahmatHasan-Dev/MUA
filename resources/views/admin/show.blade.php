<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Transaksi #{{ $donation->id_donasi }} - MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0fff4;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .receipt-card {
            background: white;
            width: 100%;
            max-width: 400px;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.15);
            overflow: hidden;
            position: relative;
            border: 1px solid #d8f3dc;
        }

        .receipt-header {
            background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .receipt-header::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 100%;
            height: 30px;
            background: white;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
            transform: scaleX(1.5);
        }

        .status-icon {
            font-size: 3.5rem;
            margin-bottom: 10px;
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
        }

        .amount-title {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .amount-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0;
        }

        .receipt-body {
            padding: 30px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            border-bottom: 1px dashed #e0e0e0;
            padding-bottom: 15px;
        }

        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .label {
            color: #888;
            font-size: 0.9rem;
        }

        .value {
            font-weight: 600;
            color: #333;
            text-align: right;
        }

        .proof-img {
            width: 100%;
            max-width: 100%;
            border-radius: 10px;
            margin-top: 15px;
            border: 1px solid #eee;
        }

        .actions {
            padding: 20px 30px;
            background: #f0fff4;
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            color: white;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        @media print {
            body {
                background: white;
                -webkit-print-color-adjust: exact;
            }

            .receipt-card {
                box-shadow: none;
                border: 1px solid #ddd;
                margin: 0 auto;
            }

            .actions {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="receipt-card">
        <div class="receipt-header">
            @if ($donation->status == 'berhasil')
                <div class="status-icon"><i class="bi bi-check-lg"></i></div>
                <div class="amount-title">Transfer Berhasil</div>
            @elseif($donation->status == 'pending')
                <div class="status-icon" style="background: rgba(255, 193, 7, 0.3);"><i
                        class="bi bi-hourglass-split"></i></div>
                <div class="amount-title">Menunggu Konfirmasi</div>
            @else
                <div class="status-icon" style="background: rgba(220, 53, 69, 0.3);"><i class="bi bi-x-lg"></i></div>
                <div class="amount-title">Transfer Gagal</div>
            @endif
            <h1 class="amount-value">Rp {{ number_format($donation->nominal, 0, ',', '.') }}</h1>
        </div>

        <div class="receipt-body">
            <div class="detail-row">
                <span class="label">ID Transaksi</span>
                <span class="value">#{{ $donation->id_donasi }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Waktu</span>
                <span class="value">{{ $donation->tanggal->format('d M Y, H:i') }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Dari</span>
                <span class="value">{{ $donation->user->nama ?? 'Guest' }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Untuk Program</span>
                <span class="value" style="text-transform: capitalize; color: #10b981;">{{ $donation->jenis }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Catatan Admin</span>
                <span class="value">{{ $donation->catatan ?? '-' }}</span>
            </div>

            <div style="margin-top: 20px;">
                <span class="label" style="display:block; margin-bottom: 8px;">Bukti Transfer</span>
                @if ($donation->bukti_transfer)
                    <img src="{{ asset('storage/' . $donation->bukti_transfer) }}" alt="Bukti Transfer"
                        class="proof-img">
                @else
                    <div
                        style="padding: 15px; background: #f9f9f9; border: 1px dashed #ccc; text-align: center; color: #888; border-radius: 8px; font-size: 0.9rem;">
                        <i class="bi bi-image"></i> Tidak ada lampiran
                    </div>
                @endif
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('admin.dashboard') }}" class="btn" style="background: #e5e7eb; color: #374151;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" class="btn" style="background: #4361ee;">
                <i class="bi bi-printer"></i> Cetak Struk
            </button>
            <form action="{{ route('admin.updateStatus', $donation->id_donasi) }}" method="POST"
                style="display: flex; flex-direction: column; gap: 10px; flex: 2;">
                @csrf
                @method('PATCH')

                <textarea name="catatan" placeholder="Tulis catatan (opsional, misal alasan penolakan)..." rows="2"
                    style="padding: 10px; border: 1px solid #d8f3dc; border-radius: 8px; width: 100%; box-sizing: border-box; font-family: inherit;"></textarea>

                <div style="display: flex; gap: 10px;">
                    @if ($donation->status !== 'berhasil')
                        <button type="submit" name="status" value="berhasil" class="btn"
                            style="background: #10b981;">
                            <i class="bi bi-check-lg"></i> Terima
                        </button>
                    @endif
                    @if ($donation->status !== 'gagal')
                        <button type="submit" name="status" value="gagal" class="btn"
                            style="background: #ef4444;">
                            <i class="bi bi-x-lg"></i> Tolak
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</body>

</html>
