<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Iuran Warga')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            overflow-y: auto;
        }
        .sidebar .logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .sidebar .brand-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .sidebar .nav-link {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: flex;
            align-items: center;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .nav-link i {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="https://i.pinimg.com/736x/19/ef/da/19efda2ce4d5433bdd5e3088eb6d8084.jpg" class="logo" alt="Logo" />
        <div class="brand-name">Iuran Warga v2.0</div>

        <ul class="nav flex-column mt-4 w-100">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.warga.index') }}">
                    <i class="bi bi-people me-2"></i> Warga
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.members.index') }}">
                    <i class="bi bi-list-ul me-2"></i> Anggota
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.payments.index') }}">
                    <i class="bi bi-cash me-2"></i> Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dues.index') }}">
                    <i class="bi bi-receipt me-2"></i> Iuran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.officers.index') }}">
                    <i class="bi bi-person-badge me-2"></i> Petugas
                </a>
            </li>
            <li class="nav-item mt-auto">
                <button type="button" class="nav-link border-0 bg-transparent w-100 text-start" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                </button>
            </li>
        </ul>

        <!-- Keluar Confirmation Modal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin keluar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">Ya, Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
