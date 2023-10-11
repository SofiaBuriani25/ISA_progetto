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

    public function test_creazione_visita()
    {
        // Crea un utente per associarlo alla visita
        $user = User::factory()->create();

        // Crea una data futura utilizzando Carbon
        $dataVisitaFutura = Carbon::now()->addDays(7); // Aggiunge 7 giorni alla data corrente


        // Crea una nuova visita
        $visita = Visita::create([
            'tipologia' => 'Visita di controllo',
            'dataVisita' => $dataVisitaFutura,
            'medico' => 'Dr. Smith',
            'prezzo' => 100.00,
            'user_id' => $user->id,
        ]);

         // Output di debug per visualizzare i dati della visita
        // dd($visita);

        // Verifica che la visita sia stata creata correttamente
        $this->assertDatabaseHas('visite', [
            'id' => $visita->id,
            'tipologia' => 'Visita di controllo',
        ]);
    }


    public function testAggiungiVisita()
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
   

    }



}

