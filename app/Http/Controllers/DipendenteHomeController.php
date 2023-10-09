<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;



class DipendenteHomeController extends Controller
{
    public function index()
    {
        $user = Auth::guard('dipendenti')->user();
        return view('dipendente_home', ['user' => $user]); // Assicurati di avere una vista chiamata 'dipendente_home'
    }

     /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit_dip', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
       // Ottieni l'utente autenticato dal request
    $user = $request->user();

    // Estrai i dati validati dalla richiesta
    $validatedData = $request->validated();

    // Verifica se l'email è stata modificata
    if ($user->email !== $validatedData['email']) {
        // Se l'email è stata modificata, reimposta l'email verificata (se necessario)
        // e aggiorna l'email dell'utente
        // Non c'è bisogno di impostare 'email_verified_at' se non esiste nella tabella
        // Rimuovi questa linea: $user->email_verified_at = null;

        $user->email = $validatedData['email'];
    }

    // Aggiorna gli altri campi del profilo
    $user->fill($validatedData);

    // Salva l'utente
    $user->save();

    // Reindirizza alla pagina di modifica del profilo con un messaggio di conferma
    return redirect()->route('profile.edit_dip')->with('status', 'profile-updated');
      
    }
}


