<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Notifications\PeticionEventoNotificacion;
use App\Notifications\EstadoEventoNotificacion;

class EventoController
{
    public function panel()
    {
        $eventos = Evento::all();

        $notificacionesAdmin = \App\Models\Notificacion::where('user_id', auth()->id())
            ->where('visto', false)
            ->where('mensaje', 'like', 'Nueva petición de evento%')
            ->latest()
            ->get();

        return view('panelAdministrativo.eventosIndex', compact('eventos', 'notificacionesAdmin'));
    }

    public function panelcreate()
    {
        return view('panelAdministrativo.eventosForm');
    }

    public function panelstore( Request $request)
    {
        $idUsuario = auth()->id();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:250',
            'fecha' => 'required|date|after_or_equal:today',
            'telefono' => 'required|string|max:15',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'modalidad_evento' => 'required|in:gratis,pago',
            'precio' => 'nullable|required_if:modalidad_evento,pago|numeric|min:0',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'required|string|max:255',
        ]);

        $rutaImagen = $request->file('imagen')->store('eventos', 'public');
        $evento = Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'telefono' => $request->telefono,
            'imagen' => $rutaImagen,
            'modalidad_evento' => $request->modalidad_evento,
            'precio' => $request->modalidad_evento === 'pago' ? $request->precio : null,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'ubicacion' => $request->ubicacion,
            'id_user' => $idUsuario,
        ]);

        // Notificar a todos los administradores
        $admins = User::where('usertype', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\Notificacion::create([
                'user_id' => $admin->id,
                'mensaje' => 'Nueva petición de evento: ' . $evento->titulo,
                'visto' => false,
                'data' => json_encode([
                    'evento_id' => $evento->id,
                    'titulo' => $evento->titulo,
                    'fecha' => $evento->fecha,
                    'url_evento' => route('eventos.panelshow', ['id' => $evento->id]),
                ]),
            ]);
        }

        return redirect()->route('eventos.panel')->with('exito', 'Tu evento está pendiente de revisión. Una vez aceptado, podrás verlo en la lista de eventos.');
    }

    public function panelshow($id)
    {
        $evento = Evento::findOrFail($id);
        return view('panelAdministrativo.eventosDetalles')->with('evento',$evento);

    }


    public function paneledit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('panelAdministrativo.eventosForm')->with('evento', $evento);
    }


    public function panelupdate(Request $request, $id)

    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date|after_or_equal:today',
            'telefono' => 'required|string|max:15',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'modalidad_evento' => 'required|in:gratis,pago',
            'precio' => 'nullable|required_if:modalidad_evento,pago|numeric|min:0',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'required|string|max:255',
            'estado_evento' => 'required|in:pendiente,aceptado,rechazado',
            'motivo_rechazo' => 'nullable|string|max:255',
        ]);

        $evento = Evento::findOrFail($id);
        if ($request->hasFile('imagen')) {
            if ($evento->imagen && Storage::exists('public/' . $evento->imagen)) {
                Storage::delete('public/' . $evento->imagen);
            }
            $evento->imagen = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'telefono' => $request->telefono,
            'imagen' => $evento->imagen,
            'modalidad_evento' => $request->modalidad_evento,
            'precio' => $request->modalidad_evento === 'pago' ? $request->precio : null,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'ubicacion' => $request->ubicacion,
            'estado' => $request->estado_evento,
            'motivo_rechazo' => $request->motivo_rechazo,
        ]);

        return redirect()->route('eventos.panel')->with('exito', 'Evento actualizado correctamente.');
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $eventos = Evento::orderby('created_at', 'desc')
            ->where('nombre', 'LIKE', "%$nombre%")
            ->where('descripcion', 'LIKE', "%$nombre%")
            ->where('participantes', 'LIKE', "%$nombre%")
            ->orWhere('telefono', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.eventosIndex')->with('eventos', $eventos);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('q');
        $query = Evento::query();

        // Si NO está autenticado, solo mostrar eventos aceptados
        if (!auth()->check()) {
            $query->where('estado', 'aceptado');
        } else {
            // Si filtra por "mios" (mis eventos)
            if ($request->filled('tipo') && $request->tipo == 'mios') {
                $query->where('id_user', auth()->id());
            }
            // Si filtra por "participando"
            elseif ($request->filled('tipo') && $request->tipo == 'participando') {
                $eventosIds = \App\Models\Participacion::where('id_user', auth()->id())->pluck('evento_id');
                $query->whereIn('id', $eventosIds);
            }
            // Si no filtra por tipo, mostrar solo aceptados
            else {
                $query->where('estado', 'aceptado');
            }
        }

        // Búsqueda general
        if ($busqueda) {
            $query->where(function($q) use ($busqueda) {
                $q->where('titulo', 'LIKE', "%$busqueda%")
                  ->orWhere('descripcion', 'LIKE', "%$busqueda%")
                  ->orWhere('fecha', 'LIKE', "%$busqueda%")
                  ->orWhere('telefono', 'LIKE', "%$busqueda%");
            });
        }

        // Filtro por estado (solo tiene sentido si es "mios" o "participando")
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Ordenar: aceptados, luego pendientes, luego rechazados
        $query->orderByRaw("FIELD(estado, 'aceptado', 'pendiente', 'rechazado')");

        $eventos = $query->latest()->paginate(3); // o el número que prefieras por página

        return view('eventos.index', compact('eventos'));
    }


    public function create()
    {
        return view('eventos.formulario');
    }

    public function store(Request $request)
    {
        $idUsuario = auth()->id();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:250',
            'fecha' => 'required|date|after_or_equal:today',
            'telefono' => 'required|string|max:15',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'modalidad_evento' => 'required|in:gratis,pago',
            'precio' => 'nullable|required_if:modalidad_evento,pago|numeric|min:0',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'required|string|max:255',
        ]);

        $rutaImagen = $request->file('imagen')->store('eventos', 'public');
        $evento = Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'telefono' => $request->telefono,
            'imagen' => $rutaImagen,
            'modalidad_evento' => $request->modalidad_evento,
            'precio' => $request->modalidad_evento === 'pago' ? $request->precio : null,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'ubicacion' => $request->ubicacion,
            'id_user' => $idUsuario,
        ]);

        // Notificar a todos los administradores
        $admins = User::where('usertype', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\Notificacion::create([
                'user_id' => $admin->id,
                'mensaje' => 'Nueva petición de evento: ' . $evento->titulo,
                'visto' => false,
                'data' => json_encode([
                    'evento_id' => $evento->id,
                    'titulo' => $evento->titulo,
                    'fecha' => $evento->fecha,
                    'url_evento' => route('eventos.panelshow', ['id' => $evento->id]),
                ]),
            ]);
        }

        return redirect()->route('eventos.index')->with('exito', 'Tu evento está pendiente de revisión. Una vez aceptado, podrás verlo en la lista de eventos.');
    }


    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.show')->with('evento',$evento);

    }


    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.formulario')->with('evento', $evento);
    }


    public function update(Request $request, $id)

    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date|after_or_equal:today',
            'telefono' => 'required|string|max:15',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'modalidad_evento' => 'required|in:gratis,pago',
            'precio' => 'nullable|required_if:modalidad_evento,pago|numeric|min:0',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'required|string|max:255',
        ]);

        $evento = Evento::findOrFail($id);
        if ($request->hasFile('imagen')) {
            if ($evento->imagen && Storage::exists('public/' . $evento->imagen)) {
                Storage::delete('public/' . $evento->imagen);
            }
            $evento->imagen = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'telefono' => $request->telefono,
            'imagen' => $evento->imagen,
            'modalidad_evento' => $request->modalidad_evento,
            'precio' => $request->modalidad_evento === 'pago' ? $request->precio : null,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'ubicacion' => $request->ubicacion,
        ]);

        return redirect()->route('eventos.index')->with('exito', 'Evento actualizado correctamente.');
    }


    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        if ($evento->imagen && Storage::exists('public/' . $evento->imagen)) {
            Storage::delete('public/' . $evento->imagen);
        }
        $evento->delete();

        return redirect()->route('eventos.index')->with('exito', 'Evento eliminado correctamente.');
    }


    public function participar($id)
    {
        $evento = Evento::findOrFail($id);

        // No permitir si el evento ya pasó
        $fechaHoraEvento = \Carbon\Carbon::parse($evento->fecha . ' ' . $evento->hora_fin);
        if (now()->greaterThan($fechaHoraEvento)) {
            return back()->with('error', 'No puedes participar en un evento que ya finalizó.');
        }

        // No permitir al creador
        if ($evento->id_user == auth()->id()) {
            return back()->with('error', 'No puedes participar en tu propio evento.');
        }

        // No permitir si ya participa
        if ($evento->participaciones()->where('id_user', auth()->id())->exists()) {
            return back()->with('error', 'Ya estás participando en este evento.');
        }

        $evento->participaciones()->create(['id_user' => auth()->id()]);
        return back()->with('exito', '¡Ahora participas en este evento!');
    }

    public function paneldestroy(string $id)
    {
        $eliminados = Evento::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('eventos.panel')->with('fracaso', 'El evento no se pudo borrar.');
        }else {
            return redirect()->route('eventos.panel')->with('exito', 'El evento se elimino correctamente.');
        }
    }

    public function dejarParticipar($id)
    {
        $evento = Evento::findOrFail($id);

        // No permitir si el evento ya pasó
        $fechaHoraEvento = \Carbon\Carbon::parse($evento->fecha . ' ' . $evento->hora_fin);
        if (now()->greaterThan($fechaHoraEvento)) {
            return back()->with('error', 'No puedes modificar tu participación en un evento que ya finalizó.');
        }

        $evento->participaciones()->where('id_user', auth()->id())->delete();
        return back()->with('exito', 'Has dejado de participar en este evento.');
    }

    public function aceptar($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->estado = 'aceptado';
        $evento->save();

        \App\Models\Notificacion::create([
            'user_id' => $evento->id_user,
            'mensaje' => 'Tu evento "' . $evento->titulo . '" ha sido aceptado.',
            'visto' => false,
            'data' => json_encode([
                'evento_id' => $evento->id,
                'titulo' => $evento->titulo,
                'fecha' => $evento->fecha,
                'estado' => $evento->estado,
                'url_evento' => route('eventos.show', ['id' => $evento->id]),
            ]),
        ]);

        return back()->with('exito', 'Evento aceptado correctamente.');
    }

    public function rechazar(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->estado = 'rechazado';
        $evento->motivo_rechazo = $request->motivo;
        $evento->save();

        \App\Models\Notificacion::create([
            'user_id' => $evento->id_user,
            'mensaje' => 'Tu evento "' . $evento->titulo . '" ha sido rechazado. Motivo: ' . $request->motivo,
            'visto' => false,
            'data' => json_encode([
                'evento_id' => $evento->id,
                'titulo' => $evento->titulo,
                'fecha' => $evento->fecha,
                'estado' => $evento->estado,
                'motivo' => $request->motivo,
                'url_evento' => route('eventos.show', ['id' => $evento->id]),
            ]),
        ]);

        return back()->with('exito', 'Evento rechazado correctamente.');
    }

}
