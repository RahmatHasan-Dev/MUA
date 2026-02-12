<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengambilan Dana | MUA Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
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

    <main style="margin-top: 76px">
        <div class="container pt-4">
            <h4 class="mb-4 text-success"><strong>Pengambilan Dana (Withdrawal)</strong></h4>

            <!-- Info Saldo -->
            <div class="card bg-success text-white mb-4 shadow-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Saldo Tersedia Saat Ini</h6>
                            <small>Total Donasi Berhasil - Total Pengeluaran</small>
                        </div>
                        <div class="text-end">
                            <h2 class="mb-0 fw-bold">Rp {{ number_format($saldoSaatIni, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Form Pengambilan -->
                <div class="col-md-5 mb-4">
                    <div class="card shadow-0 border">
                        <div class="card-header border-bottom">
                            <h5 class="mb-0"><i class="fas fa-money-check-alt me-2"></i>Form Penarikan</h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="withdrawalForm" action="{{ route('admin.withdrawal.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Nominal Penarikan (Rp)</label>
                                    <input type="number" name="nominal" id="nominalInput"
                                        class="form-control form-control-lg" min="10000" placeholder="0" required
                                        oninput="validateBalance()" />
                                    <small id="balanceError" class="text-danger fw-bold mt-1" style="display:none;">
                                        <i class="fas fa-exclamation-circle me-1"></i> Nominal melebihi saldo tersedia!
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small text-muted">Bank Tujuan / E-Wallet</label>
                                    <select name="bank_tujuan" class="form-select">
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI">BNI</option>
                                        <option value="Gopay">Gopay</option>
                                        <option value="OVO">OVO</option>
                                        <option value="Dana">Dana</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Nomor Rekening / HP</label>
                                    <input type="text" name="no_rekening" class="form-control"
                                        placeholder="Contoh: 1234567890" required />
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Atas Nama</label>
                                    <input type="text" name="atas_nama" class="form-control"
                                        placeholder="Nama Pemilik Rekening" required />
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Keterangan / Keperluan</label>
                                    <textarea name="keterangan" class="form-control" rows="2"></textarea>
                                </div>

                                <hr class="my-4">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-danger">Konfirmasi Password Admin</label>
                                    <input type="password" name="password_konfirmasi" class="form-control"
                                        placeholder="Masukkan password Anda" required />
                                </div>

                                <button type="button" id="btnSubmit" onclick="confirmWithdrawal()"
                                    class="btn btn-success btn-lg w-100 btn-block">
                                    <i class="fas fa-paper-plane me-2"></i> Proses Penarikan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Penarikan -->
                <div class="col-md-7">
                    <div class="card shadow-0 border">
                        <div class="card-header border-bottom">
                            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Penarikan</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>ID Transaksi</th>
                                            <th>Nominal</th>
                                            <th>Tujuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($riwayat as $item)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                                <td><span
                                                        class="badge bg-secondary">{{ $item->no_transaksi ?? 'WD-' . $item->id }}</span>
                                                </td>
                                                <td class="text-danger fw-bold">Rp
                                                    {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                                <td>{{ $item->judul }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Belum ada riwayat
                                                    penarikan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-2">{{ $riwayat->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-success text-white border-0">
                    <h5 class="modal-title fw-bold"><i class="fas fa-check-circle me-2"></i>Konfirmasi Penarikan</h5>
                    <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <p class="text-muted mb-1">Anda akan melakukan penarikan sebesar</p>
                        <h2 class="text-success fw-bold" id="summaryNominal">Rp 0</h2>
                    </div>

                    <div class="card bg-light border-0 mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Bank Tujuan</span>
                                <span class="fw-bold" id="summaryBank">-</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">No. Rekening</span>
                                <span class="fw-bold" id="summaryRekening">-</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Atas Nama</span>
                                <span class="fw-bold" id="summaryAtasNama">-</span>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                        <div class="small">
                            Pastikan data sudah benar. Saldo akan langsung terpotong dan tercatat sebagai pengeluaran
                            setelah proses ini.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-link text-muted text-decoration-none"
                        data-mdb-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success px-4" onclick="submitForm()">
                        <i class="fas fa-paper-plane me-2"></i>Ya, Proses Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        const saldoTersedia = {{ $saldoSaatIni }};

        function validateBalance() {
            const input = document.getElementById('nominalInput');
            const errorMsg = document.getElementById('balanceError');
            const btn = document.getElementById('btnSubmit');
            const val = parseFloat(input.value);

            if (val > saldoTersedia) {
                errorMsg.style.display = 'block';
                input.classList.add('is-invalid');
                input.classList.add('text-danger');
                btn.disabled = true;
            } else {
                errorMsg.style.display = 'none';
                input.classList.remove('is-invalid');
                input.classList.remove('text-danger');
                btn.disabled = false;
            }
        }

        function confirmWithdrawal() {
            const nominal = document.getElementById('nominalInput').value;
            const bank = document.querySelector('select[name="bank_tujuan"]').value;
            const rekening = document.querySelector('input[name="no_rekening"]').value;
            const atasNama = document.querySelector('input[name="atas_nama"]').value;
            const pass = document.querySelector('input[name="password_konfirmasi"]').value;

            if (!nominal || !rekening || !atasNama || !pass) {
                alert('Harap lengkapi semua form termasuk password konfirmasi!');
                return;
            }

            if (parseFloat(nominal) > saldoTersedia) {
                alert('Nominal melebihi saldo tersedia!');
                return;
            }

            document.getElementById('summaryNominal').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(nominal);
            document.getElementById('summaryBank').innerText = bank;
            document.getElementById('summaryRekening').innerText = rekening;
            document.getElementById('summaryAtasNama').innerText = atasNama;

            const modal = new mdb.Modal(document.getElementById('confirmModal'));
            modal.show();
        }

        function submitForm() {
            document.getElementById('withdrawalForm').submit();
        }
    </script>
</body>

</html>
