<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nino;
use Illuminate\Support\Facades\Storage;

class NinoController extends Controller
{
    // Mostrar la lista de niños
    public function index()
    {
        $ninos = Nino::all();
        return view('ninos.index', compact('ninos'));
    }

    // Mostrar formulario para registrar un niño
    public function create()
    {
        return view('ninos.create');
    }

    // Guardar un nuevo niño en la base de datos
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('ninos', 'public');
        }

        Nino::create($data);
        return redirect()->route('ninos.index')->with('success', 'Niño registrado correctamente.');
    }

    // Mostrar detalles de un niño
    public function show(Nino $nino)
    {
        return view('ninos.show', compact('nino'));
    }

    // Mostrar formulario para editar un niño
    public function edit(Nino $nino)
    {
        return view('ninos.edit', compact('nino'));
    }

    // Actualizar los datos de un niño
    public function update(Request $request, Nino $nino)
    {
        $data = $this->validateRequest($request);

        if ($request->hasFile('foto')) {
            if ($nino->foto) {
                Storage::disk('public')->delete($nino->foto);
            }
            $data['foto'] = $request->file('foto')->store('ninos', 'public');
        }

        $nino->update($data);
        return redirect()->route('ninos.index')->with('success', 'Datos actualizados correctamente.');
    }

    // Eliminar un niño
    public function destroy(Nino $nino)
    {
        if ($nino->foto) {
            Storage::disk('public')->delete($nino->foto);
        }
        $nino->delete();
        return redirect()->route('ninos.index')->with('success', 'Registro eliminado correctamente.');
    }

    // Método para validar y formatear la solicitud
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date_format:Y-m-d',
            'sexo' => 'required|in:Masculino,Femenino,Otro',
            'nombre_tutor' => 'required|string|max:255',
            'dni_tutor' => 'required|string|max:20',
            'telefono_tutor' => 'required|string|max:20',
            'email_tutor' => 'nullable|email|max:255',
            'direccion' => 'nullable|string',
            'alergias' => 'nullable|string',
            'condiciones_medicas' => 'nullable|string',
            'medicamentos' => 'nullable|string',
            'nombre_medico' => 'nullable|string|max:255',
            'telefono_medico' => 'nullable|string|max:20',
            'autorizacion_primeros_auxilios' => 'required|boolean',
            'hora_ingreso' => 'nullable|date_format:H:i',
            'hora_salida' => 'nullable|date_format:H:i',
            'persona_autorizada_recoger' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
}
