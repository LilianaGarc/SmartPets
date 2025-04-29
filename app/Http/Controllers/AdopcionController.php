<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use Illuminate\Http\Request;
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

        return redirect()->route('adopciones.panel')->with('success', 'La publicación de adopción se ha creado con éxito. Podrás ver tu publicación en tu perfil. ☺️');

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

        return redirect()->route('adopciones.panel')->with('success', 'Publicación de adopción actualizada con éxito. Podrás ver tu publicación en tu perfil. ☺️');

    }

    public function search(Request $request)
    {
        $nombre = $request->get('nombre');

        $adopciones = Adopcion::with('usuario') // Asegúrate que tengas esta relación
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


    public function index(Request $request)
    {
        $tipo_mascota = $request->get('tipo_mascota');
        $orden = $request->get('orden', 'desc');

        $adopciones = Adopcion::query();

        if (Auth::check()) {
            $adopciones->where('id_usuario', '!=', Auth::id());
        }

        if ($tipo_mascota) {
            $adopciones->where('tipo_mascota', $tipo_mascota);
        }

        if ($orden == 'most_visited') {
            $adopciones->orderBy('visibilidad', 'desc');
        } elseif ($orden == 'least_visited') {
            $adopciones->orderBy('visibilidad', 'asc');
        } elseif ($orden == 'accepted_requests') {
            $adopciones->whereHas('solicitudAceptada', function ($query) {
                $query->where('estado', 'aceptada');
            });
        } else {
            $adopciones->orderBy('created_at', $orden);
        }

        $adopciones = $adopciones->with('solicitudAceptada')->get();

        $adopciones = $adopciones->filter(function ($adopcion) {
            if (!$adopcion->solicitudAceptada) {
                return true;
            }

            if (Auth::check() && (Auth::id() === $adopcion->id_usuario || Auth::id() === $adopcion->solicitudAceptada->id_usuario)) {
                return true;
            }

            return false;
        });

        return view('adopciones.indexAdopciones', compact('adopciones'));
    }



    public function create()
    {
        return view('adopciones.create');
    }

    public function store(Request $request)
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

        return redirect()->route('adopciones.index')->with('success', 'La publicación de adopción se ha creado con éxito. Podrás ver tu publicación en tu perfil. ☺️');
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

        return redirect()->route('adopciones.index')->with('success', 'Publicación de adopción actualizada con éxito. Podrás ver tu publicación en tu perfil. ☺️');
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

        return view('adopciones.show', compact('adopcion'));
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
            return redirect()->route('adopciones.panel')->with('fracaso', 'La adopcion no se pudo borrar.');
        }else {
            return redirect()->route('adopciones.panel')->with('exito', 'La adopcion se elimino correctamente.');
        }
    }

}
