<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $partnership->name }} | Partner MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding-top: 80px;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .detail-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px;
            text-align: center;
        }

        .partner-logo {
            max-width: 300px;
            max-height: 200px;
            object-fit: contain;
            margin-bottom: 30px;
        }

        .partner-name {
            font-size: 2.5rem;
            font-weight: 800;
            color: #065f46;
            margin-bottom: 15px;
        }

        .partner-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .badge-eksklusif {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-reguler {
            background: #e5e7eb;
            color: #4b5563;
        }

        .badge-pengawasan {
            background: #dbeafe;
            color: #2563eb;
        }

        .partner-desc {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #4b5563;
            max-width: 800px;
            margin-bottom: 40px;
        }

        .btn-visit {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 40px;
            background: #10b981;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
        }

        .btn-visit:hover {
            background: #059669;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    <div class="container">
        <div class="detail-card">
            @php
                $logoUrl = \Illuminate\Support\Str::startsWith($partnership->logo, 'images/')
                    ? asset($partnership->logo)
                    : asset('storage/' . $partnership->logo);
            @endphp
            <img src="{{ $logoUrl }}" alt="{{ $partnership->name }}" class="partner-logo">

            <h1 class="partner-name">{{ $partnership->name }}</h1>
            <span
                class="partner-badge badge-{{ strtolower($partnership->kategori) }}">{{ $partnership->kategori }}</span>

            <p class="partner-desc">{{ $partnership->description }}</p>

            @if ($partnership->website_url)
                <a href="{{ $partnership->website_url }}" target="_blank" class="btn-visit">
                    Kunjungi Website Resmi <i class="bi bi-box-arrow-up-right"></i>
                </a>
            @endif
        </div>
    </div>

    @include('partials.footer')
</body>

</html>
