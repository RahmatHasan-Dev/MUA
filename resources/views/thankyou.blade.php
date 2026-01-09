<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #eafaf1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .thank-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }

        .icon-success {
            font-size: 5rem;
            color: #2d6a4f;
            margin-bottom: 20px;
        }

        h1 {
            color: #1b4332;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-home {
            background-color: #2d6a4f;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-home:hover {
            background-color: #1b4332;
        }
    </style>
</head>

<body>
    <div class="thank-card">
        <i class="bi bi-check-circle-fill icon-success"></i>
        <h1>Terima Kasih!</h1>
        <p>
            Donasi Anda telah kami terima. Terima kasih telah menjadi bagian dari perubahan baik untuk alam Indonesia.
            <br><br>
            <em>"Satu langkah kecil untukmu, satu lompatan besar untuk bumi."</em>
        </p>
        <a href="{{ route('home') }}" class="btn-home">Kembali ke Beranda</a>
        <br><br>
        <a href="{{ route('donasi') }}" style="color: #2d6a4f; font-size: 0.9rem;">Lihat Riwayat Donasi</a>
    </div>
</body>

</html>
