<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;
use App\Models\Prenotazione;
use Illuminate\Support\Carbon;


class ProdottoController extends Controller
{
    public function index()
    {
        $prodotti = Prodotto::all(); // Recupera tutti i prodotti dal database

        return view('dashboard', ['prodotti' => $prodotti]);
    }

    public function aggiungiAlCarrello(Request $request)
{

    $prodotto_id = $request->input('prodotto_id');
    $quantita = $request->input('quantita');
    $scadenza = $request->input('scadenza');


    // Debug dei valori delle variabili
    //dd($_POST);
    

    // Verifica se il prodotto esiste e se la quantità è valida
    $prodotto = Prodotto::find($prodotto_id);
    if (!$prodotto || $quantita < 0) {
        // Gestisci il caso in cui il prodotto non esiste o la quantità non è valida
        return redirect()->back()->with('error', 'Errore nella selezione del prodotto o della quantità.');
    }

    // Verifica se l'utente è autenticato come cliente o dipendente
    if (auth()->user()) {
    // Utente cliente
    $prenotazione = new Prenotazione();
    $prenotazione->user_id = auth()->user()->id;
    $prenotazione->prodotto_id = $prodotto_id;
    $prenotazione->quantita = $quantita;
    $prenotazione->save();
}
    $disponibilitaAttuale = $prodotto->disponibilita;

    
    // Calcola la nuova quantità disponibile dopo l'aggiunta al carrello
    $nuova_quantita_disponibile = $disponibilitaAttuale - $quantita;

    // Aggiorna la quantità disponibile nel database
    $prodotto->update([
        'disponibilita' => $nuova_quantita_disponibile,
    ]);
    // Qui puoi implementare la logica per aggiungere il prodotto al carrello
    // Ad esempio, puoi salvare l'ID del prodotto e la quantità in una sessione o in un database dedicato al carrello

    // Successo, reindirizza con un messaggio di successo
    return redirect()->back()->with('success', 'Prodotto aggiunto al carrello con successo.');
}

public function mostraDaOrdinare()
{

    $prodotti = Prodotto::where('scadenza', '<', Carbon::today())
    ->orWhere('disponibilita', '<=', 5)
    ->get();
    return view('daOrdinare', ['prodotti' => $prodotti]);
}

public function listaProdotti()
    {
        $prodotti = Prodotto::all(); // Recupera tutti i prodotti dal database

        return view('dipendente_home', ['prodotti' => $prodotti]);
    }



public function mostraPrenotazioni()
{
    $prenotazioni = Prenotazione::where('user_id', auth()->user()->id)->get();
    return view('mostra-prenotazioni', ['prenotazioni' => $prenotazioni]);
}




    public function aggiungiProdotto(Request $request)
{

    $prodotto_id = $request->input('prodotto_id');
    $quantita = $request->input('quantita');
    $scadenza = $request->input('scadenza');


    // Debug dei valori delle variabili
    //dd($_POST);
    

    // Verifica se il prodotto esiste e se la quantità è valida
    $prodotto = Prodotto::find($prodotto_id);
    if (!$prodotto || $quantita < 0) {
        // Gestisci il caso in cui il prodotto non esiste o la quantità non è valida
        return redirect()->back()->with('error', 'Errore nella selezione del prodotto o della quantità.');
    }

    $disponibilitaAttuale = $prodotto->disponibilita;

    
    // Calcola la nuova quantità disponibile dopo l'aggiunta al carrello
    $nuova_quantita_disponibile = $disponibilitaAttuale - $quantita;

    // Aggiorna la quantità disponibile nel database
    $prodotto->update([
        'disponibilita' => $nuova_quantita_disponibile,
    ]);
    // Qui puoi implementare la logica per aggiungere il prodotto al carrello
    // Ad esempio, puoi salvare l'ID del prodotto e la quantità in una sessione o in un database dedicato al carrello

    // Successo, reindirizza con un messaggio di successo
    return redirect()->back()->with('success', 'Prodotto aggiunto al carrello con successo.');
}
}


