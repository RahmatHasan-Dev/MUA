<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | MUA</title>
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
            background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?q=80&w=2000&auto=format&fit=crop');
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
            max-width: 420px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
            text-align: center;
        }

        /* Glossy Glare Effect */
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
            margin-bottom: 25px;
            font-weight: 700;
            text-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
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
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
        }

        .auth-links {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #6b7280;
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

        .logo-icon {
            font-size: 3rem;
            color: #10b981;
            margin-bottom: 10px;
            display: inline-block;
            filter: drop-shadow(0 0 10px rgba(16, 185, 129, 0.4));
        }

        /* Password Validation Styles */
        #password-requirements {
            margin-top: 10px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            font-size: 0.85rem;
            display: none;
            /* Hidden by default */
        }

        .req-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fca5a5;
            /* Merah (invalid) */
            transition: color 0.3s;
            margin-bottom: 5px;
        }

        .req-item.valid {
            color: #6ee7b7;
            /* Hijau (valid) */
        }

        .req-item i {
            font-size: 0.9rem;
        }

        #pass-confirm-message {
            font-size: 0.85rem;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="parallax-wrapper"></div>
    <div class="auth-card">
        <i class="bi bi-person-plus-fill logo-icon"></i>
        <h2>Bergabung Bersama Kami</h2>

        @if ($errors->any())
            <div
                style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; border: 1px solid rgba(239, 68, 68, 0.3);">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap"
                    value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email"
                    value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <input type="text" name="no_hp" class="form-control" placeholder="No. Handphone"
                    value="{{ old('no_hp') }}" required>
            </div>

            <div class="form-group">
                <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir"
                    value="{{ old('tgl_lahir') }}" required>
            </div>

            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                    required>
                <!-- Password Requirements -->
                <div id="password-requirements">
                    <div class="req-item" id="req-length"><i class="bi bi-x-circle"></i> Minimal 8 karakter</div>
                    <div class="req-item" id="req-upper"><i class="bi bi-x-circle"></i> Mengandung huruf besar</div>
                    <div class="req-item" id="req-number"><i class="bi bi-x-circle"></i> Mengandung angka</div>
                </div>
            </div>

            <div class="form-group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Konfirmasi Password" required>
                <div id="pass-confirm-message"></div>
            </div>

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>
        <div class="auth-links">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
        </div>
    </div>

    <script>
        const passInput = document.getElementById('password');
        const passConfirmInput = document.getElementById('password_confirmation');
        const reqBox = document.getElementById('password-requirements');
        const reqLength = document.getElementById('req-length');
        const reqUpper = document.getElementById('req-upper');
        const reqNumber = document.getElementById('req-number');
        const confirmMsg = document.getElementById('pass-confirm-message');

        // Tampilkan box requirement saat input password difokus
        passInput.addEventListener('focus', () => {
            reqBox.style.display = 'block';
        });

        // Fungsi untuk validasi password
        const validatePassword = () => {
            const value = passInput.value;

            // Helper function untuk update UI
            const updateReq = (element, isValid) => {
                element.classList.toggle('valid', isValid);
                const icon = element.querySelector('i');
                icon.className = isValid ? 'bi bi-check-circle-fill' : 'bi bi-x-circle';
            };

            updateReq(reqLength, value.length >= 8);
            updateReq(reqUpper, /[A-Z]/.test(value));
            updateReq(reqNumber, /[0-9]/.test(value));
        };

        // Fungsi untuk validasi konfirmasi password
        const validateConfirmation = () => {
            const passValue = passInput.value;
            const confirmValue = passConfirmInput.value;

            if (confirmValue.length === 0) {
                confirmMsg.innerHTML = '';
            } else if (passValue === confirmValue) {
                confirmMsg.innerHTML =
                    '<span style="color: #6ee7b7;"><i class="bi bi-check-circle-fill"></i> Password cocok!</span>';
            } else {
                confirmMsg.innerHTML =
                    '<span style="color: #fca5a5;"><i class="bi bi-x-circle"></i> Password tidak cocok.</span>';
            }
        };

        // Tambahkan event listener
        passInput.addEventListener('input', () => {
            validatePassword();
            validateConfirmation(); // Validasi ulang konfirmasi jika password utama diubah
        });
        passConfirmInput.addEventListener('input', validateConfirmation);


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
