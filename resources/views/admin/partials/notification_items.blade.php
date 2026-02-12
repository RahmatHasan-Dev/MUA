@php
    $hasDonations = !$notifDonasi->isEmpty();
    $hasLaporan = !$notifLaporan->isEmpty();
    $hasPengeluaran = !$notifPengeluaran->isEmpty();
    $hasNotifications = $hasDonations || $hasLaporan; // Only count actionable items as "notifications"
@endphp

@if (!$hasNotifications)
    <li>
        <a class="dropdown-item text-center text-muted py-3">
            <div class="d-flex flex-column align-items-center">
                <i class="fas fa-bell-slash fa-2x mb-2 text-muted"></i>
                <span>Tidak ada notifikasi baru</span>
            </div>
        </a>
    </li>
@else
    {{-- Notifikasi Donasi --}}
    @if ($hasDonations)
        <li>
            <h6 class="dropdown-header text-success"><i class="fas fa-hand-holding-usd me-2"></i>Donasi Pending</h6>
        </li>
        @foreach ($notifDonasi as $notif)
            <li>
                <a class="dropdown-item py-2" href="{{ route('admin.show', $notif->id_donasi) }}">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="fas fa-arrow-down text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">
                                Donasi dari <strong>{{ $notif->user->nama ?? 'Guest' }}</strong>
                            </p>
                            <p class="mb-1 small fw-bold">
                                Rp {{ number_format($notif->nominal) }}
                            </p>
                            <small class="text-muted"><i
                                    class="far fa-clock me-1"></i>{{ $notif->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    @endif

    {{-- Notifikasi Laporan Komentar --}}
    @if ($hasLaporan)
        @if ($hasDonations)
            <li>
                <hr class="dropdown-divider">
            </li>
        @endif
        <li>
            <h6 class="dropdown-header text-warning"><i class="fas fa-exclamation-triangle me-2"></i>Laporan Komentar
            </h6>
        </li>
        @foreach ($notifLaporan as $notif)
            <li>
                <a class="dropdown-item py-2" href="{{ route('admin.laporan.index', ['status' => 'pending']) }}">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="fas fa-flag text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">
                                Laporan dari <strong>{{ $notif->pelapor->nama ?? 'User' }}</strong>
                            </p>
                            <p class="mb-1 small text-muted fst-italic">
                                "{{ Str::limit($notif->alasan, 40) }}"
                            </p>
                            <small class="text-muted"><i
                                    class="far fa-clock me-1"></i>{{ $notif->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    @endif
@endif

<li>
    <hr class="dropdown-divider">
</li>
<li><a class="dropdown-item text-center text-success small py-2" href="{{ route('admin.notifications') }}">
        Lihat Semua Riwayat Notifikasi <i class="fas fa-arrow-right ms-1"></i>
    </a></li>
