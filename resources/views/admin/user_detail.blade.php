<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail User: {{ $user->nama }} | MUA Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
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
            width: 240px;
            z-index: 600;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%);
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%);
            background-color: #10b981 !important;
            color: white !important;
        }
    </style>
</head>

<body>
    @include('admin.partials.sidebar')

    <main style="margin-top: 58px">
        <div class="container pt-4">
            <!-- Tombol Kembali -->
            <a href="{{ route('admin.users') }}" class="btn btn-link text-dark mb-3 ps-0">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Users
            </a>

            <div class="row">
                <!-- Kartu Profil User -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-0 border text-center">
                        <div class="card-body">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=random&size=128"
                                class="rounded-circle mb-3 shadow-sm" alt="Avatar"
                                style="width: 100px; height: 100px;" />
                            <h5 class="mb-1"><strong>{{ $user->nama }}</strong></h5>
                            <p class="text-muted mb-2">{{ $user->email }}</p>

                            @if ($user->is_active)
                                <span class="badge badge-success rounded-pill">Aktif</span>
                            @else
                                <span class="badge badge-danger rounded-pill">Diblokir</span>
                            @endif
                            <span class="badge badge-info rounded-pill">{{ ucfirst($user->role) }}</span>

                            <hr>
                            <div class="text-start">
                                <p class="small text-muted mb-1"><i class="fas fa-phone me-2"></i>No HP</p>
                                <p class="fw-bold">{{ $user->no_hp ?? '-' }}</p>

                                <p class="small text-muted mb-1"><i class="fas fa-calendar me-2"></i>Bergabung Sejak</p>
                                <p class="fw-bold">
                                    {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d F Y') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Singkat -->
                    <div class="card shadow-0 border mt-3">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Statistik Donasi</h6>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Total Frekuensi</span>
                                <span class="fw-bold">{{ $user->donasi->count() }}x</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Total Nominal (Berhasil)</span>
                                <span class="fw-bold text-success">Rp
                                    {{ number_format($user->donasi->where('status', 'berhasil')->sum('nominal'), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Riwayat Donasi -->
                <div class="col-md-8 mb-4">
                    <div class="card shadow-0 border">
                        <div class="card-header border-bottom py-3">
                            <h5 class="mb-0"><strong><i class="fas fa-history me-2"></i>Riwayat Donasi</strong></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tanggal</th>
                                            <th>Program</th>
                                            <th>Nominal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($user->donasi as $donasi)
                                            <tr>
                                                <td>#{{ $donasi->id_donasi }}</td>
                                                <td>{{ \Carbon\Carbon::parse($donasi->tanggal)->format('d M Y') }}</td>
                                                <td>{{ ucfirst($donasi->jenis) }}</td>
                                                <td class="fw-bold">Rp
                                                    {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                                                <td>
                                                    @if ($donasi->status == 'berhasil')
                                                        <span class="badge badge-success rounded-pill">Berhasil</span>
                                                    @elseif($donasi->status == 'pending')
                                                        <span class="badge badge-warning rounded-pill">Pending</span>
                                                    @else
                                                        <span class="badge badge-danger rounded-pill">Gagal</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.show', $donasi->id_donasi) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat
                                                    donasi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>
