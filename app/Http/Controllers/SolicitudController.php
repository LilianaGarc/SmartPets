<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use Illuminate\Http\Request;
use App\Models\Solicitud;

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
        $solicitudes = Solicitud::with('adopcion')->get();
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
            'comprobante' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'id_adopcion' => 'required|integer',
            'experiencia' => 'nullable|in:Sí,No',
            'vivienda' => 'nullable|in:Casa,Departamento',
            'espacio' => 'nullable|in:Sí,No',
            'otros_animales' => 'nullable|in:Sí,No',
            'gastos_veterinarios' => 'nullable|in:Sí,No',
        ]);

        $solicitud = new Solicitud();
        $solicitud->contenido = $validated['contenido'];
        $solicitud->id_usuario = 0;
        $solicitud->id_adopcion = $validated['id_adopcion'];
        $solicitud->experiencia = $validated['experiencia'] ?? null;
        $solicitud->vivienda = $validated['vivienda'] ?? null;
        $solicitud->espacio = $validated['espacio'] ?? null;
        $solicitud->otros_animales = $validated['otros_animales'] ?? null;
        $solicitud->gastos_veterinarios = $validated['gastos_veterinarios'] ?? null;

        if ($request->hasFile('comprobante')) {
            $comprobante = $request->file('comprobante')->store('comprobantes');
            $solicitud->comprobante = $comprobante;
        }

        $solicitud->save();

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

        $solicitudes = $adopcion->solicitudes;

        return view('solicitudes.indexSolicitudes', compact('solicitudes', 'adopcion'));
    }

    public function showDetails($id_adopcion, $id)
    {
        $adopcion = Adopcion::find($id_adopcion);
        $solicitud = Solicitud::find($id);

        if (!$adopcion || !$solicitud) {
            return redirect()->route('adopciones.index')->with('error', 'Adopción o solicitud no encontrada.');
        }

        return view('solicitudes.showDetails', compact('solicitud', 'adopcion'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    // SolicitudController.php

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

        return view('solicitudes.edit', compact('solicitud', 'adopcion'));
    }


    public function update(Request $request, $id_adopcion, $id)
    {
        $validated = $request->validate([
            'contenido' => 'required|string',
            'comprobante' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'experiencia' => 'nullable|in:Sí,No',
            'vivienda' => 'nullable|in:Casa,Departamento',
            'espacio' => 'nullable|in:Sí,No',
            'otros_animales' => 'nullable|in:Sí,No',
            'gastos_veterinarios' => 'nullable|in:Sí,No',
        ]);

        $solicitud = Solicitud::find($id);

        if (!$solicitud) {
            return redirect()->route('solicitudes.show', $id_adopcion)->with('error', 'Solicitud no encontrada.');
        }

        $solicitud->contenido = $validated['contenido'];
        $solicitud->experiencia = $validated['experiencia'] ?? $solicitud->experiencia;
        $solicitud->vivienda = $validated['vivienda'] ?? $solicitud->vivienda;
        $solicitud->espacio = $validated['espacio'] ?? $solicitud->espacio;
        $solicitud->otros_animales = $validated['otros_animales'] ?? $solicitud->otros_animales;
        $solicitud->gastos_veterinarios = $validated['gastos_veterinarios'] ?? $solicitud->gastos_veterinarios;

        if ($request->hasFile('comprobante')) {
            if ($solicitud->comprobante) {
                unlink(storage_path('app/public/' . $solicitud->comprobante));
            }
            $comprobante = $request->file('comprobante')->store('comprobantes');
            $solicitud->comprobante = $comprobante;
        }

        $solicitud->save();

        return redirect()->route('solicitudes.show', $id_adopcion)->with('success', 'Solicitud actualizada con éxito.');
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
}
