<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Chat;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Notifications\SolicitudAceptada;


class SolicitudController
{
    public function panel()
    {
        $solicitudes = Solicitud::all();
        return view('panelAdministrativo.solicitudesIndex')->with('solicitudes', $solicitudes);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $solicitudes = Solicitud::orderby('created_at', 'desc')
            ->where('id_user', 'LIKE', "%$nombre%")
            ->orWhere('id_adopcion', 'LIKE', "%$nombre%")
            ->orWhere('contenido', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.solicitudesIndex')->with('solicitudes', $solicitudes);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitudes = Solicitud::with('adopcion', 'usuario')->get();

        return view('solicitudes.indexSolicitudes', compact('solicitudes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id_adopcion)
    {
        $adopcion = Adopcion::find($id_adopcion);

        if (!$adopcion) {
            return redirect()->route('adopciones.index')->with('error', 'La adopción solicitada no existe.');
        }

        return view('solicitudes.create', compact('adopcion'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'contenido' => 'required|string',
            'id_adopcion' => 'required|integer',
            'experiencia' => 'nullable|in:Sí,No',
            'espacio' => 'nullable|in:Sí,No',
            'gastos_veterinarios' => 'nullable|in:Sí,No',
        ]);

        $solicitud = new Solicitud();
        $solicitud->contenido = $validated['contenido'];
        $solicitud->id_usuario = auth()->user()->id;
        $solicitud->id_adopcion = $validated['id_adopcion'];
        $solicitud->experiencia = $validated['experiencia'] ?? null;
        $solicitud->espacio = $validated['espacio'] ?? null;
        $solicitud->gastos_veterinarios = $validated['gastos_veterinarios'] ?? null;

        $solicitud->save();

        $adopcion = \App\Models\Adopcion::find($validated['id_adopcion']);
        $usuarioReceptor = \App\Models\User::find($adopcion->id_usuario);
        $usuarioSolicitante = auth()->user();

        if (
            $usuarioReceptor &&
            $usuarioReceptor->id !== $usuarioSolicitante->id &&
            $usuarioReceptor->recibir_notificaciones
        ) {
            \App\Models\Notificacion::create([
                'user_id' => $usuarioReceptor->id,
                'mensaje' => $usuarioSolicitante->name . ' ha enviado una solicitud de adopción para tu mascota.',
                'visto' => false,
                'data' => json_encode([
                    'nombre' => $usuarioSolicitante->name,
                    'foto_perfil' => $usuarioSolicitante->fotoperfil ?? 'images/fotodeperfil.webp',
                    'mensaje_detalle' => 'Envió una solicitud de adopción',
                    'fecha' => \Carbon\Carbon::now()->toDateTimeString(),
                    'imagen_adopcion' => $adopcion->imagen ?? null,
                    'url_adopcion' => route('adopciones.show', ['id' => $adopcion->id]),
                ]),
            ]);
        }


        return redirect()->route('adopciones.index')->with('success', 'Solicitud enviada con éxito');
    }


    /**
     * Display the specified resource.
     */
    public function showSolicitudes($id_adopcion)
    {
        $adopcion = Adopcion::find($id_adopcion);

        if (!$adopcion) {
            return redirect()->route('adopciones.index')->with('error', 'Adopción no encontrada.');
        }

        if (auth()->user()->id === $adopcion->id_usuario) {
            $solicitudes = $adopcion->solicitudes;
        } else {
            $solicitudes = Solicitud::where('id_usuario', auth()->user()->id)
                ->where('id_adopcion', $adopcion->id)
                ->get();
        }

        return view('solicitudes.indexSolicitudes', compact('solicitudes', 'adopcion'));
    }



    public function showDetails($id_adopcion, $id)
    {
        $adopcion = Adopcion::find($id_adopcion);
        $solicitud = Solicitud::find($id);

        if (!$adopcion || !$solicitud) {
            return redirect()->route('adopciones.index')->with('error', 'Adopción o solicitud no encontrada.');
        }

        if (auth()->user()->id !== $adopcion->id_usuario && auth()->user()->id !== $solicitud->id_usuario) {
            return redirect()->route('solicitudes.show', $adopcion->id)->with('error', 'No tienes permiso para ver esta solicitud.');
        }

        return view('solicitudes.showDetails', compact('solicitud', 'adopcion'));
    }


    public function edit($id_adopcion, $id)
    {
        $adopcion = Adopcion::find($id_adopcion);
        $solicitud = Solicitud::find($id);

        if (!$adopcion) {
            return redirect()->route('adopciones.index')->with('error', 'La adopción no existe.');
        }

        if (!$solicitud) {
            return redirect()->route('solicitudes.show', $id_adopcion)->with('error', 'Solicitud no encontrada.');
        }

        if ($solicitud->id_usuario !== auth()->user()->id) {
            return redirect()->route('solicitudes.show', $adopcion->id)->with('error', 'No tienes permiso para editar esta solicitud.');
        }

        return view('solicitudes.edit', compact('solicitud', 'adopcion'));
    }


    public function update(Request $request, $id_adopcion, $id)
    {
        $validated = $request->validate([
            'contenido' => 'required|string',
            'experiencia' => 'nullable|in:Sí,No',
            'espacio' => 'nullable|in:Sí,No',
            'gastos_veterinarios' => 'nullable|in:Sí,No',
        ]);

        $solicitud = Solicitud::find($id);

        if (!$solicitud) {
            return redirect()->route('solicitudes.show', $id_adopcion)->with('error', 'Solicitud no encontrada.');
        }

        $solicitud->contenido = $validated['contenido'];
        $solicitud->experiencia = $validated['experiencia'] ?? $solicitud->experiencia;
        $solicitud->espacio = $validated['espacio'] ?? $solicitud->espacio;
        $solicitud->gastos_veterinarios = $validated['gastos_veterinarios'] ?? $solicitud->gastos_veterinarios;


        $solicitud->save();

        return redirect()->route('solicitudes.showDetails', [$id_adopcion, $id])->with('success', 'Solicitud actualizada con éxito.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_adopcion, $id)
    {
        $adopcion = Adopcion::find($id_adopcion);

        if (!$adopcion) {
            return redirect()->route('adopciones.index')->with('error', 'Adopción no encontrada.');
        }

        $solicitud = Solicitud::where('id_adopcion', $id_adopcion)->find($id);

        if (!$solicitud) {
            return redirect()->route('solicitudes.show', $id_adopcion)->with('error', 'Solicitud no encontrada en esta adopción.');
        }

        if ($solicitud->id_usuario !== auth()->user()->id) {
            return redirect()->route('solicitudes.show', $adopcion->id)->with('error', 'No tienes permiso para eliminar esta solicitud.');
        }

        $solicitud->delete();

        return redirect()->route('solicitudes.show', $id_adopcion)->with('success', 'Solicitud eliminada con éxito.');
    }


    public function paneldestroy(string $id)
    {
        $eliminados = Solicitud::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('solicitudes.panel')->with('fracaso', 'La solicitud no se pudo borrar.');
        }else {
            return redirect()->route('solicitudes.panel')->with('exito', 'La solicitud se elimino correctamente.');
        }
    }

    public function aceptar($id_adopcion, $id_solicitud)
    {
        $adopcion = Adopcion::find($id_adopcion);
        $solicitud = Solicitud::find($id_solicitud);

        if (!$adopcion || !$solicitud || $solicitud->id_adopcion !== $adopcion->id) {
            return redirect()->back()->with('fracaso', 'Solicitud o adopción no válida.');
        }

        if (auth()->user()->id !== $adopcion->id_usuario) {
            return redirect()->back()->with('fracaso', 'No tienes permiso para aceptar esta solicitud.');
        }

        Solicitud::where('id_adopcion', $id_adopcion)
            ->where('id', '!=', $id_solicitud)
            ->update(['estado' => 'pendiente']);

        $solicitud->estado = 'aceptada';
        $solicitud->save();

        $solicitud->usuario->notify(new SolicitudAceptada($solicitud));

        $usuarioQueAcepta = auth()->user();
        $usuarioSolicitante = $solicitud->usuario;

        $chat = Chat::where(function ($query) use ($usuarioQueAcepta, $usuarioSolicitante) {
            $query->where('id_usuario_1', $usuarioQueAcepta->id)
                ->where('id_usuario_2', $usuarioSolicitante->id);
        })->orWhere(function ($query) use ($usuarioQueAcepta, $usuarioSolicitante) {
            $query->where('id_usuario_1', $usuarioSolicitante->id)
                ->where('id_usuario_2', $usuarioQueAcepta->id);
        })->first();

        if (!$chat) {
            $chat = Chat::create([
                'id_usuario_1' => $usuarioQueAcepta->id,
                'id_usuario_2' => $usuarioSolicitante->id,
            ]);
        }

        $mensajeTexto = "🎉 ¡Felicidades, {$usuarioSolicitante->name}! 🎉<br>
Tu solicitud para adoptar a {$adopcion->nombre_mascota} ha sido aceptada por {$usuarioQueAcepta->name}.<br>
Nos alegra que formes parte de esta gran familia. Por favor, mantente en contacto para coordinar los próximos pasos.<br>
¡Gracias por tu interés y compromiso! ";


        Mensaje::create([
            'texto' => $mensajeTexto,
            'fecha' => now(),
            'estado' => false,
            'id_chat' => $chat->id,
            'user_id' => $usuarioQueAcepta->id,
            'tema' => 'Notificación',
            'imagen' => null,
        ]);

        return redirect()->route('solicitudes.show', $id_adopcion)->with('success', '¡Solicitud aceptada con éxito!');
    }


    public function cancelarAceptacion(Request $request, $id_adopcion, $id_solicitud)
    {
        $adopcion = Adopcion::find($id_adopcion);
        $solicitud = Solicitud::find($id_solicitud);

        if (!$adopcion || !$solicitud || $solicitud->id_adopcion !== $adopcion->id) {
            return redirect()->back()->with('fracaso', 'Solicitud o adopción no válida.');
        }

        if (auth()->user()->id !== $adopcion->id_usuario) {
            return redirect()->back()->with('fracaso', 'No tienes permiso para cancelar esta solicitud.');
        }

        if ($solicitud->estado !== 'aceptada') {
            return redirect()->back()->with('fracaso', 'Esta solicitud no ha sido aceptada.');
        }

        $solicitud->estado = 'pendiente';
        $solicitud->save();

        $usuarioQueCancela = auth()->user();
        $usuarioSolicitante = $solicitud->usuario;
        $motivo = $request->input('motivo_cancelacion');

        $chat = Chat::where(function ($query) use ($usuarioQueCancela, $usuarioSolicitante) {
            $query->where('id_usuario_1', $usuarioQueCancela->id)
                ->where('id_usuario_2', $usuarioSolicitante->id);
        })->orWhere(function ($query) use ($usuarioQueCancela, $usuarioSolicitante) {
            $query->where('id_usuario_1', $usuarioSolicitante->id)
                ->where('id_usuario_2', $usuarioQueCancela->id);
        })->first();

        if (!$chat) {
            $chat = Chat::create([
                'id_usuario_1' => $usuarioQueCancela->id,
                'id_usuario_2' => $usuarioSolicitante->id,
            ]);
        }

        $mensajeTexto = "📢 Hola {$usuarioSolicitante->name}, "
            . "La solicitud de adopción para {$adopcion->nombre_mascota} que había sido aceptada fue cancelada por {$usuarioQueCancela->name}.<br>"
            . "Motivo: {$motivo}<br>"
            . "Gracias por tu interés. Te animamos a seguir buscando a tu compañero ideal.";

        Mensaje::create([
            'texto' => $mensajeTexto,
            'fecha' => now(),
            'estado' => false,
            'id_chat' => $chat->id,
            'user_id' => $usuarioQueCancela->id,
            'tema' => 'Cancelación de Aceptación',
            'imagen' => null,
        ]);

        return redirect()->route('solicitudes.show', $id_adopcion)->with('success', 'La solicitud aceptada fue cancelada con éxito.');
    }



}
