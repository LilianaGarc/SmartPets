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

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $reacciones = Reaccion::with('user')
            ->whereHas('user', function ($query) use ($nombre) {
                $query->where('name', 'LIKE', "%$nombre%");
            })
            ->where('id_publicacion', 'LIKE', "%$nombre%")
            ->orWhere('tipo', 'LIKE', "%$nombre%")->get();
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
        if (!auth()->check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        $request->validate([
            'tipo' => 'required|string',
            'publicacion_id' => 'required|exists:publicaciones,id',
        ]);

        $reaccion = Reaccion::updateOrCreate(
            [
                'id_user' => auth()->id(),
                'publicacion_id' => $request->publicacion_id
            ],
            ['tipo' => $request->tipo]
        );

        return response()->json(['status' => 'success', 'reaccion' => $reaccion]);
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
    public function destroy(string $publicacion_id)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        $reaccion = Reaccion::where('publicacion_id', $publicacion_id)
            ->where('id_user', auth()->id())
            ->first();

        if ($reaccion) {
            $reaccion->delete();
            return response()->json(['status' => 'deleted']);
        }

        return response()->json(['status' => 'not_found'], 404);
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
