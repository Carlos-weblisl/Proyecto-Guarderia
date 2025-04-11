<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #00aaff; /* Azul claro */
            color: rgb(0, 0, 0);
            text-align: center;
            padding: 20px 0;
        }

        header h1 {
            font-size: 2rem;
            margin: 0;
            font-weight: 700;
            text-transform: uppercase; /* Convertir el texto a mayúsculas */
            font-family: 'Poppins', sans-serif; /* Cambiar la fuente a Poppins */
        }

        header nav {
            position: absolute;
            right: 20px;
            top: 20px;
        }

        header nav a {
            color: #ffdd57; /* Amarillo */
            font-size: 1.2rem;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        header nav a:hover {
            color: #f1c40f; /* Amarillo más brillante */
        }

        main {
            padding: 80px 20px 20px; /* Añadimos espacio arriba para el header fijo */
            text-align: center;
        }

        footer {
            background-color: #00aaff; /* Azul claro */
            color: rgb(0, 0, 0);
            padding: 10px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 1rem;
        }
    </style>
</head>
<body>

    <header>
        <h1>Administración de Divertiti</h1>
        <nav>
            <a href="{{ route('personal.index') }}">Personal</a>
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </header>
    
    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 - Divertiti</p>
    </footer>

</body>
</html>
