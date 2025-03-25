<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdopcionController extends Controller
{
    public function panel()
    {
        $adopciones = Adopcion::all();
        return view('panelAdministrativo.adopcionesIndex')->with('adopciones', $adopciones);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $adopciones = Adopcion::orderby('created_at', 'desc')
            ->where('id_usuario', 'LIKE', "%$nombre%")
            ->where('contenido', 'LIKE', "%$nombre%")
            ->orWhere('visibilidad', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.adopcionesIndex')->with('adopciones', $adopciones);
    }

    public function index(Request $request)
    {
        $tipo_mascota = $request->get('tipo_mascota');

        $adopciones = Adopcion::query();

        if ($tipo_mascota) {
            $adopciones = $adopciones->where('tipo_mascota', $tipo_mascota);
        }

        $adopciones = $adopciones->get();

        foreach ($adopciones as $adopcion) {
            $adopcion->increment('visibilidad');
        }

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
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tipo_mascota' => 'required|string|max:100',
            'nombre_mascota' => 'required|string|max:100',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('adopciones', 'public');
        }

        Adopcion::create([
            'contenido' => $request->contenido,
            'imagen' => $rutaImagen,
            'visibilidad' => true,
            'tipo_mascota' => $request->tipo_mascota,
            'nombre_mascota' => $request->nombre_mascota,
        ]);

        return redirect()->route('adopciones.index')->with('success', 'Publicación de adopción creada con éxito.');
    }

    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        return view('adopciones.edit', compact('adopcion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tipo_mascota' => 'required|string|max:100',
            'nombre_mascota' => 'required|string|max:100',
        ]);

        $adopcion = Adopcion::findOrFail($id);

        if ($request->hasFile('imagen')) {
            if ($adopcion->imagen) {
                Storage::disk('public')->delete($adopcion->imagen);
            }

            $rutaImagen = $request->file('imagen')->store('adopciones', 'public');
            $adopcion->imagen = $rutaImagen;
        }

        $adopcion->contenido = $request->contenido;
        $adopcion->tipo_mascota = $request->tipo_mascota;
        $adopcion->nombre_mascota = $request->nombre_mascota;

        $adopcion->save();

        return redirect()->route('adopciones.index')->with('success', 'Publicación de adopción actualizada con éxito.');
    }

    public function show($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        return view('adopciones.show', compact('adopcion'));
    }


    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $adopcion->delete();

        return redirect()->route('adopciones.index')->with('success', 'Publicación eliminada correctamente');
    }

    public function paneldestroy(string $id)
    {
        $eliminados = Adopcion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('adopciones.panel')->with('fracaso', 'La adopcion no se pudo borrar.');
        }else {
            return redirect()->route('adopciones.panel')->with('exito', 'La adopcion se elimino correctamente.');
        }
    }

}
