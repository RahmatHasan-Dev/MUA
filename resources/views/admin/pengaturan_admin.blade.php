<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Pengaturan Akun | MUA Admin</title>
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
                    <div class="card shadow-0 border">
                        <div class="card-header border-bottom py-3">
                            <h5 class="mb-0"><strong><i class="fas fa-user-cog me-2"></i>Pengaturan Akun
                                    Admin</strong></h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.profile.update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Foto Profil -->
                                <div class="text-center mb-4">
                                    <img id="imagePreview"
                                        src="{{ auth()->user()->foto_profil ? asset('storage/' . auth()->user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->nama) . '&background=10b981&color=fff&size=128' }}"
                                        class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;"
                                        alt="Avatar">
                                    <div class="mt-3">
                                        <label for="foto_profil" class="btn btn-success btn-sm">
                                            <i class="fas fa-camera me-1"></i> Ganti Foto
                                        </label>
                                        <input type="file" name="foto_profil" id="foto_profil" class="d-none"
                                            onchange="previewImage(event)">
                                        @if (auth()->user()->foto_profil)
                                            <button type="button" class="btn btn-danger btn-sm ms-2"
                                                onclick="document.getElementById('delete-photo-form').submit()">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <!-- Nama -->
                                <div class="mb-4">
                                    <label class="form-label" for="nama">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" class="form-control"
                                        value="{{ old('nama', auth()->user()->nama) }}" required />
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control bg-light"
                                        value="{{ auth()->user()->email }}" readonly />
                                    <small class="text-muted">Email tidak dapat diubah.</small>
                                </div>

                                <!-- No HP -->
                                <div class="mb-4">
                                    <label class="form-label" for="no_hp">Nomor HP</label>
                                    <input type="text" id="no_hp" name="no_hp" class="form-control"
                                        value="{{ old('no_hp', auth()->user()->no_hp) }}" />
                                </div>

                                <hr class="my-4">
                                <p class="fw-bold">Ubah Password</p>

                                <!-- Password -->
                                <div class="mb-4">
                                    <label class="form-label" for="password">Password Baru</label>
                                    <input type="password" id="password" name="password" class="form-control" />
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="mb-4">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" />
                                </div>

                                <button type="submit" class="btn btn-success btn-block">Simpan Perubahan</button>
                            </form>

                            <!-- Form Khusus Hapus Foto -->
                            <form id="delete-photo-form" action="{{ route('admin.profile.delete_photo') }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>
