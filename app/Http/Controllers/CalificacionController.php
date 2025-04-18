<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Calificacion;
use App\Models\Veterinaria;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
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
        $id_user = Auth::id() ?? 1; // Usa el ID autenticado o 1 como valor por defecto
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'opinion' => 'nullable|string|max:500',
        ]);

        $calificacion = Calificacion::create([
            'id_user' => $id_user,
            'id_veterinaria' => $request->input('id_veterinaria'),
            'calificacion' => $request->input('calificacion'),
            'opinion' => $request->input('opinion') ?? 'Sin opinión',
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        if ($calificacion->save()){
            return redirect()->route('veterinarias.show', ['id' => $request->input('id_veterinaria')])->with('exito', 'Su Opinión ha sido realizada.');
        } else {
            return redirect()->route('veterinarias.show', ['id' => $request->input('id_veterinaria')])->with('fracaso', 'Su Opinión no ha sido enviada.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $veterinaria = Veterinaria::with(['ubicacion', 'calificacion.user'])->findOrFail($id);
        return view('veterinarias.unaVeterinaria')->with('veterinaria', $veterinaria);
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
        $request->validate([
            'calificaion' => 'required|integer|min:1|max:5',
            'opinion' => 'nullable|string|max:500',
        ]);
    
        $calificacion = Calificacion::findOrFail($id);

        $calificacion->update([
            'calificacion' => $request->rating,
            'opinion' => $request->opinion,
        ]);
    
        return redirect()->back()->with('success', 'Calificación actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $calificacion = Calificacion::findOrFail($id);
        $calificacion->delete();
        return redirect()->back()->with('success', 'Calificación eliminada.');
    }
}
