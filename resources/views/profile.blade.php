<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Menadah Untuk Alam</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- CSS Utama -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Wrapper untuk konten utama agar tidak tertutup navbar fixed */
        .main-wrapper {
            flex: 1;
            padding-top: 120px;
            /* Sesuaikan dengan tinggi navbar */
            padding-bottom: 60px;
        }

        .profile-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .profile-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 40px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 1px solid #f3f4f6;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #d1fae5;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
        }

        .profile-info h1 {
            font-size: 1.8rem;
            color: #065f46;
            margin-bottom: 5px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .profile-info p {
            color: #6b7280;
            font-size: 1rem;
        }

        .role-badge {
            display: inline-block;
            background: #d1fae5;
            color: #059669;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <!-- Include Navbar -->
    @include('partials.navbar')

    <div class="main-wrapper">
        <div class="profile-container">
            <!-- Konten Profil akan dirender di sini -->
            @yield('content')
        </div>
    </div>

    <!-- Include Footer -->
    @include('partials.footer')

</body>

</html>
