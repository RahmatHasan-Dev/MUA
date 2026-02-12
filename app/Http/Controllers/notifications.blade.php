<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Riwayat Notifikasi | MUA</title>
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

        .notif-card {
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }

        .notif-card:hover {
            background-color: #f8f9fa;
        }

        .notif-donasi {
            border-left-color: #10b981;
        }

        .notif-laporan {
            border-left-color: #fbbf24;
        }

        .bg-read {
            background-color: #fff;
        }

        .bg-unread {
            background-color: #f0fdf4;
        }
    </style>
</head>

<body>
    <header>
        @include('admin.partials.sidebar')
        @include('admin.partials.navbar-admin')
    </header>

    <main style="margin-top: 76px">
        <div class="container pt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold">Riwayat Notifikasi</h3>
                <button onclick="markAsRead(event)" class="btn btn-outline-success btn-sm btn-rounded">
                    <i class="fas fa-check-double me-1"></i> Tandai Semua Dibaca
                </button>
            </div>
            <p class="text-muted mb-4">Lihat semua riwayat notifikasi yang masuk ke sistem, termasuk donasi dan laporan.
            </p>

            <!-- Filter Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Filter Notifikasi</h5>
                    <form method="GET" action="{{ route('admin.notifications') }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-5">
                                <label for="start_date" class="form-label">Dari Tanggal & Jam</label>
                                <input type="datetime-local" id="start_date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-5">
                                <label for="end_date" class="form-label">Sampai Tanggal & Jam</label>
                                <input type="datetime-local" id="end_date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-2 d-grid">
                                <button type="submit" class="btn btn-success"><i
                                        class="fas fa-filter me-2"></i>Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Notification List -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    @if ($notifications->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-bell-slash fa-3x mb-3"></i>
                            <p>Tidak ada notifikasi yang cocok dengan filter Anda.</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach ($notifications as $notif)
                                @php
                                    // Tentukan link dan icon berdasarkan tipe
                                    if ($notif->type == 'donasi') {
                                        $link = route('admin.show', $notif->id_donasi);
                                        $icon = 'fa-hand-holding-usd text-success';
                                        $title = 'Donasi Masuk';
                                        $desc =
                                            'User <strong>' .
                                            ($notif->user->nama ?? 'Guest') .
                                            '</strong> melakukan donasi sebesar <strong>Rp ' .
                                            number_format($notif->nominal) .
                                            '</strong>';
                                        $statusBadge =
                                            $notif->status == 'pending'
                                                ? '<span class="badge bg-warning text-dark">Pending</span>'
                                                : '<span class="badge bg-success">Berhasil</span>';
                                        $classType = 'notif-donasi';
                                    } else {
                                        $link = route('admin.laporan.index', ['status' => 'pending']);
                                        $icon = 'fa-exclamation-triangle text-warning';
                                        $title = 'Laporan Komentar';
                                        $desc =
                                            'User <strong>' .
                                            ($notif->pelapor->nama ?? 'User') .
                                            '</strong> melaporkan komentar: <em>' .
                                            Str::limit($notif->alasan, 50) .
                                            '</em>';
                                        $statusBadge =
                                            $notif->status == 'pending'
                                                ? '<span class="badge bg-warning text-dark">Pending</span>'
                                                : '<span class="badge bg-success">Reviewed</span>';
                                        $classType = 'notif-laporan';
                                    }

                                    // Cek unread (Logika sederhana berdasarkan session read_at)
                                    $date = $notif->sort_date ?? $notif->created_at;
                                    $isUnread = $date > session('admin_notif_read_at', '2000-01-01');
                                    $bgClass = $isUnread ? 'bg-unread' : 'bg-read';
                                @endphp

                                <a href="{{ $link }}"
                                    class="list-group-item list-group-item-action notif-card {{ $classType }} {{ $bgClass }} py-3">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <div class="d-flex align-items-start">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px;">
                                                <i class="fas {{ $icon }}"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ $title }} {!! $statusBadge !!}
                                                </h6>
                                                <p class="mb-1 small text-muted">{!! $desc !!}</p>
                                                <small class="text-muted">
                                                    <i class="far fa-clock me-1"></i>
                                                    {{ $date->diffForHumans() }}
                                                    ({{ $date->format('d M Y H:i') }})
                                                </small>
                                            </div>
                                        </div>
                                        @if ($isUnread)
                                            <span class="badge rounded-pill bg-danger"
                                                style="font-size: 0.5rem;">BARU</span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-center card-footer bg-white py-3">
                {{ $notifications->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        // Fungsi Mark All as Read
        function markAsRead(event) {
            if (event) event.preventDefault();

            fetch("{{ route('admin.notifications.read') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                }
            }).then(() => {
                // Reload halaman agar status unread hilang
                window.location.reload();
            });
        }
    </script>
</body>

</html>
