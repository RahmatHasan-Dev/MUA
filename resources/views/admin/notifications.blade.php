<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Semua Notifikasi | MUA Admin</title>
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
            padding: 76px 0 0;
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-success fw-bold"><i class="fas fa-bell me-2"></i>Riwayat Notifikasi</h4>
                <button onclick="markAsRead(event)" class="btn btn-outline-success btn-sm btn-rounded">
                    <i class="fas fa-check-double me-1"></i> Tandai Semua Dibaca
                </button>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    @if ($notifications->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-bell-slash fa-3x mb-3"></i>
                            <p>Belum ada notifikasi.</p>
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
                                            e($notif->user->nama ?? 'Guest') .
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
                                            e($notif->pelapor->nama ?? 'User') .
                                            '</strong> melaporkan komentar: <em>' .
                                            e(Str::limit($notif->alasan, 50)) .
                                            '</em>';
                                        $statusBadge =
                                            $notif->status == 'pending'
                                                ? '<span class="badge bg-warning text-dark">Pending</span>'
                                                : '<span class="badge bg-success">Reviewed</span>';
                                        $classType = 'notif-laporan';
                                    }

                                    // Cek unread (Logika sederhana berdasarkan session read_at)
                                    $isUnread = $notif->created_at > session('admin_notif_read_at', '2000-01-01');
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
                                                    {{ $notif->created_at->diffForHumans() }}
                                                    ({{ $notif->created_at->format('d M Y H:i') }})
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
                <div class="card-footer bg-white d-flex justify-content-center py-3">
                    {{ $notifications->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        // Fungsi Mark All as Read (Sama seperti di Navbar)
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
