<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    html {
        scroll-behavior: smooth;
    }
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

  .navbar {
    background-color: #1e2140;
  }

  .navbar-brand img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    object-fit: cover;
  }

  .navbar-brand {
    color: white;
    font-weight: bold;
    font-size: 1.2rem;
  }

  .navbar-brand:hover {
    color: #ddd;
  }

  .nav-link {
    color: white !important;
    margin-right: 1rem;
    font-weight: 500;
  }

  .nav-link:hover {
    color: #ccc !important;
  }

  .btn-login {
    background-color: white;
    color: #1e2140;
    font-weight: bold;
    border-radius: 20px;
    padding: 6px 20px;
  }

  .btn-login:hover {
    background-color: #e0e0e0;
    color: #1e2140;
  }
</style>

<nav class="navbar navbar-expand-lg px-4 shadow">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="https://i.pinimg.com/736x/19/ef/da/19efda2ce4d5433bdd5e3088eb6d8084.jpg" alt="Logo" />
      <span class="ms-2">Iuran Warga</span>
    </a>

    <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      @auth
        <span class="navbar-text me-3 text-white ms-auto">Halo, {{ Auth::user()->name }}</span>
        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</button>
      @else
        <a href="{{ route('login') }}" class="btn btn-login ms-auto">Masuk</a>
      @endauth
    </div>
  </div>
</nav>

<!-- Keluar Modal -->
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
