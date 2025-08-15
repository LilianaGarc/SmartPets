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
        // Validación de datos
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email,' . $request->user()->id],
            'telefono' => ['nullable', 'string', 'max:12'],
            'direccion' => ['nullable', 'string', 'max:100'],
            'descripción' => ['nullable', 'string', 'max:250'],
            
            'current_password' => ['nullable', 'string', 'min:8'], 
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->fill($request->validated());

        // Actualiza los campos opcionales
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->descripción = $request->descripción;

        
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        
        if ($request->filled('current_password') && $request->filled('password')) {
            // Verificar que la contraseña actual sea la del usuario
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.'])->withInput();
            }

            // Actualizar contraseña
            $user->password = bcrypt($request->password);
        }

        // Guardar cambios
        $user->save();

        return Redirect::route('profile.edit')->with('exito', 'Perfil actualizado con éxito.');
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
}