<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class ClientiTest extends DuskTestCase
{

    // Test Login
    public function testLog(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty1234') 
                    ->click('button', ['text' => 'Log in'])  
                    ->assertPathIs('/dashboard') // Verifico che l'utente sia reindirizzato alla pagina di dashboard
                    ->assertSee('Elenco dei prodotti disponibili')
                    ->click('.user-name')
                    ->pause(500)
                    ->clickLink('Log Out'); 

        });
    }

    // Test Login Errato
    public function testLogFail(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty22222') 
                    ->click('button', ['text' => 'Log in'])
                    ->assertSee('Le credenziali non sono corrette.'); 

        });
    }

    // Test per modificare alcuni dati del profilo cliente
    public function testModificaProfilo(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty1234') 
                    ->click('button', ['text' => 'Log in']);  

            $browser->visit('/dashboard')
                    ->click('.user-name')
                    ->pause(500)
                    ->clickLink('Profilo');
            
            $browser->type('#name', 'Phil')  //cambio Nome
                    ->type('#telefono', '345656463')
                    ->press('#bottone')
                    ->pause(1000)
                    ->assertSee('Salvato.')
                    ->click('.user-name')
                    ->pause(1000)
                    ->clickLink('Log Out');
                    
    });
    }

    // Test che modifica la password del cliente
    public function testModificaPassword(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty1234') 
                    ->click('button', ['text' => 'Log in']);  

            $browser->visit('/dashboard')
                    ->click('.user-name')
                    ->pause(1000)
                    ->clickLink('Profilo');
            
            $browser->type('#current_password', 'qwerty1234')  //cambio Nome
                    ->type('#password', 'qwerty1234')
                    ->type('#password_confirmation', 'qwerty1234')
                    ->press('#bottone2')
                    ->pause(1000)
                    ->assertSee('Password Salvata.')
                    ->click('.user-name')
                    ->pause(1000)
                    ->clickLink('Log Out');

    });
    }


    // Test per cercare paracetamolo nella barra di ricerca all'interno 
    // della pagina principale dle cliente
    public function testSearchParacetamolo(): void
    {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty1234') 
                    ->click('button', ['text' => 'Log in']);  

        $browser->visit('/dashboard')
            ->type('#search', 'paracetamolo') 
            ->pause(1000);
           
        $browser->within('table.min-w-full tbody tr:not([style*="display: none"]', function ($browser) {
            $browser->assertSee('Paracetamolo');
                    
        });

        $browser->click('.user-name')
                ->pause(1000)
                ->clickLink('Log Out');
        

    });

    }


    // Test per aggiungere 2 unità di paracetamolo dopo la ricerca
    public function testAggiungiParacetamolo1unita(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty1234') 
                    ->click('button', ['text' => 'Log in']);  

            $browser->visit('/dashboard')
                ->type('#search', 'paracetamolo') 
                ->pause(1000);

            $browser->within('table.min-w-full tbody tr:not([style*="display: none"])', function ($browser) {
                $browser->select('quantita', 1)
                        ->click('button', ['text' => 'Prenota'])  // Fai clic sul pulsante "Prenota"
                        ->pause(1000);
            });
    
            $browser->assertSee('Prodotto aggiunto al carrello con successo.')
                    ->click('.user-name')
                    ->pause(1000)
                    ->clickLink('Log Out');; 

            //$browser->screenshot('debug2');
            //$browser->dump();

    });

    }

    // Test per vedere se il numero precedentemente prenotato compare nella pagina
    // "Storico ordini"
    public function testAggiuntoParacetamoloInStorico(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty1234') 
                    ->click('button', ['text' => 'Log in']);  

            $browser->visit('/dashboard')
                ->clickLink('Storico ordini') 
                ->pause(1000);
               

                $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
                    $browser->assertSee('Paracetamolo')
                            ->assertSee('Analgesico')
                            ->assertSee('1');
                
            });

            $browser->click('.user-name')
                ->pause(1000)
                ->clickLink('Log Out');
        
        
        });

    }


    // Test per prenotare una visita nel caso sia possibile, altrimenti
    // viene annullata una visista precedentemente prenotata
    public function testAggiungiEliminaVisita(): void
        {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty1234') 
                    ->click('button', ['text' => 'Log in']);  

            $browser->visit('/dashboard')
                ->clickLink('Prenota visita') 
                ->pause(1000);
            
            $numeroVisiteDisponibili = intval($browser->text('#numero-visite-disponibili'));
            
            if ($numeroVisiteDisponibili === 0) {
                $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
                    $browser->click('button', ['text' => 'X'])
                            ->pause(1000);

            });
            $browser->assertSee('Visita eliminata con successo!'); 
            }else {
                $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
                    $browser->click('button', ['text' => 'Prenota'])
                            ->pause(1000);
                             
            });
            $browser->assertSee('Visita prenotata!');; 
            }

            $browser->click('.user-name')
                    ->pause(1000)
                    ->clickLink('Log Out');

        });

        }

    // Test Logout
    public function testLogout(): void
    {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty1234') 
                    ->click('button', ['text' => 'Log in']);  

        $browser->visit('/dipendente_home')
                ->click('.user-name')
                ->pause(1000)
                ->clickLink('Log Out')
                ->assertPathIs('/')
                ->assertSee('Login');
    });
    }

    // Test registrazione del cliente con alcuni campi casuali
    public function testRegistrazione(): void
    {
        $this->browse(function (Browser $browser) {
            $name = Str::random(5);
            $cognome = Str::random(10);
            $email = Str::random(8) . '@example.com'; // Genera un indirizzo email casuale

            $browser->visit('/')
                    ->clickLink('Registrazione')
                    ->pause(500)
                    ->type('#name', $name)
                    ->type('#cognome', $cognome)
                    ->type('#sesso', 'F')
                    ->type('#dataNascita', '15/05/1985')
                    ->type('#citta', 'New York')
                    ->type('#indirizzo', '123 Main Street')
                    ->type('#cap', '10001')
                    ->type('#telefono', '3436428354')
                    ->type('#codicefiscale', 'DOEJHN85D15A123B')
                    ->type('#email', $email)
                    ->type('#password', 'Password123')
                    ->type('#password_confirmation', 'Password123')
                    ->press('#bottone')
                    ->assertPathIs('/dashboard')
                    ->assertSee('Max 5 quantità prenotabile')
                    ->click('.user-name')
                    ->pause(1000)
                    ->clickLink('Log Out');
        
                    
        });
    }


    // Test registrazione del cliente con alcuni campi casuali
    public function testRegistrazioneFail(): void
    {
        $this->browse(function (Browser $browser) {
            $name = Str::random(5);
            $cognome = Str::random(10);


            $browser->visit('/')
                    ->clickLink('Registrazione')
                    ->pause(500)
                    ->type('#name', $name)
                    ->type('#cognome', $cognome)
                    ->type('#sesso', 'F')
                    ->type('#dataNascita', '15/05/1985')
                    ->type('#citta', 'New York')
                    ->type('#indirizzo', '123 Main Street')
                    ->type('#cap', '10001')
                    ->type('#telefono', '3436428354')
                    ->type('#codicefiscale', 'DOEJHN85D15A123B')
                    ->type('#email', 'filippo@gmail.com')
                    ->type('#password', 'Password123')
                    ->type('#password_confirmation', 'Password123')
                    ->press('#bottone')
                    ->assertSee('The email has already been taken.')
                    ->screenshot('100');
                    
        });
    }



        
}
