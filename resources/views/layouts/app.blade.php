<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Registro de niños')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Barra superior personalizada */
        .barra-superior {
            background-color: #00bcd4; /* Azul turquesa */
            padding: 10px 0;
            text-align: center;
        }

        /* Estilo para el logo Divertiti */
        .logo {
            font-size: 2.5rem;
            font-weight: 600;
            color: #fdd835; /* Amarillo para Divertiti */
            font-style: italic;
            text-decoration: none;
        }

        /* Estilo para la 'i' verde e inclinada */
        .logo i {
            color: #4caf50; /* Verde para la 'i' */
            font-style: italic;
            transform: rotate(-10deg); /* Inclinación de la 'i' */
        }

        /* Asegura que el texto del enlace no se subraye */
        .logo:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Barra superior con el enlace Divertiti -->
    <div class="barra-superior">
        <a href="{{ route('home') }}" class="logo">Divertit<i>i</i></a>
    </div>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
