<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Biblioteca - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand { font-weight: bold; }
        .sidebar { background-color: #f8f9fa; padding: 20px 0; }
        .sidebar .nav-link { color: #333; padding: 10px 20px; }
        .sidebar .nav-link:hover { background-color: #e9ecef; }
        .main-content { padding: 20px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                📚 Sistema Biblioteca
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar d-none d-md-block">
                <div class="list-group">
                    <a href="{{ route('home') }}" class="list-group-item list-group-item-action {{ Request::is('/') ? 'active' : '' }}">
                        🏠 Início
                    </a>
                    <a href="{{ route('books.index') }}" class="list-group-item list-group-item-action {{ Request::is('books*') ? 'active' : '' }}">
                        📖 Livros
                    </a>
                    <a href="{{ route('authors.index') }}" class="list-group-item list-group-item-action {{ Request::is('authors*') ? 'active' : '' }}">
                        👤 Autores
                    </a>
                    <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action {{ Request::is('categories*') ? 'active' : '' }}">
                        🏷️ Categorias
                    </a>
                </div>
            </div>
            <div class="col-md-10 main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>