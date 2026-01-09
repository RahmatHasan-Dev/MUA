<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style src="https://cdn.jsdelivr.net/npm/chart.js">
        </script><style>body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: #f0f2f5;
        }

        .sidebar {
            width: 250px;
            background: #1b4332;
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: block;
            padding: 15px 25px;
            color: #d8f3dc;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2d6a4f;
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        /* Wallet Card Styles */
        .wallet-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .wallet-card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .wallet-card:hover {
            transform: translateY(-5px);
        }

        .wallet-card.primary {
            background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);
            color: white;
        }

        .wallet-card h3 {
            margin: 0 0 10px 0;
            font-size: 0.9rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .wallet-card .amount {
            font-size: 2.2rem;
            font-weight: 700;
        }

        .wallet-card .icon-bg {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 5rem;
            opacity: 0.1;
            transform: rotate(-15deg);
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            margin-bottom: 20px;
            border: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px 20px;
            text-align: left;
        }

        th {
            background-color: transparent;
            color: #888;
            font-weight: 600;
            font-size: 0.9rem;
            border-bottom: 2px solid #f0f0f0;
        }

        td {
            border-bottom: 1px solid #f0f0f0;
            color: #333;
            text-align: left;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #ff6b6b;
            cursor: pointer;
            padding: 15px 25px;
            width: 100%;
            text-align: left;
            font-size: 16px;
        }

        .logout-btn:hover {
            background: #2d6a4f;
            color: white;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2><i class="bi bi-tree"></i> Admin MUA</h2>
        <a href="#" class="active"><i class="bi bi-grid"></i> Dashboard</a>
        <a href="#"><i class="bi bi-people"></i> Pengguna</a>
        <a href="#"><i class="bi bi-newspaper"></i> Berita</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn"><i class="bi bi-box-arrow-left"></i> Logout</button>
        </form>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard Donasi</h1>
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="text-align: right;">
                    <div style="font-weight: bold;">Admin MUA</div>
                    <div style="font-size: 0.8rem; color: #888;">Administrator</div>
                </div>
                <div
                    style="width: 40px; height: 40px; background: #2d6a4f; border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
        </div>

        <!-- Wallet Cards -->
        <div class="wallet-cards">
            <div class="wallet-card primary">
                <h3>Total Saldo Donasi</h3>
                <div class="amount">Rp
                    {{ number_format($donations->where('status', 'berhasil')->sum('nominal'), 0, ',', '.') }}</div>
                <i class="bi bi-wallet2 icon-bg"></i>
            </div>
            <div class="wallet-card">
                <h3>Donasi Masuk</h3>
                <div class="amount" style="color: #2d6a4f;">{{ $donations->count() }} <span
                        style="font-size: 1rem; color: #888;">Transaksi</span></div>
                <i class="bi bi-arrow-down-left-circle icon-bg"></i>
            </div>
            <div class="wallet-card">
                <h3>Menunggu Konfirmasi</h3>
                <div class="amount" style="color: #f4a261;">{{ $donations->where('status', 'pending')->count() }} <span
                        style="font-size: 1rem; color: #888;">Pending</span></div>
                <i class="bi bi-hourglass-split icon-bg"></i>
            </div>
        </div>

        <div class="charts-grid">
            <div class="card">
                <h3>Tren Donasi Bulanan</h3>
                <canvas id="trendChart"></canvas>
            </div>
            <div class="card">
                <h3>Status Donasi</h3>
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3><i class="bi bi-receipt"></i> Mutasi Donasi</h3>

                <!-- Filter Tanggal -->
                <form action="{{ url()->current() }}" method="GET"
                    style="display: flex; gap: 5px; align-items: center;">
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        style="padding: 8px; border-radius: 5px; border: 1px solid #ddd;" title="Tanggal Mulai">
                    <span>-</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        style="padding: 8px; border-radius: 5px; border: 1px solid #ddd;" title="Tanggal Akhir">
                    <button type="submit" class="btn"
                        style="padding: 8px 12px; background: #2d6a4f; color: white; border: none; border-radius: 5px; cursor: pointer;"><i
                            class="bi bi-funnel"></i></button>
                </form>

                <!-- Input Pencarian Real-time -->
                <input type="text" id="searchInput" placeholder="Cari nama donatur..."
                    style="padding: 8px; border-radius: 5px; border: 1px solid #ddd; width: 200px; margin-right: 10px;">

                <!-- Form Export dengan Filter -->
                <form action="{{ route('admin.export') }}" method="GET" style="display: flex; gap: 10px;">
                    <select name="status" style="padding: 8px; border-radius: 5px; border: 1px solid #ddd;">
                        <option value="">Semua Status</option>
                        <option value="berhasil">Berhasil</option>
                        <option value="pending">Pending</option>
                        <option value="gagal">Gagal</option>
                    </select>

                    <!-- Bawa filter tanggal/search jika ada di URL saat ini (opsional, sederhana saja dulu) -->
                    @if (request('start_date'))
                        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    @endif
                    @if (request('end_date'))
                        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    @endif

                    <button type="submit"
                        style="background: #2d6a4f; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                        <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV
                    </button>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Waktu</th>
                        <th>Pengirim</th>
                        <th>Keperluan</th>
                        <th>Jumlah</th>
                        <th>Ket.</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="donationTableBody">
                    @include('admin.partials.donasi_rows')
                </tbody>
            </table>
        </div>

    </div>

    <script>
        // Konfigurasi Grafik Tren (Line Chart)
        const ctxTrend = document.getElementById('trendChart').getContext('2d');
        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Total Donasi (Rp)',
                    data: {!! json_encode($chartValues) !!},
                    borderColor: '#2d6a4f',
                    backgroundColor: 'rgba(45, 106, 79, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Konfigurasi Grafik Status (Pie Chart)
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($pieLabels) !!},
                datasets: [{
                    data: {!! json_encode($pieValues) !!},
                    backgroundColor: [
                        '#52b788', // Berhasil (Hijau)
                        '#f4a261', // Pending (Orange)
                        '#e76f51' // Gagal (Merah)
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Script Pencarian Real-time (AJAX)
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('donationTableBody');

        searchInput.addEventListener('keyup', function() {
            const query = this.value;
            // Menggunakan URL saat ini untuk request
            fetch(`{{ request()->url() }}?search=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    tableBody.innerHTML = html;
                });
        });
    </script>
</body>

</html>
