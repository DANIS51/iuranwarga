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
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.user') }}">
                <i class="bi bi-people-fill me-2"></i> Data Warga
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">
                <i class="bi bi-person-badge-fill me-2"></i> Officer
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">
                <i class="bi bi-tags-fill me-2"></i> Category
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">
                <i class="bi bi-person-lines-fill me-2"></i> Members
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">
                <i class="bi bi-cash-coin me-2"></i> Payment
            </a>
        </li>
    </ul>

</div>
