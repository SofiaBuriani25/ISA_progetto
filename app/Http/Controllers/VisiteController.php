<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class VisiteController extends Controller
{
    public function index()
    {
         // Recupera l'utente attualmente autenticato
    $user = Auth::user();

    // Recupera le visite prenotate dal cliente corrente
    $prenotazioni = Visita::where('user_id', $user->id)->get();
    
    // Rimuovi visite scadute
    $now = Carbon::now(); // Ottieni la data e l'ora correnti
    foreach ($prenotazioni as $prenotazione) {
        if ($prenotazione->dataVisita < $now) {
            $prenotazione->delete(); // Rimuovi la visita scaduta
        }
    }

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

    // Verifica se la visita esiste
    $visita = Visita::find($visita_id);
    if (!$visita) {
        // Gestisci il caso in cui la visita non esiste 
        return redirect()->back()->with('error', 'Errore nella selezione ');
    }


    // Aggiorna  nel database
    $visita->update([
        'user_id' => $user_id,
    ]);
   
    // Successo, reindirizza con un messaggio di successo
    return redirect()->back()->with('success', 'Visita prenotata!');
}



    public function cancellaPrenotazione($id)
{
    // Trova la visita da cancellare
    $visita = Visita::findOrFail($id);

    // Verifica se l'utente autenticato è il proprietario della prenotazione
    Auth::user()->id == $visita->user_id;
        // Rimuovi l'associazione dell'utente dalla visita (imposta user_id a NULL)
    $visita->update(['user_id' => null]);

    return redirect()->back()->with('error', 'Visita eliminata con successo!');
    
}


public function visualizzaVisite()
{
  // Recupera tutte le visite, indipendentemente dal fatto che siano prenotate o meno
  $visite = Visita::all();

  return view('gestione_visite', [
      'visite' => $visite,
  ]);
    
}

public function aggiungi_visita(Request $request) //Il dipendente che può aggiungere una nuova visita
{

    $visita = new Visita();
    //$prodotto_id = $request->input('prodotto_id');
    $visita->tipologia = $request->input('tipologia');
    $visita->dataVisita = $request->input('dataVisita');
    $visita->medico = $request->input('medico');
    $visita->prezzo = $request->input('prezzo');
   
    $visita->save();

    // Successo, reindirizza con un messaggio di successo
    return redirect()->back()->with('success', 'Visita aggiunta alla lista con successo.');
}



}
