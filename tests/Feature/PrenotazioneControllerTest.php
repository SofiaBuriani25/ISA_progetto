<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Prenotazione;
use App\Models\User;
use App\Models\Prodotto;
use Illuminate\Foundation\Testing\WithFaker;

class PrenotazioneControllerTest extends TestCase
{
    use WithFaker;


    public function testConfermaPagamento()
    {
        // Crea una prenotazione di esempio
        $prenotazione = Prenotazione::factory()->create(['pagato' => false]);
    
        // Simula l'azione di conferma pagamento
        $response = $this->post(route('conferma_pagamento', ['id' => $prenotazione->id]));
    
        // Verifica se la risposta ha lo stato 302 (redirect)
        $response->assertStatus(302);
    
        // Verifica se viene reindirizzato alla pagina 'gestionePrenotazioni'
        $response->assertRedirect(route('gestionePrenotazioni'));
    
        // Verifica se nella sessione c'è il messaggio di successo
        $response->assertSessionHas('success', 'Prodotto pagato!');
    
        // Verifica se la prenotazione è stata effettivamente pagata (il campo 'pagato' è impostato su true)
        $this->assertTrue(Prenotazione::find($prenotazione->id)->pagato);
    }
    

    public function testEliminaPrenotazione()
{
    // Crea un utente
    $user = User::factory()->create();
    $this->actingAs($user);

    // Crea un prodotto con disponibilità iniziale
    $prodotto = Prodotto::factory()->create([
        'disponibilita' => 10,
    ]);

    // Crea una prenotazione per il prodotto
    $prenotazione = Prenotazione::factory()->create([
        'user_id' => $user->id,
        'prodotto_id' => $prodotto->id,
        'quantita' => 5,
    ]);

    // Esegui una richiesta POST per eliminare la prenotazione
    $response = $this->post(route('elimina_prenotazione', ['id' => $prenotazione->id]));

    // Verifica se la risposta ha uno stato di reindirizzamento
    $response->assertStatus(302);

    // Verifica il reindirizzamento alla pagina 'gestionePrenotazioni'
    $response->assertRedirect(route('gestionePrenotazioni'));

    // Verifica se c'è un messaggio di errore nella sessione
    $response->assertSessionHas('error', 'Prodotto ritornato al magazzino');

    // Verifica se il prodotto è stato restituito al magazzino
    $this->assertEquals(15, Prodotto::find($prodotto->id)->disponibilita);

    // Verifica se la prenotazione è stata eliminata
    $this->assertDatabaseMissing('prenotazioniClienti', ['id' => $prenotazione->id]);
}

}
