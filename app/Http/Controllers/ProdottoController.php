<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;
use App\Models\Prenotazione;
use App\Models\Ordine;
use Illuminate\Support\Carbon;


class ProdottoController extends Controller
{
    public function index()
    {
        $prodotti = Prodotto::all(); // Recupera tutti i prodotti dal database

        $prenotazioniNonPagate = Prenotazione::where('user_id', auth()->user()->id)
        ->where('pagato', false)
        ->sum('quantita');

        $limite = 5;
        $numeroRimenenti = $limite - $prenotazioniNonPagate;

        return view('dashboard', ['prodotti' => $prodotti, 'numeroRimenenti'=> $numeroRimenenti]);
    }



    
    public function aggiungiAlCarrello(Request $request)
    {

    $prodotto_id = $request->input('prodotto_id');
    $quantita = $request->input('quantita');
    $scadenza = $request->input('scadenza');

    
    // Verifica se il prodotto esiste e se la quantità è valida
    $prodotto = Prodotto::find($prodotto_id);
    if (!$prodotto || $quantita < 0) {
        // Gestisci il caso in cui il prodotto non esiste o la quantità non è valida
        return redirect()->back()->with('error', 'Errore nella selezione del prodotto o della quantità.');
    }

    if (auth()->user()) {

     // Verifica se l'utente ha raggiunto il limite di 5 prenotazioni non pagate
    $limitePrenotazioni = 5;
    $prenotazioniNonPagate = Prenotazione::where('user_id', auth()->user()->id)
        ->where('pagato', false)
        ->count();

    $numeroRimenenti = $limitePrenotazioni - $prenotazioniNonPagate;

    if ($numeroRimenenti < 0) {
        return redirect()->back()
        ->with('error', 'Hai raggiunto il limite massimo di prenotazioni non pagate.')
        ->with('numeroRimenenti', $numeroRimenenti);
        }

    
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
    return redirect()->back()
    ->with('success', 'Prodotto aggiunto al carrello con successo.');

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
    $prenotazioni = Prenotazione::where('user_id', auth()->user()->id)
    ->orderBy('created_at', 'desc') // Ordine decrescente per vedere prima le ultime prenotazioni
    ->get();
    return view('mostra-prenotazioni', ['prenotazioni' => $prenotazioni]);
}




    public function aggiungiProdotto(Request $request) //Il dipendente che può aggiungere un nuovo prodotto
{

    $name = $request->input('name');

    // Verifica se il prodotto esiste 
    $prodottoEsistente = Prodotto::where('name', $name)->first();
    if ($prodottoEsistente ) {
        // Gestisci il caso in cui il prodotto non esiste
        return redirect()->back()->with('error', 'Il Prodotto esiste già.');
    }
    $prodotto = new Prodotto();
    //$prodotto_id = $request->input('prodotto_id');
    $prodotto->name = $request->input('name');
    $prodotto->tipo = $request->input('tipo');
    $prodotto->scadenza = $request->input('scadenza');
    $prodotto->disponibilita = $request->input('disponibilita');
    $prodotto->prezzo = $request->input('prezzo');
    $prodotto->descrizione = $request->input('descrizione');
   
    $prodotto->save();

    // Successo, reindirizza con un messaggio di successo
    return redirect()->back()->with('success', 'Prodotto aggiunto alla lista con successo.');
}







public function ordinaProdotto(Request $request) //DIPENDENTE
    {

    $prodotto_id = $request->input('prodotto_id');
    $quantita = $request->input('quantita');
   

    
    // Verifica se il prodotto esiste e se la quantità è valida
    $prodotto = Prodotto::find($prodotto_id);
    if (!$prodotto) {
        // Gestisci il caso in cui il prodotto non esiste o la quantità non è valida
        return redirect()->back()->with('error', 'Errore nella selezione del prodotto.');
    }


    // Utente cliente
    $ordine = new Ordine();
    $ordine->dipendenti_id = auth()->user()->id;
    $ordine->prodotto_id = $prodotto_id;
    $ordine->quantita = $quantita;
    $ordine->save();



    $disponibilitaAttuale = $prodotto->disponibilita;


    // Calcola la nuova quantità disponibile dopo l'aggiunta al carrello
    $nuova_quantita_disponibile = $disponibilitaAttuale + $quantita;

    // Aggiorna la quantità disponibile nel database
    $prodotto->update([
        'disponibilita' => $nuova_quantita_disponibile,
    ]);
    // Qui puoi implementare la logica per aggiungere il prodotto al carrello
    // Ad esempio, puoi salvare l'ID del prodotto e la quantità in una sessione o in un database dedicato al carrello

    // Successo, reindirizza con un messaggio di successo
    return redirect()->back()
    ->with('success', 'Prodotto aggiunto con successo.');
   // ->with('prenotazioniNonPagate', $prenotazioniNonPagate);
}






}


