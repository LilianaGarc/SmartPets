<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Veterinaria;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class VeterinariaController extends Controller
{
    public function panel()
    {
        $veterinarias = Veterinaria::all();
        return view('panelAdministrativo.veterinariasIndex')->with('veterinarias', $veterinarias);
    }

    public function search(Request $request)
    {
        $nombre = $request->get('nombre');

        $veterinarias = Veterinaria::orderBy('created_at', 'desc')
            ->where(function ($query) use ($nombre) {
                $query->where('nombre', 'LIKE', "%$nombre%")
                    ->orWhere('nombre_veterinario', 'LIKE', "%$nombre%")
                    ->orWhere('telefono', 'LIKE', "%$nombre%");
            })
            ->get();

        return view('panelAdministrativo.veterinariasIndex')->with('veterinarias', $veterinarias);
    }


    // Método que muestra todas las veterinarias
    public function index()
    {
        
        if (auth()->check() && auth()->user()->es_admin) {
            $veterinarias = Veterinaria::all();
            return view('panelAdministrativo.veterinariasIndex')->with('veterinarias', $veterinarias);
        } else {
            $veterinarias = Veterinaria::Paginate(6);
            return view('veterinarias.index')->with('veterinarias', $veterinarias);
        }

    }

    // Método que muestra el formulario para crear una veterinaria
    public function create()
    {
        if (auth()->user()->es_admin) {
            $usuarios = User::all();
            return view('veterinarias.formulario')->with('usuarios', $usuarios);
        } else {
            return view('veterinarias.formulario');
        }
    }

    // Método que almacena una veterinaria
    public function store(Request $request)
    {
        if (auth()->user()->es_admin) {
            $idUsuario = $request->input('id_user');
            if (!$idUsuario) {
                return back()->with('fracaso', 'Debes seleccionar un usuario dueño.');
            }
        } else {
            $idUsuario = auth()->id();
        }
        // Validación de la información
        $request->validate([
            'nombre' => 'required|string|max:255',
            'nombre_veterinario' => 'required|string|max:255',
            'horario_apertura' => 'required',
            'horario_cierre' => 'required|after:horario_apertura',
            'departamento' => 'required',
            'ciudad' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'telefono' => 'required|regex:/^[2389]\d{7}$/',
            'whatsapp' => 'nullable|regex:/^[389]\d{7}$/',
            'imagenes.*' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'redes.*.tipo_red_social' => 'nullable|string|max:255',
            'redes.*.nombre_usuario' => 'nullable|string|max:255',
        ]);

        // Crear la ubicación
        $ubicacion = Ubicacion::create([
            'departamento' => $request->input('departamento'),
            'municipio' => $request->input('municipio'),
            'ciudad' => $request->input('ciudad'),
            'direccion' => $request->input('direccion'),
            'latitud' => $request->input('latitud'),
            'longitud' => $request->input('longitud'),
        ]);
        // Crear la veterinaria
        $veterinaria = Veterinaria::create([
            'id_user' => $idUsuario,
            'nombre' => $request->input('nombre'),
            'nombre_veterinario' => $request->input('nombre_veterinario'),
            'horario_apertura' => $request->input('horario_apertura'),
            'horario_cierre' => $request->input('horario_cierre'),
            'telefono' => $request->input('telefono'),
            'whatsapp' => $request->input('whatsapp'),
            'evaluacion' => $request->input('evaluacion', 0),
            'id_ubicacion' => $ubicacion->id,
        ]);

        // Guardar las imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('veterinarias', 'public');
                $veterinaria->imagenes()->create(['path' => $path, 'id_veterinaria' => $veterinaria->id]);
            }
        }

        // Guardar la red
        if ($request->has('redes')) {
            foreach ($request->input('redes') as $red) {
                $veterinaria->redes()->create([
                    'tipo_red_social' => $red['tipo_red_social'] ?? null,
                    'nombre_usuario' => $red['nombre_usuario'] ?? null,
                    'id_veterinaria' => $veterinaria->id,
                ]);
            }
        }

        if ($veterinaria->save()) {
            // Se guardó correctamente
            if (auth()->user()->es_admin) {
                return redirect()->route('veterinarias.panel')->with('exito', 'Veterinaria registrada exitosamente');
            } else {
                return redirect()->route('veterinarias.index')->with('exito', 'Veterinaria registrada exitosamente');
            }
        } else {
            // No se pudo guardar
            if (auth()->user()->es_admin) {
                return redirect()->route('veterinarias.panel')->with('fracaso', 'La veterinaria no se pudo registrar');
            } else {
                return redirect()->route('veterinarias.index')->with('fracaso', 'La veterinaria no se pudo registrar');
            }
        }
    }

    // Método que muestra una veterin aria
    public function show(string $id)
    {
        if (auth()->check() && auth()->user()->es_admin) {
            $veterinaria = Veterinaria::with(['ubicacion', ])->findOrFail($id);
        return view('veterinarias.otra')->with('veterinaria', $veterinaria);  // crea la ruta y lavista ponle
        } else {
            $veterinaria = Veterinaria::with(['ubicacion', 'calificaciones.user'])->findOrFail($id);
            return view('veterinarias.unaVeterinaria')->with('veterinaria', $veterinaria);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $veterinaria = Veterinaria::with('ubicacion', 'imagenes')->findOrFail($id);

        if (auth()->user()->es_admin) {
            $usuarios = User::all();
            return view('veterinarias.formulario', compact('veterinaria', 'usuarios'));
        } else {
            return view('veterinarias.formulario')->with('veterinaria' , $veterinaria);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->es_admin) {
            // Lógica para admin: puede asignar cualquier usuario
            $idUsuario = $request->input('id_user');
        } else {
            // Lógica para usuario normal: solo puede asignarse a sí mismo
            $idUsuario = auth()->id();
        }
        // Validación de los información al actualizar.
        $request->validate([
            'nombre' => 'required|string|max:255',
            'nombre_veterinario' => 'required|string|max:255',
            'horario_apertura' => 'required',
            'horario_cierre' => 'required|after:horario_apertura',
            'departamento' => 'required',
            'municipio' => 'required|string|max:100',
            'ciudad' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'telefono' => 'required|regex:/^[2389]\d{7}$/',
            'whatsapp' => 'nullable|regex:/^[389]\d{7}$/',
            'imagenes.*' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'redes.*.tipo_red_social' => 'nullable|string|max:255',
            'redes.*.nombre_usuario' => 'nullable|string|max:255',
        ]);

        $veterinaria = Veterinaria::with('imagenes', 'redes')->findOrFail($id);
        $ubicacion = Ubicacion::findOrFail($veterinaria->id_ubicacion);

        // Actualizar la ubicación
        $ubicacion->update([
            'departamento' => $request->input('departamento'),
            'ciudad' => $request->input('ciudad'),
            'municipio' => $request->input('municipio'),
            'direccion' => $request->input('direccion'),
            'latitud' => $request->input('latitud'),
            'longitud' => $request->input('longitud'),
        ]);

        // Actualizar la veterinaria
        $veterinaria->update([
            'id_user' => $idUsuario,
            'nombre' => $request->input('nombre'),
            'nombre_veterinario' => $request->input('nombre_veterinario'),
            'horario_apertura' => $request->input('horario_apertura'),
            'horario_cierre' => $request->input('horario_cierre'),
            'telefono' => $request->input('telefono'),
            'whatsapp' => $request->input('whatsapp'),
        ]);

        // Actualizar la imagen si se elimina una anterior o si se ingresa una nueva al sistema
        // Manejo de imágenes eliminadas
        if ($request->has('deleted_images')) {
            $deletedImageIds = explode(',', $request->deleted_images);
            foreach ($deletedImageIds as $imageId) {
                $imagen = $veterinaria->imagenes()->find($imageId);
                if ($imagen) {
                    // Eliminar el archivo físico
                    if (\Storage::disk('public')->exists($imagen->path)) {
                        \Storage::disk('public')->delete($imagen->path);
                    }
                    // Eliminar el registro de la base de datos
                    $imagen->delete();
                }
            }
        }

        // Manejo de imágenes nuevas
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('veterinarias', 'public');
                $veterinaria->imagenes()->create(['path' => $path]);
            }
        }

        $veterinaria->redes()->delete();

        $redes = $request->input('redes');
        if (is_array($redes)) {
            foreach ($redes as $red) {
                $veterinaria->redes()->create([
                    'tipo_red_social' => $red['tipo_red_social'] ?? null,
                    'nombre_usuario' => $red['nombre_usuario'] ?? null,
                ]);
            }
        }

        // Guardar la veterinaria

        if (auth()->user()->es_admin) {
            return redirect()->route('veterinarias.panel')->with('exito', 'Veterinaria actualizada exitosamente');
        } else {
            return redirect()->route('veterinarias.index')->with('exito', 'Veterinaria actualizada exitosamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function paneldestroy(string $id)
    {
        $eliminados = Veterinaria::destroy($id);
        if ($eliminados > 0) {
            return redirect()->route('veterinarias.panel')->with('exito', 'La veterinaria se eliminó exitosamente');
        } else {
            return redirect()->route('veterinarias.panel')->with('fracaso', 'La veterinaria no se pudo eliminar');
        }
    }
}
