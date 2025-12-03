<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostrar formulario de edición de perfil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualizar información del perfil.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email,' . $request->user()->id],
            'telefono' => ['nullable', 'string', 'max:12'],
            'direccion' => ['nullable', 'string', 'max:100'],
            'descripción' => ['nullable', 'string', 'max:250'],
            
            'current_password' => ['nullable', 'string', 'min:8'], 
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // DATOS NORMALES
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->descripción = $request->descripción;

        // ===============================
        // ⭐ PROCESAR Y GUARDAR LA FOTO
        // ===============================
        if ($request->hasFile('profile_photo')) {

            /* 💬 Solución: borrar la anterior solo si existe */
            if ($user->fotoperfil && Storage::disk('public')->exists($user->fotoperfil)) {
                Storage::disk('public')->delete($user->fotoperfil);
            }

            /* 💬 Solución: guardar en storage/app/public/perfiles */
            $path = $request->file('profile_photo')->store('perfiles', 'public');

            /* 💬 Solución: guardar ruta en la BD */
            $user->fotoperfil = $path;
        }

        $user->save();

        return back()->with('exito', 'Perfil actualizado correctamente');
    }


    /**
     * Eliminar cuenta de usuario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Eliminar foto de perfil
     */
    public function deleteProfilePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->fotoperfil) {
            // Elimina del disco
            Storage::disk('public')->delete($user->fotoperfil);
            $user->fotoperfil = null;
            $user->save();
        }

        return back()->with('exito', 'Foto de perfil eliminada correctamente.');
    }
}
