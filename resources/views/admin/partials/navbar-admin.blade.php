<!-- Navbar Admin -->
<style>
    /* RESET TOTAL: Pastikan dropdown admin tidak terpengaruh CSS global (style.css) */
    #main-navbar .dropdown-menu {
        display: none !important;
        /* Paksa sembunyi default */
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateY(20px) !important;
        /* Posisi awal lebih turun agar animasi slide-up terasa */
        transition: opacity 0.3s ease, transform 0.3s ease !important;
        margin-top: 58px !important;
        margin-top: 62px !important;
        /* Jarak pas agar muncul DI BAWAH navbar (bukan menumpuk) */
        border-radius: 12px !important;
        /* Sudut membulat biar modern */
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2) !important;
        /* Bayangan halus */
        border: none !important;
        /* Hilangkan border bawaan yang kaku */
        padding: 0 !important;
        /* Reset padding agar header/footer dropdown rapi */
    }

    /* HANYA MUNCUL SAAT ADA CLASS .show (yang ditambahkan oleh JS saat KLIK) */
    #main-navbar .dropdown-menu.show {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) !important;
    }

    /* Matikan paksa efek hover dari luar jika ada */
    #main-navbar .dropdown:hover>.dropdown-menu:not(.show) {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }

    /* Animasi Berkedip untuk Badge Notifikasi */
    @keyframes pulse-red {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
        }

        70% {
            transform: scale(1.1);
            box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
        }

        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
        }
    }

    .badge-pulse {
        animation: pulse-red 2s infinite;
    }
