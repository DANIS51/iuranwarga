<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #1e2140, #060714);
      color: white;
    }

    .main-wrapper {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 240px;
      background-color: #1e2140;
      padding-top: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      border-right: 1px solid #2c2f4a;
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
      text-align: left;
      transition: background 0.3s;
    }

    .sidebar .nav-link:hover {
      background-color: #343a50;
    }

    .content-area {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .main-content {
      padding: 20px;
    }

    footer {
      background-color: #1e2140;
      color: white;
      padding: 1rem;
      text-align: center;
      border-top: 1px solid #2c2f4a;
    }

    table {
      color: white;
    }

    .table-dark thead {
      background-color: #2a2d48;
    }
  </style>
</head>
<body>
  <div class="main-wrapper">
    @include('admin.navbar-admin') <!-- Sidebar -->

    <div class="content-area">
      <div class="main-content">
        @yield('content')
      </div>
      <footer>
        <p>&copy; 2025 My CD Danis Maulid</p>
      </footer>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
