<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function borrarTodas()
    {
        Notificacion::where('user_id', auth()->id())->delete();

        return response()->json(['success' => true]);
    }

    public function marcarComoVista($id)
    {
        $notificacion = Notificacion::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('visto', false)
            ->first();

        if ($notificacion) {
            $notificacion->visto = true;
            $notificacion->save();
        }

        return response()->json(['success' => true]);
    }

    public function configurar(Request $request)
    {
        $user = Auth::user();
        $user->recibir_notificaciones = $request->input('recibir_notificaciones', false);
        $user->save();

        return response()->json(['message' => 'Preferencias actualizadas correctamente']);
    }


}

