<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Prenotazione;
use App\Models\User;
use App\Models\Prodotto;
use App\Models\Dipendente;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;

class PrenotazioneControllerTest extends TestCase
{
    use WithFaker;


    public function testConfermaPagamento()
    {

        //Autentica un dipendente
        $user = Dipendente::where('id', 3)
        ->first();
        // Assicurati che l'utente sia stato trovato
        $this->assertNotNull($user, 'dipendenti');
        // Autentica l'utente
        Auth::guard('dipendenti')->login($user);

        // Crea una prenotazione di esempio
        $prenotazione = Prenotazione::factory()->create(['pagato' => 0]);
    
        // Simula l'azione di conferma pagamento
        $response = $this->post(route('conferma_pagamento', ['id' => $prenotazione->id]));
    
    
        // Verifica se viene reindirizzato alla pagina 'gestionePrenotazioni'
        $response->assertRedirect(route('gestionePrenotazioni'));
    
        // Verifica se la prenotazione è stata effettivamente pagata (il campo 'pagato' è impostato su true)
        $this->assertEquals(1, Prenotazione::find($prenotazione->id)->pagato);
    }
    

    public function testEliminaPrenotazione()
{
    // Crea un utente
    $user = User::factory()->create(); ///////////////// QUI LA PRIMA VOLTA CHE SI FA CI VA ['id' => 3]
    $this->actingAs($user);

    // Crea un prodotto con disponibilità iniziale
    $prodotto = Prodotto::factory()->create([
        'disponibilita' => 100,
    ]);


    // Crea 2 prenotazioni di quqantità 5 relative allo stesso prodotto, una rimane e l'altra viene annullata
    // Quindi la disponibilità invece che 100 sarèà 105, in quanto la prenotazione annullata fa aumentare la merce disponibile
    $prenotazione = Prenotazione::factory(2)->create(['pagato' => 0, 'quantita' => 5, 'prodotto_id' => $prodotto->id]);
    //prende la prima prenotazione che trova con campo 'pagato' a 0 e quantità 5
    $prenotazione = Prenotazione::where('pagato', 0)
    ->where('prodotto_id', $prodotto->id)
    ->where('quantita', 5)
    ->first();


    //Autentica un dipendente
    $user = Dipendente::where('id', 3)
    ->first();
    // Assicurati che l'utente sia stato trovato
    $this->assertNotNull($user, 'dipendenti');
    // Autentica l'utente
    Auth::guard('dipendenti')->login($user);


    // Esegui una richiesta POST per eliminare la prenotazione
    $response = $this->post(route('elimina_prenotazione', ['id' => $prenotazione->id]));

    // Verifica il reindirizzamento alla pagina 'gestionePrenotazioni'
    $response->assertRedirect(route('gestionePrenotazioni'));


    // Verifica se il prodotto è stato restituito al magazzino
    $this->assertEquals(105, Prodotto::find($prodotto->id)->disponibilita);

    // Verifica se la prenotazione è stata eliminata
    $this->assertDatabaseMissing('prenotazioniClienti', ['id' => $prenotazione->id]);
}



}
