<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAIController extends Controller
{

    public function preguntar(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        $request->validate([
            'pregunta' => 'required|string|max:1000',
        ]);

        $key = 'user:' . $user->id . ':preguntas_count';
        $count = Cache::get($key, 0);

        $expiresAt = Cache::get('user:' . $user->id . ':preguntas_expira_en');

        if ($count >= 5) {
            $tiempoRestante = $expiresAt ? now()->diffInSeconds($expiresAt) : 0;
            return response()->json([
                'error' => 'Has alcanzado el límite diario de 5 preguntas',
                'tiempo_restante' => $tiempoRestante
            ], 429);
        }

        if (!$expiresAt) {
            $expiresAt = now()->addDay();
            Cache::put('user:' . $user->id . ':preguntas_expira_en', $expiresAt, $expiresAt);
        }

        try {
            $prompt = "Responde brevemente y con claridad:\nPregunta: " . $request->pregunta;

            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
                'max_tokens' => 100,
            ]);


            $respuesta = $response->choices[0]->message->content ?? 'No se obtuvo respuesta';

            Cache::put($key, $count + 1, $expiresAt);

            return response()->json([
                'respuesta' => $respuesta,
                'preguntas_restantes' => 5 - ($count + 1),
                'tiempo_restante' => now()->diffInSeconds($expiresAt)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al consultar la IA: ' . $e->getMessage()
            ], 500);
        }
    }

    public function preguntasRestantes(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        $key = 'user:' . $user->id . ':preguntas_count';
        $count = Cache::get($key, 0);
        $expiresAt = Cache::get('user:' . $user->id . ':preguntas_expira_en');

        return response()->json([
            'preguntas_restantes' => max(0, 5 - $count),
            'tiempo_restante' => $expiresAt ? now()->diffInSeconds($expiresAt) : null
        ]);
    }

}
