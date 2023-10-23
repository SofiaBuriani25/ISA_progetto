<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Visita;
use App\Models\User;
use App\Models\Dipendente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VisitaTest extends TestCase
{
    //use RefreshDatabase;

   


    public function testAggiungiVisita() //dipendente che crea una visita
    {
      /*  // Crea un utente dipendente fittizio
        $user = Dipendente::factory()->create();
        $this->actingAs($user); */

        // Recupera l'utente dipendente dai dati esistenti nel database
        $user = Dipendente::first();
        
        // Autentica l'utente come dipendente
        Auth::guard('dipendenti')->login($user);

        // Dati del prodotto da aggiungere
      $visitaData = [
        'tipologia' => 'Visita Prova',
        'dataVisita' => '2023-10-21 15:30:00',
        'medico' => 'Dr. De Luca',
        'prezzo' => 120.00,
    ];

    // Esegui una richiesta POST per aggiungere la visita
    $response = $this->post('/gestione_visite', $visitaData);

        // Verifica che il redirect sia avvenuto con successo
        $response->assertRedirect();
   
        // Estrae l'ID dell'ultima visita aggiunta
        $ultimaVisitaId = Visita::latest()->first()->id;
        // Verifica che sia stata aggiunta una riga nella tabella 'visite' utilizzando l'ID
        $this->assertDatabaseHas('visite', ['id' => $ultimaVisitaId, 'tipologia' => 'Visita Prova']);

    }

    public function test_prenotazione_visita() //utente che prenota una visita
    {
        // Crea un utente per associarlo alla visita
        $user = User::factory()->create();

        /* QUI CREA UNA VISITA NUOVA
        // Crea una data futura utilizzando Carbon
        $dataVisitaFutura = Carbon::now()->addDays(7); // Aggiunge 7 giorni alla data corrente
        // Crea una nuova visita
        $visita = Visita::create([
            'tipologia' => 'Visita di controllo2',
            'dataVisita' => $dataVisitaFutura,
            'medico' => 'Dr. Smith',
            'prezzo' => 100.00,
            'user_id' => $user->id,
        ]);
         // Output di debug per visualizzare i dati della visita
        // dd($visita);
        */


        // QUI UTILIZZA UNA VISITA ESISTENTE CREATA PRIMA

            // Trova una visita esistente con tipologia 'Visita Prova' e 'user_id' a null
        $visita = Visita::where('tipologia', 'Visita Prova')
        ->whereNull('user_id')
        ->first();

        // Verifica che sia stata trovata una visita
        $this->assertNotNull($visita, "Nessuna visita con tipologia 'Visita Prova' e 'user_id' nullo trovata.");

        // Aggiorna il campo 'user_id' della visita trovata con l'ID dell'utente
        $visita->update(['user_id' => $user->id]);

        // Verifica che la visita sia stata creata correttamente
        $this->assertDatabaseHas('visite', [
            'id' => $visita->id,
            'user_id' => $user->id,
        ]);
    }

}

