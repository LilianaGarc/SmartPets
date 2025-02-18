<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicaciones = Publicacion::all();
        return view('panelAdministrativo.publicacionesIndex')->with('publicaciones', $publicaciones);
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
        $eliminados = Publicacion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('publicaciones.index')->with('fracaso', 'La publicacion no se pudo borrar.');
        }else {
            return redirect()->route('publicaciones.index')->with('exito', 'La publicacion se elimino correctamente.');
        }
    }
}
