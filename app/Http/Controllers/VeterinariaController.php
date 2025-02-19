<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
    // Método que muestra todas las veterinarias
    public function index()
    {
        $veterinarias = Veterinaria::paginate(10);
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
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'nombre_veterinario' => 'required|string|max:255',
            'horario_apertura' => 'required',
            'horario_cierre' => 'required|after:horario_apertura',
            'departamento' => 'required',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'redes_sociales' => 'nullable|array',
            'redes_sociales.*.red' => 'required_with:redes_sociales.*.usuario|string|max:200',
            'redes_sociales.*.usuario' => 'required_with:redes_sociales.*.red|max:200',
            'telefono' => 'required|regex:/^[2389]\d{7}$/',
            'imagen.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'evaluacion' => 'nullable|numeric|min:0|max:5',
        ]);

        // Validación adicional para asegurarse de que las horas no sean iguales
        if ($request->input('horario_apertura') == $request->input('horario_cierre')) {
            return back()->withErrors(['horario_cierre' => 'La hora de apertura y la hora de cierre no pueden ser iguales.'])->withInput();
        }

        //manejo de imagenes  -> solo quedan la funcion faltaron pruebas
        $imagenes = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $imagen) {
                $path = $imagen->store('imagenes', 'public');
                $imagenes[] = $path;
            }
        }


        $redes_sociales = $request->input('redes_sociales', json_encode([]));

        // Crear la veterinaria
        $veterinaria = Veterinaria::create([
            'nombre' => $request->input('nombre'),
            'nombre_veterinario' => $request->input('nombre_veterinario'),
            'horario_apertura' => $request->input('horario_apertura'),
            'horario_cierre' => $request->input('horario_cierre'),
            'departamento' => $request->input('departamento'),
            'municipio' => $request->input('municipio'),
            'ciudad' => $request->input('ciudad'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'imagen' => $imagenes,
            'redes_sociales' => $redes_sociales,
            'evaluacion' => $request->input('evaluacion', 0),
        ]);

        $veterinaria = Ubicacion::create([
        'direccion' => $request->direccion,
        'ciudad' => $request->ciudad,
        'departamento' => $request->departamento,
        'municipio' => $request->municipio,
        'veterinaria_id' => $veterinaria->id, // 🔥 Se asigna la veterinaria_id correcta
    ]);

        // Crear la ubicación
        /*
        $veterinaria= Ubicacion::create([
            'direccion' => $request->input('direccion'),
            'ciudad' => $request->input('ciudad'),
            'departamento' => $request->input('departamento'),
            'municipio' => $request->input('municipio'),
        ]);
        */

        if ($veterinaria->save()) {
            // mensaje de que todo salio bien
            return redirect()->route('veterinarias.index')->with('exito', 'La veterinaria se guardó exitosamente');
        } else {
            // mensaje de que no se logró guardar
            return redirect()->route('veterinarias.index')->with('fracaso', 'La veterinaria no se pudo guardar');
        }
    }
    // Método que muestra una veterinaria
    public function show(string $id)
    {
        $veterinaria = Veterinaria::findOrFail($id);
        return view('veterinarias.unaVeterinaria')->with('veterinaria', $veterinaria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $veterinaria = Veterinaria::findOrFail($id);
        return view('veterinarias.formulario')->with('veterinaria', $veterinaria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'nombre_veterinario' => 'required|string|max:255',
            'horario_apertura' => 'required',
            'horario_cierre' => 'required|after:horario_apertura',
            'direccion' => 'required|string|max:255',
            'departamento' => 'required',
            'ciudad' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'redes_sociales' => 'nullable|array',
            'redes_sociales.*.red' => 'required_with:redes_sociales.*.usuario|string|max:200',
            'redes_sociales.*.usuario' => 'required_with:redes_sociales.*.red|max:200',
            'telefono' => 'required|regex:/^[2389]\d{7}$/',
            'imagen.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'evaluacion' => 'nullable|numeric|min:0|max:5',
        ]);

        // Validación adicional para asegurarse de que las horas no sean iguales
        if ($request->input('horario_apertura') == $request->input('horario_cierre')) {
            return back()->withErrors(['horario_cierre' => 'La hora de apertura y la hora de cierre no pueden ser iguales.'])->withInput();
        }

        //manejo de imagenes  -> solo quedan la funcion faltaron pruebas
        $imagenes = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $imagen) {
                $path = $imagen->store('imagenes', 'public');
                $imagenes[] = $path;
            }
        }

        $redes_sociales = $request->input('redes_sociales', []);
        $veterinaria = Veterinaria::findOrFail($id);

         // Crear la veterinaria
        $veterinaria->update ([
            'nombre' => $request->input('nombre'),
            'nombre_veterinario' => $request->input('nombre_veterinario'),
            'horario_apertura' => $request->input('horario_apertura'),
            'horario_cierre' => $request->input('horario_cierre'),
            'departamento' => $request->input('departamento'),
            'municipio' => $request->input('municipio'),
            'ciudad' => $request->input('ciudad'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'imagen' => json_encode($imagenes),
            'redes_sociales' => json_encode($redes_sociales),
            'evaluacion' => $request->input('evaluacion', 0),
        ]);
        // Crear la ubicación
        /*
        $veterinaria->ubicacion()->update([
            'direccion' => $request->input('direccion'),
            'ciudad' => $request->input('ciudad'),
            'departamento' => $request->input('departamento'),
            'municipio' => $request->input('municipio'),
        ]);
        */

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
