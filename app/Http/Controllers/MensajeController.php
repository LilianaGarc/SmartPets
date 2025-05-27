<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Auth;

class MensajeController
{
    public function panel()
    {
        $mensajes = Mensaje::all();
        return view('panelAdministrativo.mensajesIndex')->with('mensajes', $mensajes);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $mensajes = Mensaje::orderby('created_at', 'desc')
            ->where('id_chat', 'LIKE', "%$nombre%")
            ->where('texto', 'LIKE', "%$nombre%")
            ->orWhere('fecha', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.mensajesIndex')->with('mensajes', $mensajes);
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
    public function store(Request $request, Chat $chat)
    {
        $request->validate([
            'texto' => 'required|string',
        ]);

        $user = Auth::user();
        if ($chat->id_usuario_1 !== $user->id && $chat->id_usuario_2 !== $user->id) {
            abort(403);
        }

        $mensaje = new Mensaje();
        $mensaje->texto = $request->input('texto');
        $mensaje->user_id = $user->id;
        $mensaje->id_chat = $chat->id;
        $mensaje->fecha = now();
        $mensaje->estado = false;
        $mensaje->save();

        return response()->json([
            'success' => true,
            'mensaje' => $mensaje->load('usuario')
        ]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function paneldestroy(string $id)
    {
        $eliminados = Mensaje::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('mensajes.panel')->with('fracaso', 'El mensaje no se pudo borrar.');
        }else {
            return redirect()->route('mensajes.panel')->with('exito', 'El mensaje se elimino correctamente.');
        }
    }
}
