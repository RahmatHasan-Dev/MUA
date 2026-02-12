<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Visi Misi - Admin MUA</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar style adjustment if needed */
    </style>
</head>

<body>

    @include('admin.partials.sidebar')

    <main style="margin-top: 58px">
        <div class="container pt-4">
            <h3>Kelola Visi & Misi</h3>
            <hr>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Section Visi -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-success"><i class="fas fa-eye me-2"></i>Visi</h5>
                    @if (!$visi)
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalVisi">
                            <i class="fas fa-plus"></i> Tambah Visi
                        </button>
                    @else
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalVisi">
                            <i class="fas fa-edit"></i> Edit Visi
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    @if ($visi)
                        <blockquote class="blockquote mb-0">
                            <p>{{ $visi->deskripsi }}</p>
                            @if ($visi->judul)
                                <footer class="blockquote-footer mt-2">{{ $visi->judul }}</footer>
                            @endif
                        </blockquote>
                    @else
                        <p class="text-muted text-center my-3">Data Visi belum diatur.</p>
                    @endif
                </div>
            </div>

            <!-- Section Misi -->
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-success"><i class="fas fa-list-ol me-2"></i>Misi</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalMisi">
                        <i class="fas fa-plus"></i> Tambah Misi
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Icon</th>
                                    <th class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($misi as $item)
                                    <tr>
                                        <td class="ps-4">{{ $loop->iteration }}</td>
                                        <td><strong>{{ $item->judul ?? '-' }}</strong></td>
                                        <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                                        <td><i class="{{ $item->icon }} text-success"></i> <small
                                                class="text-muted">({{ $item->icon }})</small></td>
                                        <td class="text-end pe-4">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalMisiEdit{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.visimisi.destroy', $item->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Hapus misi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">Belum ada data misi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Visi (Create/Edit) -->
    <div class="modal fade" id="modalVisi" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ $visi ? route('admin.visimisi.update', $visi->id) : route('admin.visimisi.store') }}"
                    method="POST">
                    @csrf
                    @if ($visi)
                        @method('PUT')
                    @endif
                    <input type="hidden" name="kategori" value="visi">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $visi ? 'Edit Visi' : 'Tambah Visi' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul (Opsional)</label>
                            <input type="text" name="judul" class="form-control" value="{{ $visi->judul ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi Visi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" required>{{ $visi->deskripsi ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Misi Create -->
    <div class="modal fade" id="modalMisi" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.visimisi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kategori" value="misi">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Misi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul Misi</label>
                            <input type="text" name="judul" class="form-control"
                                placeholder="Contoh: Rehabilitasi Hutan">
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi Misi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Icon (Class FontAwesome/Bootstrap)</label>
                            <input type="text" name="icon" class="form-control"
                                placeholder="Contoh: fas fa-tree">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modals Edit Misi -->
    @foreach ($misi as $item)
        <div class="modal fade" id="modalMisiEdit{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.visimisi.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Misi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Judul Misi</label>
                                <input type="text" name="judul" class="form-control"
                                    value="{{ $item->judul }}">
                            </div>
                            <div class="mb-3">
                                <label>Deskripsi Misi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" required>{{ $item->deskripsi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Icon</label>
                                <input type="text" name="icon" class="form-control"
                                    value="{{ $item->icon }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
