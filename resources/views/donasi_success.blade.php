<!DOCTYPE html>
<html>

<head>
    <title>Donasi Berhasil</title>
</head>

<body style="font-family: Arial, sans-serif; color: #333;">
    <div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #2d6a4f; text-align: center;">Terima Kasih!</h2>
        <p>Halo {{ $donasi->user->nama ?? 'Donatur' }},</p>
        <p>Kami telah menerima donasi Anda sebesar <strong>Rp
                {{ number_format($donasi->nominal, 0, ',', '.') }}</strong> untuk program
            <strong>{{ ucfirst($donasi->jenis) }}</strong>.</p>

        @if ($donasi->catatan)
            <p><em>"{{ $donasi->catatan }}"</em></p>
        @endif

        <p>Dukungan Anda sangat berarti bagi kelestarian alam Indonesia.</p>
        <p style="text-align: center; margin-top: 30px; font-size: 12px; color: #888;">&copy; {{ date('Y') }} Menadah
            Untuk Alam</p>
    </div>
</body>

</html>
