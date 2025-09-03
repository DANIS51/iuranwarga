@extends('template')
@section('title', 'Login - Iuran Warga')
@section('content')

<!-- Simple Login Styling -->
<style>
    .login-card {
        max-width: 400px;
        margin: auto;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 6px;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-right: 0;
    }

    .form-control {
        border-left: 0;
    }

    .input-group .input-group-text:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .input-group .form-control:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .btn-primary {
        border-radius: 8px;
    }

    .invalid-feedback {
        display: block;
    }
</style>

<div class="container py-5">
    <div class="login-card bg-white">
        <h4 class="text-center mb-4 text-primary">
            <i class="fas fa-sign-in-alt"></i> Login
        </h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text"
                           id="username"
                           name="username"
                           class="form-control @error('username') is-invalid @enderror"
                           placeholder="Masukkan username"
                           value="{{ old('username') }}"
                           required
                           autofocus>
                </div>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Masukkan password"
                           required>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

@endsection
