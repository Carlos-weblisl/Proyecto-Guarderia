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
                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="99999999 - Clientes - Varios">
                <small class="text-success">+ Agregar Nuevo Cliente</small>
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
@endsection
