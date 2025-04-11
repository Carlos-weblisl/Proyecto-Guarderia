@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/niños.css') }}">
@endpush

@section('content')
<div class="container">
    <h1 class="mb-4 titulo-ninos">Lista de Niños</h1>

    <!-- Botón para registrar un nuevo niño -->
    <div class="mb-3 text-end">
        <a href="{{ route('ninos.create') }}" class="btn btn-agregar">
            <i class="fas fa-plus"></i> Registrar Niño
        </a>
    </div>

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabla de niños -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered tabla-ninos">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Edad</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Nombre del Tutor</th>
                    <th>Teléfono del Tutor</th>
                    <th>Alergias</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($ninos as $nino)
                <tr>
                    <td>{{ $nino->id }}</td>
                    <td>{{ $nino->nombre_completo }}</td>
                    <td>{{ $nino->sexo }}</td>
                    <td>{{ $nino->edad }} años</td>
                    <td>{{ \Carbon\Carbon::parse($nino->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $nino->nombre_tutor }}</td>
                    <td>{{ $nino->telefono_tutor }}</td>
                    <td>{{ $nino->alergias ? $nino->alergias : 'Ninguna' }}</td>
                    <td class="d-flex justify-content-center gap-2 acciones-ninos">
                        <a href="{{ route('ninos.show', $nino->id) }}" class="btn btn-ver btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('ninos.edit', $nino->id) }}" class="btn btn-editar btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('ninos.destroy', $nino->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-eliminar btn-sm" onclick="return confirm('¿Seguro que deseas eliminar?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No hay niños registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
