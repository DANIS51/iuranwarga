<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #1e2140, #060714);
      color: white;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 240px;
      height: 100vh;
      background-color: #1e2140;
      padding-top: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .sidebar .logo {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
    }

    .sidebar .brand-name {
      color: white;
      font-weight: bold;
      margin-top: 10px;
      font-size: 1.2rem;
    }

    .sidebar .nav-link {
      color: white !important;
      padding: 10px 20px;
      width: 100%;
      display: block;
      text-align: left;
      transition: background 0.3s;
    }

    .sidebar .nav-link:hover {
      background-color: #343a50;
    }

    .main-content {
      margin-left: 240px;
      padding: 20px;
    }

    footer {
      margin-left: 240px;
      padding: 1rem;
      text-align: center;
      background-color: #1e2140;
      color: white;
    }
  </style>
</head>
<body>

  @include('admin.navbar-admin') <!-- sidebar -->

  <div class="main-content">
    @yield('content') <!-- konten halaman -->
  </div>

  <footer>
    <p>&copy; 2025 My CD Danis Maulid</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
