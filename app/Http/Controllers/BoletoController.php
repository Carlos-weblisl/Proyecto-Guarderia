<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boleto;
use App\Models\BoletoDetalle;

class BoletoController extends Controller
{
    /**
     * Muestra el formulario para crear una boleta en la sección indicada.
     *
     * @param  string  $section
     * @return \Illuminate\View\View
     */
    public function create($section)
    {
        // Definimos las secciones permitidas.
        $allowedSections = ['mixta', 'Divertiyan', 'Divertiti'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        // Mapeamos la sección a un título personalizado.
        $titles = [
            'mixta'      => 'Sección Mixta',
            'Divertiyan' => 'Sección Divertiyan',
            'Divertiti'  => 'Sección Divertiti'
        ];
        $title = $titles[$section];

        // Retornamos la vista pasando 'section' y 'title'
        return view('boleto.form', compact('section', 'title'));
    }

    /**
     * Procesa y guarda el formulario de boletas (y sus detalles, si existen).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $section)
    {
        // Validar que la sección sea una de las permitidas.
        $allowedSections = ['mixta', 'Divertiyan', 'Divertiti'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        // Validar los datos del formulario.
        $validatedData = $request->validate([
            'nombre'            => 'nullable|string|max:255',
            'tipo_comprobante'  => 'required|string|max:255',
            'establecimiento'   => 'required|string|max:255',
            'tipo_operacion'    => 'required|string|max:255',
            'cliente'           => 'required|string|max:255',
            'vendedor'          => 'required|string|max:255',
            'fecha_emision'     => 'required|date',
            'serie'             => 'required|string|max:10',
            'moneda'            => 'required|string|max:50',
            'condicion_pago'    => 'required|string|max:50',
            'tipo_cambio'       => 'nullable|numeric',
            'metodo_pago'       => 'required|string|max:50',
            'destino'           => 'required|string|max:255',
            'referencia'        => 'nullable|string|max:255',
            'monto'             => 'required|numeric',
            // Validación para los detalles (productos)
            'detalles.*.descripcion'   => 'nullable|string|max:255',
            'detalles.*.unidad'        => 'nullable|string|max:50',
            'detalles.*.cantidad'      => 'nullable|integer|min:1',
            'detalles.*.valor_unitario'=> 'nullable|numeric',
            'detalles.*.precio_unitario'=> 'nullable|numeric',
            'detalles.*.subtotal'      => 'nullable|numeric',
            'detalles.*.total'         => 'nullable|numeric',
        ]);

        // Incorporamos la sección (ya validada) al array de datos.
        $validatedData['section'] = $section;

        // Creamos el registro en la tabla 'boletos'
        $boleto = Boleto::create([
            'nombre'           => $validatedData['nombre'] ?? null,
            'section'          => $validatedData['section'],
            'tipo_comprobante' => $validatedData['tipo_comprobante'],
            'establecimiento'  => $validatedData['establecimiento'],
            'tipo_operacion'   => $validatedData['tipo_operacion'],
            'cliente'          => $validatedData['cliente'],
            'vendedor'         => $validatedData['vendedor'],
            'fecha_emision'    => $validatedData['fecha_emision'],
            'serie'            => $validatedData['serie'],
            'moneda'           => $validatedData['moneda'],
            'condicion_pago'   => $validatedData['condicion_pago'],
            'tipo_cambio'      => $validatedData['tipo_cambio'] ?? null,
            'metodo_pago'      => $validatedData['metodo_pago'],
            'destino'          => $validatedData['destino'],
            'referencia'       => $validatedData['referencia'] ?? null,
            'monto'            => $validatedData['monto'],
        ]);

        // Guardar los detalles de productos (si existen).
        if ($request->has('detalles')) {
            foreach ($request->input('detalles') as $detalle) {
                // Se guarda el detalle solo si se ingresa una descripción.
                if (isset($detalle['descripcion']) && $detalle['descripcion'] !== '') {
                    $boleto->detalles()->create([
                        'descripcion'    => $detalle['descripcion'],
                        'unidad'         => $detalle['unidad'] ?? null,
                        'cantidad'       => $detalle['cantidad'] ?? 1,
                        'valor_unitario' => $detalle['valor_unitario'] ?? 0,
                        'precio_unitario'=> $detalle['precio_unitario'] ?? 0,
                        'subtotal'       => $detalle['subtotal'] ?? 0,
                        'total'          => $detalle['total'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Boleto registrado con éxito.');
    }
}
