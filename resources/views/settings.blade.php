<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - MUA</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .settings-container {
            max-width: 800px;
            margin: 120px auto 60px;
            padding: 20px;
        }

        .settings-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .settings-header {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .settings-header h2 {
            margin: 0;
            color: #2d6a4f;
        }

        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .setting-item:last-child {
            border-bottom: none;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2d6a4f;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }
    </style>
</head>

<body>

    @include('partials.navbar')


    <div class="settings-container">
        <div class="settings-card">
            <div class="settings-header">
                <h2><i class="bi bi-gear"></i> Pengaturan Akun</h2>
            </div>
            <div class="setting-item">
                <span>Notifikasi Email</span>
                <label class="toggle-switch"><input type="checkbox" checked><span class="slider"></span></label>
            </div>
            <div class="setting-item">
                <span>Tampilkan Profil ke Publik</span>
                <label class="toggle-switch"><input type="checkbox"><span class="slider"></span></label>
            </div>
        </div>

        <div class="settings-card">
            <div class="settings-header">
                <h2><i class="bi bi-shield-lock"></i> Keamanan & Privasi</h2>
            </div>

            <!-- Form Ubah Password -->
            <div style="padding: 20px 0; border-bottom: 1px solid #eee;">
                <form action="{{ route('settings.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if (session('success'))
                        <div
                            style="background-color: #d1e7dd; color: #0f5132; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            style="background-color: #f8d7da; color: #842029; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div style="margin-bottom: 15px;"><label
                            style="display:block; margin-bottom:5px; font-weight:600; color:#2d6a4f;">Password Saat
                            Ini</label><input type="password" name="current_password"
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;"></div>
                    <div style="margin-bottom: 15px;"><label
                            style="display:block; margin-bottom:5px; font-weight:600; color:#2d6a4f;">Password
                            Baru</label><input type="password" name="password"
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;"></div>
                    <div style="margin-bottom: 15px;"><label
                            style="display:block; margin-bottom:5px; font-weight:600; color:#2d6a4f;">Konfirmasi
                            Password Baru</label><input type="password" name="password_confirmation"
                            style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;"></div>

                    <button type="submit"
                        style="padding: 10px 20px; background-color: #2d6a4f; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Simpan
                        Password</button>
                </form>
            </div>

            <div class="setting-item">
                <span>Hapus Akun</span>
                <button
                    style="padding: 5px 15px; cursor: pointer; background: #ff6b6b; color: white; border: none; border-radius: 4px;">Hapus</button>
            </div>
        </div>
    </div>
</body>

</html>
