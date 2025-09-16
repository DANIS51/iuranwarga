<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>warga Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />
</head>
<body>
  <div class="main-wrapper">
    @include('officers.navbar-officer') <!-- Sidebar -->

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
