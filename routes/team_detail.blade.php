<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $team['nama'] }} - Tim MUA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9fafb;
            color: #333;
        }

        /* Header Styles (Sama dengan about.blade.php) */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 0 20px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #10b981;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Detail Card Styles */
        .detail-section {
            margin-top: 120px;
            margin-bottom: 60px;
            display: flex;
            justify-content: center;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            flex-direction: row;
        }

        .profile-img-container {
            flex: 1;
            background: #d1fae5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .profile-img {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            flex: 1.5;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .profile-name {
            font-size: 2.5rem;
            color: #1b4332;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .profile-role {
            color: #10b981;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .profile-bio {
            color: #555;
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .contact-info {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            margin-bottom: 10px;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background: #2d6a4f;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #1b4332;
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
            }

            .profile-img-container {
                padding: 30px;
            }

            .profile-img {
                width: 180px;
                height: 180px;
            }

            .profile-info {
                padding: 30px;
                text-align: center;
            }

            .contact-item {
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header id="header">
        <nav class="container">
            <a href="{{ url('/') }}" class="logo">
                <i class="bi bi-tree"></i>
                Menadah Untuk Alam
            </a>
        </nav>
    </header>

    <!-- Detail Section -->
    <section class="detail-section container">
        <div class="profile-card fade-in">
            <div class="profile-img-container">
                <img src="{{ asset('images/' . $team['foto']) }}"
                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($team['nama']) }}&background=10b981&color=fff&size=250'"
                    alt="{{ $team['nama'] }}" class="profile-img">
            </div>
            <div class="profile-info">
                <h1 class="profile-name">{{ $team['nama'] }}</h1>
                <div class="profile-role">{{ $team['posisi'] }}</div>

                <p class="profile-bio">
                    {{ $team['bio'] }}
                </p>

                <div class="contact-info">
                    <div class="contact-item">
                        <i class="bi bi-envelope-fill" style="color: #10b981;"></i>
                        {{ $team['email'] ?? 'email@mua.com' }}
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-linkedin" style="color: #0077b5;"></i>
                        LinkedIn Profile
                    </div>
                </div>

                <div>
                    <a href="{{ route('about') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Tim
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Simple Fade In Animation
        document.addEventListener("DOMContentLoaded", function() {
            const card = document.querySelector('.profile-card');
            card.style.opacity = "0";
            card.style.transform = "translateY(20px)";
            card.style.transition = "opacity 0.8s ease, transform 0.8s ease";

            setTimeout(() => {
                card.style.opacity = "1";
                card.style.transform = "translateY(0)";
            }, 100);
        });
    </script>
</body>

</html>
