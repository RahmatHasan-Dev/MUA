<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - MUA</title>
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
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px 0;
        }

        .auth-container {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-header i {
            font-size: 3rem;
            color: #2d6a4f;
        }

        .auth-header h2 {
            color: #1b4332;
            margin-top: 10px;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #40916c;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #d8f3dc;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #52b788;
        }

        .btn-auth {
            width: 100%;
            padding: 1rem;
            background: #2d6a4f;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            font-size: 1rem;
            margin-top: 1rem;
        }

        .btn-auth:hover {
            background: #1b4332;
        }

        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .auth-footer a {
            color: #2d6a4f;
            text-decoration: none;
            font-weight: bold;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #999;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: #2d6a4f;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-header">
            <i class="bi bi-tree"></i>
            <h2>Bergabung dengan MUA</h2>
            <p>Mulai langkah kecilmu untuk bumi yang lebih baik</p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nomor HP</label>
                <input type="number" name="no_hp" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn-auth">Daftar Sekarang</button>
        </form>
        <div class="auth-footer">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
        </div>
        <a href="{{ route('home') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
    </div>
</body>

</html>
