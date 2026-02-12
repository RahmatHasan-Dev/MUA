<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Pengeluaran | MUA Admin</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    </style>
</head>

<body>
    <header>
        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        @include('admin.partials.navbar-admin')
    </header>

    <!-- Main layout -->
    <main style="margin-top: 76px">
        <div class="container pt-4">
            <!-- Chart Section -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header border-bottom py-3">
                    <h5 class="mb-0 text-success"><strong><i class="fas fa-chart-pie me-2"></i>Ringkasan Pengeluaran per
                            Kategori</strong></h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px; position: relative;">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="card shadow-sm border-0">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 text-danger"><strong><i class="fas fa-file-invoice-dollar me-2"></i>Laporan
                            Pengeluaran</strong></h5>
                    <div class="d-flex align-items-center">
                        <div class="me-3 text-end d-none d-md-block">
                            <small class="text-muted d-block" style="line-height: 1;">Dana Tersedia</small>
                            <span class="fw-bold text-success">Rp {{ number_format($saldoSaatIni, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Alert Notifikasi -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Filter & Search -->
                    <form action="{{ route('admin.pengeluaran') }}" method="GET" class="mb-4">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label class="form-label small text-muted">Dari Tanggal</label>
                                <input type="date" name="start_date" class="form-control form-control-sm"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted">Sampai Tanggal</label>
                                <input type="date" name="end_date" class="form-control form-control-sm"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Pencarian</label>
                                <input type="text" name="search" class="form-control form-control-sm"
                                    placeholder="Cari Judul, Kategori, Nominal..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                                @if (request('start_date') || request('end_date') || request('search'))
                                    <a href="{{ route('admin.pengeluaran') }}" class="btn btn-light btn-sm ms-1"
                                        title="Reset"><i class="fas fa-times"></i></a>
                                @endif
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr class="text-uppercase small text-muted">
                                    <th class="fw-bold">No</th>
                                    <th class="fw-bold">Tanggal</th>
                                    <th class="fw-bold">Judul</th>
                                    <th class="fw-bold">Kategori</th>
                                    <th class="fw-bold">Nominal</th>
                                    <th class="fw-bold">Keterangan</th>
                                    <th class="fw-bold">Bukti</th>
                                    <th class="fw-bold text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengeluaran as $index => $item)
                                    <tr>
                                        <td>{{ $pengeluaran->firstItem() + $index }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td><span
                                                class="badge badge-secondary rounded-pill d-inline">{{ $item->kategori }}</span>
                                        </td>
                                        <td class="text-danger fw-bold">Rp
                                            {{ number_format($item->nominal, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                        <td>
                                            @if ($item->bukti)
                                                <button type="button" class="btn btn-link btn-sm btn-rounded text-info"
                                                    onclick="openImageModal('{{ asset('storage/' . $item->bukti) }}', '{{ $item->judul }}')">
                                                    <i class="fas fa-image me-1"></i> Lihat
                                                </button>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.pengeluaran.cetak', $item->id) }}" target="_blank"
                                                class="btn btn-secondary btn-sm btn-floating shadow-0 me-1"
                                                title="Cetak Kwitansi">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <button class="btn btn-warning btn-sm btn-floating shadow-0 me-1"
                                                data-id="{{ $item->id }}" data-judul="{{ $item->judul }}"
                                                data-nominal="{{ $item->nominal }}"
                                                data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}"
                                                data-kategori="{{ $item->kategori }}"
                                                data-keterangan="{{ $item->keterangan }}"
                                                onclick="openEditModal(this)" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <form action="{{ route('admin.pengeluaran.destroy', $item->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm btn-floating shadow-0"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                            Belum ada data pengeluaran.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total Pengeluaran:</td>
                                    <td class="text-danger fw-bold">Rp
                                        {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pengeluaran->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pengeluaran Baru</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nominal (Rp)</label>
                                <input type="number" name="nominal" class="form-control" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input class="form-control" list="kategoriOptions" name="kategori"
                                placeholder="Pilih atau ketik kategori baru..." required>
                            <datalist id="kategoriOptions">
                                <option value="Operasional">
                                <option value="Program">
                                <option value="Gaji">
                                <option value="Peralatan">
                                <option value="Lainnya">
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan Detail (Opsional)</label>
                            <textarea name="keterangan" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bukti Foto (Opsional)</label>
                            <input type="file" name="bukti" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pengeluaran</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" id="edit_judul" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nominal (Rp)</label>
                                <input type="number" name="nominal" id="edit_nominal" class="form-control"
                                    min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="edit_tanggal" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input class="form-control" list="kategoriOptions" name="kategori" id="edit_kategori"
                                placeholder="Pilih atau ketik kategori baru..." required>
                            <!-- Datalist menggunakan ID yang sama dengan modal tambah -->
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan Detail (Opsional)</label>
                            <textarea name="keterangan" id="edit_keterangan" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ganti Bukti (Opsional)</label>
                            <input type="file" name="bukti" class="form-control" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah bukti.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Lihat Bukti -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="imageModalLabel">Bukti Pengeluaran</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImagePreview" src="" class="img-fluid rounded shadow-sm"
                        style="max-height: 70vh;" alt="Bukti">
                    <p id="modalImageTitle" class="text-muted mt-2 mb-0"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

    <script>
        const editModalEl = document.getElementById('editModal');
        const editModal = new mdb.Modal(editModalEl);
        const imageModalEl = document.getElementById('imageModal');
        const imageModal = new mdb.Modal(imageModalEl);

        function openEditModal(button) {
            // Ambil data dari atribut data-*
            const id = button.getAttribute('data-id');
            const judul = button.getAttribute('data-judul');
            const nominal = button.getAttribute('data-nominal');
            const tanggal = button.getAttribute('data-tanggal');
            const kategori = button.getAttribute('data-kategori');
            const keterangan = button.getAttribute('data-keterangan');

            // Isi nilai input dalam modal
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_nominal').value = nominal;
            document.getElementById('edit_tanggal').value = tanggal;
            document.getElementById('edit_kategori').value = kategori;
            document.getElementById('edit_keterangan').value = keterangan ? keterangan : '';

            // Update action URL form
            // Asumsi route update adalah /admin/pengeluaran/{id}
            const form = document.getElementById('editForm');
            form.action = '/admin/pengeluaran/' + id;

            // Tampilkan modal
            editModal.show();
        }

        function openImageModal(src, title) {
            document.getElementById('modalImagePreview').src = src;
            document.getElementById('modalImageTitle').innerText = title;
            imageModal.show();
        }

        // Chart Initialization
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('categoryChart').getContext('2d');
            const chartLabels = @json($chartLabels);
            const chartValues = @json($chartValues);

            // Generate random colors for chart
            const backgroundColors = chartLabels.map(() => `hsl(${Math.random() * 360}, 70%, 50%)`);

            new Chart(ctx, {
                type: 'bar', // Bisa diganti 'pie' atau 'doughnut'
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Total Pengeluaran (Rp)',
                        data: chartValues,
                        backgroundColor: backgroundColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
