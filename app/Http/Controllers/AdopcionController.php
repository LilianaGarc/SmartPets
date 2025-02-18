<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use Illuminate\Http\Request;

class AdopcionController extends Controller
{
    public function index()
    {
        $adopciones = Adopcion::all();
        return view('adopciones.indexAdopciones', compact('adopciones'));
    }

    public function create()
    {
        return view('adopciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('adopciones', 'public');
        }

        Adopcion::create([
            'contenido' => $request->contenido,
            'imagen' => $rutaImagen,
            'visibilidad' => true,
        ]);

        return redirect()->route('adopciones.index')->with('success', 'Publicación de adopción creada con éxito.');
    }

    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $adopcion->delete();

        return redirect()->route('adopciones.index')->with('success', 'Publicación eliminada correctamente');
    }

}
