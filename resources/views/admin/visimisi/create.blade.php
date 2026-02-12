<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Visi Misi | MUA Admin</title>
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
            <div class="card shadow-0 border">
                <div class="card-header border-bottom py-3">
                    <h5 class="mb-0"><strong><i class="fas fa-plus me-2"></i>Tambah Visi / Misi</strong></h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.visimisi.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="misi" selected>Misi</option>
                                <option value="visi">Visi</option>
                            </select>
                            <small class="text-muted">Pilih "Visi" hanya jika data Visi belum ada.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control"
                                placeholder="Contoh: Edukasi Masyarakat" required />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Icon (Bootstrap Icons)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="iconPreview"
                                            class="bi bi-question-circle"></i></span>
                                    <input type="text" name="icon" id="iconInput" class="form-control"
                                        placeholder="Contoh: bi bi-tree" />
                                </div>
                                <small class="text-muted">Lihat referensi di <a href="https://icons.getbootstrap.com/"
                                        target="_blank">Bootstrap
                                        Icons</a></small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Urutan</label>
                                <input type="number" name="urutan" class="form-control" placeholder="0" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.visimisi.index') }}" class="btn btn-light me-2">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iconInput = document.getElementById('iconInput');
            const iconPreview = document.getElementById('iconPreview');
            const defaultIconClass = 'bi bi-question-circle';

            function updateIconPreview() {
                const newClass = iconInput.value.trim();
                // Validasi sederhana di client-side, yang utama ada di server
                if (newClass && /^[a-zA-Z0-9\s-]+$/.test(newClass)) {
                    iconPreview.className = newClass;
                } else {
                    iconPreview.className = defaultIconClass;
                }
            }

            // Event listener untuk update real-time
            iconInput.addEventListener('input', updateIconPreview);

            // Inisialisasi saat halaman dimuat
            updateIconPreview();
        });
    </script>
</body>

</html>
