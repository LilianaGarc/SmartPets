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
        $id_user = Auth::id(); // Usa el ID autenticado
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'opinion' => 'nullable|string|max:200',
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
        $veterinaria = Veterinaria::with(['ubicacion', 'calificaciones' => function($query) {$query->latest->take(5);}, 'calificacion.user'])->findOrFail($id);
        return view('veterinarias.unaVeterinaria')->with('veterinaria', $veterinaria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $calificacion = Calificacion::findOrFail($id);
        return view('veterinarias.unaVeterinaria')->with('calificacion', $calificacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'opinion' => 'nullable|string|max:200',
        ]);
    
        $calificacion = Calificacion::findOrFail($id);

        $calificacion->update([
            'calificacion' => $request->input('calificacion'),
            'opinion' => $request->input('opinion'),
        ]);
        $calificacion->save();
    
        return redirect()->back()->with('exito', 'Su Opinión ha sido actualizada.');

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
