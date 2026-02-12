<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Partnership - Admin MUA</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        }
    </style>
</head>

<body>
    <!--Main Navigation-->
    @include('admin.partials.sidebar')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Partnership Baru</h5>
                        </div>
                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.partnerships.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Nama -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-lg" value="{{ old('name') }}" required />
                                    <label class="form-label" for="name">Nama Partner / Perusahaan</label>
                                </div>

                                <!-- Deskripsi -->
                                <div class="form-outline mb-4">
                                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                    <label class="form-label" for="description">Deskripsi Singkat</label>
                                </div>

                                <!-- Website URL -->
                                <div class="form-outline mb-4">
                                    <input type="url" id="website_url" name="website_url" class="form-control"
                                        value="{{ old('website_url') }}" />
                                    <label class="form-label" for="website_url">URL Website (Opsional)</label>
                                </div>

                                <!-- Logo Upload -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-muted small" for="logo">Logo
                                        Partner</label>
                                    <input type="file" class="form-control" id="logo" name="logo"
                                        accept="image/*" />
                                    <div class="form-text">Format: JPG, PNG, GIF. Maks: 5MB.</div>
                                </div>

                                <!-- Status Active -->
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_active"
                                        name="is_active" checked />
                                    <label class="form-check-label" for="is_active">
                                        Tampilkan di halaman publik (Aktif)
                                    </label>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.partnerships.index') }}"
                                        class="btn btn-light shadow-0">Batal</a>
                                    <button type="submit" class="btn btn-success shadow-0"><i
                                            class="bi bi-save me-2"></i> Simpan Data</button>
                                </div>
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
