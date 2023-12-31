<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\Dipendente;
use App\Models\Prodotto;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Database\Factories\DipendenteFactory;
use Database\Factories\ProdottoFactory;

class DipendenteHomeControllerTest extends TestCase
{
    
    use InteractsWithViews; // Per interagire con le viste nei test
    use WithFaker;
    /**
     * Test per l'accesso alla pagina index del controller DipendenteHomeController.
     */

    public function testAccessoAllaPaginaIndex()
    {
        // Crea un utente dipendente fittizio
        
        $user = Dipendente::factory()->create(); ///////////// QUI LA PRIMA VOLTA CHE SI FA CI VA ['id' => 3]
        $this->actingAs($user);

        // Crea un prodotto di esempio
        $prodotto = Prodotto::factory()->create([
        'disponibilita' => 10, // Imposta una disponibilità iniziale
    ]);


        // Autentica l'utente come dipendente
        Auth::guard('dipendenti')->login($user);

        // Effettua una richiesta GET alla pagina di index
        $response = $this->get('/dipendente_home');
        // Verifica che la risposta abbia uno stato HTTP 200 (OK)
        $response->assertStatus(200);
        // Verifica che la vista 'dipendente_home' sia stata restituita
        $response->assertViewIs('dipendente_home');

       
    }


    public function testUpdate(): void
    {
        $user = Dipendente::where('id', 3)
        ->first();

        // Assicura che l'utente sia stato trovato
        $this->assertNotNull($user, 'dipendenti');
        // Autentica l'utente
        $this->actingAs($user, 'dipendenti');


        $newData = [
            'name' => $this->faker->name,
            'cognome' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            
        ];

         // Effettua una richiesta POST per l'aggiornamento del profilo
         $response = $this->patch(route('profile.update_dip'), $newData);
         // Verifica che la risposta sia una redirect alla pagina di modifica del profilo
         $response->assertRedirect(route('profile.edit_dip'));
         // Verifica che il messaggio di session 'status' sia impostato su 'profile-updated'
         $this->assertEquals('profile-updated_dip', session('status'));
 
         // Verifica che i dati dell'utente siano stati aggiornati correttamente
         $user->refresh();
         $this->assertEquals($newData['name'], $user->name);
         $this->assertEquals($newData['cognome'], $user->cognome);
         $this->assertEquals($newData['email'], $user->email);
         

     }


}
