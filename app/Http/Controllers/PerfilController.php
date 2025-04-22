<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return view('perfil.index', compact('user'));
    }

    public function showPerfil($id)
    {
        $user = User::findOrFail($id);
        $adopciones = Adopcion::where('id_usuario', $user->id)->get();

        $solicitudes = Solicitud::where('id_usuario', $user->id)->with('adopcion')->get();

        $adopcionesSolicitadas = $solicitudes->map(function ($solicitud) {
            return [
                'adopcion' => $solicitud->adopcion,
                'solicitud' => $solicitud,
            ];
        })->filter(function ($item) {
            return $item['adopcion'] !== null;
        });

        return view('perfil.index', compact('user', 'adopciones', 'adopcionesSolicitadas'));
    }


    public function actualizarFoto(Request $request)
    {
        $request->validate([
            'fotoperfil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->fotoperfil && Storage::exists('public/' . $user->fotoperfil)) {
            Storage::delete('public/' . $user->fotoperfil);
        }

        $path = $request->file('fotoperfil')->store('fotoperfiles', 'public');

        $user->fotoperfil = $path;
        $user->save();

        return redirect()->back()->with('success', 'Foto de perfil actualizada correctamente.');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
