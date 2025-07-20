<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puntaje;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PuntajeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'puntaje' => 'required|integer|min:0',
        ]);

        $usuarioId = auth()->id();
        $nuevoPuntaje = $request->puntaje;

        // Buscar el puntaje existente del usuario
        $puntajeExistente = Puntaje::where('id_usuario', $usuarioId)->first();

        if ($puntajeExistente) {
            // Solo actualizar si el nuevo puntaje es mayor
            if ($nuevoPuntaje > $puntajeExistente->puntaje) {
                $puntajeExistente->update(['puntaje' => $nuevoPuntaje]);
            }
        } else {
            // Crear nuevo puntaje si no existe
            Puntaje::create([
                'id_usuario' => $usuarioId,
                'puntaje' => $nuevoPuntaje,
            ]);
        }

        return response()->json(['mensaje' => 'Puntaje procesado']);
    }

    public function ranking()
    {
        $ranking = Puntaje::with('usuario')
            ->orderByDesc('puntaje')
            ->limit(10)
            ->get();

        return view('puntajes.ranking', compact('ranking'));
    }

    public function rankingJson(Request $request)
    {
        $perPage = (int) $request->query('perPage', 10);
        $page = (int) $request->query('page', 1);

        // Obtener todos los puntajes ordenados
        $ranking = Puntaje::select('id_usuario', DB::raw('MAX(puntaje) as puntaje'))
            ->groupBy('id_usuario')
            ->orderByDesc('puntaje')
            ->get();

        $total = $ranking->count();

        // Paginar manualmente
        $paginated = $ranking->slice(($page - 1) * $perPage, $perPage)->values();

        // Obtener usuarios relacionados
        $usuarios = User::whereIn('id', $paginated->pluck('id_usuario'))->get()->keyBy('id');

        // Formatear los datos
        $rankingDetallado = $paginated->map(function ($r) use ($usuarios) {
            $usuario = $usuarios[$r->id_usuario] ?? null;

            return [
                'nombre' => $usuario->name ?? 'Anónimo',
                'puntaje' => $r->puntaje,
                'fotoperfil' => $usuario && $usuario->fotoperfil
                    ? asset('storage/' . $usuario->fotoperfil)
                    : null,
            ];
        });

        return response()->json([
            'data' => $rankingDetallado,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'lastPage' => ceil($total / $perPage),
        ]);
    }
}
