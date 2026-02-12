<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Kelola Users | MUA Admin</title>
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
                    <h5 class="mb-0"><strong><i class="fas fa-users me-2"></i>Daftar Pengguna</strong></h5>
                </div>
                <div class="card-body">
                    <!-- Search & Export -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <form action="{{ route('admin.users') }}" method="GET" class="d-flex gap-2">
                                <!-- Input Pencarian -->
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari Nama, Email, HP..." value="{{ request('search') }}">
                                    <button class="btn btn-success" type="submit"><i
                                            class="fas fa-search"></i></button>
                                </div>

                                <!-- Filter Role (Dropdown) -->
                                <select name="role" class="form-select" style="width: 150px;"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Role</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User
                                    </option>
                                </select>

                                @if (request('search') || request('role'))
                                    <a href="{{ route('admin.users') }}" class="btn btn-danger px-3"
                                        title="Reset Filter"><i class="fas fa-times"></i></a>
                                @endif
                            </form>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.users.export') }}" class="btn btn-success"><i
                                    class="fas fa-file-csv me-2"></i>Export CSV</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                    <!-- Header Tabel dengan Fitur Sorting -->
                                    <th>
                                        <a href="{{ route('admin.users', array_merge(request()->query(), ['sort' => 'nama', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                            class="text-dark text-decoration-none">
                                            Nama <i class="fas fa-sort ms-1"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.users', array_merge(request()->query(), ['sort' => 'email', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                            class="text-dark text-decoration-none">
                                            Email <i class="fas fa-sort ms-1"></i>
                                        </a>
                                    </th>
                                    <th>No HP</th>
                                    <th>
                                        <a href="{{ route('admin.users', array_merge(request()->query(), ['sort' => 'role', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                            class="text-dark text-decoration-none">
                                            Role <i class="fas fa-sort ms-1"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.users', array_merge(request()->query(), ['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                            class="text-dark text-decoration-none">
                                            Tanggal Bergabung <i class="fas fa-sort ms-1"></i>
                                        </a>
                                    </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!-- Logika Avatar: Jika ada foto (misal fitur upload ada) tampilkan, jika tidak gunakan UI Avatars -->
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=random"
                                                    class="rounded-circle" alt=""
                                                    style="width: 45px; height: 45px" />
                                                <div class="ms-3">
                                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                                        class="fw-bold mb-1 text-success text-decoration-none">
                                                        {{ $user->nama }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->no_hp ?? '-' }}</td>
                                        <td>
                                            @if ($user->role == 'admin')
                                                <span class="badge badge-danger rounded-pill d-inline">Admin</span>
                                            @else
                                                <span class="badge badge-info rounded-pill d-inline">User</span>
                                            @endif

                                            @if (!$user->is_active)
                                                <span
                                                    class="badge badge-danger rounded-pill d-inline ms-1">Blocked</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : '-' }}
                                        </td>
                                        <td>
                                            @if (auth()->id() != $user->id)
                                                <form action="{{ route('admin.users.block', $user->id) }}"
                                                    method="POST" class="d-inline block-form">
                                                    @csrf
                                                    @method('PATCH')

                                                    @if ($user->is_active)
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm btn-rounded btn-block-user"
                                                            title="Blokir User">
                                                            <i class="fas fa-ban"></i>
                                                        </button>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-success btn-sm btn-rounded btn-block-user"
                                                            title="Aktifkan User">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    @endif
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links('pagination::bootstrap-5') }}
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
