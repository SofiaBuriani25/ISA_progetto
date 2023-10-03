<?php

namespace Tests\Feature;

use App\Models\Dipendente; 
use App\Models\Prodotto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Factory;
use database\factories\ProdottoFactory;
use database\factories\DipendenteFactory;


class DipendentiHomeControllerTest extends TestCase
{
   // ...

    public function testAccessoAllaPaginaIndex()
    {
        // Simula l'accesso di un utente dipendente
        $user = Dipendente::factory()->create();
        $this->actingAs($user, 'dipendenti');

        // Creare un oggetto fittizio Prodotto per il test (se necessario)
        // $prodotto = Prodotto::factory()->make();
        
        // Crea un prodotto di esempio
        $prodotto = Prodotto::factory()->create([
            'disponibilita' => 10, // Imposta una disponibilità iniziale
        ]);

        // Effettua una richiesta GET alla pagina di index e passa $prodotto alla vista (se necessario)
        $response = $this->get('/dipendente_home', ['prodotto' => $prodotto]);

        // Verifica che la risposta abbia uno stato HTTP 200 (OK)
        $response->assertStatus(200);

        // Verifica che la vista 'dipendente_home' sia stata restituita
        $response->assertViewIs('dipendente_home');

        // Puoi anche verificare specificamente la presenza della variabile $prodotto nella vista (se necessario)
        if ($prodotto) {
            $response->assertViewHas('prodotto', $prodotto);
        }
    }

   // ...
}