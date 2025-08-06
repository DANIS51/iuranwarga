<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Landing Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #1e2140, #060714);
      color: white;
    }

    .hero {
      padding: 100px 0;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 800;
      line-height: 1.2;
    }

    .hero p {
      font-size: 1.125rem;
      line-height: 1.6;
      margin-top: 1rem;
      margin-bottom: 2rem;
    }

    .hero-img {
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

  @include('admin.navbar-admin')



    <div class="container">
      <h1>Welcome to Our Community</h1>
      <p>Join us in making a difference in our neighborhood.</p>
      <img src="https://i.pinimg.com/736x/19/ef/da/19efda2ce4d5433bdd5e3088eb6d8084.jpg" alt="Community Image" class="hero-img">
    </div>
  </div>
  
  @yield('content')
 <footer class=" text-center text-white">
        <p>&copy; 2025 My CD danis maulid</p>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
