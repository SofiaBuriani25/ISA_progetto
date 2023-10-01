<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;
use Illuminate\Support\Facades\Auth;

class VisiteController extends Controller
{
    public function index()
    {
         // Recupera l'utente attualmente autenticato
    $user = Auth::user();

    // Recupera le visite prenotate dal cliente corrente
    $prenotazioni = Visita::where('user_id', $user->id)->get();

    // Conta il numero di visite prenotate dal cliente
    $numeroPrenotazioni = $prenotazioni->count();

    // Verifica se il cliente può prenotare ulteriori visite (massimo 2)
    $limitePrenotazioni = 2;
    $puoPrenotare = $numeroPrenotazioni < $limitePrenotazioni;

    // Recupera le visite disponibili per prenotazione (senza utente)
    $visite = Visita::whereNull('user_id')->get();

    return view('visite', [
        'puoPrenotare' => $puoPrenotare,
        'visite' => $visite,
        'prenotazioni' => $prenotazioni,
        'numeroPrenotazioni' => $numeroPrenotazioni,
        'limitePrenotazioni' => $limitePrenotazioni,
    ]);

        
    }

    public function aggiungiPrenotazione(Request $request)
{

    
    $user = Auth::user();
    $user_id = $user->id;   
    $visita_id = $request->input('visita_id');



    // Verifica se il prodotto esiste e se la quantità è valida
    $visita = Visita::find($visita_id);
    if (!$visita) {
        // Gestisci il caso in cui il prodotto non esiste o la quantità non è valida
        return redirect()->back()->with('error', 'Errore nella selezione del prodotto o della quantità.');
    }


    // Aggiorna la quantità disponibile nel database
    $visita->update([
        'user_id' => $user_id,
    ]);
    // Qui puoi implementare la logica per aggiungere il prodotto al carrello
    // Ad esempio, puoi salvare l'ID del prodotto e la quantità in una sessione o in un database dedicato al carrello

    // Successo, reindirizza con un messaggio di successo
    return redirect()->back()->with('success', 'Prodotto aggiunto al carrello con successo.');
}



public function cancellaPrenotazione($id)
{
    // Trova la visita da cancellare
    $visita = Visita::findOrFail($id);

    // Verifica se l'utente autenticato è il proprietario della prenotazione
    Auth::user()->id == $visita->user_id;
        // Rimuovi l'associazione dell'utente dalla visita (imposta user_id a NULL)
    $visita->update(['user_id' => null]);

    return redirect()->route('visite');
    
}


}
