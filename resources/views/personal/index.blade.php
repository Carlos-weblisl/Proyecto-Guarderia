@extends('layouts.admin')

@section('content')
    <!-- Contenedor del logo, alineado a la izquierda -->
    <div class="logo-container">
        <a href="{{ route('home') }}" class="logo">
            Divertit<span class="second-i">i</span>
        </a>
    </div>

    <link rel="stylesheet" href="{{ asset('css/personal.css') }}">

    <h2>LISTA DE PERSONAL</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personals as $personal)
                <tr>
                    <td>{{ $personal->name }}</td>
                    <td>{{ $personal->apellido ?? 'No registrado' }}</td>
                    <td>{{ $personal->email }}</td>
                    <td>{{ $personal->telefono ?? 'No registrado' }}</td>
                    <td>{{ $personal->direccion ?? 'No registrada' }}</td>
                    <td>{{ ucfirst($personal->rol) }}</td>
                    <td>
                        <a href="{{ route('personal.edit', $personal->id) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
