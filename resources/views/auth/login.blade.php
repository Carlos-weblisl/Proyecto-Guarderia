<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Divertiti</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <!-- Sección de Login -->
        <div class="login-section">
            <img src="{{ asset('imagenes/divertiti.png') }}" style="width: 300px; height: auto;" alt="Logo Divertiti">
            <h2>Iniciar Sesión</h2>

            <!-- Mostrar errores de validación -->
            @if ($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Ingresar Correo">
                
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="Ingresar Contraseña">
                
                <button type="submit" class="btn-ingresar">Ingresar</button>
            </form>
            
            <p class="register-link">¿Aún no tienes cuenta? 
                <a href="{{ route('register') }}">Registrarse</a>
            </p>
        </div>

        <!-- Sección de Bienvenida -->
        <div class="welcome-section">
            <h2>Bienvenidos a <span>Divertiti</span></h2>
            <p>El lugar donde la diversión nunca termina. Aquí encontrarás juegos, aventuras y muchas sorpresas para grandes y pequeños...</p>
        </div>
    </div>
</body>
</html>

