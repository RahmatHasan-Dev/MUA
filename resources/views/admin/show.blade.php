<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail Donasi #{{ $donasi->id_donasi }} | MUA Admin</title>
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
    </style>
</head>

<body>
    <header>
        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        @include('admin.partials.navbar-admin')
    </header>

    <!-- Main layout -->
    <main style="margin-top: 76px">
        <div class="container pt-4">
            <!-- Tombol Kembali -->
            <div class="mb-3">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-success shadow-0">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
                </a>
            </div>
            <div class="row">
                <!-- Detail Donasi -->
                <div class="col-md-8 mb-4">
                    <div class="card shadow-0 border">
                        <div class="card-header border-bottom py-3">
                            <h5 class="mb-0 text-success"><strong>Detail Donasi #{{ $donasi->id_donasi }}</strong></h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Donatur</p>
                                    <p class="fw-bold">{{ $donasi->user->nama ?? 'Guest' }}</p>
                                    <p class="text-muted small">{{ $donasi->user->email ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Tanggal</p>
                                    <p class="fw-bold">
                                        {{ \Carbon\Carbon::parse($donasi->tanggal)->format('d F Y H:i') }}</p>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Nominal</p>
                                    <h4 class="text-success fw-bold">Rp
                                        {{ number_format($donasi->nominal, 0, ',', '.') }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Metode Pembayaran</p>
                                    <p class="fw-bold">{{ $donasi->metode_pembayaran ?? 'Transfer Bank' }}</p>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <p class="text-muted mb-1">Catatan Admin</p>
                                    <p class="fw-bold">{{ $donasi->catatan ?? '-' }}</p>
                                </div>
                            </div>
                            <hr>
                            <p class="fw-bold mb-3">Bukti Transfer</p>
                            @if ($donasi->bukti_transfer)
                                <img src="{{ asset('storage/' . $donasi->bukti_transfer) }}"
                                    class="img-fluid rounded shadow-sm" alt="Bukti Transfer"
                                    style="max-height: 500px; width: auto;">
                            @else
                                <div class="alert alert-warning">Tidak ada bukti transfer yang diunggah.</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Form Update Status -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-0 border">
                        <div class="card-header border-bottom py-3">
                            <h5 class="mb-0"><strong>Status Donasi</strong></h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('admin.donasi.status', $donasi->id_donasi) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="mb-4">
                                    <label class="form-label">Status Saat Ini</label>
                                    <select name="status" class="form-select">
                                        <option value="pending" {{ $donasi->status == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="berhasil" {{ $donasi->status == 'berhasil' ? 'selected' : '' }}>
                                            Berhasil</option>
                                        <option value="gagal" {{ $donasi->status == 'gagal' ? 'selected' : '' }}>Gagal
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Catatan (Opsional)</label>
                                    <textarea name="catatan" class="form-control" rows="3" placeholder="Alasan perubahan status...">{{ $donasi->catatan }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-success btn-block">Update Status</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>
