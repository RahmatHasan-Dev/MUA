<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Partnership - Admin MUA</title>
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
            /* Adjusted for new navbar height */
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
                <h2 class="mb-0 text-success fw-bold"><i class="bi bi-building"></i> Kelola Partnership</h2>
                <a href="{{ route('admin.partnerships.create') }}" class="btn btn-success btn-lg shadow-0">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Partner
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>Logo</th>
                                    <th>Nama Partner</th>
                                    <th>Deskripsi</th>
                                    <th>Website</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($partnerships as $partner)
                                    <tr>
                                        <td>
                                            @if ($partner->logo)
                                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="Logo"
                                                    class="rounded"
                                                    style="width: 50px; height: 50px; object-fit: contain; background: #f8f9fa;">
                                            @else
                                                <div class="rounded d-flex align-items-center justify-content-center bg-light text-muted"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="fw-bold">{{ $partner->name }}</td>
                                        <td>{{ Str::limit($partner->description, 50) }}</td>
                                        <td>
                                            @if ($partner->website_url)
                                                <a href="{{ $partner->website_url }}" target="_blank"
                                                    class="text-success text-decoration-none">
                                                    <i class="bi bi-link-45deg"></i> Kunjungi
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($partner->kategori == 'eksklusif')
                                                <span class="badge badge-warning rounded-pill d-inline">Eksklusif</span>
                                            @elseif($partner->kategori == 'pengawasan')
                                                <span class="badge badge-info rounded-pill d-inline">Pengawasan</span>
                                            @else
                                                <span class="badge badge-secondary rounded-pill d-inline">Reguler</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($partner->is_active)
                                                <span class="badge badge-success rounded-pill d-inline">Aktif</span>
                                            @else
                                                <span class="badge badge-danger rounded-pill d-inline">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.partnerships.edit', $partner->id) }}"
                                                class="btn btn-warning btn-sm btn-floating shadow-0" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.partnerships.destroy', $partner->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus partnership ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm btn-floating shadow-0" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            Belum ada data partnership.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $partnerships->links('pagination::bootstrap-5') }}
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
