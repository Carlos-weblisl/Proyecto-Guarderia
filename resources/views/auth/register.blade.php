<!doctype html>
<html lang="es">
<head>
    <title>Registro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    
    <style>
        .right-section {
            background-color: #f8f9fa;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row shadow-lg rounded overflow-hidden" style="max-width: 900px; width: 100%;">
            <!-- Sección del formulario -->
            <div class="col-md-6 p-4 bg-white">
                <div class="text-center mb-4">
                    <img src="{{ asset('imagenes/divertiti.png') }}" height="100" alt="Logo">
                    <h4 class="mt-2">Registro de Usuario</h4>
                </div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese su nombre" value="{{ old('name') }}">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese su apellido" value="{{ old('apellido') }}">
                        @error('apellido') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese su correo" value="{{ old('email') }}">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select name="rol" id="rol" class="form-select">
                            <option value="empleado" {{ old('rol') == 'empleado' ? 'selected' : '' }}>Empleado</option>
                            <option value="administrador" {{ old('rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="cajero" {{ old('rol') == 'cajero' ? 'selected' : '' }}>Cajero</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">Crear Cuenta</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p class="mb-0">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-decoration-none">Iniciar sesión</a></p>
                </div>
            </div>

            <!-- Sección de información adicional -->
            <div class="col-md-6 right-section">
                <h2>Jardín de Infantes</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
