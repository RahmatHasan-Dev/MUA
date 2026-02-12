<!-- c:\xampp\htdocs\MUA\resources\views\admin\visimisi\index.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Visi Misi - Admin MUA</title>
    <!-- Font Awesome (Required for User Icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
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

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <!--Main Navigation-->
    @include('admin.partials.sidebar')
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 text-success fw-bold"><i class="bi bi-flag"></i> Kelola Visi & Misi</h2>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Section Visi -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 text-success fw-bold"><i class="bi bi-eye me-2"></i>Visi</h5>
                    @if (!$visi)
                        <a href="{{ route('admin.visimisi.create') }}" class="btn btn-success btn-sm shadow-0">
                            <i class="bi bi-plus-lg me-2"></i> Tambah Visi
                        </a>
                    @else
                        <a href="{{ route('admin.visimisi.edit', $visi->id) }}" class="btn btn-warning btn-sm shadow-0">
                            <i class="bi bi-pencil-square me-2"></i> Edit Visi
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if ($visi)
                        <blockquote
                            class="blockquote mb-0 border-start border-5 border-success ps-3 bg-light p-3 rounded">
                            <p class="mb-2 fst-italic">"{{ $visi->deskripsi }}"</p>
                            @if ($visi->judul)
                                <footer class="blockquote-footer mt-2">{{ $visi->judul }}</footer>
                            @endif
                        </blockquote>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-exclamation-circle fs-1 d-block mb-2"></i>
                            Data Visi belum diatur.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section Misi -->
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 text-success fw-bold"><i class="bi bi-list-ol me-2"></i>Misi</h5>
                    <a href="{{ route('admin.visimisi.create') }}" class="btn btn-success btn-sm shadow-0">
                        <i class="bi bi-plus-lg me-2"></i> Tambah Misi
                    </a>
                </div>
                <div class="card-body pb-0">
                    <!-- Search Form -->
                    <form action="{{ route('admin.visimisi.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari judul atau deskripsi misi..." value="{{ request('search') }}">
                            <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                            @if (request('search'))
                                <a href="{{ route('admin.visimisi.index') }}" class="btn btn-light" title="Reset"><i
                                        class="fas fa-times"></i></a>
                            @endif
                        </div>
                    </form>
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
                                        <td class="fw-bold">{{ $item->judul ?? '-' }}</td>
                                        <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2 text-success"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="{{ $item->icon }}"></i>
                                                </div>
                                                <small class="text-muted">({{ $item->icon }})</small>
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('admin.visimisi.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm btn-floating shadow-0" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.visimisi.destroy', $item->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Hapus misi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm btn-floating shadow-0"
                                                    title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            Belum ada data misi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 text-muted">
                                Showing {{ $misi->firstItem() }} to {{ $misi->lastItem() }} of {{ $misi->total() }}
                                results
                            </p>
                        </div>
                        <div>
                            {{ $misi->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>
