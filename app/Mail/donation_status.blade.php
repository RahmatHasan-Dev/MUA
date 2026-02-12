<!DOCTYPE html>
<html>

<head>
    <title>Status Donasi Diperbarui</title>
</head>

<body style="font-family: Arial, sans-serif; color: #333;">
    <h2 style="color: #2d6a4f;">Halo, {{ $donasi->user->nama }}!</h2>

    <p>Terima kasih telah berpartisipasi dalam menjaga alam bersama MUA.</p>

    <p>Status donasi Anda dengan ID <strong>#{{ $donasi->id_donasi }}</strong> sebesar <strong>Rp
            {{ number_format($donasi->nominal, 0, ',', '.') }}</strong> telah diperbarui menjadi:</p>

    <div
        style="padding: 15px; background-color: #d1e7dd; color: #0f5132; display: inline-block; border-radius: 5px; font-weight: bold; text-transform: uppercase;">
        {{ $donasi->status }}
    </div>

    <p>Dana ini akan digunakan untuk program <strong>{{ ucfirst($donasi->jenis) }}</strong>.</p>

    @if ($donasi->catatan)
        <div
            style="margin-top: 15px; padding: 10px; background-color: #f8f9fa; border-left: 4px solid #2d6a4f; color: #555;">
            <strong>Catatan Admin:</strong><br>
            {{ $donasi->catatan }}
        </div>
    @endif

    <br>
    <p>Salam Lestari,<br>Tim Menadah Untuk Alam</p>
</body>

</html>
