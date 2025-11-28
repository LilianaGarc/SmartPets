<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $attempts = session('login_attempts', 0);
        $data = [];

        if ($attempts >= 3) {
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            session(['captcha_answer' => $num1 + $num2]);
            $data['captcha_question'] = "$num1 + $num2 = ?";
        }

        return view('auth.login', $data);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $attempts = session('login_attempts', 0);

        if ($attempts >= 3) {
            if ($request->input('captcha') != session('captcha_answer')) {
                throw ValidationException::withMessages([
                    'captcha' => 'La respuesta del CAPTCHA es incorrecta. Inténtelo nuevamente.',
                ]);
            }
        }

        try {
            $request->authenticate();
        } catch (ValidationException $e) {
            $new_attempts = $attempts + 1;
            session(['login_attempts' => $new_attempts]);
            throw $e;
        }

        session()->forget(['login_attempts', 'captcha_answer']);

        $request->session()->regenerate();

        $request->user()->update(['last_login_at' => now()]);

        if ($request->user()->usertype === 'admin') {
            return redirect('/panel/dashboard');
        } else {
            return redirect('/index');
        }

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
