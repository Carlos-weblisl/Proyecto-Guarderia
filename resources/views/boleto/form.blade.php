    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h2>Registro de Boleta de Venta - {{ $title }}</h2>

        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('boleto.store', ['section' => $section]) }}" method="POST">
            @csrf

            <!-- Fila 1 -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="tipo_comprobante">Tipo comprobante</label>
                    <select class="form-control" id="tipo_comprobante" name="tipo_comprobante">
                        <option>BOLETA DE VENTA ELECTRÓNICA</option>
                        <option>FACTURA DE VENTA ELECTRÓNICA</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="establecimiento">Establecimiento</label>
                    <select class="form-control" id="establecimiento" name="establecimiento">
                        <option>Oficina Principal</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tipo_operacion">Tipo operación</label>
                    <select class="form-control" id="tipo_operacion" name="tipo_operacion">
                        <option>Venta interna</option>
                    </select>
                </div>
            </div>

            <!-- Fila 2 -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="cliente">Cliente</label>
                    <select class="form-control" id="cliente" name="cliente">
                        <option value="">Seleccione un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">
                                <!-- CAMBIO: Mostrar nombre + documento según el tipo -->
                                {{ $cliente->tipo_documento == 'RUC' ? $cliente->numero_documento . ' - ' . $cliente->razon_social : $cliente->numero_documento . ' - ' . $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevoCliente">
                        + Agregar nuevo cliente
                    </a>
                </div>
                <div class="col-md-4">
                    <label for="vendedor">Vendedor</label>
                    <select class="form-control" id="vendedor" name="vendedor">
                        <option>Administrador</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="fecha_emision">Fec. Emisión</label>
                    <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="{{ now()->format('Y-m-d') }}">
                </div>
            </div>


            <!-- Fila 3 -->
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="serie">Serie</label>
                    <select class="form-control" id="serie" name="serie">
                        <option>BE01</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="moneda">Moneda</label>
                    <select class="form-control" id="moneda" name="moneda">
                        <option>Soles</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="condicion_pago">Condición de pago</label>
                    <select class="form-control" id="condicion_pago" name="condicion_pago">
                        <option>Contado</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tipo_cambio">Tipo de cambio</label>
                    <input type="text" class="form-control" id="tipo_cambio" name="tipo_cambio" value="3.705">
                </div>
            </div>

            <!-- Fila 4 -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="metodo_pago">Método de pago</label>
                    <select class="form-control" id="metodo_pago" name="metodo_pago">
                        <option>Efectivo</option>
                    </select>
                    <button type="button" class="btn btn-outline-success btn-sm mt-1">+ Agregar Método de Pago</button>
                </div>
                <div class="col-md-4">
                    <label for="destino">Destino</label>
                    <select class="form-control" id="destino" name="destino">
                        <option>CAJA GENERAL</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="referencia">Referencia</label>
                    <input type="text" class="form-control" id="referencia" name="referencia">
                </div>
            </div>

            <!-- Fila 5 -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="monto">Monto</label>
                    <input type="number" class="form-control" id="monto" name="monto" value="0">
                </div>
            </div>

            <!-- Información Adicional -->
            <div class="row mt-4">
                <div class="col">
                    <h5 class="text-success">+ Información Adicional</h5>
                    <hr>
                </div>
            </div>

            <!-- Tabla de Productos -->
            <div class="table-responsive">
                <table class="table table-bordered mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Unidad</th>
                            <th>Cantidad</th>
                            <th>Valor Unitario</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se pueden iterar productos ya agregados o dejar la tabla vacía para ser llenada por el usuario -->
                    </tbody>
                </table>
                <button type="button" class="btn btn-success">+ Agregar Producto</button>
            </div>

            <!-- Botón Final -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Guardar Boleta</button>
                <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- Modal de Clientes Registrados -->
    <div class="modal fade" id="modalClientes" tabindex="-1" aria-labelledby="modalClientesLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalClientesLabel">Clientes Registrados</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre / Razón Social</th>
                    <th>Documento</th>
                    <th>Email</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->tipo_documento == 'RUC' ? $cliente->razon_social : $cliente->nombre }}</td>
                    <td>{{ $cliente->numero_documento }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>
                    <button type="button" class="btn btn-sm btn-primary seleccionar-cliente"
                            data-id="{{ $cliente->id }}"
                            data-nombre="{{ $cliente->tipo_documento == 'RUC' ? $cliente->numero_documento . ' - ' . $cliente->razon_social : $cliente->numero_documento . ' - ' . $cliente->nombre }}">
                        Seleccionar
                    </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    <!-- Modal para Agregar Nuevo Cliente -->
<div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-labelledby="modalNuevoClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <form action="{{ route('clientes.store') }}" method="POST">
          @csrf

          <div class="modal-header">
            <h5 class="modal-title" id="modalNuevoClienteLabel">Nuevo Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <div class="modal-body">
            <!-- Primera fila -->
            <div class="row mb-3">
              <div class="col-md-3">
                <label class="form-label">Tipo Doc. Identidad *</label>
                <select name="tipo_documento" class="form-select" id="tipoDocumento">
                  <option value="DNI">DNI</option>
                  <option value="CE">CE</option>
                  <option value="RUC">RUC</option>
                  <option value="Pasaporte">Pasaporte</option>
                  <option value="Doc.trib.no.dom.sin.ruc">Doc.trib.no.dom.sin.ruc</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Número *</label>
                <input
                  type="text"
                  name="numero_ruc"
                  class="form-control"
                  id="numeroDocumento"
                  placeholder="0/8"
                  required
                >
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button type="button" class="btn btn-outline-secondary">🔍 RENIEC</button>
              </div>
            </div>

            <!-- Segunda fila -->
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Nombre *</label>
                <input type="text" name="nombre" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Nombre comercial</label>
                <input type="text" name="nombre_comercial" class="form-control">
              </div>
            </div>

            <!-- Tercera fila -->
            <div class="row mb-3">
              <div class="col-md-3">
                <label class="form-label">Forma de Pago</label>
                <select name="forma_pago" class="form-select">
                  <option value="Efectivo">Efectivo</option>
                  <option value="Transferencia">Transferencia</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Código interno</label>
                <input type="text" name="codigo_interno" class="form-control">
              </div>
              <div class="col-md-3">
                <label class="form-label">País</label>
                <select name="pais" class="form-select">
                  <option value="PERU">PERU</option>
                </select>
              </div>
            </div>

            <!-- Ubicación -->
            <div class="row mb-3">
              <div class="col-md-4">
                <label class="form-label">Departamento</label>
                <select name="departamento" class="form-select">
                  <option value="">Seleccionar</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Provincia</label>
                <select name="provincia" class="form-select">
                  <option value="">Seleccionar</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Distrito</label>
                <select name="distrito" class="form-select">
                  <option value="">Seleccionar</option>
                </select>
              </div>
            </div>

            <!-- Dirección -->
            <div class="row mb-3">
              <div class="col-md-9">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control">
              </div>
            </div>

            <!-- Contacto general -->
            <div class="row mb-3">
              <div class="col-md-4">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control">
              </div>
              <div class="col-md-4">
                <label class="form-label">Correo electrónico *</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Tipo de Cliente</label>
                <select name="tipo_cliente" class="form-select">
                  <option value="">Seleccionar</option>
                </select>
              </div>
            </div>

            <!-- Contacto directo -->
            <h6 class="mt-4">Contacto</h6>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Nombre y Apellido</label>
                <input type="text" name="contacto_nombre" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Teléfono</label>
                <input type="text" name="contacto_telefono" class="form-control">
              </div>
            </div>

          </div> <!-- /.modal-body -->

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    const tipoSelect = document.getElementById('tipoDocumento');
    const inputNumero = document.getElementById('numeroDocumento');

    tipoSelect.addEventListener('change', () => {
      let placeholder = '0/8';
      if (tipoSelect.value === 'DNI') placeholder = '8 dígitos';
      if (tipoSelect.value === 'RUC') placeholder = '11 dígitos';
      if (tipoSelect.value === 'CE') placeholder = '9 dígitos';
      if (tipoSelect.value === 'Pasaporte') placeholder = 'Hasta 12 caracteres';
      if (tipoSelect.value === 'Doc.trib.no.dom.sin.ruc') placeholder = 'Sin RUC';
      inputNumero.placeholder = placeholder;
    });
  </script>
  @endpush

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
@endif
    <!-- Script para seleccionar cliente del modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const botones = document.querySelectorAll('.seleccionar-cliente');
            const selectCliente = document.getElementById('cliente');

            botones.forEach(boton => {
                boton.addEventListener('click', () => {
                    const id = boton.dataset.id;

                    for (let i = 0; i < selectCliente.options.length; i++) {
                        if (selectCliente.options[i].value == id) {
                            selectCliente.selectedIndex = i;
                            break;
                        }
                    }

                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalClientes'));
                    modal.hide();
                });
            });
        });
    </script>
    </div>
    @endsection
