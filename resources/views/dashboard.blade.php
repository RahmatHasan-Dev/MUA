<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard Admin | MUA</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
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

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .card-ecommerce {
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .card-ecommerce:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <!--Main Navigation-->
    @include('admin.partials.sidebar')
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">

            <!-- Section: Statistics -->
            <section class="mb-4">
                <div class="row">
                    <!-- Total Donasi -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-ecommerce">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                            <i class="fas fa-hand-holding-usd text-success fa-2x"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">Total Donasi</p>
                                            <h5 class="mb-0 fw-bold">Rp {{ number_format($totalDonasi, 0, ',', '.') }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pengeluaran -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-ecommerce">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                                            <i class="fas fa-file-invoice-dollar text-danger fa-2x"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">Total Pengeluaran</p>
                                            <h5 class="mb-0 fw-bold">Rp
                                                {{ number_format($totalPengeluaran, 0, ',', '.') }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sisa Saldo -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-ecommerce">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                            <i class="fas fa-wallet text-primary fa-2x"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0">Sisa Saldo</p>
                                            <h5 class="mb-0 fw-bold">Rp {{ number_format($sisaSaldo, 0, ',', '.') }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menunggu / Pending -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}"
                            class="text-reset text-decoration-none">
                            <div class="card card-ecommerce">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                                                <i class="fas fa-clock text-warning fa-2x"></i>
                                            </div>
                                            <div>
                                                <p class="text-muted mb-0">Menunggu</p>
                                                <h5 class="mb-0 fw-bold">{{ $donasiPending }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Section: Charts -->
            <section class="mb-4">
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="card card-ecommerce h-100">
                            <div class="card-header border-0">
                                <h5 class="mb-0 text-center"><strong>Analisis Pemasukan</strong></h5>
                            </div>
                            <div class="card-body">
                                <canvas id="incomeChart" style="max-height: 350px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card card-ecommerce h-100">
                            <div class="card-header border-0">
                                <h5 class="mb-0 text-center"><strong>Status Donasi</strong></h5>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <canvas id="statusChart" style="max-height: 250px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section: Table -->
            <section class="mb-4">
                <div class="card card-ecommerce">
                    <div class="card-header border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><strong>Transaksi Terbaru</strong></h5>
                            <a href="{{ route('admin.pemasukan') }}"
                                class="btn btn-outline-success btn-sm btn-rounded">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Donatur</th>
                                        <th scope="col">Program</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Bukti</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donations as $donasi)
                                        <tr>
                                            <td><span class="fw-bold">#{{ $donasi->id_donasi }}</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2">
                                                        <p class="fw-bold mb-1">{{ $donasi->user->nama ?? 'Guest' }}
                                                        </p>
                                                        <p class="text-muted mb-0 small">
                                                            {{ $donasi->user->email ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-success rounded-pill d-inline">{{ ucfirst($donasi->jenis) }}</span>
                                            </td>
                                            <td>Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($donasi->tanggal)->format('d M Y') }}</td>
                                            <td>
                                                @if ($donasi->status == 'berhasil')
                                                    <span
                                                        class="badge badge-success rounded-pill d-inline">Berhasil</span>
                                                @elseif($donasi->status == 'pending')
                                                    <span
                                                        class="badge badge-warning rounded-pill d-inline">Pending</span>
                                                @else
                                                    <span class="badge badge-danger rounded-pill d-inline">Gagal</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($donasi->bukti_transfer)
                                                    <button type="button" class="btn btn-link btn-sm btn-rounded"
                                                        onclick="showProof('{{ asset('storage/' . $donasi->bukti_transfer) }}')">
                                                        Lihat
                                                    </button>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.show', $donasi->id_donasi) }}"
                                                    class="btn btn-link btn-sm btn-rounded">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <div class="text-muted small">
                                Showing {{ $donations->firstItem() }} to {{ $donations->lastItem() }} of
                                {{ $donations->total() }} results
                            </div>
                            <div>
                                {{ $donations->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!--Main layout-->

    <!-- Modal Bukti -->
    <div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proofModalLabel">Bukti Transfer</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="proofImage" src="" class="img-fluid rounded shadow-4" alt="Bukti Transfer">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

    <script>
        // Modal Logic
        const proofModal = new mdb.Modal(document.getElementById('proofModal'));

        function showProof(src) {
            document.getElementById('proofImage').src = src;
            proofModal.show();
        }

        // Charts
        const chartLabels = @json($chartLabels);
        const chartValues = @json($chartValues);
        const pieLabels = @json($pieLabels);
        const pieValues = @json($pieValues);

        // Income Chart
        new Chart(document.getElementById('incomeChart'), {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Pemasukan (Rp)',
                    data: chartValues,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        grid: {
                            borderDash: [2, 4],
                            color: '#f0f0f0'
                        },
                        beginAtZero: true
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Status Chart
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieValues,
                    backgroundColor: ['#10b981', '#fbbf24', '#ef4444'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '75%'
            }
        });
    </script>
</body>

</html>
