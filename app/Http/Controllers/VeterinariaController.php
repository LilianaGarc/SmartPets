<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Veterinaria;
use App\Models\Ubicacion;
use Illuminate\Container\Attributes\Storage;
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
        $veterinarias = Veterinaria::orderby('created_at', 'desc')
            ->where('nombre', 'LIKE', "%$nombre%")
            ->orWhere('nombre_veterinario', 'LIKE', "%$nombre%")
            ->orWhere('telefono', 'LIKE', "%$nombre%")
            ->get();
        return view('panelAdministrativo.veterinariasIndex')->with('veterinarias', $veterinarias);
    }

    // Método que muestra todas las veterinarias
    public function index()
    {
        $veterinarias = Veterinaria::paginate(6);
        return view('veterinarias.index')->with('veterinarias', $veterinarias);
    }

    // Método que muestra el formulario para crear una veterinaria
    public function create()
    {
        $veterinarias = Veterinaria::all();
        return view('veterinarias.formulario')->with('veterinarias', $veterinarias);
    }

    // Método que almacena una veterinaria
    public function store(Request $request)
    {
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
            'id' => $request->input('id'),
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

        // Proceso de guardado
        if ($veterinaria->save()) {
            // mensaje de que todo salio bien
            return redirect()->route('veterinarias.index')->with('exito', 'La veterinaria se registrada exitosamente');
        } else {
            // mensaje de que no se logró guardar
            return redirect()->route('veterinarias.index')->with('fracaso', 'La veterinaria no se pudo registrar');
        }
    }

    // Método que muestra una veterinaria
    public function show(string $id)
    {
        $veterinaria = Veterinaria::with(['ubicacion', 'calificaciones.user'])->findOrFail($id);
        return view('veterinarias.unaVeterinaria')->with('veterinaria', $veterinaria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $veterinaria = Veterinaria::with('ubicacion', 'imagenes')->findOrFail($id);
        return view('veterinarias.formulario')->with('veterinaria', $veterinaria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
            'nombre' => $request->input('nombre'),
            'nombre_veterinario' => $request->input('nombre_veterinario'),
            'horario_apertura' => $request->input('horario_apertura'),
            'horario_cierre' => $request->input('horario_cierre'),
            'telefono' => $request->input('telefono'),
            'whatsapp' => $request->input('whatsapp'),
        ]);

        // Actualizar la imagen si se elimina una anterior o si se ingresa una nueva al sistema
        if ($request->has('existing_imagenes')) {
            $imageneAEliminar = $veterinaria->imagenes()->whereNotIn('id', $request->input('existing_imagenes'))->get();
            foreach ($imageneAEliminar as $imagen) {
                if ($imagen && \Storage::disk('public')->exists($imagen->path)) {
                    $imagen->update(['path' => $imagen->path]);
                }
                $imagen->delete();
            }
        }

        // Se sube la imagen
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('veterinarias', 'public');
                $veterinaria->imagenes()->create(['path' => $path]);
            }
        }
        // Manejo de redes sociales en la actualización.
        if ($request->has('redes')) {
            $veterinaria->redes()->delete();

            // Guardar nuevas redes sociales
            foreach ($request->input('redes') as $red) {
                $veterinaria->redes()->create([
                    'tipo_red_social' => $red['tipo_red_social'] ?? null,
                    'nombre_usuario' => $red['nombre_usuario'] ?? null,
                ]);
            }
        }

        // Guardar la veterinaria
        if ($veterinaria->save()) {
            // mensaje de que todo salio bien
            return redirect()->route('veterinarias.index')->with('exito', 'La veterinaria se módifico exitosamente');
        } else {
            // mensaje de que no se logró guardar
            return redirect()->route('veterinarias.index')->with('fracaso', 'La veterinaria no se pudo modificar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eliminados = Veterinaria::destroy($id);
        if ($eliminados > 0) {
            return redirect()->route('veterinarias.index')->with('exito', 'La veterinaria se eliminó exitosamente');
        } else {
            return redirect()->route('veterinarias.index')->with('fracaso', 'La veterinaria no se pudo eliminar');
        }
    }

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
