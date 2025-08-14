<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Publicacion;
use App\Models\Solicitud;
use App\Models\Veterinaria;
use App\Models\Evento;
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
        $adopciones = \App\Models\Adopcion::where('id_usuario', operator: $user->id)->get();
        $veterinarias = \App\Models\Veterinaria::where('id_user', operator: $user->id)->get();
        $veterinarias = Veterinaria::where('id_user', $user->id)->get();
        $eventos = Evento::where('id_user', $user->id)->where('estado', 'aceptado')->get();
        $productosUsuario = $user->productos()->with('categoria')->get();

        $publicaciones = Publicacion::where('id_user', $user->id)
            ->with('publicacionOriginal.user')
            ->withCount('likes')
            ->with(['likes' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        $publicaciones->each(function ($publicacion) use ($user) {
            $publicacion->user_has_liked = $publicacion->likes->isNotEmpty();
            unset($publicacion->likes);
        });

        $solicitudes = \App\Models\Solicitud::where('id_usuario', $user->id)->with('adopcion')->get();
        $adopcionesSolicitadas = $solicitudes->map(function ($solicitud) {
            return [
                'adopcion' => $solicitud->adopcion,
                'solicitud' => $solicitud,
            ];
        })->filter(function ($item) {
            return $item['adopcion'] !== null;
        });

        return view('perfil.index', compact('user', 'adopciones', 'adopcionesSolicitadas', 'productosUsuario', 'publicaciones', 'eventos', 'veterinarias'));
    }

    public function showPerfil($id)
    {
        $user = User::findOrFail($id);
        $adopciones = Adopcion::where('id_usuario', $user->id)->get();
        $eventos = Evento::where('id_user', $user->id)->where('estado', 'aceptado')->get();
        $productosUsuario = $user->productos()->with('categoria')->get();
        $veterinarias = Veterinaria::where('id_user', $user->id)->get();

        $publicaciones = Publicacion::where('id_user', $user->id)
            ->with('publicacionOriginal.user')
            ->withCount('likes')
            ->with(['likes' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        $publicaciones->each(function ($publicacion) use ($user) {
            $publicacion->user_has_liked = $publicacion->likes->isNotEmpty();
            unset($publicacion->likes);
        });

        $solicitudes = Solicitud::where('id_usuario', $user->id)->with('adopcion')->get();

        $adopcionesSolicitadas = $solicitudes->map(function ($solicitud) {
            return [
                'adopcion' => $solicitud->adopcion,
                'solicitud' => $solicitud,
            ];
        })->filter(function ($item) {
            return $item['adopcion'] !== null;
        });

        return view('perfil.unPerfil', compact('user', 'adopciones', 'adopcionesSolicitadas', 'productosUsuario', 'publicaciones', 'eventos', 'veterinarias'));
    }


    public function actualizarFoto(Request $request)
    {
        $request->validate([
            'fotoperfil' => 'required|image|mimes:jpeg,png,jpg,gif,webp,bmp,tiff|max:5120',
        ], [
            'fotoperfil.required' => 'Por favor selecciona una imagen.',
            'fotoperfil.image' => 'El archivo debe ser una imagen válida.',
            'fotoperfil.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, webp, bmp o tiff.',
            'fotoperfil.max' => 'La imagen no debe pesar más de 5MB.',
        ]);


        $user = Auth::user();

        if ($user->fotoperfil && Storage::exists('public/' . $user->fotoperfil)) {
            Storage::delete('public/' . $user->fotoperfil);
        }

        $path = $request->file('fotoperfil')->store('fotoperfiles', 'public');

        $user->fotoperfil = $path;
        $user->save();
        $user->refresh();


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
    public function seleccionarMascota(Request $request)
    {
        $user = auth()->user();

        if (!$user->fotoperfil) {
            return redirect()->back()->with('error', 'Debes actualizar tu foto de perfil para desbloquear la mascota virtual.');
        }

        $request->validate([
            'mascota_virtual' => 'required|in:mascota1.png,mascota2.png,mascota3.png,mascota4.png,mascota5.png',
        ]);

        $user->mascota_virtual = $request->mascota_virtual;
        $user->save();

        return redirect()->back()->with('success', '¡Mascota virtual actualizada con éxito!');
    }
    public function actualizarMascotaVirtual(Request $request)
    {
        $request->validate([
            'nombre_mascota_virtual' => 'nullable|string|max:30',
        ]);

        $user = auth()->user();
        $user->nombre_mascota_virtual = $request->nombre_mascota_virtual;
        $user->save();

        return back()->with('success', 'Nombre de tu mascota actualizado');
    }
    public function actualizarEstadisticas(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'hambre' => 'required|integer|min:0|max:100',
            'felicidad' => 'required|integer|min:0|max:100',
        ]);


        $user->hambre_mascota_virtual = $request->hambre;
        $user->felicidad_mascota_virtual = $request->felicidad;
        $user->save();

        return response()->json(['success' => true]);
    }
}
