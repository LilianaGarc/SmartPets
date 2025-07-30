<?php

namespace App\Http\Controllers;

use App\Models\Reaccion;
use Illuminate\Http\Request;

class ReaccionController
{
    /**
     * Mostrar todas las reacciones en el panel administrativo.
     */
    public function panel()
    {
        $reacciones = Reaccion::with('user', 'publicacion')->get();
        return view('panelAdministrativo.reaccionesIndex', compact('reacciones'));
    }

    /**
     * Buscar reacciones en el panel administrativo.
     */
    public function search(Request $request)
    {
        $nombre = $request->get('nombre');
        $reacciones = Reaccion::with('user', 'publicacion')
            ->whereHas('user', function ($query) use ($nombre) {
                $query->where('name', 'LIKE', "%$nombre%");
            })
            ->orWhereHas('publicacion', function ($query) use ($nombre) {
                $query->where('contenido', 'LIKE', "%$nombre%");
            })
            ->orWhere('tipo', 'LIKE', "%$nombre%")
            ->get();

        return view('panelAdministrativo.reaccionesIndex', compact('reacciones'));
    }

    /**
     * Crear o actualizar una reacción para una publicación.
     */
    public function store(Request $request)
    {
        $request->validate([
            'publicacion_id' => 'required|exists:publicacions,id',
            'tipo' => 'required|in:amor,risa,triste,enojado',
        ]);

        $userId = Auth::id();

        // Buscar si ya reaccionó a esta publicación
        $reaccion = Reaccion::where('user_id', $userId)
            ->where('publicacion_id', $request->publicacion_id)
            ->first();

        if ($reaccion) {
            // Actualizar tipo de reacción
            $reaccion->tipo = $request->tipo;
            $reaccion->save();
        } else {
            // Crear nueva reacción
            $reaccion = Reaccion::create([
                'user_id' => $userId,
                'publicacion_id' => $request->publicacion_id,
                'tipo' => $request->tipo,
            ]);
        }

        // Contar reacciones actualizadas
        $reaccionesCount = Reaccion::where('publicacion_id', $request->publicacion_id)->count();

        return response()->json([
            'status' => 'success',
            'reaccionesCount' => $reaccionesCount,
            'tipo' => $reaccion->tipo,
        ]);
    }


    public function destroy($publicacionId)
    {
        $userId = Auth::id();

        $reaccion = Reaccion::where('user_id', $userId)
            ->where('publicacion_id', $publicacionId)
            ->first();

        if ($reaccion) {
            $reaccion->delete();

            $reaccionesCount = Reaccion::where('publicacion_id', $publicacionId)->count();

            return response()->json([
                'status' => 'deleted',
                'reaccionesCount' => $reaccionesCount,
            ]);
        }

        return response()->json(['status' => 'not_found'], 404);
    }

    /**
     * Eliminar una reacción desde el panel administrativo.
     */
    public function paneldestroy(string $id)
    {
        $eliminados = Reaccion::destroy($id);

        if ($eliminados < 1) {
            return redirect()->route('reacciones.panel')->with('fracaso', 'La reacción no se pudo borrar.');
        } else {
            return redirect()->route('reacciones.panel')->with('exito', 'Reacción eliminada correctamente.');
        }
    }
}
