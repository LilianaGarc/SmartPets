<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        $answers = session()->get('answers', []);

        $pregunta = Pregunta::whereNotIn('id', array_keys($answers))->first();

        if (!$pregunta) {
            return redirect()->route('chatbot.result');
        }

        session()->put('current_question_id', $pregunta->id);

        return view('chatbot.index', compact('pregunta'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'respuesta_id' => 'required|exists:respuestas,id',
        ]);

        $respuesta = Respuesta::find($validated['respuesta_id']);
        $answers = session()->get('answers', []);

        $currentQuestionId = session()->get('current_question_id');
        $answers[$currentQuestionId] = $respuesta;

        session()->put('answers', $answers);

        $pregunta = Pregunta::where('id', '>', $currentQuestionId)->first();

        if ($pregunta) {
            session()->put('current_question_id', $pregunta->id);
            return view('chatbot.index', compact('pregunta'));
        } else {
            return $this->mostrarResultado();
        }
    }

    public function atras()
    {
        $currentQuestionId = session()->get('current_question_id');

        $pregunta = Pregunta::where('id', '<', $currentQuestionId)->orderBy('id', 'desc')->first();

        if ($pregunta) {
            session()->put('current_question_id', $pregunta->id);
            return view('chatbot.index', compact('pregunta'));
        } else {
            return redirect()->route('chatbot.index');
        }
    }

    public function mostrarResultado()
    {
        $answers = session()->get('answers', []);
        $tipoMascotaCount = $this->contarRespuestasPorTipoMascota($answers);

        arsort($tipoMascotaCount);
        $tipoMascota = key($tipoMascotaCount);

        return view('chatbot.result', compact('tipoMascota', 'tipoMascotaCount'));
    }

    public function reiniciar()
    {
        session()->forget('answers');
        session()->forget('current_question_id');
        return redirect()->route('chatbot.index');
    }

    protected function contarRespuestasPorTipoMascota($answers)
    {
        $tipoMascotaCount = [];

        foreach ($answers as $respuesta) {
            if ($respuesta->tipoMascota) {
                $tipo = $respuesta->tipoMascota->nombre_tipo;
                if (!isset($tipoMascotaCount[$tipo])) {
                    $tipoMascotaCount[$tipo] = 0;
                }
                $tipoMascotaCount[$tipo]++;
            } else {
                $tipoMascotaCount['Desconocido'] = $tipoMascotaCount['Desconocido'] ?? 0;
                $tipoMascotaCount['Desconocido']++;
            }
        }

        return $tipoMascotaCount;
    }
}
