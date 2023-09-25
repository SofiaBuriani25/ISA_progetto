<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'cognome' => $request->cognome, // Aggiungi il campo cognome.
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dataNascita' => $request->dataNascita, // Aggiungi il campo dataNascita.
            'sesso' => $request->sesso, // Aggiungi il campo sesso.
            'citta' => $request->citta, // Aggiungi il campo citta.
            'indirizzo' => $request->indirizzo, // Aggiungi il campo indirizzo.
            'cap' => $request->cap, // Aggiungi il campo cap.
            'telefono' => $request->telefono, // Aggiungi il campo telefono.
            'codicefiscale' => $request->codicefiscale, // Aggiungi il campo codicefiscale.
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
