<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih | MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0fdf4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .success-card {
            background: white;
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(16, 185, 129, 0.15);
            text-align: center;
            max-width: 500px;
            width: 90%;
            position: relative;
            z-index: 10;
            animation: popUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: #d1fae5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            position: relative;
        }

        .icon-wrapper i {
            font-size: 3.5rem;
            color: #10b981;
            animation: checkmark 0.8s ease-in-out forwards;
        }

        h1 {
            color: #064e3b;
            font-size: 2rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        p {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 1.05rem;
        }

        .btn-home {
            display: inline-block;
            padding: 15px 35px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.4);
        }

        @keyframes popUp {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes checkmark {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>

    <div class="success-card">
        <div class="icon-wrapper">
            <i class="bi bi-check-lg"></i>
        </div>
        <h1>Terima Kasih!</h1>
        <p>
            Kebaikan Anda telah kami terima. <br>
            Semoga menjadi berkah untuk alam dan kehidupan kita semua.
        </p>
        <a href="{{ route('donasi') }}" class="btn-home">
            <i class="bi bi-arrow-left"></i> Kembali ke Donasi
        </a>
    </div>

    <script>
        // Jalankan animasi confetti saat halaman dimuat
        window.onload = function() {
            // Efek ledakan confetti dari tengah
            var duration = 3 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = {
                startVelocity: 30,
                spread: 360,
                ticks: 60,
                zIndex: 0
            };

            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }

            var interval = setInterval(function() {
                var timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                var particleCount = 50 * (timeLeft / duration);

                // Confetti dari kiri dan kanan
                confetti(Object.assign({}, defaults, {
                    particleCount,
                    origin: {
                        x: randomInRange(0.1, 0.3),
                        y: Math.random() - 0.2
                    }
                }));
                confetti(Object.assign({}, defaults, {
                    particleCount,
                    origin: {
                        x: randomInRange(0.7, 0.9),
                        y: Math.random() - 0.2
                    }
                }));
            }, 250);

            // Tembakan confetti tambahan yang elegan (warna hijau & emas)
            setTimeout(() => {
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: {
                        y: 0.6
                    },
                    colors: ['#10b981', '#059669', '#FFD700'] // Hijau & Emas
                });
            }, 500);
        };
    </script>
</body>

</html>
