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
        $request->validate([
            'calificacion' => 'required|integer|min:0|max:5',
            'opinion' => 'nullable|string|max:500',
        ]);

        $calificacion = Calificacion::create([
            'id_user' => Auth::check() ? Auth::id() : null, // Si hay usuario autenticado, lo asigna; si no, lo deja nulo
            'id_veterinaria' => $request->input('id_veterinaria'),
            'calificacion' => $request->input('calificacion'),
            'opinion' => $request->input('opinion'),
        ]);

        if ($calificacion->save()){
            return redirect()->route('veterinarias.show',['id'=>$id])->with('exito', 'Su Opinión ha sido enviada.');
        }else{
            return redirect()->route('veterinarias.show',['id'=>$id])->with('fracaso', 'Su Opinión no ha sido enviada.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $calificaciones = Calificacion::with('user')->where('id_veterinaria', $id)->get();
        return view('calificaciones.index')->with('calificaciones', $calificaciones);
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
        $calificacion->delete();
        return redirect()->back()->with('success', 'Calificación eliminada.');
    }
}
