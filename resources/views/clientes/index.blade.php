<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes | Divertiti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">
</head>
<body>

<!-- Barra superior negra con enlace a Home -->
<div class="barra-superior">
    <a href="{{ route('home') }}" class="logo">Divertit<i style="color: green;">i</i></a>
</div>

<!-- Contenido principal -->
<div class="container mt-4">
    <h1 class="titulo text-center">Gestión de <span class="clientes">Clientes</span></h1>

    <div class="text-center mb-3">
        <a href="{{ route('clientes.create') }}" class="btn btn-primary rounded-pill">Agregar Cliente</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Tipo Doc</th>
                    <th>N° Doc</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Forma de Pago</th>
                    <th>Distrito</th>
                    <th>Departamento</th>
                    <th>Provincia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->tipo_documento }}</td>
                    <td>{{ $cliente->numero_documento }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->forma_pago }}</td>
                    <td>{{ $cliente->distrito }}</td>
                    <td>{{ $cliente->departamento }}</td>
                    <td>{{ $cliente->provincia }}</td>
                    <td class="acciones text-center">
                        <!-- Botón Editar -->
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-editar rounded-pill" title="Editar Cliente">✏️</a>
                        <!-- Formulario para Eliminar -->
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar rounded-pill" title="Eliminar Cliente" onclick="return confirm('¿Eliminar a {{ $cliente->nombre }}?')">🗑️</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
