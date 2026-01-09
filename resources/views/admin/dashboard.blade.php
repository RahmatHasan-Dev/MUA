<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: #f0fff4;
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

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            color: #2d6a4f;
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

        .status-select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .btn-update {
            padding: 5px 10px;
            background: #2d6a4f;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        /* Style untuk Kartu Analisis */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #2d6a4f;
        }

        .stat-card h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
        }

        .stat-card .value {
            font-size: 24px;
            font-weight: bold;
            color: #1b4332;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2><i class="bi bi-tree"></i>Admin MUA</h2><a href="#" class="active"><i
                class="bi bi-grid"></i>Dashboard</a><a href="#"><i class="bi bi-people"></i>Pengguna</a><a
            href="#"><i class="bi bi-newspaper"></i>Berita</a>
        <form method="POST" action="{{ route('logout') }}">@csrf <button type="submit" class="logout-btn"><i
                    class="bi bi-box-arrow-left"></i>Logout</button></form>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Dashboard Donasi</h1>
            <div>Selamat datang, Admin</div>
        </div>
        @if (session('success'))
            <div style="background: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }} </div>
        @endif
        <!-- Form Filter Tanggal -->
        <div class="card" style="margin-bottom: 20px;">
            <form action="{{ route('admin.dashboard') }}" method="GET"
                style="display: flex; gap: 15px; align-items: flex-end;">
                <div style="flex-grow: 1;"><label
                        style="display: block; margin-bottom: 5px; font-size: 14px; color: #666;">Cari
                        Donatur</label><input type="text" name="search" value="{{ request('search') }}"
                        class="status-select" style="width: 100%; box-sizing: border-box;"
                        placeholder="Nama donatur..."></div>
                <div><label style="display: block; margin-bottom: 5px; font-size: 14px; color: #666;">Dari
                        Tanggal</label><input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="status-select" style="width: 150px;"></div>
                <div><label style="display: block; margin-bottom: 5px; font-size: 14px; color: #666;">Sampai
                        Tanggal</label><input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="status-select" style="width: 150px;"></div><button type="submit" class="btn-update"
                    style="height: 38px; padding: 0 20px; font-size: 14px;"><i class="bi bi-filter"></i>Filter</button>
                @if (request('start_date'))
                    <a href="{{ route('admin.dashboard') }}" class="btn-update"
                        style="background: #6c757d; text-decoration: none; display: flex; align-items: center; height: 38px; padding: 0 20px; font-size: 14px;">Reset</a>
                @endif
                <a href="{{ route('admin.export', request()->all()) }}" class="btn-update"
                    style="background: #198754; text-decoration: none; display: flex; align-items: center; height: 38px; padding: 0 20px; font-size: 14px;">
                    <i class="bi bi-file-earmark-spreadsheet"></i>Export CSV</a>
            </form>
        </div>
        <!-- Bagian Analisis Data -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Donasi Terkumpul</h3>
                <div class="value">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #40916c;">
                <h3>Total Transaksi</h3>
                <div class="value">{{ $jumlahTransaksi }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #ffc107;">
                <h3>Menunggu Konfirmasi</h3>
                <div class="value">{{ $donasiPending }}</div>
            </div>
        </div>
        <!-- Grafik Tren Donasi -->
        <div class="card" style="margin-bottom: 30px;">
            <h3>Tren Donasi Bulanan</h3><canvas id="donationChart" style="width: 100%; height: 300px;"></canvas>
        </div>
        <div class="card">
            <h3>Daftar Donasi Masuk</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Donatur</th>
                        <th>Program</th>
                        <th>Nominal</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $donasi)
                        <tr>
                            <td>#{{ $donasi->id_donasi }}</td>
                            <td>{{ $donasi->tanggal->format('d M Y') }}</td>
                            <td><strong>{{ $donasi->user->nama ?? 'Guest' }}</strong><br><small
                                    style="color: #888">{{ $donasi->user->email ?? '-' }}</small></td>
                            <td style="text-transform: capitalize;">{{ $donasi->jenis }}</td>
                            <td>
                                <div id="nominal-display-{{ $donasi->id_donasi }}">Rp
                                    {{ number_format($donasi->nominal, 0, ',', '.') }} <button type="button"
                                        onclick="toggleEdit({{ $donasi->id_donasi }})"
                                        style="background:none; border:none; color:#2d6a4f; cursor:pointer; padding:0; margin-left:5px;"><i
                                            class="bi bi-pencil-square"></i></button></div>
                                <form id="nominal-form-{{ $donasi->id_donasi }}"
                                    action="{{ route('admin.donasi.update', $donasi->id_donasi) }}" method="POST"
                                    style="display:none; align-items:center; gap:5px;">@csrf
                                    @method('PUT') <input type="number" name="nominal"
                                        value="{{ $donasi->nominal }}"
                                        style="width: 100px; padding: 5px; border:1px solid #ddd; border-radius:4px;"><button
                                        type="submit" class="btn-update" style="padding: 5px;"><i
                                            class="bi bi-check"></i></button><button type="button"
                                        onclick="toggleEdit({{ $donasi->id_donasi }})" class="btn-update"
                                        style="background:#6c757d; padding: 5px;"><i class="bi bi-x"></i></button>
                                </form>
                            </td>
                            <td>
                                @if (!empty($donasi->bukti_transfer))
                                    <a href="{{ asset('storage/' . $donasi->bukti_transfer) }}" target="_blank"
                                        style="color: #2d6a4f; text-decoration: underline; font-size: 12px;">Lihat
                                        Bukti</a>
                                @else
                                    <span style="color: #999; font-size: 12px;">-</span>
                                @endif
                            </td>
                            <td><span
                                    class="badge {{ $donasi->status == 'berhasil' ? 'badge-success' : ($donasi->status == 'pending' ? 'badge-warning' : 'badge-danger') }}"
                                    style="background-color: {{ $donasi->status == 'pending' ? '#fff3cd' : '' }}; color: {{ $donasi->status == 'pending' ? '#856404' : '' }}">{{ ucfirst($donasi->status) }}
                                </span></td>
                            <td>
                                <form action="{{ route('admin.donasi.status', $donasi->id_donasi) }}" method="POST">
                                    @csrf @method('PATCH') <a href="{{ route('admin.show', $donasi->id_donasi) }}"
                                        class="btn-update"
                                        style="background: #17a2b8; color: white; text-decoration: none; display: inline-block; padding: 6px 8px; margin-right: 5px;"
                                        title="Lihat Detail"><i class="bi bi-eye"></i></a><select name="status"
                                        class="status-select">
                                        <option value="pending" {{ $donasi->status == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="berhasil"
                                            {{ $donasi->status == 'berhasil' ? 'selected' : '' }}>Berhasil
                                        </option>
                                        <option value="gagal" {{ $donasi->status == 'gagal' ? 'selected' : '' }}>
                                            Gagal
                                        </option>
                                    </select><button type="submit" class="btn-update">Update</button>
                                </form>
                            </td>
                    </tr>@empty <tr>
                            <td colspan="7" style="text-align: center;">Belum ada data donasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // Inisialisasi Chart.js
        const ctx = document.getElementById('donationChart').getContext('2d');
        const donationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Total Donasi (Rp)',
                    data: {!! json_encode($chartValues) !!},
                    backgroundColor: 'rgba(45, 106, 79, 0.2)',
                    borderColor: '#2d6a4f',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        function toggleEdit(id) {
            var display = document.getElementById('nominal-display-' + id);
            var form = document.getElementById('nominal-form-' + id);
            if (display.style.display === 'none') {
                display.style.display = 'block';
                form.style.display = 'none';
            } else {
                display.style.display = 'none';
                form.style.display = 'flex';
            }
        }
    </script>
</body>

</html>
