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

        // Assicurati che l'utente sia stato trovato
        $this->assertNotNull($user);

        // Autentica l'utente
        $this->actingAs($user);


        $newData = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            // Aggiungere altri campi del profilo se necessario
        ];

         // Effettuare una richiesta POST per l'aggiornamento del profilo
         $response = $this->patch(route('profile.update'), $newData);

         // Verificare che la risposta sia una redirect alla pagina di modifica del profilo
         $response->assertRedirect(route('profile.edit'));
 
         // Verificare che il messaggio di session 'status' sia impostato su 'profile-updated'
         $this->assertEquals('profile-updated', session('status'));
 
         // Verificare che i dati dell'utente siano stati aggiornati correttamente
         $user->refresh();
         $this->assertEquals($newData['name'], $user->name);
         $this->assertEquals($newData['email'], $user->email);
         
         // Verificare che 'email_verified_at' sia null se l'email è stata modificata
         if ($user->isDirty('email')) {
             $this->assertNull($user->email_verified_at);
         }
     }
    

     public function testUpdateDip(): void // DIPENDENTE
     {
         $user = Dipendente::where('id', 3)
         ->first();
 
         // Assicurati che l'utente sia stato trovato
         $this->assertNotNull($user);
 
         // Autentica l'utente
         $this->actingAs($user);
 
 
         $newData = [
             'name' => $this->faker->name,
             'cognome' => $this->faker->lastName,
             'email' => $this->faker->safeEmail,
             // Aggiungere altri campi del profilo se necessario
         ];
 
          // Effettuare una richiesta POST per l'aggiornamento del profilo
          $response = $this->patch(route('profile.update_dip'), $newData);
 
          // Verificare che la risposta sia una redirect alla pagina di modifica del profilo
          $response->assertRedirect(route('profile.edit_dip'));
  
          // Verificare che il messaggio di session 'status' sia impostato su 'profile-updated'
          $this->assertEquals('profile-updated', session('status'));
  
          // Verificare che i dati dell'utente siano stati aggiornati correttamente
          $user->refresh();
          $this->assertEquals($newData['name'], $user->name);
          $this->assertEquals($newData['cognome'], $user->lastName);
          $this->assertEquals($newData['email'], $user->email);
          
          /*
          // Verificare che 'email_verified_at' sia null se l'email è stata modificata
          if ($user->isDirty('email')) {
              $this->assertNull($user->email_verified_at);
          }
          */
      }


}
