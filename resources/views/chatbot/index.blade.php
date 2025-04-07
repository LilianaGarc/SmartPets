<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mascota Ideal</title>
    <link rel="stylesheet" href="{{ asset('css/mascotaideal.css') }}">

</head>
<body>
@include('MenuPrincipal.Navbar')

<form action="{{ route('chatbot.store') }}" method="POST">
    @csrf
    <h1>{{ $pregunta->texto_pregunta }}</h1>

    @foreach($pregunta->respuestas as $respuesta)
        <div>
            <input type="radio" name="respuesta_id" value="{{ $respuesta->id }}" id="respuesta{{ $respuesta->id }}" required
                   @if(session()->has('answers') && isset(session('answers')[$pregunta->id]) && session('answers')[$pregunta->id]->id == $respuesta->id) checked @endif>
            <label for="respuesta{{ $respuesta->id }}">{{ $respuesta->texto_respuesta }}</label>
        </div>
    @endforeach

    <div class="form-buttons">
        @if(session()->has('current_question_id') && session('current_question_id') > 1)
            <button type="button" class="previous" onclick="window.location='{{ route('chatbot.atras') }}'">Atrás</button>
        @endif

        <button type="submit" class="next">Siguiente</button>
    </div>
</form>


</body>
</html>
