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

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 76px 0 0;
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
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%);
            background-color: #10b981 !important;
            color: white !important;
        }
    </style>
</head>

<body>
    <header>
        @include('admin.partials.sidebar')
        @include('admin.partials.navbar-admin')
    </header>

    <main style="margin-top: 76px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 text-success fw-bold"><i class="bi bi-pencil-square"></i> Edit Partner</h2>
                <a href="{{ route('admin.partnerships.index') }}" class="btn btn-secondary shadow-0">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm mb-5">
                <div class="card-body p-4">
                    <form action="{{ route('admin.partnerships.update', $partnership->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Nama Partner -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Partner</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $partnership->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kategori Partner</label>
                                <select name="kategori" class="form-select @error('kategori') is-invalid @enderror"
                                    required>
                                    <option value="reguler"
                                        {{ old('kategori', $partnership->kategori) == 'reguler' ? 'selected' : '' }}>
                                        Partner Reguler</option>
                                    <option value="eksklusif"
                                        {{ old('kategori', $partnership->kategori) == 'eksklusif' ? 'selected' : '' }}>
                                        Partner Eksklusif</option>
                                    <option value="pengawasan"
                                        {{ old('kategori', $partnership->kategori) == 'pengawasan' ? 'selected' : '' }}>
                                        Dibawah Pengawasan</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Website URL -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Website URL</label>
                                <input type="url" name="website_url"
                                    class="form-control @error('website_url') is-invalid @enderror"
                                    value="{{ old('website_url', $partnership->website_url) }}">
                                @error('website_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Logo Upload -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Logo Partner</label>
                                <input type="file" name="logo"
                                    class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                                <div class="form-text">Biarkan kosong jika tidak ingin mengubah logo.</div>
                                @if ($partnership->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $partnership->logo) }}" alt="Current Logo"
                                            style="height: 50px; object-fit: contain;">
                                        <span class="text-muted small ms-2">Logo saat ini</span>
                                    </div>
                                @endif
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Deskripsi Singkat</label>
                                <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $partnership->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Aktif -->
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="isActive"
                                        name="is_active" value="1" {{ $partnership->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isActive">Tampilkan Partner ini (Aktif)</label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-success btn-lg shadow-0 px-5">
                                    <i class="fas fa-save me-2"></i> Update Partner
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>
