@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/AgreClientes.css') }}">
@section('content')
<div class="container">
    <h2 class="mb-4">Registrar Nuevo Cliente</h2>

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

    <form action="{{ route('clientes.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Dirección:</label>
                <input type="text" name="direccion" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Teléfono:</label>
                <input type="text" name="telefono" class="form-control" placeholder="+51987654321">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tipo de Documento:</label>
                <select name="tipo_documento" class="form-control">
                    <option value="">Seleccione...</option>
                    <option value="DNI">DNI</option>
                    <option value="RUC">RUC</option>
                    <option value="Pasaporte">Pasaporte</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Número de Documento:</label>
                <input type="text" name="numero_documento" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Número de RUC:</label>
                <input type="text" name="numero_ruc" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Forma de Pago:</label>
                <select name="forma_pago" class="form-control">
                    <option value="">Seleccione...</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Transferencia">Transferencia</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Distrito:</label>
                <input type="text" name="distrito" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Departamento:</label>
                <input type="text" name="departamento" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Provincia:</label>
                <input type="text" name="provincia" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cliente</button>
    </form>
</div>
@endsection
