<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User; // Importar el modelo User

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Preparar los datos antes de la validación
     * Aquí recortamos y normalizamos el email
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'email' => trim(strtolower($this->input('email'))),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required', 'string'],
            'captcha' => ['sometimes', 'required', 'numeric'],
        ];
    }

    /**
     * Mensajes personalizados de validación
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email'     => 'Ingresa un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'captcha.required' => 'Debes responder el CAPTCHA.',
            'captcha.numeric'  => 'La respuesta del CAPTCHA debe ser un número.',
        ];
    }

    /**
     * Validación personalizada después de las reglas
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $email = trim(strtolower($this->input('email')));

            // Verificar si el correo existe en la base de datos
            if ($email && !User::where('email', $email)->exists()) {
                $validator->errors()->add('email', 'El correo electrónico no está registrado en nuestro sistema.');
            }
        });
    }

    /**
     * Attempt to authenticate the request's credentials.
     */
    public function authenticate(): void
    {
        \Illuminate\Support\Facades\App::setLocale('es');

        $this->ensureIsNotRateLimited();

        $credentials = $this->only('email', 'password');

        // Asegurarnos de que el email esté en minúsculas
        $credentials['email'] = trim(strtolower($credentials['email']));

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Correo o contraseña incorrectos. Por favor verifica tus datos.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
