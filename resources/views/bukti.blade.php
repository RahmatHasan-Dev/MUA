<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Galeri Bukti Transfer | MUA Admin</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
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
            padding: 58px 0 0;
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
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
            background-color: #10b981 !important;
            color: white !important;
        }

        .img-preview {
            height: 200px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .img-preview:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main layout -->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <h4 class="mb-4 text-success"><strong><i class="fas fa-images me-2"></i>Galeri Bukti Transfer</strong></h4>

            @if ($donations->isEmpty())
                <div class="alert alert-warning">Belum ada bukti transfer yang diunggah.</div>
            @else
                <div class="row">
                    @foreach ($donations as $donasi)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">

                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">ID: #{{ $donasi->id_donasi }}</h5>
                                    <p class="card-text small text-muted mb-1">
                                        <i class="fas fa-user me-1"></i> {{ $donasi->user->nama ?? 'Guest' }}
                                    </p>
                                    <p class="card-text fw-bold text-success mb-2">
                                        Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                                    </p>
                                    <p class="card-text small mb-2">
                                        {{ $donasi->tanggal->format('d M Y') }}
                                    </p>

                                    <!-- Status Badge -->
                                    @if ($donasi->status == 'berhasil')
                                        <span class="badge badge-success">Berhasil</span>
                                    @elseif($donasi->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-danger">Gagal</span>
                                    @endif

                                    <hr>
                                    <a href="{{ route('admin.show', $donasi->id_donasi) }}"
                                        class="btn btn-outline-primary btn-sm btn-block">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $donations->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </main>

    <!-- Modal Preview Gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Bukti Transfer</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Preview">
                </div>
            </div>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        const imageModal = new mdb.Modal(document.getElementById('imageModal'));

        function showImage(src, title) {
            document.getElementById('modalImage').src = src;
            document.getElementById('modalTitle').innerText = 'Bukti Transfer ' + title;
            imageModal.show();
        }
    </script>
</body>

</html>
