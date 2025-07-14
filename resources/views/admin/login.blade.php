<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Peminjaman Laboratorium - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    {{-- Tambahkan style bawaan Laravel atau buatan sendiri --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="login-card">
            <h1>Aplikasi Peminjaman Laboratorium</h1>
            <h2>Sign In</h2>

            {{-- Tampilkan error jika login gagal --}}
            @if($errors->any())
        <div style="color: red; margin-bottom: 10px;">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Form Login --}}
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="contoh@example.com" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="/" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            <p class="signup-link">
                Belum punya akun? Segera daftar pada <a href="#">halaman registrasi</a>
            </p>
        </div>
    </div>
</body>
</html>
