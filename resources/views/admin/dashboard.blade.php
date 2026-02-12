<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - MUA</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <!-- amCharts 4 -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- amCharts 5 -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 76px 0 0;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
            background-color: #10b981 !important;
            color: white !important;
        }

        .card-stat {
            transition: transform 0.3s;
        }

        .card-stat:hover {
            transform: translateY(-5px);
        }

        /* Animasi Berkilau untuk Widget Embun */
        @keyframes shimmer {
            0% {
                opacity: 0.7;
                filter: drop-shadow(0 0 3px rgba(13, 202, 240, 0.4));
            }

            50% {
                opacity: 1;
                filter: drop-shadow(0 0 10px rgba(13, 202, 240, 0.8));
            }

            100% {
                opacity: 0.7;
                filter: drop-shadow(0 0 3px rgba(13, 202, 240, 0.4));
            }
        }

        .shimmer-icon {
            animation: shimmer 3s infinite;
        }

        /* Live Feed Styling */
        .live-feed-container {
            display: flex;
            align-items: center;
            background: #064e3b;
            /* Dark green background */
            border-radius: 50px;
            /* Pill shape */
            padding: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }

        .live-feed-label {
            display: flex;
            align-items: center;
            gap: 8px;
            background-color: #dc3545;
            /* Red for 'live' */
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 0.8rem;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .live-feed-label .live-dot {
            width: 8px;
            height: 8px;
            background-color: white;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }

        .scrolling-wrapper {
            flex-grow: 1;
            overflow: hidden;
        }

        .scrolling-content {
            display: flex;
            width: max-content;
            animation: scroll 20s linear infinite;
            /* Atur kecepatan di sini (misal: 30s = Cepat, 80s = Lambat) */
        }

        .scrolling-content:hover {
            animation-play-state: paused;
        }

        @keyframes scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .feed-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 20px;
            margin: 0 15px;
            /* Spacing between items */
            border-radius: 50px;
            color: #e0e7ff;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .feed-item i {
            color: #34d399;
            /* Lighter green for icon */
        }

        .feed-item strong {
            color: #ffffff;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <header>
        @include('admin.partials.sidebar')
        @include('admin.partials.navbar-admin')
    </header>

    <main style="margin-top: 76px;">
        <div class="container pt-4">
            <!-- Hero Dashboard Section (Creative Replacement for Filter) -->
            <div class="card shadow-sm mb-4 overflow-hidden" style="border-radius: 15px; border: none;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Left: Greeting & Status -->
                        <div class="col-md-8 p-4 text-white d-flex flex-column justify-content-center"
                            style="background: linear-gradient(135deg, #065f46 0%, #10b981 100%); position: relative; overflow: hidden;">
                            <!-- Decorative Circle -->
                            <div
                                style="position: absolute; top: -30px; right: -30px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;">
                            </div>
                            <div style="position: relative; z-index: 1;">
                                <h4 class="fw-bold mb-2">Halo, {{ Auth::user()->nama ?? 'Admin' }}! 👋</h4>
                                <p class="mb-4 opacity-90" style="font-size: 1.05rem;">
                                    @if ($donasiPending > 0)
                                        Ada <span class="fw-bold text-warning px-2 py-1 rounded"
                                            style="background: rgba(0,0,0,0.3);">{{ $donasiPending }} donasi
                                            pending</span> yang menunggu persetujuan Anda hari ini.
                                    @else
                                        Semua aman terkendali! Tidak ada donasi pending saat ini. Waktunya fokus pada
                                        strategi kampanye baru?
                                    @endif
                                </p>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('admin.pemasukan') }}"
                                        class="btn btn-light shadow-sm text-success fw-bold px-4"><i
                                            class="fas fa-check-circle me-2"></i>Cek Donasi</a>
                                    <a href="{{ route('admin.campaign.add') }}"
                                        class="btn btn-outline-light fw-bold px-4"><i class="fas fa-plus me-2"></i>Buat
                                        Kampanye</a>
                                </div>

                                <!-- Widgets Container -->
                                <div class="d-flex flex-wrap gap-3 mt-4">
                                    <!-- Weather Widget -->
                                    <div id="weather-widget"
                                        class="d-flex align-items-center bg-white bg-opacity-10 p-2 rounded"
                                        style="width: fit-content; backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.2);">
                                        <div id="weather-icon" class="me-3" style="font-size: 1.5rem;">🌤️</div>
                                        <div class="text-white">
                                            <div id="weather-temp" class="fw-bold" style="font-size: 0.9rem;">Memuat...
                                            </div>
                                            <div id="weather-desc" class="small opacity-75" style="font-size: 0.75rem;">
                                                Lokasi: Indonesia</div>
                                        </div>
                                    </div>

                                    <!-- Tetesan Embun Pagi Widget (NEW) -->
                                    <div class="d-flex align-items-center bg-white bg-opacity-10 p-2 rounded"
                                        style="width: fit-content; backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.2);">
                                        <div class="me-3 text-center" style="width: 40px;">
                                            <i class="fas fa-tint text-info shimmer-icon"
                                                style="font-size: 1.5rem;"></i>
                                        </div>
                                        <div class="text-white">
                                            <div class="fw-bold" style="font-size: 0.9rem;">Tetesan Embun Pagi</div>
                                            <div class="small opacity-90" style="font-size: 0.75rem;">
                                                +Rp {{ number_format($todayIncome ?? 0, 0, ',', '.') }}
                                                <span class="text-white-50 mx-1">|</span>
                                                {{ $todayCount ?? 0 }} Tetesan
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Right: Impact Visualizer -->
                        <div
                            class="col-md-4 p-4 bg-white d-flex flex-column justify-content-center align-items-center text-center position-relative">
                            <h6 class="text-muted text-uppercase small fw-bold mb-3" style="letter-spacing: 1px;">
                                Estimasi Dampak Nyata</h6>
                            <!-- Mock calculation: Rp 50.000 = 1 Pohon (Bisa disesuaikan logikanya) -->
                            @php $trees = floor($totalDonasi / 50000); @endphp
                            <div class="d-flex align-items-baseline mb-1">
                                <!-- Added ID and data-target for animation -->
                                <h1 id="tree-counter" class="fw-bold text-success mb-0 display-4 me-2"
                                    data-target="{{ $trees }}">0</h1>
                            </div>
                            <p class="text-muted fw-bold mb-3">Pohon Terdanai 🌳</p>

                            <!-- Mini Visuals -->
                            <div class="d-flex justify-content-center gap-3 text-success opacity-50">
                                <i class="fas fa-seedling fa-2x"></i>
                                <i class="fas fa-tree fa-2x"></i>
                                <i class="fas fa-leaf fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Live Feed Section (Elegant Version) -->
            <div class="live-feed-container">
                <div class="live-feed-label">
                    <div class="live-dot"></div>
                    <span>Live</span>
                </div>
                <div class="scrolling-wrapper">
                    <div class="scrolling-content">
                        @if ($todayDonors->isNotEmpty())
                            <!-- Loop twice for seamless animation -->
                            @foreach (range(1, 2) as $_)
                                @foreach ($todayDonors as $donor)
                                    <div class="feed-item">
                                        <i class="fas fa-leaf"></i>
                                        <span><strong>{{ Str::limit($donor->user->nama ?? 'Donatur Tamu', 20) }}</strong>
                                            baru saja berdonasi <strong>Rp
                                                {{ number_format($donor->nominal, 0, ',', '.') }}</strong></span>
                                    </div>
                                @endforeach
                            @endforeach
                        @else
                            <div class="feed-item">
                                <i class="fas fa-moon"></i>
                                <span>Belum ada donasi hari ini. Suasana masih tenang...</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stat border-start border-4 border-success shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Total Donasi</p>
                                    <h5 class="mb-0 fw-bold text-success">Rp
                                        {{ number_format($totalDonasi, 0, ',', '.') }}</h5>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-hand-holding-usd fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stat border-start border-4 border-danger shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Pengeluaran</p>
                                    <h5 class="mb-0 fw-bold text-danger">Rp
                                        {{ number_format($totalPengeluaran, 0, ',', '.') }}</h5>
                                </div>
                                <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-file-invoice-dollar fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stat border-start border-4 border-primary shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Sisa Saldo</p>
                                    <h5 class="mb-0 fw-bold text-primary">Rp
                                        {{ number_format($sisaSaldo, 0, ',', '.') }}</h5>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-wallet fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stat border-start border-4 border-warning shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Donasi Pending</p>
                                    <h5 class="mb-0 fw-bold text-warning">{{ $donasiPending }}</h5>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-clock fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row mb-4">
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-success"><i class="fas fa-chart-line me-2"></i>Analisis Arus
                                Kas (Combo Chart)</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-success"><i class="fas fa-chart-pie me-2"></i>Status Donasi
                                (3D
                                Pie)</h5>
                        </div>
                        <div class="card-body">
                            <div id="statusChart" style="height: 200px;"></div>
                            <div class="mt-3 pt-4 border-top">
                                <h6 class="text-muted small text-uppercase fw-bold mb-3">Rincian Status</h6>
                                @php $totalStatus = array_sum($pieValues); @endphp
                                @foreach ($pieLabels as $index => $label)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <span
                                                style="width: 10px; height: 10px; border-radius: 50%; background-color: {{ $pieColors[$index] }}; display: inline-block; margin-right: 8px;"></span>
                                            <span class="text-dark">{{ $label }}</span>
                                        </div>
                                        <div class="text-end">
                                            <span class="fw-bold">{{ $pieValues[$index] }}</span>
                                            <small class="text-muted ms-1"
                                                style="font-size: 0.85rem;">({{ $totalStatus > 0 ? number_format(($pieValues[$index] / $totalStatus) * 100, 1) : 0 }}%)</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Charts Row: Area & Bubble -->
            <div class="row mb-4">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-chart-area me-2"></i>Tren
                                Pertumbuhan
                                User (Area Chart)</h5>
                        </div>
                        <div class="card-body">
                            <div id="areaChartContainer" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-warning"><i class="fas fa-braille me-2"></i>Analisis Keuangan
                                (Multidimensi)</h5>
                        </div>
                        <div class="card-body">
                            <div id="bubbleChartContainer" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daily Chart Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-success"><i class="fas fa-chart-bar me-2"></i>Statistik Donasi Harian
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="dailyChart" style="max-height: 350px;"></canvas>
                </div>
            </div>

            <!-- Recent Donations Table -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-success"><i class="fas fa-list me-2"></i>Donasi Terbaru</h5>
                    <a href="{{ route('admin.export') }}" class="btn btn-sm btn-success"><i
                            class="fas fa-file-export me-2"></i>Export CSV</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Donatur</th>
                                    <th>Program</th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donations as $donasi)
                                    <tr>
                                        <td>#{{ $donasi->id_donasi }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $donasi->user->nama ?? 'Guest' }}</div>
                                            <small class="text-muted">{{ $donasi->user->email ?? '-' }}</small>
                                        </td>
                                        <td><span class="badge bg-info text-dark">{{ ucfirst($donasi->jenis) }}</span>
                                        </td>
                                        <td class="fw-bold text-success">Rp
                                            {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($donasi->tanggal)->format('d M Y') }}</td>
                                        <td>
                                            @if ($donasi->status == 'berhasil')
                                                <span class="badge bg-success">Berhasil</span>
                                            @elseif($donasi->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Gagal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.show', $donasi->id_donasi) }}"
                                                class="btn btn-sm btn-primary shadow-0">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data donasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $donations->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

    <!-- Chart Scripts -->
    <script>
        // --- 1. Counter Animation (Pohon Terdanai) ---
        document.addEventListener("DOMContentLoaded", () => {
            const counter = document.getElementById('tree-counter');
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 detik
            const start = 0;
            let startTime = null;

            function animate(currentTime) {
                if (!startTime) startTime = currentTime;
                const progress = Math.min((currentTime - startTime) / duration, 1);

                // Easing function (easeOutExpo)
                const ease = 1 - Math.pow(2, -10 * progress);

                const currentVal = Math.floor(ease * (target - start) + start);
                counter.innerText = new Intl.NumberFormat('id-ID').format(currentVal);

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    counter.innerText = new Intl.NumberFormat('id-ID').format(target);
                }
            }
            requestAnimationFrame(animate);
        });

        // --- 2. Weather Widget (Real Location) ---
        function initWeather() {
            const tempEl = document.getElementById('weather-temp');
            const descEl = document.getElementById('weather-desc');
            const iconEl = document.getElementById('weather-icon');

            function updateWeather(lat, lon, locationName) {
                fetch(
                        `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true&timezone=auto`
                    )
                    .then(response => response.json())
                    .then(data => {
                        const temp = data.current_weather.temperature;
                        const code = data.current_weather.weathercode;
                        let icon = '🌤️';
                        let desc = 'Cerah';

                        if (code > 3) {
                            icon = '☁️';
                            desc = 'Berawan';
                        }
                        if (code > 45) {
                            icon = '🌧️';
                            desc = 'Gerimis';
                        }
                        if (code > 60) {
                            icon = '⛈️';
                            desc = 'Hujan';
                        }
                        if (code > 80) {
                            icon = '🌩️';
                            desc = 'Badai';
                        }

                        tempEl.innerText = `${temp}°C - ${desc}`;
                        descEl.innerText = `Lokasi: ${locationName}`;
                        iconEl.innerText = icon;
                    })
                    .catch(() => {
                        tempEl.innerText = "Gagal memuat";
                    });
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;
                        // Get City Name
                        fetch(
                                `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=id`
                            )
                            .then(res => res.json())
                            .then(data => {
                                const city = data.city || data.locality || "Lokasi Anda";
                                updateWeather(lat, lon, city);
                            })
                            .catch(() => updateWeather(lat, lon, "Lokasi Terdeteksi"));
                    },
                    () => updateWeather(-6.2088, 106.8456, "Jakarta (Default)")
                );
            } else {
                updateWeather(-6.2088, 106.8456, "Jakarta (Default)");
            }
        }
        initWeather();

        // Helper untuk format Rupiah di Tooltip
        const formatRupiah = (value) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);
        };

        // 1. Combo Chart (Arus Kas: Bar Pemasukan/Pengeluaran + Line Saldo + Line Target)
        const ctxTrend = document.getElementById('trendChart').getContext('2d');

        // Gradient untuk Pemasukan
        const gradientIncome = ctxTrend.createLinearGradient(0, 0, 0, 400);
        gradientIncome.addColorStop(0, 'rgba(16, 185, 129, 0.8)'); // Green top
        gradientIncome.addColorStop(1, 'rgba(16, 185, 129, 0.1)'); // Green bottom

        new Chart(ctxTrend, {
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    type: 'bar',
                    label: 'Pemasukan',
                    data: {!! json_encode($incomeValues) !!},
                    backgroundColor: gradientIncome,
                    borderColor: '#10b981',
                    borderWidth: 1,
                    borderRadius: 5,
                    order: 3
                }, {
                    type: 'bar',
                    label: 'Pengeluaran',
                    data: {!! json_encode($expenseValues) !!},
                    backgroundColor: 'rgba(239, 68, 68, 0.7)', // Red
                    borderColor: '#ef4444',
                    borderWidth: 1,
                    borderRadius: 5,
                    order: 4
                }, {
                    type: 'line',
                    label: 'Net Saldo (Selisih)',
                    data: {!! json_encode($balanceValues) !!},
                    borderColor: '#3b82f6', // Blue
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: false,
                    order: 2
                }, {
                    type: 'line',
                    label: 'Target Bulanan',
                    data: {!! json_encode($targetValues) !!},
                    borderColor: '#fbbf24', // Yellow/Gold
                    borderWidth: 2,
                    borderDash: [5, 5], // Garis putus-putus
                    pointRadius: 0,
                    fill: false,
                    order: 1
                }]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + formatRupiah(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 2]
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // 2. Status Donasi Chart (Highcharts 3D Pie)
        const pieLabels = {!! json_encode($pieLabels) !!};
        const pieValues = {!! json_encode($pieValues) !!};
        const pieColors = {!! json_encode($pieColors) !!};

        const highchartsData = pieLabels.map((label, index) => {
            return {
                name: label,
                y: pieValues[index],
                color: pieColors[index]
            };
        });

        Highcharts.chart('statusChart', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                },
                backgroundColor: 'transparent'
            },
            title: {
                text: null
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Status',
                data: highchartsData
            }],
            credits: {
                enabled: false
            }
        });

        // 3. Daily Chart (Bar Chart - Tetap)
        const ctxDaily = document.getElementById('dailyChart').getContext('2d');
        new Chart(ctxDaily, {
            type: 'bar',
            data: {
                labels: {!! json_encode($dailyLabels) !!},
                datasets: [{
                    label: 'Donasi Harian (Rp)',
                    data: {!! json_encode($dailyValues) !!},
                    backgroundColor: '#10b981',
                    borderRadius: 4,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 4],
                            color: '#f0f0f0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // 4. User Growth Chart (amCharts 5 - Draggable Range)
        am5.ready(function() {
            var root = am5.Root.new("areaChartContainer");
            root.setThemes([am5themes_Animated.new(root)]);

            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0
            }));

            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineX.set("forceHidden", true);
            cursor.lineY.set("forceHidden", true);

            // Real Data from Controller
            var data = [
                @foreach ($areaLabels as $i => $label)
                    {
                        date: new Date("{{ $label }}").getTime(),
                        value: {{ $areaValues[$i] }}
                    },
                @endforeach
            ];

            var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                baseInterval: {
                    timeUnit: "month",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true,
                    minGridDistance: 90
                })
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));

            var series = chart.series.push(am5xy.LineSeries.new(root, {
                name: "Total User",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY} User"
                })
            }));

            series.fills.template.setAll({
                fillOpacity: 0.2,
                visible: true
            });

            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));

            series.data.setAll(data);
            series.appear(1000);
            chart.appear(1000, 100);
        });

        // 5. Donation Time Distribution (amCharts 5 - Multidimensi)
        am5.ready(function() {
            var root = am5.Root.new("bubbleChartContainer");
            root.setThemes([am5themes_Animated.new(root)]);
            root.dateFormatter.setAll({
                dateFormat: "yyyy-MM-dd",
                dateFields: ["valueX"]
            });

            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                layout: root.verticalLayout
            }));

            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "zoomX"
            }));
            cursor.lineY.set("visible", false);

            // Real Data from Controller (Financial Analysis)
            var data = [
                @foreach ($chartLabels as $i => $label)
                    {
                        date: "{{ \Carbon\Carbon::parse($label)->format('Y-m-d') }}",
                        market0: {{ $balanceValues[$i] }}, // Saldo
                        market1: {{ $targetValues[$i] }}, // Target
                        sales0: {{ $expenseValues[$i] }}, // Pengeluaran
                        sales1: {{ $incomeValues[$i] }} // Pemasukan
                    },
                @endforeach
            ];

            var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                baseInterval: {
                    timeUnit: "month",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true
                }),
                tooltip: am5.Tooltip.new(root, {}),
                tooltipDateFormat: "yyyy-MM-dd"
            }));

            var yAxis0 = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {
                    pan: "zoom"
                })
            }));

            var yRenderer1 = am5xy.AxisRendererY.new(root, {
                opposite: true
            });
            yRenderer1.grid.template.set("forceHidden", true);
            var yAxis1 = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: yRenderer1,
                syncWithAxis: yAxis0
            }));

            var columnSeries1 = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Pemasukan",
                xAxis: xAxis,
                yAxis: yAxis0,
                valueYField: "sales1",
                valueXField: "date",
                clustered: false,
                tooltip: am5.Tooltip.new(root, {
                    pointerOrientation: "horizontal",
                    labelText: "{name}: {valueY}"
                })
            }));
            columnSeries1.columns.template.setAll({
                width: am5.percent(60),
                fillOpacity: 0.5,
                strokeOpacity: 0
            });
            columnSeries1.data.processor = am5.DataProcessor.new(root, {
                dateFields: ["date"],
                dateFormat: "yyyy-MM-dd"
            });

            var columnSeries0 = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Pengeluaran",
                xAxis: xAxis,
                yAxis: yAxis0,
                valueYField: "sales0",
                valueXField: "date",
                clustered: false,
                tooltip: am5.Tooltip.new(root, {
                    pointerOrientation: "horizontal",
                    labelText: "{name}: {valueY}"
                })
            }));
            columnSeries0.columns.template.set("width", am5.percent(40));

            var series0 = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
                name: "Saldo Bersih",
                xAxis: xAxis,
                yAxis: yAxis1,
                valueYField: "market0",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    pointerOrientation: "horizontal",
                    labelText: "{name}: {valueY}"
                })
            }));
            series0.strokes.template.setAll({
                strokeWidth: 2
            });
            series0.bullets.push(function() {
                return am5.Bullet.new(root, {
                    sprite: am5.Circle.new(root, {
                        stroke: series0.get("fill"),
                        strokeWidth: 2,
                        fill: root.interfaceColors.get("background"),
                        radius: 5
                    })
                });
            });

            var series1 = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
                name: "Target",
                xAxis: xAxis,
                yAxis: yAxis1,
                valueYField: "market1",
                valueXField: "date"
            }));
            series1.strokes.template.setAll({
                strokeWidth: 2,
                strokeDasharray: [2, 2]
            });
            var tooltip1 = series1.set("tooltip", am5.Tooltip.new(root, {
                pointerOrientation: "horizontal"
            }));
            tooltip1.label.set("text", "{name}: {valueY}");
            series1.bullets.push(function() {
                return am5.Bullet.new(root, {
                    sprite: am5.Circle.new(root, {
                        stroke: series1.get("fill"),
                        strokeWidth: 2,
                        fill: root.interfaceColors.get("background"),
                        radius: 5
                    })
                });
            });

            var scrollbar = chart.set("scrollbarX", am5xy.XYChartScrollbar.new(root, {
                orientation: "horizontal",
                height: 60
            }));
            var sbDateAxis = scrollbar.chart.xAxes.push(am5xy.DateAxis.new(root, {
                baseInterval: {
                    timeUnit: "month",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {})
            }));
            var sbValueAxis0 = scrollbar.chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));
            var sbValueAxis1 = scrollbar.chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));
            var sbSeries0 = scrollbar.chart.series.push(am5xy.ColumnSeries.new(root, {
                valueYField: "sales0",
                valueXField: "date",
                xAxis: sbDateAxis,
                yAxis: sbValueAxis0
            }));
            sbSeries0.columns.template.setAll({
                fillOpacity: 0.5,
                strokeOpacity: 0
            });
            var sbSeries1 = scrollbar.chart.series.push(am5xy.LineSeries.new(root, {
                valueYField: "market0",
                valueXField: "date",
                xAxis: sbDateAxis,
                yAxis: sbValueAxis1
            }));

            var legend = chart.children.push(am5.Legend.new(root, {
                x: am5.p50,
                centerX: am5.p50
            }));
            legend.data.setAll(chart.series.values);

            columnSeries1.data.setAll(data);
            columnSeries0.data.setAll(data);
            series0.data.setAll(data);
            series1.data.setAll(data);
            sbSeries0.data.setAll(data);
            sbSeries1.data.setAll(data);

            series0.appear(1000);
            series1.appear(1000);
            chart.appear(1000, 100);
        });
    </script>
</body>

</html>
