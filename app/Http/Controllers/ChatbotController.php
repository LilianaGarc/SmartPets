<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $totalQuestions = Pregunta::count();

        $answeredCount = DB::table('user_responses')
            ->where('user_id', Auth::id())
            ->count();

        if ($answeredCount >= $totalQuestions) {
            return redirect()->route('chatbot.result');
        }

        $currentQuestionId = session('current_question_id');

        if (!$currentQuestionId) {
            $pregunta = Pregunta::orderBy('id')->first();
            $currentQuestionNumber = 1;
        } else {
            $pregunta = Pregunta::find($currentQuestionId);
            $currentQuestionNumber = session('current_question_number', 1);
        }

        if (!$pregunta) {
            return redirect()->route('chatbot.result');
        }

        $answers = DB::table('user_responses')
            ->where('user_id', Auth::id())
            ->pluck('respuesta_id', 'pregunta_id')
            ->toArray();

        session()->put('current_question_id', $pregunta->id);
        session()->put('current_question_number', $currentQuestionNumber);

        $totalQuestions = Pregunta::count();

        return view('chatbot.index', compact('pregunta', 'currentQuestionNumber', 'totalQuestions', 'answers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'respuesta_id' => 'required|exists:respuestas,id',
        ]);

        $respuesta = Respuesta::find($validated['respuesta_id']);
        $currentQuestionId = session()->get('current_question_id');

        DB::table('user_responses')->updateOrInsert(
            ['user_id' => Auth::id(), 'pregunta_id' => $currentQuestionId],
            ['respuesta_id' => $respuesta->id]
        );

        $preguntaSiguiente = Pregunta::where('id', '>', $currentQuestionId)->orderBy('id')->first();

        if ($preguntaSiguiente) {
            session()->put('current_question_id', $preguntaSiguiente->id);
            $currentQuestionNumber = Pregunta::where('id', '<=', $preguntaSiguiente->id)->count();
            session()->put('current_question_number', $currentQuestionNumber);

            return redirect()->route('chatbot.index');
        }

        return $this->mostrarResultado();
    }

    public function atras()
    {
        $currentQuestionId = session()->get('current_question_id');

        $preguntaAnterior = Pregunta::where('id', '<', $currentQuestionId)->orderBy('id', 'desc')->first();

        if ($preguntaAnterior) {
            $answers = DB::table('user_responses')
                ->where('user_id', Auth::id())
                ->pluck('respuesta_id', 'pregunta_id')
                ->toArray();

            $currentQuestionNumber = Pregunta::where('id', '<=', $preguntaAnterior->id)->count();
            $totalQuestions = Pregunta::count();

            session()->put('current_question_id', $preguntaAnterior->id);
            session()->put('current_question_number', $currentQuestionNumber);

            return view('chatbot.index', compact('preguntaAnterior', 'currentQuestionNumber', 'totalQuestions', 'answers'))
                ->with('pregunta', $preguntaAnterior);
        }

        return redirect()->route('chatbot.index');
    }

    public function mostrarResultado()
    {
        $answers = DB::table('user_responses')
            ->where('user_id', Auth::id())
            ->pluck('respuesta_id', 'pregunta_id')
            ->toArray();

        $tipoMascotaCount = $this->contarRespuestasPorTipoMascota($answers);

        if (empty($tipoMascotaCount)) {
            $tipoMascota = null;
        } else {
            arsort($tipoMascotaCount);
            $max = max($tipoMascotaCount);
            $tiposGanadores = array_keys(array_filter($tipoMascotaCount, fn($v) => $v === $max));
            $tipoMascota = $tiposGanadores[0]; // El primero en caso de empate
        }

        return view('chatbot.result', compact('tipoMascota', 'tipoMascotaCount'));
    }

    protected function contarRespuestasPorTipoMascota($answers)
    {
        $tipoMascotaCount = [];

        foreach ($answers as $respuestaId) {
            $respuesta = Respuesta::with('tipoMascota')->find($respuestaId);

            if ($respuesta && $respuesta->tipoMascota) {
                $tipo = $respuesta->tipoMascota->nombre_tipo;

                if (!isset($tipoMascotaCount[$tipo])) {
                    $tipoMascotaCount[$tipo] = 0;
                }
                $tipoMascotaCount[$tipo]++;
            }
        }

        return $tipoMascotaCount;
    }

    public function reiniciar()
    {
        DB::table('user_responses')
            ->where('user_id', Auth::id())
            ->delete();

        session()->forget('current_question_id');
        session()->forget('current_question_number');

        return redirect()->route('chatbot.index');
    }
}
