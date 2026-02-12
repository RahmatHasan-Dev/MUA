<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Profil Admin | MUA</title>
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

        .profile-card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .profile-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            height: 150px;
        }

        .avatar-wrapper {
            margin-top: -75px;
            text-align: center;
        }

        .avatar-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #fff;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card profile-card mb-4">
                        <div class="profile-header"></div>
                        <div class="card-body pt-0">
                            <div class="avatar-wrapper">
                                @if ($user->foto_profil)
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Avatar"
                                        class="avatar-img">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=10b981&color=fff&size=150"
                                        alt="Avatar" class="avatar-img">
                                @endif
                            </div>
                            <div class="text-center mt-3">
                                <h4 class="mb-0 fw-bold">{{ $user->nama }}</h4>
                                <p class="text-muted">{{ $user->email }}</p>
                                <span class="badge bg-success">Administrator</span>
                            </div>

                            <hr class="my-4">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ old('nama', $user->nama) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">No. Handphone</label>
                                        <input type="text" name="no_hp" class="form-control"
                                            value="{{ old('no_hp', $user->no_hp) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Foto Profil</label>
                                        <input type="file" name="foto_profil" class="form-control" accept="image/*">
                                    </div>

                                    <div class="col-12 mt-4">
                                        <h6 class="text-muted text-uppercase small fw-bold">Ganti Password (Opsional)
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Kosongkan jika tidak ingin mengganti">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Ulangi password baru">
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-success btn-lg shadow-0">
                                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>
