<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Laporan Pemasukan | MUA Admin</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" />
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
            padding: 58px 0 0;
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
    </style>
</head>

<body>
    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main layout -->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="card shadow-0 border">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 text-success"><strong><i class="fas fa-money-bill-wave me-2"></i>Laporan
                            Pemasukan</strong></h5>
                    <!-- Tombol Export -->
                    <a href="{{ route('admin.export', ['status' => 'berhasil']) }}"
                        class="btn btn-success btn-sm btn-rounded">Export CSV</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Donatur</th>
                                    <th>Program</th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($donations as $donasi)
                                    <tr>
                                        <td>#{{ $donasi->id_donasi }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-2">
                                                    <p class="fw-bold mb-1">{{ $donasi->user->nama ?? 'Guest' }}</p>
                                                    <p class="text-muted mb-0 small">{{ $donasi->user->email ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span
                                                class="badge badge-success rounded-pill d-inline">{{ ucfirst($donasi->jenis) }}</span>
                                        </td>
                                        <td class="text-success fw-bold">+ Rp
                                            {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($donasi->tanggal)->format('d M Y') }}</td>
                                        <td><span
                                                class="badge badge-success rounded-pill d-inline">{{ ucfirst($donasi->status) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data pemasukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $donations->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>
