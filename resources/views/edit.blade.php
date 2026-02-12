<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .profile-container {
            max-width: 800px;
            margin: 120px auto 60px;
            padding: 20px;
        }

        .profile-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header h2 {
            color: #2d6a4f;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #40916c;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8f3dc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #52b788;
            outline: none;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.2);
        }

        .btn-save {
            background-color: #2d6a4f;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-save:hover {
            background-color: #1b4332;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Navbar (Menggunakan struktur yang sama dengan halaman lain) -->
    @include('partials.navbar')

    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <i class="bi bi-person-bounding-box" style="font-size: 3rem; color: #2d6a4f;"></i>
                <h2>Edit Profil</h2>
                <p>Perbarui informasi pribadi Anda</p>
            </div>

            @if (session('status') === 'profile-updated')
                <div class="alert-success">
                    <i class="bi bi-check-circle-fill"></i> Profil berhasil diperbarui.
                </div>
            @endif

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input id="nama" name="nama" type="text" class="form-control"
                        value="{{ old('nama', $user->nama) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP</label>
                    <input id="no_hp" name="no_hp" type="text" class="form-control"
                        value="{{ old('no_hp', $user->no_hp) }}">
                </div>

                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control"
                        value="{{ old('tgl_lahir', $user->tgl_lahir ? $user->tgl_lahir->format('Y-m-d') : '') }}">
                </div>

                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>

</html>
