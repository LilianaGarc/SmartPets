<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Veterinaria;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class VeterinariaController extends Controller
{
    // ----------- PANEL ADMINISTRATIVO -----------

    public function panel()
    {
        $veterinarias = Veterinaria::all();
        return view('panelAdministrativo.veterinariasIndex')->with('veterinarias', $veterinarias);
    }

    public function panelcreate()
    {
        $usuarios = User::all();
        return view('panelAdministrativo.veterinariasForm')->with('usuarios', $usuarios);
    }

    public function search(Request $request)
    {
        $nombre = $request->get('nombre');

        $veterinarias = Veterinaria::where(function($q) use ($nombre) {
            $q->where('nombre', 'like', "%{$nombre}%")
                ->orWhere('nombre_veterinario', 'like', "%{$nombre}%")
                ->orWhere('telefono', 'like', "%{$nombre}%");
        })->get();

        return view('panelAdministrativo.veterinariasIndex', compact('veterinarias'));
    }


    public function panelstore(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
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
            'imagenes.*' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:5120',
            'redes.*.tipo_red_social' => 'nullable|string|max:255',
            'redes.*.nombre_usuario' => 'nullable|string|max:255',
        ]);

        $opinion = $request->input('opinion');
        if (empty($opinion)) {
            $opinion = '';  // Asignar un valor vacío si la opinión está vacía
        }


        $ubicacion = Ubicacion::create([
            'departamento' => $request->departamento,
            'municipio' => $request->municipio,
            'ciudad' => $request->ciudad,
            'direccion' => $request->direccion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);

        $veterinaria = Veterinaria::create([
            'id_user' => $request->id_user,
            'nombre' => $request->nombre,
            'nombre_veterinario' => $request->nombre_veterinario,
            'horario_apertura' => $request->horario_apertura,
            'horario_cierre' => $request->horario_cierre,
            'telefono' => $request->telefono,
            'whatsapp' => $request->whatsapp,
            'evaluacion' => $request->input('evaluacion', 0),
            'id_ubicacion' => $ubicacion->id,
        ]);

        // Imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('veterinarias', 'public');
                $veterinaria->imagenes()->create(['path' => $path]);
            }
        }

        // Redes sociales
        if ($request->has('redes')) {
            foreach ($request->input('redes') as $red) {
                $veterinaria->redes()->create([
                    'tipo_red_social' => $red['tipo_red_social'] ?? null,
                    'nombre_usuario' => $red['nombre_usuario'] ?? null,
                ]);
            }
        }

        return redirect()->route('veterinarias.panel')->with('exito', 'Veterinaria registrada exitosamente');
    }

    public function paneledit(string $id)
    {
        $veterinaria = Veterinaria::with('ubicacion', 'imagenes', 'redes')->findOrFail($id);
        $usuarios = User::all();
        return view('panelAdministrativo.veterinariasForm')->with('veterinaria', $veterinaria)->with('usuarios', $usuarios);
    }

    public function panelupdate(Request $request, string $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
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
            'imagenes.*' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:5120',
            'redes.*.tipo_red_social' => 'nullable|string|max:255',
            'redes.*.nombre_usuario' => 'nullable|string|max:255',
        ]);

        $veterinaria = Veterinaria::with('imagenes', 'redes')->findOrFail($id);
        $ubicacion = Ubicacion::findOrFail($veterinaria->id_ubicacion);

        // Asignar la opinión vacía si está vacía
        $opinion = $request->input('opinion');
        if (empty($opinion)) {
            $opinion = '';  // Asignar un valor vacío si la opinión está vacía
        }

        // Actualizar ubicación
        $ubicacion->update([
            'departamento' => $request->departamento,
            'ciudad' => $request->ciudad,
            'municipio' => $request->municipio,
            'direccion' => $request->direccion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);

        // Actualizar veterinaria
        $veterinaria->update([
            'id_user' => $request->id_user,
            'nombre' => $request->nombre,
            'nombre_veterinario' => $request->nombre_veterinario,
            'horario_apertura' => $request->horario_apertura,
            'horario_cierre' => $request->horario_cierre,
            'telefono' => $request->telefono,
            'whatsapp' => $request->whatsapp,
        ]);

        // Eliminar imágenes seleccionadas
        if ($request->has('deleted_images')) {
            $deletedImageIds = explode(',', $request->deleted_images);
            foreach ($deletedImageIds as $imageId) {
                $imagen = $veterinaria->imagenes()->find($imageId);
                if ($imagen) {
                    if (\Storage::disk('public')->exists($imagen->path)) {
                        \Storage::disk('public')->delete($imagen->path);
                    }
                    $imagen->delete();
                }
            }
        }

        // Agregar nuevas imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('veterinarias', 'public');
                $veterinaria->imagenes()->create(['path' => $path]);
            }
        }

        // Actualizar redes sociales
        $veterinaria->redes()->delete();
        if ($request->has('redes')) {
            foreach ($request->input('redes') as $red) {
                $veterinaria->redes()->create([
                    'tipo_red_social' => $red['tipo_red_social'] ?? null,
                    'nombre_usuario' => $red['nombre_usuario'] ?? null,
                ]);
            }
        }

        return redirect()->route('veterinarias.panel')->with('exito', 'Veterinaria actualizada exitosamente');
    }

    public function panelshow(string $id)
    {
        $veterinaria = Veterinaria::with('ubicacion', 'imagenes', 'redes')->findOrFail($id);
        return view('panelAdministrativo.veterinariasDetalles', compact('veterinaria'));
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

    // ----------- USUARIO NORMAL -----------

    public function index()
    {
        $veterinarias = Veterinaria::paginate(9);
        return view('veterinarias.index')->with('veterinarias', $veterinarias);
    }

    public function create()
    {
        return view('veterinarias.formulario');
    }

    public function store(Request $request)
    {
        $idUsuario = auth()->id();
        $departamentos = [
                    'Atlántida', 'Choluteca', 'Colón', 'Comayagua', 'Copán', 'Cortés',
                    'El Paraíso', 'Francisco Morazán', 'Gracias a Dios', 'Intibucá',
                    'Islas de la Bahía', 'La Paz', 'Lempira', 'Ocotepeque', 'Olancho',
                    'Santa Bárbara', 'Valle', 'Yoro'
                    ];

        $request->validate([
            'nombre' => 'required|string|max:150',
            'nombre_veterinario' => 'required|string|max:150',
            'horario_apertura' => 'required',
            'horario_cierre' => 'required|after:horario_apertura',
            'departamento' => 'required|in:'.implode(',', $departamentos),
            'ciudad' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
            'latitud' => 'nullable|numeric|regex:/^-?\d{1,10}(\.\d+)?$/',
            'longitud' => 'nullable|numeric|regex:/^-?\d{1,10}(\.\d+)?$/',
            'telefono' => 'required|regex:/^[2389]\d{7}$/',
            'whatsapp' => 'nullable|regex:/^[389]\d{7}$/',
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'redes.*.tipo_red_social' => 'nullable|string|max:100|in:Facebook,Instagram',
            'redes.*.nombre_usuario' => 'nullable|string|max:100',
        ]);

        $ubicacion = Ubicacion::create([
            'departamento' => $request->departamento,
            'municipio' => $request->municipio,
            'ciudad' => $request->ciudad,
            'direccion' => $request->direccion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);

        $veterinaria = Veterinaria::create([
            'id_user' => $idUsuario,
            'nombre' => $request->nombre,
            'nombre_veterinario' => $request->nombre_veterinario,
            'horario_apertura' => $request->horario_apertura,
            'horario_cierre' => $request->horario_cierre,
            'telefono' => $request->telefono,
            'whatsapp' => $request->whatsapp,
            'evaluacion' => $request->input('evaluacion', 0),
            'id_ubicacion' => $ubicacion->id,
        ]);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('veterinarias', 'public');
                $veterinaria->imagenes()->create(['path' => $path]);
            }
        }

        if ($request->has('redes')) {
            foreach ($request->input('redes') as $red) {
                $veterinaria->redes()->create([
                    'tipo_red_social' => $red['tipo_red_social'] ?? null,
                    'nombre_usuario' => $red['nombre_usuario'] ?? null,
                ]);
            }
        }

        return redirect()->route('veterinarias.index')->with('exito', 'Veterinaria registrada exitosamente');
    }

    public function show(string $id)
    {
        $veterinaria = Veterinaria::with(['ubicacion', 'calificaciones.user'])->findOrFail($id);
        return view('veterinarias.unaVeterinaria', compact('veterinaria'));
    }

    public function edit(string $id)
    {
        $veterinaria = Veterinaria::with('ubicacion', 'imagenes', 'redes')->findOrFail($id);
        return view('veterinarias.formulario', compact('veterinaria'));
    }

    public function update(Request $request, string $id)
    {
        $idUsuario = auth()->id();
        $departamentos = [
                    'Atlántida', 'Choluteca', 'Colón', 'Comayagua', 'Copán', 'Cortés',
                    'El Paraíso', 'Francisco Morazán', 'Gracias a Dios', 'Intibucá',
                    'Islas de la Bahía', 'La Paz', 'Lempira', 'Ocotepeque', 'Olancho',
                    'Santa Bárbara', 'Valle', 'Yoro'
                    ];

        $request->validate([
            'nombre' => 'required|string|max:150',
            'nombre_veterinario' => 'required|string|max:150',
            'horario_apertura' => 'required',
            'horario_cierre' => 'required|after:horario_apertura',
            'departamento' => 'required|in:'.implode(',', $departamentos),
            'municipio' => 'required|string|max:100',
            'ciudad' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
            'latitud' => 'nullable|numeric|regex:/^-?\d{1,10}(\.\d+)?$/',
            'longitud' => 'nullable|numeric|regex:/^-?\d{1,10}(\.\d+)?$/',
            'telefono' => 'required|regex:/^[2389]\d{7}$/',
            'whatsapp' => 'nullable|regex:/^[389]\d{7}$/',
            'imagenes.*' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:5120',
            'redes.*.tipo_red_social' => 'nullable|string|max:100|in:Facebook,Instagram',
            'redes.*.nombre_usuario' => 'nullable|string|max:100',
        ]);

        $veterinaria = Veterinaria::with('imagenes', 'redes')->findOrFail($id);
        $ubicacion = Ubicacion::findOrFail($veterinaria->id_ubicacion);

        $ubicacion->update([
            'departamento' => $request->departamento,
            'ciudad' => $request->ciudad,
            'municipio' => $request->municipio,
            'direccion' => $request->direccion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);

        $veterinaria->update([
            'id_user' => $idUsuario,
            'nombre' => $request->nombre,
            'nombre_veterinario' => $request->nombre_veterinario,
            'horario_apertura' => $request->horario_apertura,
            'horario_cierre' => $request->horario_cierre,
            'telefono' => $request->telefono,
            'whatsapp' => $request->whatsapp,
        ]);

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
    public function destroy(string $id)
    {
        $veterinaria = Veterinaria::findOrFail($id);
        $ubicacion = Ubicacion::findOrFail($veterinaria->id_ubicacion);

        // Eliminar imágenes
        foreach ($veterinaria->imagenes as $imagen) {
            if (\Storage::disk('public')->exists($imagen->path)) {
                \Storage::disk('public')->delete($imagen->path);
            }
            $imagen->delete();
        }

        // Eliminar redes sociales
        $veterinaria->redes()->delete();

        // Eliminar ubicación
        $ubicacion->delete();

        // Eliminar veterinaria
        $veterinaria->delete();

        return redirect()->route('veterinarias.index')->with('exito', 'Veterinaria eliminada exitosamente');
    }
}
