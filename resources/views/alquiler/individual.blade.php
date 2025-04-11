@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Alquiler Individual</h2>
    <form action="{{ route('alquiler.guardar') }}" method="POST">
        @csrf
        <input type="hidden" name="tipo" value="individual">

        <label for="dni">Cliente:</label>
        <div style="display: flex; align-items: center;">
            <input type="text" id="dni" name="dni" placeholder="Ingrese el DNI o nombre del cliente" autocomplete="off">
            <button type="button" id="agregarDni" class="btn-agregar">+ Agregar</button>
        </div>
        <ul id="clientes-sugerencias" class="sugerencias"></ul>

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

<!-- Agregar jQuery para la búsqueda dinámica -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#dni").on("input", function () {
            let query = $(this).val();
            if (query.length >= 3) { // Inicia la búsqueda después de 3 caracteres
                $.ajax({
                    url: "{{ route('clientes.buscar') }}", // Ruta que devolverá los clientes
                    type: "GET",
                    data: { query: query },
                    success: function (data) {
                        $("#clientes-sugerencias").empty();
                        if (data.length > 0) {
                            data.forEach(function (cliente) {
                                $("#clientes-sugerencias").append(`
                                    <li class="sugerencia-item" data-dni="${cliente.dni}">
                                        ${cliente.dni} - ${cliente.nombre}
                                    </li>
                                `);
                            });
                        }
                    }
                });
            } else {
                $("#clientes-sugerencias").empty();
            }
        });

        // Llenar el input al hacer clic en una sugerencia
        $(document).on("click", ".sugerencia-item", function () {
            $("#dni").val($(this).data("dni"));
            $("#clientes-sugerencias").empty();
        });
    });
</script>

<style>
    .sugerencias {
        list-style: none;
        padding: 0;
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
        position: absolute;
        width: 200px;
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

<!-- Modal para agregar nuevo cliente -->
<div id="modalAgregarDni" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Nuevo Cliente</h2>
        <form id="formNuevoCliente">
            @csrf

            <div class="form-group">
                <label for="tipo_doc">Tipo Doc. Identidad *</label>
                <select id="tipo_doc" name="tipo_doc" required>
                    <option value="DNI">DNI</option>
                    <option value="RUC">RUC</option>
                    <option value="CE">Carnet de Extranjería</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nuevo_dni">Número *</label>
                <div class="dni-container">
                    <input type="text" id="nuevo_dni" name="nuevo_dni" minlength="8" maxlength="11" required>
                    <button type="button" id="buscarDniModal" class="btn-reniec">🔍 RENIEC</button>
                </div>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre *</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono">
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo">
            </div>

            <div class="form-group">
                <label for="tipo_cliente">Tipo de Cliente</label>
                <select id="tipo_cliente" name="tipo_cliente">
                    <option value="">Seleccionar</option>
                    <option value="regular">Regular</option>
                    <option value="vip">VIP</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
</div>


<style>
/* Estilos del modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 50%;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
}

.close {
    float: right;
    font-size: 24px;
    cursor: pointer;
}

.form-group {
    margin-bottom: 15px;
}

.dni-container {
    display: flex;
    align-items: center;
}

.dni-container input {
    flex-grow: 1;
    margin-right: 5px;
}

.btn-reniec {
    background-color: #ddd;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

.btn-reniec:hover {
    background-color: #ccc;
}

.btn-cancelar {
    background-color: #ddd;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
}

.btn-guardar {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
</style>

<script>
document.getElementById('agregarDni').addEventListener('click', function() {
    document.getElementById('modalAgregarDni').style.display = 'flex';
});

document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('modalAgregarDni').style.display = 'none';
});

document.getElementById('formNuevoCliente').addEventListener('submit', function(event) {
    event.preventDefault();
    document.getElementById('modalAgregarDni').style.display = 'none';
});

// Buscar datos por DNI con API
document.getElementById('buscarDni').addEventListener('click', function() {
    buscarDni(document.getElementById("dni").value);
});

document.getElementById('buscarDniModal').addEventListener('click', function() {
    buscarDni(document.getElementById("nuevo_dni").value, true);
});

function buscarDni(dni, esModal = false) {
    if (dni.length !== 8) {
        alert("Ingrese un DNI válido de 8 dígitos.");
        return;
    }

    fetch(`https://dniruc.apisperu.com/api/v1/dni/${dni}?token=TU_TOKEN_AQUI`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("nuevo_dni").value = dni;
            document.getElementById("nombre").value = data.nombre;
            document.getElementById("direccion").value = data.direccion || "";
            document.getElementById("telefono").value = data.telefono || "";
            document.getElementById("correo").value = data.correo || "";

            if (!esModal) {
                document.getElementById('modalAgregarDni').style.display = 'flex';
            }
        } else {
            alert("No se encontraron datos para este DNI.");
        }
    })
    .catch(error => console.error("Error en la consulta:", error));
}
</script>
@endsection
