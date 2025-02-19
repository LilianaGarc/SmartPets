<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
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
