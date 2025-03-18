<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class UbicacionController
{
    public function panel()
    {
        $ubicaciones = Ubicacion::all();
        return view('panelAdministrativo.ubicacionesIndex')->with('ubicaciones', $ubicaciones);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $ubicaciones = Ubicacion::orderby('created_at', 'desc')
            ->where('direccion', 'LIKE', "%$nombre%")
            ->orWhere('ciudad', 'LIKE', "%$nombre%")
            ->orWhere('municipio', 'LIKE', "%$nombre%")
            ->orWhere('departamento', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.ubicacionesIndex')->with('ubicaciones', $ubicaciones);
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
        $eliminados = Ubicacion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('ubicaciones.panel')->with('fracaso', 'La ubicacion no se pudo borrar.');
        }else {
            return redirect()->route('ubicaciones.panel')->with('exito', 'La ubicacion se elimino correctamente.');
        }
    }
}
