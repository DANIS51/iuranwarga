<style>
    .nav-link {
  display: flex;
  align-items: center;
  font-size: 15px;
}

.nav-link i {
  font-size: 18px;
}

</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="sidebar">
    <img src="https://i.pinimg.com/736x/19/ef/da/19efda2ce4d5433bdd5e3088eb6d8084.jpg" class="logo" alt="Logo" />
    <div class="brand-name">Iuran Warga</div>

    <ul class="nav flex-column mt-4 w-100">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('officer.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('officer.payments.approve') }}">
                <i class="bi bi-person-lines-fill me-2"></i> Data Anggota Iuran
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('officer.payments.reject') }}">
                <i class="bi bi-cash-coin me-2"></i> Data Pembayaran
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('officers') }}">
                <i class="bi bi-plus-circle me-2"></i> Tambah Pembayaran
            </a>
        </li>

        <li class="nav-item mt-auto">
            <button type="button" class="nav-link border-0 bg-transparent w-100 text-start" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </li>

        <!-- Logout Confirmation Modal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">Ya, Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </ul>

</div>
