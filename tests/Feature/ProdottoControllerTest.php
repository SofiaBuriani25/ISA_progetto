<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Prodotto;
use App\Models\Dipendente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProdottoControllerTest extends TestCase
{
    //use RefreshDatabase;

    public function testAggiungiProdotto()
    {
        // Crea un utente dipendente fittizio
        $user = Dipendente::factory()->create();
        $this->actingAs($user);
        
        // Autentica l'utente come dipendente
        Auth::guard('dipendenti')->login($user);

        // Dati del prodotto da aggiungere
        $prodottoData = [
            'name' => 'Prodotto Prova',
            'tipo' => 'test AggiungiProdotto',
            'scadenza' => '2023-12-31',
            'disponibilita' => 10,
            'prezzo' => 50.00,
            'descrizione' => 'Descrizione Prodotto',
        ];

        // Effettua una richiesta POST per aggiungere il prodotto
        $response = $this->post('/aggiungiProdotto', $prodottoData);

        // Verifica che il prodotto sia stato aggiunto correttamente nel database
        $this->assertDatabaseHas('prodotti', ['name' => 'Prodotto Prova']);

        // Verifica che il redirect sia avvenuto con successo
        $response->assertRedirect();

    }



    public function testOrdinaProdotto()
    {
        // Crea un utente dipendente fittizio
        $user = Dipendente::factory()->create();
        $this->actingAs($user);
        
        // Autentica l'utente come dipendente
        Auth::guard('dipendenti')->login($user);

        // Crea un prodotto con disponibilità uguale a 5
        $prodotto = Prodotto::factory()->create([
            'disponibilita' => 5,
            'scadenza' => '2023-12-31',
        ]);

        // Dati per la richiesta POST
        $data = [
            'prodotto_id' => $prodotto->id,
            'quantita' => 10, // Modifica la quantità a seconda del test
        ];

        // Effettua una richiesta POST per ordinare il prodotto
        $response = $this->post('/ordina_prodotto', $data);

        // Verifica che il redirect sia avvenuto con successo
        $response->assertRedirect();


        // Verifica che la quantità disponibile sia stata aumentata correttamente
        $this->assertDatabaseHas('prodotti', [
            'id' => $prodotto->id,
            'disponibilita' => 15, // Cambia il valore in base all'ordine effettuato
        ]);

        // Verifica che sia stata creata una riga nella tabella 'ordiniDipendenti' con la quantità di 10
        $this->assertDatabaseHas('ordiniDipendenti', [
            'dipendenti_id' => $user->id,
            'prodotto_id' => $prodotto->id,
            'quantita' => $data['quantita'],
            // Aggiungi altri campi se necessario
            ]);
            
       
    }



    public function testPrenotazioniProdottoClienti() // utente che prenota un prodotto
    {
         // Crea un utente fittizio
         $user = User::factory()->create();
         $this->actingAs($user);
         
         // Autentica l'utente come utente
         Auth::guard('web')->login($user);


        // Crea un prodotto di prova
          $prodotto = Prodotto::factory()->create();

        // Simula l'autenticazione dell'utente
        $this->actingAs($user);

        // Dati di prova per il form
        $data = [
            'prodotto_id' => $prodotto->id,
            'quantita' => 3, // Sostituisci con la quantità desiderata
        ];

        // Effettua una richiesta POST per aggiungere il prodotto al carrello
        $response = $this->post(route('aggiungi_al_carrello'), $data);

        // Verifica che il redirect sia avvenuto con successo
        $response->assertRedirect();


         // Verifica che sia stata creata una riga nella tabella 'prenotazioniClienti'
        $this->assertDatabaseHas('prenotazioniClienti', [
        'user_id' => $user->id,
        'prodotto_id' => $prodotto->id,
        'quantita' => $data['quantita'],
        // Aggiungi altri campi se necessario
        ]);


        // Verifica che la quantità disponibile sia stata ridotta correttamente nel database
        $prodottoAggiornato = Prodotto::find($prodotto->id);
        $this->assertEquals($prodotto->disponibilita - $data['quantita'], $prodottoAggiornato->disponibilita);
    }



}





