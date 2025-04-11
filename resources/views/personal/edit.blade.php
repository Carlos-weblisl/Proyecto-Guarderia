@extends('layouts.admin')

<head>
    <link rel="stylesheet" href="{{ asset('css/Edpersonal.css') }}">
</head>

@section('content')
    <div class="container">
        <!-- Barra de Navegación con Divertiti -->
        <div class="logo-container">
            <a href="{{ route('home') }}" class="logo">
                Divertit<span class="second-i">i</span>
            </a>
        </div>

        <h2>Editar Personal</h2>

        <!-- Formulario de Edición -->
        <form action="{{ route('personal.update', $personal->id) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" value="{{ old('name', $personal->name) }}" required class="form-input">
            </div>

            <div class="form-group">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" name="apellido" value="{{ old('apellido', $personal->apellido) }}" required class="form-input">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" value="{{ old('email', $personal->email) }}" required class="form-input">
            </div>

            <div class="form-group">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" name="telefono" value="{{ old('telefono', $personal->telefono) }}" class="form-input">
            </div>

            <div class="form-group">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" name="direccion" value="{{ old('direccion', $personal->direccion) }}" class="form-input">
            </div>

            <div class="form-group">
                <label for="rol" class="form-label">Rol:</label>
                <select name="rol" required class="form-input">
                    <option value="empleado" {{ $personal->rol == 'empleado' ? 'selected' : '' }}>Empleado</option>
                    <option value="cajero" {{ $personal->rol == 'cajero' ? 'selected' : '' }}>Cajero</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-submit">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
