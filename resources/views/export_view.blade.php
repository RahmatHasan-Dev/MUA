<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Export Data | MUA Admin</title>
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

        /* Sidebar Active State - Green MUA Theme */
        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
            background-color: #10b981 !important;
            color: white !important;
        }
    </style>
</head>

<body>

    @include('admin.partials.sidebar')

    <main style="margin-top: 58px">
        <div class="container pt-4">
            <h4 class="mb-4 text-success"><strong>Export Data Donasi</strong></h4>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Export CSV -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-0 border">
                        <div class="card-header border-bottom py-3">
                            <h5 class="mb-0 text-success"><i class="fas fa-file-csv me-2"></i>Export CSV (Excel)</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.export') }}" method="GET">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Dari Tanggal</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sampai Tanggal</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="">Semua Status</option>
                                        <option value="berhasil">Berhasil</option>
                                        <option value="pending">Pending</option>
                                        <option value="gagal">Gagal</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Program</label>
                                    <select name="jenis" class="form-select">
                                        <option value="">Semua Program</option>
                                        <option value="satwa">Satwa</option>
                                        <option value="karang">Karang</option>
                                        <option value="bakau">Bakau</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Download CSV</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Export PDF -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-0 border">
                        <div class="card-header border-bottom py-3">
                            <h5 class="mb-0 text-danger"><i class="fas fa-file-pdf me-2"></i>Export Laporan PDF</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.export.pdf') }}" method="GET">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Dari Tanggal</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sampai Tanggal</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                </div>
                                <div class="alert alert-info small">
                                    <i class="fas fa-info-circle me-1"></i> PDF akan mencetak laporan ringkas siap cetak
                                    berdasarkan rentang tanggal yang dipilih.
                                </div>
                                <button type="submit" class="btn btn-danger btn-block">Download PDF</button>
                                <button type="submit" formaction="{{ route('admin.export.pdf.email') }}"
                                    class="btn btn-warning btn-block mt-2"><i class="fas fa-envelope me-2"></i>Kirim ke
                                    Email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>
