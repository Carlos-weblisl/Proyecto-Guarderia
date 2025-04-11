<?php

namespace App\Http\Controllers;

use App\Models\User; // Asegúrate de usar el modelo User
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index()
    {
        // Obtener solo los usuarios con roles 'empleado' o 'cajero'
        $personals = User::whereIn('rol', ['empleado', 'cajero'])->get();
        
        // Pasar los usuarios a la vista
        return view('personal.index', compact('personals'));
    }

    public function edit($id)
    {
        // Encontrar el usuario por ID
        $personal = User::findOrFail($id);

        // Pasar los datos del usuario a la vista de edición
        return view('personal.edit', compact('personal'));
    }

    public function update(Request $request, $id)
    {
        // Encontrar el usuario por ID
        $personal = User::findOrFail($id);

        // Validar y actualizar los datos del usuario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'rol' => 'required|in:empleado,cajero', // Asegúrate de que el rol sea válido
        ]);

        $personal->update($validated);

        // Redirigir a la lista de personal con un mensaje de éxito
        return redirect()->route('personal.index')->with('success', 'Datos actualizados correctamente');
    }
}
