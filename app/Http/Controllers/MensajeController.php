<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $user = Auth::user();

        if ($chat->id_usuario_1 !== $user->id && $chat->id_usuario_2 !== $user->id) {
            abort(403);
        }

        $request->validate([
            'texto' => 'nullable|string|max:1000',
            'imagen' => 'nullable|image|max:5120',
        ]);

        if (!$request->filled('texto') && !$request->hasFile('imagen')) {
            return response()->json([
                'success' => false,
                'message' => 'Debe enviar texto o una imagen.'
            ], 422);
        }

        $mensaje = new Mensaje();
        $mensaje->user_id = $user->id;
        $mensaje->id_chat = $chat->id;
        $mensaje->fecha = now();
        $mensaje->estado = false;

        if ($request->filled('texto')) {
            $mensaje->texto = $request->input('texto');
        } else {
            $mensaje->texto = '';
        }

        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('mensajes', 'public');
            $mensaje->imagen = $ruta;
        }

        $mensaje->save();

        return response()->json([
            'success' => true,
            'mensaje' => $mensaje->load('usuario')
        ]);
    }


    public function getNuevosMensajes(Request $request, Chat $chat)
    {
        $usuarioActual = Auth::user();

        $ultimoTimestamp = $request->query('ultimo_timestamp');
        if (!$ultimoTimestamp) {
            return response()->json(['mensajes' => []]);
        }

        $mensajesNuevos = $chat->mensajes()
            ->where('created_at', '>', $ultimoTimestamp)
            ->with('usuario')
            ->orderBy('created_at')
            ->get();

        return response()->json([
            'mensajes' => $mensajesNuevos
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
