<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | MUA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at center, #059669 0%, #064e3b 100%);
            overflow: hidden;
        }

        .parallax-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            z-index: -1;
            filter: brightness(0.4) contrast(1.1);
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
            text-align: center;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 100%;
            height: 100%;
            background: linear-gradient(115deg, transparent 40%, rgba(255, 255, 255, 0.15) 50%, transparent 60%);
            transform: skewX(-20deg);
            transition: 0.7s;
            pointer-events: none;
        }

        .auth-card:hover::before {
            left: 150%;
        }

        h2 {
            color: #fff;
            margin-bottom: 15px;
            font-weight: 700;
            text-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
        }

        p.description {
            color: #d1fae5;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: #fff;
            font-family: inherit;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 50px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
        }

        .logo-icon {
            font-size: 3rem;
            color: #10b981;
            margin-bottom: 10px;
            display: inline-block;
            filter: drop-shadow(0 0 10px rgba(16, 185, 129, 0.4));
        }

        .auth-links {
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .auth-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-links a:hover {
            text-decoration: underline;
            color: #6ee7b7;
        }
    </style>
</head>

<body>
    <div class="parallax-wrapper"></div>

    <div class="auth-card">
        <i class="bi bi-lock-fill logo-icon"></i>
        <h2>Lupa Password?</h2>
        <p class="description">Masukkan email Anda, kami akan mengirimkan link untuk mereset password.</p>

        @if (session('status'))
            <div
                style="background: rgba(16, 185, 129, 0.2); color: #a7f3d0; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; border: 1px solid rgba(16, 185, 129, 0.3);">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
            </div>

            <button type="submit" class="btn-submit">Kirim Link Reset</button>
        </form>

        <div class="auth-links">
            <a href="{{ route('login') }}">
                <i class="bi bi-arrow-left"></i> Kembali ke Login
            </a>
        </div>
    </div>

    <script>
        // 3D Tilt Effect
        const card = document.querySelector('.auth-card');
        document.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            // Max rotation 5 deg (kalem)
            const rotateX = ((y - centerY) / centerY) * -5;
            const rotateY = ((x - centerX) / centerX) * 5;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });
        document.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
        });
    </script>
</body>

</html>
