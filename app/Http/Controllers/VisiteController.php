<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;

class VisiteController extends Controller
{
    public function index()
    {
        $visite = Visita::all(); 

        return view('visite', ['visite' => $visite]);
    }

    public function aggiungiPrenotazione(Request $request)
{

    $user_id = $request->input('user_id');
    $visita_id = $request->input('visita_id');

    dd($user_id);

    // Debug dei valori delle variabili
    //dd($_POST);
    

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

}
