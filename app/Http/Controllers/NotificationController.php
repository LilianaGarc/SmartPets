<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

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

}

