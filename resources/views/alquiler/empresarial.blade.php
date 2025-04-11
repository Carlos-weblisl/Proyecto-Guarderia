@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Alquiler Empresarial</h2>
    <form action="{{ route('alquiler.guardar') }}" method="POST">
        @csrf
        <input type="hidden" name="tipo" value="empresarial">

        <label for="ruc">Empresa:</label>
        <div style="display: flex; align-items: center;">
            <input type="text" id="ruc" name="ruc" placeholder="Ingrese el RUC o nombre de la empresa" autocomplete="off">
            <button type="button" id="buscarRuc" class="btn-sunat">🔍</button>
            <button type="button" onclick="mostrarModal()" class="btn-agregar">+ Agregar</button>
        </div>
        <ul id="empresas-sugerencias" class="sugerencias"></ul>

        <label for="plan_id">Selecciona un Plan:</label>
        <select name="plan_id" required>
            @foreach($planes as $plan)
                <option value="{{ $plan->id }}">{{ $plan->nombre }} - ${{ $plan->precio }} por día</option>
            @endforeach
        </select>

        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" required>

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin" required>

        <button type="submit">Alquilar</button>
    </form>
</div>

<!-- Modal para añadir empresa -->
<div id="modalEmpresa" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid #ccc;">
    <h3>Añadir Empresa</h3>
    <label for="ruc_nuevo">RUC:</label>
    <div style="display: flex; align-items: center;">
        <input type="text" id="ruc_nuevo" name="ruc_nuevo" minlength="11" maxlength="11">
        <button type="button" onclick="buscarEmpresa()">🔍</button>
        <button type="button" id="reniec">RENIEC</button>
    </div>
    <br>
    <label for="nombre_empresa">Nombre:</label>
    <input type="text" id="nombre_empresa" name="nombre_empresa">
    <br>
    <label for="direccion_empresa">Dirección:</label>
    <input type="text" id="direccion_empresa" name="direccion_empresa">
    <br>
    <button type="button" onclick="cerrarModal()">Cancelar</button>
    <button type="button" onclick="guardarEmpresa()">Guardar</button>
</div>

<!-- jQuery para la búsqueda en vivo -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#ruc").on("input", function () {
            let query = $(this).val();
            if (query.length >= 3) { // Búsqueda después de 3 caracteres
                $.ajax({
                    url: "{{ route('empresas.buscar') }}", // Ruta para buscar empresas
                    type: "GET",
                    data: { query: query },
                    success: function (data) {
                        $("#empresas-sugerencias").empty();
                        if (data.length > 0) {
                            data.forEach(function (empresa) {
                                $("#empresas-sugerencias").append(`
                                    <li class="sugerencia-item" data-ruc="${empresa.ruc}">
                                        ${empresa.ruc} - ${empresa.nombre}
                                    </li>
                                `);
                            });
                        }
                    }
                });
            } else {
                $("#empresas-sugerencias").empty();
            }
        });

        // Llenar el input al hacer clic en una sugerencia
        $(document).on("click", ".sugerencia-item", function () {
            $("#ruc").val($(this).data("ruc"));
            $("#empresas-sugerencias").empty();
        });

        // Acción del botón RENIEC
        $("#reniec").click(function () {
            alert('Consulta RENIEC en proceso...');
        });
    });

    function mostrarModal() {
        document.getElementById('modalEmpresa').style.display = 'block';
    }

    function cerrarModal() {
        document.getElementById('modalEmpresa').style.display = 'none';
    }

    function buscarEmpresa() {
        alert('Buscando empresa con RUC: ' + document.getElementById('ruc_nuevo').value);
    }

    function guardarEmpresa() {
        alert('Empresa guardada con éxito.');
        cerrarModal();
    }
</script>

<style>
    .sugerencias {
        list-style: none;
        padding: 0;
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
        position: absolute;
        width: 250px;
        background: white;
        z-index: 1000;
    }
    .sugerencia-item {
        padding: 8px;
        cursor: pointer;
    }
    .sugerencia-item:hover {
        background: #ddd;
    }
</style>
@endsection
