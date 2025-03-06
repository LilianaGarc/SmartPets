<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use Illuminate\Http\Request;

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
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',  // 'required' agregado
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            // Almacena la imagen en el directorio 'adopciones' dentro de 'public'
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