</style>
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top"
    style="background: linear-gradient(135deg, #064e3b 0%, #065f46 100%); backdrop-filter: blur(10px); box-shadow: 0 4px 25px rgba(6, 78, 59, 0.5); border-bottom: 1px solid rgba(255, 255, 255, 0.1); height: 76px; z-index: 601;">
    <!-- Container wrapper -->
    <div class="container-fluid h-100">
        <div class="d-flex justify-content-between align-items-center w-100">

            <!-- Left: Toggle & Brand -->
            <div class="d-flex align-items-center">
                <!-- Toggle button -->
                <button class="navbar-toggler me-3" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation"
                    style="border: none;">
                    <i class="fas fa-bars text-white fa-lg"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                    <span class="fw-bold text-white"
                        style="letter-spacing: 1.5px; font-size: 1.3rem; text-shadow: 0 0 10px rgba(52, 211, 153, 0.6);">
                        <i class="fas fa-tree me-2 text-warning"></i>MUA ADMIN
                    </span>
                </a>
            </div>

            <!-- Center: Greeting (Absolute Center) -->
            <div class="d-none d-md-block position-absolute start-50 translate-middle-x">
                <div class="text-center text-white">
                    <span class="small d-block text-white-50" style="font-size: 0.75rem; letter-spacing: 1px;">SELAMAT
                        DATANG</span>
                    <span class="fw-bold"
                        style="font-size: 1.1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">{{ Auth::user()->nama ?? 'Administrator' }}</span>
                </div>
            </div>

            <!-- Right: Notification & Profile -->
            <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">

                <!-- Notification Bell -->
                <li class="nav-item dropdown me-4">
                    <a class="nav-link text-white position-relative dropdown-toggle hidden-arrow" href="#"
                        id="navbarDropdownNotif" role="button" data-mdb-dropdown-init data-mdb-ripple-init
                        aria-expanded="false">
                        <i class="fas fa-bell fa-lg" style="filter: drop-shadow(0 0 5px rgba(255,255,255,0.3));"></i>
                        @php $totalNotif = ($countDonasi ?? 0) + ($countLaporan ?? 0); @endphp
                        <span id="notif-badge"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light {{ $totalNotif > 0 ? 'badge-pulse' : '' }}"
                            style="font-size: 0.6rem; display: {{ $totalNotif > 0 ? 'block' : 'none' }};">
                            {{ $totalNotif }}
                        </span>
                    </a>

                    <ul id="notif-list" class="dropdown-menu dropdown-menu-end shadow-lg"
                        aria-labelledby="navbarDropdownNotif"
                        style="width: 320px; max-height: 500px; overflow-y: auto;">

                        <li>
                            <h6 class="dropdown-header fw-bold">Notifikasi</h6>
                        </li>

                        <!-- Section Pemasukan (Donasi) -->
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <h6 class="dropdown-header text-success"><i class="fas fa-arrow-down me-1"></i> Pemasukan
                                (Pending)</h6>
                        </li>
                        @forelse($notifDonasi ?? [] as $d)
                            <li>
                                <a class="dropdown-item notification-link" data-type="donasi"
                                    data-id="{{ $d->id_donasi }}" href="{{ route('admin.show', $d->id_donasi) }}">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $d->user->nama ?? 'Guest' }}</strong>
                                        <small class="text-muted">{{ $d->created_at->diffForHumans() }}</small>
                                    </div>
                                    <small class="text-muted">Donasi Rp {{ number_format($d->nominal) }}</small>
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item text-muted small">Tidak ada donasi pending.</span></li>
                        @endforelse

                        <!-- Section Laporan Komentar -->
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <h6 class="dropdown-header text-warning"><i class="fas fa-exclamation-circle me-1"></i>
                                Laporan Komentar</h6>
                        </li>
                        @forelse($notifLaporan ?? [] as $l)
                            <li>
                                <a class="dropdown-item notification-link" data-type="laporan"
                                    data-id="{{ $l->id }}"
                                    href="{{ route('admin.laporan.index', ['status' => 'pending']) }}">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ Str::limit($l->alasan, 15) }}</strong>
                                        <small class="text-muted">{{ $l->created_at->diffForHumans() }}</small>
                                    </div>
                                    <small class="text-muted">Pelapor: {{ $l->pelapor->nama ?? 'User' }}</small>
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item text-muted small">Tidak ada laporan baru.</span></li>
                        @endforelse

                        <!-- Section Pengeluaran (Info Terbaru) -->
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <h6 class="dropdown-header text-danger"><i class="fas fa-arrow-up me-1"></i> Pengeluaran
                                Terbaru</h6>
                        </li>
                        @forelse($notifPengeluaran ?? [] as $p)
                            <li>
                                <a class="dropdown-item notification-link" href="{{ route('admin.pengeluaran') }}">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ Str::limit($p->judul, 15) }}</strong>
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M') }}</small>
                                    </div>
                                    <small class="text-muted">Rp {{ number_format($p->nominal) }}</small>
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item text-muted small">Belum ada pengeluaran.</span></li>
                        @endforelse

                        <li>
                            <hr class="dropdown-divider m-0">
                        </li>
                        <li>
                            <a class="dropdown-item text-center small fw-bold py-2 bg-light text-primary"
                                href="{{ route('admin.notifications') }}">Lihat Semua Notifikasi</a>
                        </li>
                    </ul>
                </li>

                <!-- Avatar & Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                        id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init data-mdb-ripple-init
                        aria-expanded="false">
                        <div class="rounded-circle d-flex justify-content-center align-items-center shadow"
                            style="width: 42px; height: 42px; border: 2px solid rgba(255,255,255,0.8); background: linear-gradient(135deg, #fbbf24, #d97706);">
                            <span class="text-white fw-bold"
                                style="font-size: 16px; text-shadow: 0 1px 2px rgba(0,0,0,0.2);">
                                {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                            </span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0"
                        aria-labelledby="navbarDropdownMenuLink" style="min-width: 200px; ">
                        <li class="bg-light p-1 text-center border-bottom">
                            <p class="mb-0 fw-bold text-dark">{{ Auth::user()->nama ?? 'Admin' }}</p>
                            <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                        </li>
                        <li><a class="dropdown-item py-2" href="{{ route('admin.profile.edit') }}"><i
                                    class="fas fa-user-circle me-2 text-success"></i> Profil Saya</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('admin.profile.edit') }}"><i
                                    class="fas fa-cog me-2 text-success"></i> Pengaturan</a></li>
                        <li>
                            <hr class="dropdown-divider my-1" />
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger"><i
                                        class="fas fa-sign-out-alt me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Audio Element untuk Notifikasi -->
