<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;
use App\Models\Prenotazione;
use App\Models\Ordine;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PrenotazioneController extends Controller
{
    public function index()
    {
        // Recupera tutte le prenotazioni con le informazioni sull'utente associato
        $prenotazioni = Prenotazione::with('cliente')
        ->where('pagato', false)
        ->get();

        // Passa le prenotazioni alla vista
        return view('gestionePrenotazioni', ['prenotazioni' => $prenotazioni]);
    }

    public function confermaPagamento($id)
{
    $prenotazione = Prenotazione::find($id);
    
    if ($prenotazione) {
        $prenotazione->pagato = 1;
        $prenotazione->save();
    }

    return redirect()
    ->route('gestionePrenotazioni')
    ->with('success', 'Prodotto pagato!');
}

public function eliminaPrenotazione($id)
{
    $prenotazione = Prenotazione::find($id);
    
    if ($prenotazione) {
        $prodotto = Prodotto::find($prenotazione->prodotto_id);

        if ($prodotto) {
            // Aggiungi la quantità prenotata al magazzino
            $prodotto->disponibilita += $prenotazione->quantita;
            $prodotto->save();
        }

        // Elimina la prenotazione
        $prenotazione->delete();
    }

    return redirect()
    ->route('gestionePrenotazioni')
    ->with('error', 'Prodotto ritornato al magazzino.');;
}
}
