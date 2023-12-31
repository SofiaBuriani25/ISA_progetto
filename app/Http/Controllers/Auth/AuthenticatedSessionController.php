<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        // Esegui il logout del tipo di utente corrente (se presente)
    if (auth()->guard('dipendenti')->check()) {
        auth()->guard('dipendenti')->logout();
    } else {
        auth()->logout();
    }

 
        if (Auth::guard('dipendenti')->attempt($request->only('email', 'password'))) {
        // Se l'utente è un dipendente, reindirizza a una home page specifica per i dipendenti
            return redirect()->route('dipendente_home');
        }

        $request->authenticate();

        $request->session()->regenerate();
        

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (auth()->guard('dipendenti')->check()) {
            auth()->guard('dipendenti')->logout();
        } else {
            auth()->guard('web')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
