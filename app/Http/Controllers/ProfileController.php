<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Validación extra para la foto
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email,' . $user->id],
            'telefono' => ['nullable', 'string', 'max:12'],
            'direccion' => ['nullable', 'string', 'max:100'],
            'descripción' => ['nullable', 'string', 'max:250'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'], // 2MB máx
            'current_password' => ['nullable', 'string', 'min:8'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // === SUBIR FOTO DE PERFIL ===
        if ($request->hasFile('profile_photo')) {
            // Borrar la anterior si existe
            if ($user->fotoperfil) {
                Storage::disk('public')->delete($user->fotoperfil);
            }

            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->fotoperfil = $path;
        }

        // Rellenar datos
        $user->fill($request->only(['name', 'email', 'telefono', 'direccion', 'descripción']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Cambio de contraseña
        if ($request->filled('current_password') && $request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
            }
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('exito', 'Perfil actualizado correctamente.');
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
