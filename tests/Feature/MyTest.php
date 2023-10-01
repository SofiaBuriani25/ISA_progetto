<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Prodotto;
use App\Models\Prenotazione;
use App\Models\User;
use Database\Factories\ProdottoFactory;
use Database\Factories\UserFactory;

class MyTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /*public function testExample()
{
    // Crea un record di esempio nel database utilizzando una factory
    $example = Prodotto::factory()->create([
        'name' => 'Test Record',
    ]);

    // Effettua una richiesta GET o POST o esegui qualsiasi altra azione che coinvolge il database

    // Esegui le asserzioni per verificare che il record sia stato scritto nel database
    $this->assertDatabaseHas('prodotti', ['name' => 'Test Record']);
}*/

    public function testAggiungiProdottoAlCarrello()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crea un prodotto di esempio
        $prodotto = Prodotto::factory()->create([
            'disponibilita' => 10, // Imposta una disponibilità iniziale
        ]);

        // Dati di prova per il test
        $quantitaDaAggiungere = 3;

        // Effettua una richiesta POST simulata per aggiungere il prodotto al carrello
        $response = $this->post(route('aggiungi_al_carrello'), [
            'prodotto_id' => $prodotto->id,
            'quantita' => $quantitaDaAggiungere,
        ]);

        // Verifica se la quantità disponibile nel database è stata aggiornata correttamente
        $prodottoAggiornato = Prodotto::find($prodotto->id);
       
        $quantitaDisponibileDopo = $prodottoAggiornato->disponibilita;
        
        // Verifica se è stata creata una prenotazione nel database
        $prenotazione = Prenotazione::where('prodotto_id', $prodotto->id)->first();
   
        // Assicurati che il prodotto abbia la quantità disponibile corretta dopo l'aggiunta al carrello
        $this->assertEquals($prodotto->disponibilita - $quantitaDaAggiungere, $quantitaDisponibileDopo);

        // Assicurati che sia stata creata una prenotazione per il prodotto
        $this->assertNotNull($prenotazione);

        // Verifica la risposta HTTP
        $response->assertRedirect(); // Assicurati che la risposta sia una reindirizzazione

        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Prodotto aggiunto al carrello con successo.', session('success'));
    }

}

