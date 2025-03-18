<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\Reaccion;
use App\Models\User;
use Illuminate\Http\Request;

class PublicacionController
{
    public function panel()
    {
        $publicaciones = Publicacion::with('user')->get();
        return view('panelAdministrativo.publicacionesIndex')->with('publicaciones',$publicaciones);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $publicaciones = Publicacion::with('user')
            ->whereHas('user', function ($query) use ($nombre) {
                $query->where('name', 'LIKE', "%$nombre%");
            })
            ->where('contenido', 'LIKE', "%$nombre%")
            ->orWhere('visibilidad', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.publicacionesIndex')->with('publicaciones', $publicaciones);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicaciones = Publicacion::with('user')
            ->withCount('reacciones')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('publicaciones.indexPublicaciones')->with('publicaciones',$publicaciones);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publicaciones.crearPublicaciones');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visibilidad' => 'required',
            'contenido' => 'required|string|max:255',
            'imagen' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('publicaciones', 'public');
        }

        Publicacion::create([
            'visibilidad' => $request->visibilidad,
            'contenido' => $request->contenido,
            'imagen' => $rutaImagen,

        ]);

        return redirect()->route('publicaciones.index')->with('success', 'Publicación de adopción creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publicacion = Publicacion::findorFail($id);
        $comentarios = Comentario::with('user')
            ->where('id_publicacion', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('publicaciones.comentarios', ['publicacion'=>$publicacion, 'comentarios'=>$comentarios]);

    }

    public function detalles(string $id)
    {
        $publicacion = Publicacion::findorFail($id);
        $comentarios = Comentario::with('user')
            ->where('id_publicacion', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        $comen = Comentario::where('id_publicacion', $id)->count();
        $reac = Reaccion::where('publicacion_id', $id)->count();
        return view('publicaciones.verPublicacion', ['publicacion'=>$publicacion, 'comentarios'=>$comentarios, 'comen'=>$comen, 'reac'=>$reac ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eliminados = Publicacion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('publicaciones.index')->with('fracaso', 'La publicacion no se pudo borrar.');
        }else {
            return redirect()->route('publicaciones.index')->with('exito', 'La publicacion se elimino correctamente.');
        }
    }

    public function paneldestroy(string $id)
    {
        $eliminados = Publicacion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('publicaciones.panel')->with('fracaso', 'La publicacion no se pudo borrar.');
        }else {
            return redirect()->route('publicaciones.panel')->with('exito', 'La publicacion se elimino correctamente.');
        }
    }
}
