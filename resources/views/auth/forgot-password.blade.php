<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .parallax-bg {
            position: fixed;
            top: -5%;
            left: -5%;
            width: 110%;
            height: 110%;
            background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?q=80&w=2000&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            z-index: -1;
            filter: brightness(0.6);
            transition: transform 0.1s ease-out;
        }

        .auth-container {
            background: rgba(255, 255, 255, 0.85);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            text-align: center;
        }

        .auth-header i {
            font-size: 3rem;
            color: #10b981;
            margin-bottom: 10px;
        }

        .auth-header h2 {
            color: #065f46;
            margin: 10px 0 5px;
        }

        .auth-header p {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            outline: none;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        .btn-auth {
            width: 100%;
            padding: 12px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-auth:hover {
            background: #059669;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: #6b7280;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: #10b981;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="parallax-bg" id="parallaxBg"></div>
    <div class="auth-container">
        <div class="auth-header">
            <i class="bi bi-shield-lock"></i>
            <h2>Reset Password</h2>
            <p>Masukkan email Anda untuk menerima link reset password.</p>
        </div>
        @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="Email Anda" required>
            <button type="submit" class="btn-auth">Kirim Link Reset</button>
        </form>
        <a href="{{ route('login') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali ke Login</a>
    </div>
    <script>
        document.addEventListener('mousemove', (e) => {
            const bg = document.getElementById('parallaxBg');
            const x = (window.innerWidth - e.pageX * 2) / 90;
            const y = (window.innerHeight - e.pageY * 2) / 90;
            bg.style.transform = `translateX(${x}px) translateY(${y}px)`;
        });
    </script>
</body>

</html>
