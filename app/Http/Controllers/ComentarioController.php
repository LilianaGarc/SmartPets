<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class ComentarioController
{
    public function panel()
    {
        $comentarios = Comentario::with('user')->get();
        return view('panelAdministrativo.comentariosIndex')->with('comentarios', $comentarios);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $comentarios = Comentario::with('user')
            ->whereHas('user', function ($query) use ($nombre) {
                $query->where('name', 'LIKE', "%$nombre%");
            })
            ->where('id_publicacion', 'LIKE', "%$nombre%")
            ->orWhere('contenido', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.comentariosIndex')->with('comentarios', $comentarios);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required|string|max:280',
        ], [
            'comentario.required' => 'El comentario no puede estar vacío.',
            'comentario.max' => 'El comentario no puede tener más de 100 caracteres.',
        ]);

        $publicacion = Publicacion::findOrFail($id);
        $comentario = new Comentario();
        $comentario->contenido = $request->input('comentario');
        $comentario->id_user = auth()->id();
        $comentario->id_publicacion = $publicacion->id;

        if ($comentario->save()) {
            return redirect()->route('publicaciones.show', ['id' => $id])
                ->with('exito', 'El comentario se envió correctamente.');
        } else {
            return redirect()->route('publicaciones.show', ['id' => $id])
                ->with('fracaso', 'El comentario no se pudo enviar.');
        }
    }


    public function panelstore(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $comentario = new Comentario();
        $comentario->contenido = $request->input('comentario');
        $comentario->id_user = auth()->id();
        $comentario->id_publicacion = $publicacion->id;

        if ($comentario->save()) {
            return redirect()->route('publicaciones.paneldetalles', ['id' => $id])->with('exito', 'El comentario se envió correctamente.');
        } else {
            return redirect()->route('publicaciones.paneldetalles', ['id' => $id])->with('fracaso', 'El comentario no se pudo enviar.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required|string|max:100',
        ], [
            'comentario.required' => 'El comentario no puede estar vacío.',
            'comentario.max' => 'El comentario no puede tener más de 100 caracteres.',
        ]);

        $comentario = Comentario::findOrFail($id);

        // Verificar que el usuario sea dueño del comentario
        if ($comentario->id_user !== auth()->id()) {
            abort(403);
        }

        $comentario->contenido = $request->input('comentario');

        if ($comentario->save()) {
            return redirect()->route('publicaciones.show', ['id' => $comentario->id_publicacion])
                ->with('exito', 'El comentario se actualizó correctamente.');
        } else {
            return redirect()->route('publicaciones.show', ['id' => $comentario->id_publicacion])
                ->with('fracaso', 'No se pudo actualizar el comentario.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $publicacion_id = $request->input('publicacion_id');
        $eliminados = Comentario::destroy($id);

        if ($eliminados > 0){
            return redirect()->route('publicaciones.show', ['id' => $publicacion_id])->with('exito', 'El comentario se elimino correctamente.');
        } else {
            return redirect()->route('publicaciones.show', ['id' => $publicacion_id])->with('fracaso', 'El comentario no se pudo eliminar.');
        }

    }

    public function paneldestroy(string $id)
    {
    //


    }
    public function comentarios($id)
    {
        $publicacion = Publicacion::with('user')->findOrFail($id);
        $comentarios = Comentario::with('user')->where('id_publicacion', $id)->get();

        return view('publicaciones.comentarios', compact('publicacion', 'comentarios'));
    }

}
