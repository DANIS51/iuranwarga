@extends('template')

@section('content')
<style>
    body {
        background-color: #202225;
        color: white;
    }

    .login-card {
        background-color: #2f3136;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    }

    .form-control {
        background-color: #40444b;
        border: 1px solid #5865F2;
        color: white;
    }

    .form-control:focus {
        background-color: #40444b;
        border-color: #7289da;
        color: white;
        box-shadow: none;
    }

    .btn-outline-discord {
        border: 2px solid #5865F2;
        background-color: transparent;
        color: #5865F2;
        padding: 6px 20px;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease-in-out;
        text-decoration: none;
        display: inline-block;
    }

    .btn-outline-discord:hover {
        background-color: #5865F2;
        color: #fff;
        text-decoration: none;
    }

    .btn-discord {
        background-color: #5865F2;
        color: white;
        border-radius: 50px;
        font-weight: bold;
        padding: 10px 30px;
        transition: all 0.3s ease-in-out;
    }

    .btn-discord:hover {
        background-color: #4752c4;
        color: white;
    }
</style>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5 login-card">
        <h2 class="mb-4 text-center">Log In</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>

            <!-- Submit Button -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-discord">
                    Log In
                </button>
            </div>

            <!-- Link Tambahan -->
            <div class="d-flex justify-content-center align-items-center">
                <span class="text-white me-2">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="">Daftar di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection
