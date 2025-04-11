@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles del Niño</h2>
    
    <div class="mb-3">
        <strong>Nombre Completo:</strong> {{ $nino->nombre_completo }}
    </div>

    <div class="mb-3">
        <strong>Fecha de Nacimiento:</strong> {{ $nino->fecha_nacimiento }}
    </div>

    <div class="mb-3">
        <strong>Sexo:</strong> {{ $nino->sexo }}
    </div>

    <div class="mb-3">
        <strong>Nombre del Tutor:</strong> {{ $nino->nombre_tutor }}
    </div>

    <div class="mb-3">
        <strong>DNI del Tutor:</strong> {{ $nino->dni_tutor }}
    </div>

    <div class="mb-3">
        <strong>Teléfono del Tutor:</strong> {{ $nino->telefono_tutor }}
    </div>

    <div class="mb-3">
        <strong>Alergias:</strong> {{ $nino->alergias ?? 'Ninguna' }}
    </div>

    <a href="{{ route('ninos.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
