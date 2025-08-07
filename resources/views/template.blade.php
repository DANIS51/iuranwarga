<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Landing Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #1e2140, #060714);
        color: white;
    }

    main {
        flex: 1;
    }

    .section {
      padding: 100px 0;
    }

    .section h1 {
      font-size: 3rem;
      font-weight: 800;
      line-height: 1.2;
    }

    .section p {
      font-size: 1.125rem;
      line-height: 1.6;
      margin-top: 1rem;
      margin-bottom: 2rem;
    }

    .section-img {
      max-width: 100%;
    }

    .nav-link {
      color: white !important;
      font-weight: bold;
      margin: 0 10px;
    }
  </style>
</head>
<body>
  @include('navbar')

  <main>
    @yield('content')
  </main>

  <footer class="text-center text-white py-3" style="background-color: #1e2140;">
    <p>&copy; 2025 MyCD by Danis Maulid</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</html>
