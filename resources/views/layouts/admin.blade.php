<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin InLabs')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            background-color: #00796B; /* Teal */
            min-height: 100vh;
            color: white;
            padding: 2rem 1rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #00695C;
        }

        .sidebar .active {
            background-color: #004D40;
            font-weight: bold;
        }

        .content {
            padding: 2rem;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar">
        @include('partials.sidebar')
    </div>

    <!-- Main Content -->
    <div class="col-md-10 content">
        <h2>@yield('title', 'Admin')</h2>
        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
