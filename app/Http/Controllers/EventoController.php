<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;
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
            'titulo' => 'required|string|max:30',
            'descripcion' => 'required|string|max:200',
            'fecha' => 'required|date|after_or_equal:today',
            'telefono' => 'required|string|max:8|regex:/^[2389]\d{7}$/',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'modalidad_evento' => 'required|in:gratis,pago',
            'precio' => 'required_if:modalidad_evento,pago|nullable|numeric|min:0|max:10000',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'required|string|max:150',
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
        $evento = Evento::findOrFail($id);

        $deleteRequested = $request->input('eliminar_imagen') === '1';
        $hasExistingImage = !empty($evento->imagen);

        $imagenRule = ($hasExistingImage && !$deleteRequested)
            ? 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
            : 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120';

        $request->validate([
            'titulo' => 'required|string|max:30',
            'descripcion' => 'required|string|max:250',
            'fecha' => 'required|date|after_or_equal:today',
            'telefono' => 'required|string|max:8|regex:/^[2389]\d{7}$/',
            'imagen' => $imagenRule,
            'modalidad_evento' => 'required|in:gratis,pago',
            'precio' => 'required_if:modalidad_evento,pago|nullable|numeric|min:0|max:10000',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'required|string|max:150',
        ]);

        // procesar imagen: si suben nueva imagen, reemplaza y borra la anterior
        if ($request->hasFile('imagen')) {
            if ($evento->imagen && Storage::disk('public')->exists($evento->imagen)) {
                Storage::disk('public')->delete($evento->imagen);
            }
            $evento->imagen = $request->file('imagen')->store('eventos', 'public');
        } else {
            if ($deleteRequested && $evento->imagen) {
                if (Storage::disk('public')->exists($evento->imagen)) {
                    Storage::disk('public')->delete($evento->imagen);
                }
                $evento->imagen = null;
            }

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
            'estado' => $request->estado_evento ?? $evento->estado,
            'motivo' => $request->motivo_rechazo ?? $evento->motivo,
        ]);

        return redirect()->route('eventos.panel')->with('exito', 'Evento actualizado correctamente.');
    }

    public function search(Request $request)
    {
        $nombre = $request->get('nombre');

        $eventos = Evento::where(function ($query) use ($nombre) {
            $query->where('titulo', 'LIKE', "%$nombre%")
                ->orWhere('descripcion', 'LIKE', "%$nombre%")
                ->orWhere('telefono', 'LIKE', "%$nombre%");
        })->orderBy('created_at', 'desc')->get();

        return view('panelAdministrativo.eventosIndex', compact('eventos'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $busqueda = $request->input('q');
    $query = Evento::query();

        if (!auth()->check()) {
            $query->where('estado', 'aceptado');
        } else {
            if ($request->filled('tipo') && $request->tipo == 'mios') {
                $query->where('id_user', auth()->id());
            } elseif ($request->filled('tipo') && $request->tipo == 'participando') {
                $eventosIds = \App\Models\Participacion::where('id_user', auth()->id())->pluck('evento_id');
                $query->whereIn('id', $eventosIds)->where('estado', 'aceptado');
            } else {
                $query->where('estado', 'aceptado')
                    ->where('id_user', '!=', auth()->id());
            }
        }

        
        if ($busqueda) {
            $query->where(function($q) use ($busqueda) {
                $q->where('titulo', 'LIKE', "%$busqueda%")
                ->orWhere('descripcion', 'LIKE', "%$busqueda%")
                ->orWhere('fecha', 'LIKE', "%$busqueda%")
                ->orWhere('telefono', 'LIKE', "%$busqueda%");
            });
        }


        if ($request->filled('estado') && $request->tipo === 'mios') {
            $query->where('estado', $request->estado);
        }


        $query->orderByRaw("FIELD(estado, 'aceptado', 'pendiente', 'rechazado')");
        $eventos = $query->orderBy('fecha', 'asc')->paginate(9);

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
            'titulo' => 'required|string|max:30',
            'descripcion' => 'required|string|max:200',
            'fecha' => 'required|date|after_or_equal:today',
            'telefono' => 'required|string|max:8|regex:/^[2389]\d{7}$/',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'modalidad_evento' => 'required|in:gratis,pago',
            'precio' => 'required_if:modalidad_evento,pago|nullable|numeric|min:0|max:10000',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'required|string|max:150',
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
        $evento = Evento::findOrFail($id);

        $deleteRequested = $request->input('eliminar_imagen') === '1';
        $hasExistingImage = !empty($evento->imagen);

        $imagenRule = ($hasExistingImage && !$deleteRequested)
            ? 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
            : 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120';

        $request->validate([
            'titulo' => 'required|string|max:30',
            'descripcion' => 'required|string|max:250',
            'fecha' => 'required|date|after_or_equal:today',
            'telefono' => 'required|string|max:8|regex:/^[2389]\d{7}$/',
            'imagen' => $imagenRule,
            'modalidad_evento' => 'required|in:gratis,pago',
            'precio' => 'required_if:modalidad_evento,pago|nullable|numeric|min:0|max:10000',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'required|string|max:150',
        ]);

        if ($request->hasFile('imagen')) {
            if ($evento->imagen && Storage::disk('public')->exists($evento->imagen)) {
                Storage::disk('public')->delete($evento->imagen);
            }
            $evento->imagen = $request->file('imagen')->store('eventos', 'public');
        } else {
            if ($deleteRequested && $evento->imagen) {
                if (Storage::disk('public')->exists($evento->imagen)) {
                    Storage::disk('public')->delete($evento->imagen);
                }
                $evento->imagen = null;
            }
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

        $fechaHoraEvento = Carbon::parse($evento->fecha . ' ' . $evento->hora_fin, 'America/Tegucigalpa');

        if (Carbon::now('America/Tegucigalpa')->greaterThan($fechaHoraEvento)) {
            return back()->with('error', 'No puedes participar en un evento que ya finalizó.');
        }

        $fechaHoraEvento = \Carbon\Carbon::parse($evento->fecha . ' ' . $evento->hora_fin);
        if (now()->greaterThan($fechaHoraEvento)) {
            return back()->with('error', 'No puedes participar en un evento que ya finalizó.');
        }

        if ($evento->id_user == auth()->id()) {
            return back()->with('error', 'No puedes participar en tu propio evento.');
        }

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
        $request->validate([
            'motivo' => 'required|string|max:100',
        ]);

        $evento = Evento::findOrFail($id);
        $evento->estado = 'rechazado';
        $evento->motivo = $request->motivo;
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