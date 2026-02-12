<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools System | MUA Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
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
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            background-color: #10b981 !important;
            color: white !important;
        }
    </style>
</head>

<body>
    @include('admin.partials.sidebar')

    <main style="margin-top: 58px">
        <div class="container pt-4">
            <h4 class="mb-4 text-primary"><strong>System Tools</strong></h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <!-- Clear Cache -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-broom fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Clear Cache</h5>
                            <p class="card-text">Bersihkan cache aplikasi, route, dan view jika terjadi error tampilan.
                            </p>
                            <form action="{{ route('admin.tools.cache') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">Jalankan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Backup Database -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-database fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Backup Database</h5>
                            <p class="card-text">Download seluruh data database dalam format JSON.</p>
                            <form action="{{ route('admin.tools.backup') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info">Download Backup</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Test Email -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-envelope-open-text fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Test Email</h5>
                            <p class="card-text">Kirim email percobaan ke <strong>{{ auth()->user()->email }}</strong>.
                            </p>
                            <form action="{{ route('admin.tools.email') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Kirim Test</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Fix Storage Link -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-link fa-3x text-secondary mb-3"></i>
                            <h5 class="card-title">Perbaiki Storage Link</h5>
                            <p class="card-text">Gunakan ini jika gambar tidak muncul (broken image).</p>
                            <form action="{{ route('admin.tools.fix-storage') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Perbaiki Link</button>
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
