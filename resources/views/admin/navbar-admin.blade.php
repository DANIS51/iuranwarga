<style>
    .navbar {
        background-color: #1e2140;
    }

    .navbar-brand img {
        border-radius: 50%;
    }

    .nav-link:hover {
        color: #f0f0f0 !important;
    }

    .btn-light {
        background-color: #ffffff;
        color: #1e2140;
    }

    .btn-light:hover {
        background-color: #e0e0e0;
    }

    .navbar .container-fluid {
        justify-content: center; /* ini yang bikin ke tengah */
    }

    .navbar-brand {
        display: flex;
        align-items: center;
    }

    .navbar-brand span {
        color: white;
        font-weight: bold;
    }

    .navbar-nav {
        justify-content: center;
        width: 100%;
    }

    .nav-link {
        color: white !important;
    }
</style>

<nav class="navbar navbar-expand-lg px-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://i.pinimg.com/736x/19/ef/da/19efda2ce4d5433bdd5e3088eb6d8084.jpg" class="logo" alt="Logo" width="40" />
      <span class="ms-2">Iuran Warga</span>
    </a>

    <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Daftar Warga</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Officer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Members</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Payment</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
