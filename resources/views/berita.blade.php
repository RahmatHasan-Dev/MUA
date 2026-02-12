<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Kelola Berita | MUA Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <h5 class="mb-0"><strong><i class="fas fa-newspaper me-2"></i>Daftar Berita</strong></h5>
                </div>
                <div class="card-body">
                    <!-- Search & Export -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <form action="{{ route('admin.berita') }}" method="GET" class="d-flex gap-2">
                                <!-- Input Pencarian -->
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari Judul, Deskripsi, Tag..." value="{{ request('search') }}">
                                    <button class="btn btn-success" type="submit"><i
                                            class="fas fa-search"></i></button>
                                </div>

                                @if (request('search') || request('role'))
                                    <a href="{{ route('admin.berita') }}" class="btn btn-danger px-3"
                                        title="Reset Filter"><i class="fas fa-times"></i></a>
                                @endif
                            </form>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.berita.add') }}" class="btn btn-success"><i
                                    class="fas fa-plus me-2"></i>Tambah Berita</a>
                            <a href="{{ route('admin.berita.export') }}" class="btn btn-success"><i
                                    class="fas fa-file-csv me-1"></i>Export CSV</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                    <!-- Header Tabel dengan Fitur Sorting -->
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Peserta</th>
                                    <th>Tag 1</th>
                                    <th>Tag 2</th>
                                    <th>Tag 3</th>
                                    <th>Edit / Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($berita as $beritax)
                                    <tr>
                                        <td>{{ $beritax->judul }}</td>
                                        <td>{{ $beritax->deskripsi ?? '-' }}</td>
                                        <td>
                                            {{ $beritax->tanggal ? \Carbon\Carbon::parse($beritax->created_at)->format('d M Y') : '-' }}
                                        </td>
                                        <td>{{ $beritax->lokasi }}</td>
                                        <td>{{ $beritax->peserta }}</td>
                                        <td>{{ $beritax->tag1 }}</td>
                                        <td>{{ $beritax->tag2 }}</td>
                                        <td>{{ $beritax->tag3 }}</td>
                                        <td>
                                            <a href="{{ route('admin.berita.edit', $beritax->id_berita) }}"
                                                class="btn btn-warning btn-sm mb-1"><i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ route('admin.berita.delete', $beritax->id_berita) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-1"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <p class="mb-0 text-muted">
                                Showing {{ $berita->firstItem() }} to {{ $berita->lastItem() }} of
                                {{ $berita->total() }} results
                            </p>
                        </div>
                        <div>
                            {{ $berita->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        // 1. Handle Flash Messages (Success/Error) dari Controller
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        @endif

        // 2. Handle Konfirmasi Blokir/Aktifkan dengan SweetAlert2
        document.querySelectorAll('.btn-block-user').forEach(button => {
            button.addEventListener('click', function() {
                let form = this.closest('form');
                let isBlocking = this.querySelector('.fa-ban') !== null; // Cek ikon untuk tentukan aksi
                let actionText = isBlocking ? "Blokir" : "Aktifkan";
                let confirmBtnColor = isBlocking ? '#d33' : '#28a745';

                Swal.fire({
                    title: `Yakin ingin ${actionText} user ini?`,
                    text: isBlocking ? "User tidak akan bisa login, tapi data donasi tetap aman." :
                        "User akan dapat login kembali.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: confirmBtnColor,
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: `Ya, ${actionText}!`,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
