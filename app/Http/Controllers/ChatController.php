<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController
{
    public function panel()
    {
        $chats = Chat::all();
        return view('panelAdministrativo.chatsIndex')->with('chats', $chats);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $chats = Chat::orderby('created_at', 'desc')
            ->where('id_user', 'LIKE', "%$nombre%")
            ->orWhere('id_user', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.chatsIndex')->with('chats', $chats);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $usuarioActual = Auth::user();
        $usuarios = User::where('id', '!=', $usuarioActual->id)
            ->where('usertype', 'user')
            ->get();

        $usuariosConMensajes = $usuarios->map(function ($usuario) use ($usuarioActual) {
            $chat = Chat::where(function ($query) use ($usuario, $usuarioActual) {
                $query->where('id_usuario_1', $usuarioActual->id)->where('id_usuario_2', $usuario->id);
            })->orWhere(function ($query) use ($usuario, $usuarioActual) {
                $query->where('id_usuario_1', $usuario->id)->where('id_usuario_2', $usuarioActual->id);
            })->first();

            $ultimoMensaje = null;
            $fechaOrden = now()->subYears(100);
            $mensajesNoLeidos = 0;

            if ($chat) {
                $ultimoMensaje = $chat->mensajes()->latest()->first();
                if ($ultimoMensaje) {
                    $fechaOrden = $ultimoMensaje->created_at;
                }

                $mensajesNoLeidos = $chat->mensajes()
                    ->where('user_id', '!=', $usuarioActual->id)
                    ->where('estado', false)
                    ->count();
            }

            return [
                'usuario' => $usuario,
                'chat' => $chat,
                'ultimo_mensaje' => $ultimoMensaje,
                'fechaOrden' => $fechaOrden,
                'mensajes_no_leidos' => $mensajesNoLeidos,
            ];
        })->sortByDesc('fechaOrden')->values();

        $chatActivo = null;
        $mensajes = collect();

        if ($request->has('chat_id')) {
            $chatActivo = Chat::with(['usuario1', 'usuario2', 'mensajes.usuario'])->find($request->chat_id);
        } else {
            $ultimoChat = $usuariosConMensajes->first(function ($c) {
                return $c['chat'] !== null && $c['ultimo_mensaje'] !== null;
            });

            if ($ultimoChat && $ultimoChat['chat']) {
                $chatActivo = Chat::with(['usuario1', 'usuario2', 'mensajes.usuario'])->find($ultimoChat['chat']->id);
            }
        }

        if ($chatActivo) {
            Mensaje::where('id_chat', $chatActivo->id)
                ->where('user_id', '!=', $usuarioActual->id)
                ->where('estado', false)
                ->update(['estado' => true]);

            $mensajes = $chatActivo->mensajes()->orderBy('created_at')->get();
        }

        $mensajePredefinido = urldecode($request->query('mensaje', ''));
        $imagenMascota = $request->query('imagen_mascota', '');

        return view('chats.index', [
            'usuariosConMensajes' => $usuariosConMensajes,
            'chatActivo' => $chatActivo,
            'mensajes' => $mensajes,
            'mensajePredefinido' => $mensajePredefinido,
            'imagenMascota' => $imagenMascota,
        ]);
    }



    public function usuariosConMensajes()
    {
        $usuarioActual = Auth::user();
        $usuarios = User::where('id', '!=', $usuarioActual->id)
            ->where('usertype', 'user')
            ->get();

        $usuariosConMensajes = $usuarios->map(function ($usuario) use ($usuarioActual) {
            $chat = Chat::where(function ($query) use ($usuario, $usuarioActual) {
                $query->where('id_usuario_1', $usuarioActual->id)->where('id_usuario_2', $usuario->id);
            })->orWhere(function ($query) use ($usuario, $usuarioActual) {
                $query->where('id_usuario_1', $usuario->id)->where('id_usuario_2', $usuarioActual->id);
            })->first();

            $ultimoMensaje = null;
            $fechaOrden = now()->subYears(100);
            $mensajesNoLeidos = 0;

            if ($chat) {
                $ultimoMensaje = $chat->mensajes()->latest()->first();
                if ($ultimoMensaje) {
                    $fechaOrden = $ultimoMensaje->created_at;
                }

                $mensajesNoLeidos = $chat->mensajes()
                    ->where('user_id', '!=', $usuarioActual->id)
                    ->where('estado', false)
                    ->count();
            }

            return [
                'usuario' => [
                    'id' => $usuario->id,
                    'name' => $usuario->name,
                    'fotoperfil' => $usuario->fotoperfil,
                    'en_linea' => $usuario->en_linea,
                ],
                'chat' => $chat,
                'ultimo_mensaje' => $ultimoMensaje,
                'fechaOrden' => $fechaOrden,
                'mensajes_no_leidos' => $mensajesNoLeidos,
            ];
        })->sortByDesc('fechaOrden')->values();

        return response()->json(['usuariosConMensajes' => $usuariosConMensajes]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        $user = Auth::user();
        if ($chat->id_usuario_1 !== $user->id && $chat->id_usuario_2 !== $user->id) {
            abort(403);
        }

        $mensajes = $chat->mensajes()->with('usuario')->orderBy('created_at')->get();

        return view('chats.show', compact('chat', 'mensajes', 'user'));
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

    public function iniciarChat($userId)
    {
        $authId = auth()->id();

        $chat = Chat::where(function ($query) use ($authId, $userId) {
            $query->where('id_usuario_1', $authId)->where('id_usuario_2', $userId);
        })->orWhere(function ($query) use ($authId, $userId) {
            $query->where('id_usuario_1', $userId)->where('id_usuario_2', $authId);
        })->first();

        if (!$chat) {
            $chat = Chat::create([
                'id_usuario_1' => $authId,
                'id_usuario_2' => $userId,
            ]);
        }

        $mensajePredefinido = request()->query('mensaje', '');
        $imagenMascota = request()->query('imagen_mascota', '');

        $parametros = [
            'chat_id' => $chat->id,
        ];

        if (!empty($mensajePredefinido)) {
            $parametros['mensaje'] = $mensajePredefinido;
        }

        if (!empty($imagenMascota)) {
            $parametros['imagen_mascota'] = $imagenMascota;
        }

        return redirect()->route('chats.index', $parametros);
    }







    public function paneldestroy(string $id)
    {
        $eliminados = Chat::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('chats.panel')->with('fracaso', 'El chat no se pudo borrar.');
        }else {
            return redirect()->route('chats.panel')->with('exito', 'El chat se elimino correctamente.');
        }
    }

}
