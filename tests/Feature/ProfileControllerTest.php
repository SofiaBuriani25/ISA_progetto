<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Dipendente;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Database\Factories\UserFactory;
use Database\Factories\DipendenteFactory;

class ProfileControllerTest extends TestCase
{
   use WithFaker;

    public function testUpdate(): void // UTENTE
    {
        $user = User::where('id', 3)
        ->first();

        // Assicura che l'utente sia stato trovato
        $this->assertNotNull($user);
        // Autentica l'utente
        $this->actingAs($user);


        $newData = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            
        ];

         // Effettua una richiesta POST per l'aggiornamento del profilo
         $response = $this->patch(route('profile.update'), $newData);
         // Verifica che la risposta sia una redirect alla pagina di modifica del profilo
         $response->assertRedirect(route('profile.edit'));
         // Verifica che il messaggio di session 'status' sia impostato su 'profile-updated'
         $this->assertEquals('profile-updated', session('status'));
 
         // Verifica che i dati dell'utente siano stati aggiornati correttamente
         $user->refresh();
         $this->assertEquals($newData['name'], $user->name);
         $this->assertEquals($newData['email'], $user->email);
         
         // Verifica che 'email_verified_at' sia null se l'email è stata modificata
         if ($user->isDirty('email')) {
             $this->assertNull($user->email_verified_at);
         }
     }
    

     public function testUpdateDip(): void // DIPENDENTE
     {
         $user = Dipendente::where('id', 3)
         ->first();
 
         // Assicura che l'utente sia stato trovato
         $this->assertNotNull($user);
          // Autentica l'utente come dipendente
          Auth::guard('dipendenti')->login($user);
 
 
         $newData2 = [
             'name' => $this->faker->name,
             'cognome' => $this->faker->lastName,
             'email' => $this->faker->safeEmail,
             
         ];
 
          // Effettua una richiesta POST per l'aggiornamento del profilo
          $response = $this->patch(route('profile.update_dip'), $newData2);
          // Verifica che la risposta sia una redirect alla pagina di modifica del profilo
          $response->assertRedirect(route('profile.edit_dip'));
          // Verifica che il messaggio di session 'status' sia impostato su 'profile-updated'
          $this->assertEquals('profile-updated_dip', session('status'));
  
          // Verifica che i dati dell'utente siano stati aggiornati correttamente
          $user->refresh();
          $this->assertEquals($newData2['name'], $user->name);
          $this->assertEquals($newData2['cognome'], $user->cognome);
          $this->assertEquals($newData2['email'], $user->email);
          
        
      }


}
