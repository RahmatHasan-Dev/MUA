<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - {{ config('app.name', 'MUA') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1 style="font-size: 4rem; font-weight: 600; color: var(--primary-green); text-align: center; margin-bottom: 0.5rem;">MUA</h1>
                <p class="login-subtitle">Selamatkan Bumi, Lestarikan Keanekaragaman Hayati</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama Anda">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email Anda">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required placeholder="Masukkan password Anda">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Konfirmasi password Anda">
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="login-actions">
                    <button type="submit" class="btn-login">
                        Daftar
                    </button>
                </div>
            </form>

            @if (Route::has('login'))
                <div class="register-section">
                    <p class="register-text">Sudah punya akun?</p>
                    <a href="{{ route('login') }}" class="register-link">Masuk sekarang</a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>