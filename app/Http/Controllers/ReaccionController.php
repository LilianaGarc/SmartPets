<?php

namespace App\Http\Controllers;

use App\Models\Reaccion;
use Illuminate\Http\Request;

class ReaccionController
{
    public function panel()
    {
        $reacciones = Reaccion::with('user')->get();
        return view('panelAdministrativo.reaccionesIndex')->with('reacciones', $reacciones);
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
        $eliminados = Reaccion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('reacciones.panel')->with('fracaso', 'La reaccion no se pudo borrar.');
        }else {
            return redirect()->route('reacciones.panel')->with('exito', 'La reaccion se elimino correctamente.');
        }
    }


}
