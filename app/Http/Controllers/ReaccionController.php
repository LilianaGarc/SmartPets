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
        if (!auth()->check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        $request->validate([
            'tipo' => 'required|string',
            'publicacion_id' => 'required|exists:publicaciones,id',
        ]);

        $reaccion = Reaccion::updateOrCreate(
            [
                'id_user' => auth()->id(),
                'publicacion_id' => $request->publicacion_id,
            ],
            ['tipo' => $request->tipo]
        );

        return response()->json(['status' => 'success', 'reaccion' => $reaccion]);
    }

    /**
     * Eliminar una reacción.
     */
    public function destroy(string $publicacion_id)
    {

        if (!auth()->check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }


        $reaccion = Reaccion::where('publicacion_id', $publicacion_id)
            ->where('id_user', auth()->id())
            ->first();


        if ($reaccion) {
            $reaccion->delete();
            return response()->json(['status' => 'deleted']);
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
