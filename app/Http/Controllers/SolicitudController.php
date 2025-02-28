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
            'comprobante' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'id_adopcion' => 'required|integer',
        ]);

        $solicitud = new Solicitud();
        $solicitud->contenido = $validated['contenido'];
        $solicitud->id_usuario = 0;
        $solicitud->id_adopcion = $validated['id_adopcion'];

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



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
