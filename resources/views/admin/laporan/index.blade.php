<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Komentar - Admin MUA</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts -->
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
            padding: 76px 0 0;
            /* Adjusted for new navbar height */
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

    <!-- Main layout -->
    <main style="margin-top: 76px;">
        <div class="container pt-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-0 border">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 text-success"><strong><i class="fas fa-comments me-2"></i>Laporan
                            Komentar</strong></h5>

                    <!-- Filter Status -->
                    <form action="{{ route('admin.laporan.index') }}" method="GET" class="d-flex gap-2">
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()"
                            style="width: 150px;">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed
                            </option>
                        </select>
                        @if (request('status'))
                            <a href="{{ route('admin.laporan.index') }}" class="btn btn-light btn-sm" title="Reset"><i
                                    class="fas fa-times"></i></a>
                        @endif
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Pelapor</th>
                                    <th>Komentar Dilaporkan</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + $laporan->firstItem() - 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-2">
                                                    <p class="fw-bold mb-1">
                                                        {{ $item->pelapor->nama ?? 'User Terhapus' }}
                                                    </p>
                                                    <p class="text-muted mb-0 small">{{ $item->pelapor->email ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->komentar)
                                                <p class="fw-bold mb-1">{{ $item->komentar->user->nama ?? 'Anonim' }}
                                                </p>
                                                <p class="text-muted mb-0 small text-wrap" style="max-width: 300px;">
                                                    "{{ Str::limit($item->komentar->isi, 50) }}"
                                                </p>
                                            @else
                                                <span class="text-danger fst-italic">Komentar telah dihapus</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->alasan }}</td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <span class="badge badge-warning rounded-pill d-inline">Pending</span>
                                            @elseif($item->status == 'reviewed')
                                                <span class="badge badge-success rounded-pill d-inline">Reviewed</span>
                                            @else
                                                <span
                                                    class="badge badge-secondary rounded-pill d-inline">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                @if ($item->komentar)
                                                    <button type="button" class="btn btn-primary btn-sm btn-floating"
                                                        data-mdb-toggle="modal"
                                                        data-mdb-target="#replyModal{{ $item->id }}"
                                                        title="Balas Komentar">
                                                        <i class="fas fa-reply"></i>
                                                    </button>
                                                @endif

                                                @if ($item->status == 'pending')
                                                    <form action="{{ route('admin.laporan.reviewed', $item->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Tandai laporan ini sudah ditinjau?');">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm btn-floating"
                                                            title="Tandai Reviewed">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($item->komentar)
                                                    <form
                                                        action="{{ route('admin.laporan.delete_comment', $item->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus komentar ini? Laporan akan otomatis ditandai reviewed.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm btn-floating"
                                                            title="Hapus Komentar">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Modal Reply -->
                                                <div class="modal fade" id="replyModal{{ $item->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Balas Komentar</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-mdb-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('admin.laporan.reply', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <p class="small text-muted mb-2">Membalas komentar
                                                                        dari
                                                                        <strong>{{ $item->komentar->user->nama ?? 'User' }}</strong>:
                                                                    </p>
                                                                    <div class="p-2 bg-light rounded mb-3 fst-italic">
                                                                        "{{ Str::limit($item->komentar->isi ?? '', 100) }}"
                                                                    </div>
                                                                    <textarea name="isi" class="form-control" rows="3" placeholder="Tulis balasan Anda di sini..." required></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-mdb-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Kirim
                                                                        Balasan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada laporan komentar saat ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $laporan->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>
