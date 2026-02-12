<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Admin MUA</title>
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
    <!--Main Navigation-->
    <header>
        @include('admin.partials.sidebar')
        @include('admin.partials.navbar-admin')
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 76px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 text-success fw-bold"><i class="bi bi-pencil-square"></i> Edit Berita</h2>
                <a href="{{ route('admin.berita') }}" class="btn btn-secondary shadow-0">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm mb-5">
                <div class="card-body p-4">
                    <form action="{{ route('admin.berita.update', $berita->id_berita) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row g-4">
                            <!-- Judul -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Judul Berita</label>
                                <input type="text" name="judul"
                                    class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $berita->judul) }}" placeholder="Masukkan judul berita..."
                                    required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea name="deskripsi" rows="6" class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Tuliskan deskripsi lengkap berita..." required>{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal & Lokasi -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror"
                                    value="{{ old('tanggal', $berita->tanggal) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Lokasi</label>
                                <input type="text" name="lokasi"
                                    class="form-control @error('lokasi') is-invalid @enderror"
                                    value="{{ old('lokasi', $berita->lokasi) }}"
                                    placeholder="Contoh: Pantai Indah Kapuk" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Peserta & Gambar -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jumlah/Keterangan Peserta</label>
                                <input type="text" name="peserta"
                                    class="form-control @error('peserta') is-invalid @enderror"
                                    value="{{ old('peserta', $berita->peserta) }}" placeholder="Contoh: 50 Relawan"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Upload Gambar (Opsional)</label>
                                <input type="file" name="gambar" id="gambarInput"
                                    class="form-control @error('gambar') is-invalid @enderror" accept="image/*"
                                    onchange="previewImage()">
                                <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar.</div>

                                <div class="mt-3" id="previewContainer">
                                    <label class="form-label d-block text-muted small">Gambar Saat Ini /
                                        Preview:</label>
                                    @if ($berita->gambar)
                                        <img id="preview-img" src="{{ asset('storage/' . $berita->gambar) }}"
                                            alt="Preview" class="img-fluid rounded shadow-sm"
                                            style="max-height: 200px; object-fit: cover;">
                                    @else
                                        <img id="preview-img" src="#" alt="Preview"
                                            class="img-fluid rounded shadow-sm d-none"
                                            style="max-height: 200px; object-fit: cover;">
                                    @endif
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Tags (Kategori)</label>
                                <div class="row g-2">
                                    <div class="col-md-4"><input type="text" name="tag1" class="form-control"
                                            value="{{ old('tag1', $berita->tag1) }}"
                                            placeholder="Tag 1 (Contoh: Lingkungan)" required></div>
                                    <div class="col-md-4"><input type="text" name="tag2" class="form-control"
                                            value="{{ old('tag2', $berita->tag2) }}"
                                            placeholder="Tag 2 (Contoh: Sosial)" required></div>
                                    <div class="col-md-4"><input type="text" name="tag3" class="form-control"
                                            value="{{ old('tag3', $berita->tag3) }}"
                                            placeholder="Tag 3 (Contoh: Edukasi)" required></div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-success btn-lg shadow-0 px-5">
                                    <i class="fas fa-save me-2"></i> Update Berita
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        function previewImage() {
            const input = document.getElementById('gambarInput');
            const previewImg = document.getElementById('preview-img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>
