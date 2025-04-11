@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Niño</h1>
    <link href="{{ asset('css/createN.css') }}" rel="stylesheet">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ninos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre_completo" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="{{ old('nombre_completo') }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required max="{{ date('Y-m-d') }}">
        </div>

        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-control" id="sexo" name="sexo" required>
                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ old('sexo') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="nombre_tutor" class="form-label">Nombre del Tutor</label>
            <input type="text" class="form-control" id="nombre_tutor" name="nombre_tutor" value="{{ old('nombre_tutor') }}" required>
        </div>

        <div class="mb-3">
            <label for="dni_tutor" class="form-label">DNI del Tutor</label>
            <input type="text" class="form-control" id="dni_tutor" name="dni_tutor" value="{{ old('dni_tutor') }}" pattern="\d{8}" title="Debe contener 8 dígitos" required>
        </div>

        <div class="mb-3">
            <label for="telefono_tutor" class="form-label">Teléfono del Tutor</label>
            <input type="text" class="form-control" id="telefono_tutor" name="telefono_tutor" value="{{ old('telefono_tutor') }}" pattern="\d{9}" title="Debe contener 9 dígitos" required>
        </div>

        <div class="mb-3">
            <label for="email_tutor" class="form-label">Correo Electrónico del Tutor</label>
            <input type="email" class="form-control" id="email_tutor" name="email_tutor" value="{{ old('email_tutor') }}">
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <textarea class="form-control" id="direccion" name="direccion">{{ old('direccion') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="alergias" class="form-label">Alergias</label>
            <textarea class="form-control" id="alergias" name="alergias">{{ old('alergias') }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="autorizacion_primeros_auxilios" name="autorizacion_primeros_auxilios" value="1" {{ old('autorizacion_primeros_auxilios') ? 'checked' : '' }}>
            <label class="form-check-label" for="autorizacion_primeros_auxilios">Autorizo primeros auxilios</label>
        </div>

        <button type="submit" class="btn btn-success">Registrar</button>
        <a href="{{ route('ninos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    document.getElementById('fecha_nacimiento').addEventListener('input', function() {
        let fecha = this.value;
        let partes = fecha.split('-');
        if (partes[0] && partes[0].length > 4) {
            this.value = partes[0].slice(0, 4) + '-' + (partes[1] || '') + '-' + (partes[2] || '');
        }
    });
</script>
@endsection
