<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Solicitud;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdopcionController extends Controller
{
    public function panel()
    {
        $adopciones = Adopcion::with('usuario')->get();
        return view('panelAdministrativo.adopcionesIndex')->with('adopciones', $adopciones);
    }

    public function panelcreate()

    {
        return view('panelAdministrativo.adopcionesForm');
    }


    public function search(Request $request)
    {
        $nombre = $request->get('nombre');

        $adopciones = Adopcion::with('usuario')
        ->where(function ($query) use ($nombre) {
            $query->whereHas('usuario', function ($q) use ($nombre) {
                $q->where('name', 'LIKE', "%$nombre%");
            })
                ->orWhere('nombre_mascota', 'LIKE', "%$nombre%")
                ->orWhere('tipo_mascota', 'LIKE', "%$nombre%")
                ->orWhere('contenido', 'LIKE', "%$nombre%");
        })
            ->orderBy('created_at', 'desc')->get();

        return view('panelAdministrativo.adopcionesIndex')->with('adopciones', $adopciones);
    }


    public function panelshow(string $id)

    {
        $adopcion = Adopcion::with(['usuario', 'solicitudAceptada'])->findOrFail($id);
        return view('panelAdministrativo.adopcionesDetalles', compact('adopcion'));
    }


    public function panelstore(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tipo_mascota' => 'required|string|max:100',
            'nombre_mascota' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'raza_mascota' => 'required|string|max:100',
            'ubicacion_mascota' => 'required|string|max:100',
        ]);

        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $rutaImagen = $request->file('imagen')->store('adopciones', 'public');
        } else {
            return redirect()->route('adopciones.create')->with('error', 'Por favor sube una imagen válida.');
        }

        Adopcion::create([
            'contenido' => $request->contenido,
            'imagen' => $rutaImagen,
            'visibilidad' => 0,
            'tipo_mascota' => $request->tipo_mascota,
            'nombre_mascota' => $request->nombre_mascota,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'raza_mascota' => $request->raza_mascota,
            'ubicacion_mascota' => $request->ubicacion_mascota,
            'id_usuario' => Auth::id(),
        ]);

        return redirect()->route('adopciones.panel')->with('exito', 'La publicación de adopción se ha creado con éxito.');

    }


    public function paneledit(string $id)
    {
        $adopcion = Adopcion::findOrfail($id);
        return view('panelAdministrativo.adopcionesForm')->with('adopcion', $adopcion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function panelupdate(Request $request, string $id)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tipo_mascota' => 'required|string|max:100',
            'nombre_mascota' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'raza_mascota' => 'required|string|max:100',
            'ubicacion_mascota' => 'required|string|max:255',
        ]);

        $adopcion = Adopcion::findOrFail($id);

        if ($request->hasFile('imagen')) {
            if ($adopcion->imagen) {
                Storage::disk('public')->delete($adopcion->imagen);
            }

            $rutaImagen = $request->file('imagen')->store('adopciones', 'public');
            $adopcion->imagen = $rutaImagen;
        }

        $adopcion->contenido = $request->contenido;
        $adopcion->tipo_mascota = $request->tipo_mascota;
        $adopcion->nombre_mascota = $request->nombre_mascota;
        $adopcion->fecha_nacimiento = $request->fecha_nacimiento;
        $adopcion->raza_mascota = $request->raza_mascota;
        $adopcion->ubicacion_mascota = $request->ubicacion_mascota;

        $adopcion->save();

        return redirect()->route('adopciones.panel')->with('exito', 'Publicación de adopción actualizada con éxito.');

    }


    public function index(Request $request)
    {
        $tipo_mascota = $request->get('tipo_mascota');
        $orden = $request->get('orden', 'desc');
        $ordenes_validos = ['desc', 'asc', 'most_visited', 'least_visited', 'accepted_requests'];

        if (!in_array($orden, $ordenes_validos)) {
            $orden = 'desc';
        }

        if ($orden === 'accepted_requests') {
            $solicitudes = Solicitud::where('id_usuario', Auth::id())
                ->with('adopcion')
                ->get();

            $adopciones = $solicitudes->map(fn($s) => $s->adopcion)->filter();

            if ($tipo_mascota && $tipo_mascota !== '') {
                $adopciones = $adopciones->filter(fn($a) => $a->tipo_mascota === $tipo_mascota);
            }

            $adopciones->each->load('solicitudAceptada');

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 8;
            $currentItems = $adopciones->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $paginated = new LengthAwarePaginator($currentItems, $adopciones->count(), $perPage, $currentPage);
            $paginated->withPath(route('adopciones.index'))->appends($request->all());

            return view('adopciones.indexAdopciones', ['adopciones' => $paginated]);
        }

        $query = Adopcion::query();

        if (Auth::check()) {
            $query->where('id_usuario', '!=', Auth::id());
        }

        if ($tipo_mascota && $tipo_mascota !== '') {
            $query->where('tipo_mascota', $tipo_mascota);
        }

        switch ($orden) {
            case 'most_visited':
                $query->orderBy('visibilidad', 'desc');
                break;
            case 'least_visited':
                $query->orderBy('visibilidad', 'asc');
                break;
            default:
                $query->orderBy('created_at', $orden);
                break;
        }

        $adopciones = $query->with('solicitudAceptada')->get();

        $adopciones = $adopciones->filter(function ($adopcion) {
            if (!$adopcion->solicitudAceptada) {
                return true;
            }

            return Auth::check() && (
                    Auth::id() === $adopcion->id_usuario ||
                    Auth::id() === $adopcion->solicitudAceptada->id_usuario
                );
        });

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 8;
        $currentItems = $adopciones->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator($currentItems, $adopciones->count(), $perPage, $currentPage);
        $paginated->withPath(route('adopciones.index'))->appends($request->all());

        return view('adopciones.indexAdopciones', ['adopciones' => $paginated]);
    }


    public function create()
    {
        return view('adopciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',

            'imagen_principal' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'imagenes_secundarias' => 'nullable|array|max:4',
            'imagenes_secundarias.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'tipo_mascota' => [
                'required',
                'string',
                'in:Perro,Gato,Conejo,Tortuga,Peces,Otro',
            ],

            'nombre_mascota' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            ],

            'fecha_nacimiento' => 'required|date|before_or_equal:today',

            'raza_mascota' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            ],

            'ubicacion_mascota' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s#.,-]+$/',
            ],
        ], [
            'tipo_mascota.in'          => 'El tipo de mascota seleccionado no es válido.',
            'tipo_mascota.required'    => 'El tipo de mascota es obligatorio.',
            'nombre_mascota.regex'     => 'El nombre de la mascota solo puede contener letras y espacios.',
            'raza_mascota.regex'       => 'La raza de la mascota solo puede contener letras y espacios.',
            'ubicacion_mascota.regex'  => 'La ubicación contiene caracteres no permitidos.',
        ]);

        if ($request->hasFile('imagenes_secundarias') && count($request->file('imagenes_secundarias')) > 4) {
            return redirect()->route('adopciones.create')->with('error', 'No puedes subir más de 4 imágenes secundarias.');
        }

        if ($request->hasFile('imagen_principal') && $request->file('imagen_principal')->isValid()) {
            $imagenPrincipal = $request->file('imagen_principal')->store('adopciones', 'public');
        } else {
            return redirect()->route('adopciones.create')->with('error', 'Por favor sube una imagen válida para la imagen principal.');
        }

        $imagenesSecundarias = [];
        if ($request->hasFile('imagenes_secundarias')) {
            foreach ($request->file('imagenes_secundarias') as $imagen) {
                if ($imagen->isValid()) {
                    $imagenesSecundarias[] = $imagen->store('adopciones', 'public');
                } else {
                    return redirect()->route('adopciones.create')->with('error', 'Una de las imágenes secundarias no es válida.');
                }
            }
        }

        $adopcion = Adopcion::create([
            'contenido'            => $request->contenido,
            'imagen'               => $imagenPrincipal,
            'imagenes_secundarias' => json_encode($imagenesSecundarias),
            'visibilidad'          => 0,
            'tipo_mascota'         => $request->tipo_mascota,
            'nombre_mascota'       => $request->nombre_mascota,
            'fecha_nacimiento'     => $request->fecha_nacimiento,
            'raza_mascota'         => $request->raza_mascota,
            'ubicacion_mascota'    => $request->ubicacion_mascota,
            'id_usuario'           => Auth::id(),
        ]);

        $usuarioCreador = Auth::user();

        $usuarios = \App\Models\User::where('id', '!=', $usuarioCreador->id)
            ->where('recibir_notificaciones', true)
            ->get();

        foreach ($usuarios as $usuario) {
            \App\Models\Notificacion::create([
                'user_id' => $usuario->id,
                'mensaje' => $usuarioCreador->name . ' creó una nueva publicación de adopción',
                'visto' => false,
                'data' => json_encode([
                    'nombre'         => $usuarioCreador->name,
                    'foto_perfil'    => $usuarioCreador->fotoperfil ? $usuarioCreador->fotoperfil : 'images/fotodeperfil.webp',
                    'mensaje_detalle'=> 'Creó una nueva publicación de adopción',
                    'fecha'          => \Carbon\Carbon::now()->toDateTimeString(),
                    'imagen_adopcion'=> $imagenPrincipal,
                    'url_adopcion'   => route('adopciones.show', ['id' => $adopcion->id]),
                ]),
            ]);
        }

        return redirect()->route('adopciones.index')->with('success', 'La publicación de adopción se ha creado con éxito.');
    }



    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);

        if ($adopcion->id_usuario != Auth::id()) {
            return redirect()->route('adopciones.index')->with('fracaso', 'No tienes permiso para editar esta publicación.');
        }

        return view('adopciones.edit', compact('adopcion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
            'imagen_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'imagenes_secundarias' => 'nullable|array|max:4',
            'imagenes_secundarias.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tipo_mascota' => 'required|string|max:100',
            'nombre_mascota' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'raza_mascota' => 'required|string|max:100',
            'ubicacion_mascota' => 'required|string|max:255',
        ]);

        $adopcion = Adopcion::findOrFail($id);

        if ($adopcion->id_usuario != Auth::id()) {
            return redirect()->route('adopciones.index')->with('fracaso', 'No tienes permiso para editar esta publicación.');
        }

        // Imagen principal
        if ($request->hasFile('imagen_principal')) {
            if ($adopcion->imagen) {
                Storage::disk('public')->delete($adopcion->imagen);
            }
            $adopcion->imagen = $request->file('imagen_principal')->store('adopciones', 'public');
        }

        $imagenesExistentes = $adopcion->imagenes_secundarias ? json_decode($adopcion->imagenes_secundarias, true) : [];

        $imagenesAEliminar = $request->input('imagenes_secundarias_eliminar', []);
        if (!empty($imagenesAEliminar)) {
            foreach ($imagenesAEliminar as $imagen) {
                if (in_array($imagen, $imagenesExistentes)) {
                    Storage::disk('public')->delete($imagen);
                    $imagenesExistentes = array_filter($imagenesExistentes, fn($img) => $img !== $imagen);
                }
            }
        }

        if ($request->hasFile('imagenes_secundarias')) {
            $archivosNuevos = $request->file('imagenes_secundarias');
            foreach ($archivosNuevos as $archivo) {
                if ($archivo->isValid() && count($imagenesExistentes) < 4) {
                    $ruta = $archivo->store('adopciones', 'public');
                    $imagenesExistentes[] = $ruta;
                }
            }
        }

        $adopcion->imagenes_secundarias = count($imagenesExistentes) ? json_encode(array_values($imagenesExistentes)) : null;

        $adopcion->contenido = $request->contenido;
        $adopcion->tipo_mascota = $request->tipo_mascota;
        $adopcion->nombre_mascota = $request->nombre_mascota;
        $adopcion->fecha_nacimiento = $request->fecha_nacimiento;
        $adopcion->raza_mascota = $request->raza_mascota;
        $adopcion->ubicacion_mascota = $request->ubicacion_mascota;

        $adopcion->save();

        return redirect()->route('adopciones.index')->with('success', 'Publicación de adopción actualizada con éxito. ☺️');
    }




    public function show($id)
    {
        $adopcion = Adopcion::with('solicitudAceptada')->findOrFail($id);
        $user = Auth::user();

        if ($adopcion->solicitudAceptada) {
            $permitido = $user && (
                    $user->id === $adopcion->id_usuario ||
                    $user->id === $adopcion->solicitudAceptada->id_usuario
                );

            if (!$permitido) {
                return redirect()->route('adopciones.index')->with('fracaso', 'No tienes acceso a esta publicación.');
            }
        }

        $visitedKey = 'visited_adopcion_' . $adopcion->id;

        if (!$user || !session()->has($visitedKey)) {
            $adopcion->increment('visibilidad');
            if ($user) {
                session()->put($visitedKey, true);
            }
        }

        $relacionadasTipo = Adopcion::where('id', '!=', $adopcion->id)
            ->where('tipo_mascota', $adopcion->tipo_mascota)
            ->where('id_usuario', '!=', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        if ($relacionadasTipo->count() < 4) {
            $faltantes = 4 - $relacionadasTipo->count();

            $otras = Adopcion::where('id', '!=', $adopcion->id)
                ->whereNotIn('id', $relacionadasTipo->pluck('id'))
                ->where('id_usuario', '!=', $user->id)
                ->orderBy('created_at', 'desc')
                ->take($faltantes)
                ->get();

            $adopcionesRelacionadas = $relacionadasTipo->concat($otras);
        } else {
            $adopcionesRelacionadas = $relacionadasTipo;
        }

        return view('adopciones.show', compact('adopcion', 'adopcionesRelacionadas'));
    }


    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);

        if ($adopcion->id_usuario != Auth::id()) {
            return redirect()->route('adopciones.index')->with('fracaso', 'No tienes permiso para eliminar esta publicación.');
        }

        if ($adopcion->imagen) {
            Storage::disk('public')->delete($adopcion->imagen);
        }

        $adopcion->delete();

        return redirect()->route('adopciones.index')->with('success', 'Publicación de adopción eliminada.');
    }

    public function paneldestroy(string $id)
    {
        $eliminados = Adopcion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('adopciones.panel')->with('fracaso', 'La adopción no se pudo borrar.');
        }else {
            return redirect()->route('adopciones.panel')->with('exito', 'La adopción se eliminó correctamente.');
        }
    }

}
