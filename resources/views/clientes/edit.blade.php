@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Cliente</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Error!</strong> Por favor revisa los campos obligatorios.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Dirección:</label>
                <input type="text" name="direccion" value="{{ old('direccion', $cliente->direccion) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Teléfono:</label>
                <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email', $cliente->email) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tipo de Documento:</label>
                <select name="tipo_documento" class="form-control" required>
                    <option value="DNI" {{ old('tipo_documento', $cliente->tipo_documento) == 'DNI' ? 'selected' : '' }}>DNI</option>
                    <option value="Pasaporte" {{ old('tipo_documento', $cliente->tipo_documento) == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                    <option value="Carné de extranjería" {{ old('tipo_documento', $cliente->tipo_documento) == 'Carné de extranjería' ? 'selected' : '' }}>Carné de extranjería</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Número de Documento:</label>
                <input type="text" name="numero_documento" value="{{ old('numero_documento', $cliente->numero_documento) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Número de RUC:</label>
                <input type="text" name="numero_ruc" value="{{ old('numero_ruc', $cliente->numero_ruc) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Forma de Pago:</label>
                <select name="forma_pago" class="form-control">
                    <option value="Efectivo" {{ old('forma_pago', $cliente->forma_pago) == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                    <option value="Tarjeta" {{ old('forma_pago', $cliente->forma_pago) == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                    <option value="Transferencia" {{ old('forma_pago', $cliente->forma_pago) == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Distrito:</label>
                <input type="text" name="distrito" value="{{ old('distrito', $cliente->distrito) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Departamento:</label>
                <input type="text" name="departamento" value="{{ old('departamento', $cliente->departamento) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Provincia:</label>
                <input type="text" name="provincia" value="{{ old('provincia', $cliente->provincia) }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
        </form>
    </div>
@endsection
