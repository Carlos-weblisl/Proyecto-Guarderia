<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Muestra la lista de clientes con paginación.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->paginate(10); // 10 clientes por página
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Muestra el formulario de creación de un nuevo cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'direccion'     => 'nullable|string|max:255',
            'telefono'      => 'nullable|string|max:20|regex:/^\+?\d{7,20}$/',
            'email'         => 'required|email|unique:clientes,email|max:255',
            'tipo_documento'=> 'nullable|string|in:DNI,RUC,Pasaporte',
            'numero_ruc'    => 'nullable|string|max:20|unique:clientes,numero_ruc',
            'forma_pago'    => 'nullable|string|in:Efectivo,Tarjeta,Transferencia',
            'distrito'      => 'nullable|string|max:255',
            'departamento'  => 'nullable|string|max:255',
            'provincia'     => 'nullable|string|max:255',
        ]);

        Cliente::create($request->only([
            'nombre', 'direccion', 'telefono', 'email',
            'tipo_documento', 'numero_ruc', 'forma_pago',
            'distrito', 'departamento', 'provincia'
        ]));

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente.');
    }

    /**
     * Muestra el formulario de edición de un cliente.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualiza la información del cliente en la base de datos.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'tipo_documento'=> 'nullable|string|in:DNI,RUC,Pasaporte',
            'numero_ruc'    => 'nullable|string|max:20|unique:clientes,numero_ruc,' . $cliente->id,
            'forma_pago'    => 'nullable|string|in:Efectivo,Tarjeta,Transferencia',
            'direccion'     => 'nullable|string|max:255',
            'distrito'      => 'nullable|string|max:255',
            'provincia'     => 'nullable|string|max:255',
            'departamento'  => 'nullable|string|max:255',
            'telefono'      => 'nullable|string|max:20|regex:/^\+?\d{7,20}$/',
            'email'         => 'required|email|unique:clientes,email,' . $cliente->id,
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Elimina un cliente de la base de datos.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'No se pudo eliminar el cliente.');
        }
    }
}
