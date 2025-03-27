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
            'edad_mascota' => 'required|integer|min:0',
            'raza_mascota' => 'required|string|max:100',
            'ubicacion_mascota' => 'required|string|max:100',
        ]);

        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $rutaImagen = $request->file('imagen')->store('adopciones', 'public');
        } else {
            return redirect()->route('adopciones.create')->with('error', 'Por favor sube una imagen válida.');
        }

        Adopcion::create([
            'contenido' => $request->contenido,
            'imagen' => $rutaImagen,
            'visibilidad' => 0,
            'tipo_mascota' => $request->tipo_mascota,
            'nombre_mascota' => $request->nombre_mascota,
            'edad_mascota' => $request->edad_mascota,
            'raza_mascota' => $request->raza_mascota,
            'ubicacion_mascota' => $request->ubicacion_mascota,
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
            'edad_mascota' => 'required|integer|min:0',
            'raza_mascota' => 'required|string|max:100',
            'ubicacion_mascota' => 'required|string|max:255',
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
        $adopcion->edad_mascota = $request->edad_mascota;
        $adopcion->raza_mascota = $request->raza_mascota;
        $adopcion->ubicacion_mascota = $request->ubicacion_mascota;

        $adopcion->save();

        return redirect()->route('adopciones.index')->with('success', 'Publicación de adopción actualizada con éxito.');
    }


    public function show($id)
    {
        $adopcion = Adopcion::findOrFail($id);

        $adopcion->increment('visibilidad');

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