<audio id="notif-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

<script>
    // Inisialisasi Dropdown MDB agar bisa di-klik dan ditutup (toggle)
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof mdb !== 'undefined') {
            const {
                Dropdown,
                Ripple,
                initMDB
            } = mdb;
            initMDB({
                Dropdown,
                Ripple
            });
        }
    });

    let lastCount = {{ ($countDonasi ?? 0) + ($countLaporan ?? 0) }}; // Inisialisasi jumlah awal

    // Fungsi untuk mengambil notifikasi terbaru secara real-time
    function fetchNotifications() {
        fetch("{{ route('admin.notifications.fetch') }}")
            .then(response => response.json())
            .then(data => {
                // Update Badge
                const badge = document.getElementById('notif-badge');
                if (data.count > 0) {
                    badge.style.display = 'block';
                    badge.innerText = data.count;
                    badge.classList.add('badge-pulse');
                } else {
                    badge.style.display = 'none';
                    badge.classList.remove('badge-pulse');
                }

                // Tambahkan tombol "Lihat Semua" ke HTML yang diterima dari server
                const seeAllHtml =
                    `<li><hr class="dropdown-divider m-0"></li>
                                    <li><a class="dropdown-item text-center small fw-bold py-2 bg-light text-primary" href="{{ route('admin.notifications') }}">Lihat Semua Notifikasi</a></li>`;

                // Update List Dropdown
                document.getElementById('notif-list').innerHTML = data.html + seeAllHtml;

                // Cek apakah ada notifikasi baru untuk memutar suara
                if (data.count > lastCount) {
                    const audio = document.getElementById('notif-sound');
                    if (audio) {
                        audio.play().catch(error => console.log('Autoplay prevented:', error));
                    }
                }
                lastCount = data.count; // Update counter terakhir
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Event Delegation untuk menangani klik pada notifikasi (baik yang statis maupun hasil AJAX)
    document.addEventListener('click', function(e) {
        // Cek apakah yang diklik adalah link notifikasi
        const link = e.target.closest('.notification-link');
        // Pastikan link belum pernah diklik sebelumnya di tampilan ini
        if (link && !link.hasAttribute('data-clicked')) {
            // Tandai link sudah diklik agar tidak mengurangi badge berkali-kali
            link.setAttribute('data-clicked', 'true');

            // Hanya proses notifikasi yang punya type dan id (untuk donasi & laporan)
            const type = link.getAttribute('data-type');
            const id = link.getAttribute('data-id');

            if (type && id) {
                // 1. Kurangi badge secara visual
                const badge = document.getElementById('notif-badge');
                if (badge && badge.style.display !== 'none') {
                    let currentCount = parseInt(badge.innerText);
                    if (currentCount > 0) {
                        currentCount--; // Kurangi 1
                        badge.innerText = currentCount;

                        // Jika jadi 0, sembunyikan badge
                        if (currentCount === 0) {
                            badge.style.display = 'none';
                            badge.classList.remove('badge-pulse');
                        }
                    }
                }

                // 2. Kirim request ke server untuk menandai sudah dibaca
                fetch("{{ route('admin.notifications.read.single') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        type: type,
                        id: id
                    }),
                    keepalive: true // Penting agar request tetap jalan meski halaman berpindah
                });
            }
        }
    });

    // Fungsi Mark All as Read
    function markAsRead(event) {
        event.stopPropagation(); // Mencegah dropdown tertutup saat diklik
        fetch("{{ route('admin.notifications.read') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        }).then(() => {
            fetchNotifications(); // Refresh tampilan segera
        });
    }

    // Jalankan polling setiap 30 detik
    setInterval(fetchNotifications, 30000);
</script>
