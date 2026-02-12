<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Partnership - Admin MUA</title>
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

        /* Custom Styles for Edit Page */
        .image-preview-box {
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background: #f9f9f9;
            transition: all 0.3s;
        }

        .image-preview-box:hover {
            border-color: #10b981;
            background: #f0fdf4;
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
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-success text-white py-3">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Partnership</h5>
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

                            <form action="{{ route('admin.partnerships.update', $partnership->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Nama -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="name">Nama Partner / Perusahaan</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-lg"
                                        value="{{ old('name', $partnership->name) }}" required />
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="description">Deskripsi Singkat</label>
                                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $partnership->description) }}</textarea>
                                </div>

                                <!-- Website URL -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="website_url">URL Website (Opsional)</label>
                                    <input type="url" id="website_url" name="website_url" class="form-control"
                                        value="{{ old('website_url', $partnership->website_url) }}" />
                                </div>

                                <!-- Logo Upload -->
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <label class="form-label fw-bold" for="logo">Ganti Logo (Opsional)</label>
                                        <input type="file" class="form-control" id="logo" name="logo"
                                            accept="image/*" />
                                        <div class="form-text text-muted">Format: JPG, PNG, GIF. Maks: 5MB. Biarkan
                                            kosong jika tidak ingin mengubah.</div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <label class="form-label fw-bold mb-2">Logo Saat Ini</label>
                                        <div class="image-preview-box">
                                            @if ($partnership->logo)
                                                <img src="{{ asset('storage/' . $partnership->logo) }}"
                                                    alt="Current Logo" class="img-fluid rounded shadow-sm"
                                                    style="max-height: 100px; object-fit: contain;">
                                            @else
                                                <span class="text-muted small">Tidak ada logo</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Active -->
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_active"
                                        name="is_active" {{ $partnership->is_active ? 'checked' : '' }} />
                                    <label class="form-check-label" for="is_active">
                                        Tampilkan di halaman publik (Aktif)
                                    </label>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.partnerships.index') }}"
                                        class="btn btn-light shadow-0">Batal</a>
                                    <button type="submit" class="btn btn-success shadow-0"><i
                                            class="bi bi-save me-2"></i> Update Data</button>
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
