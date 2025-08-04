<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }
        header, footer {
            background: #007BFF;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        main {
            padding: 2rem;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <header>
        <h1>CD Landing Page</h1>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <p>&copy; 2025 My CD Website</p>
    </footer>

</body>
</html>
