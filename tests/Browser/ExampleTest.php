<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testDashboardCliente(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') // Inserisci un'email valida
                    ->type('password', 'qwerty123') // Inserisci una password valida
                    ->click('button', ['text' => 'Log in'])  // Fai clic sul pulsante "Login"
                    ->assertPathIs('/dashboard') // Verifica che l'utente sia reindirizzato alla pagina di dashboard
                    ->assertSee('Elenco dei prodotti disponibili'); // Verifica che la dashboard contenga un messaggio di benvenuto

        });
        
    }


    public function testSearchParacetamolo(): void
    {
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
            ->clickLink('Dashboard')
            ->type('#search', 'paracetamolo') 
            ->pause(1000);
           
        $browser->within('table.min-w-full tbody tr:not([style*="display: none"]', function ($browser) {
            $browser->assertSee('Paracetamolo');
        });

    });

    }

    public function testAggiungiParacetamolo2unita(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Dashboard')
                ->type('#search', 'paracetamolo') 
                ->pause(1000);
                //->screenshot('debug1');

            $browser->within('table.min-w-full tbody tr:not([style*="display: none"])', function ($browser) {
                $browser->select('quantita', 2)
                        ->click('button', ['text' => 'Prenota']);  // Fai clic sul pulsante "Prenota"
            });
    
            $browser->assertSee('Prodotto aggiunto al carrello con successo.'); 

            //$browser->screenshot('debug2');
            //$browser->dump();

    });

    }

    public function testAggiuntoParacetamoloInStorico(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Dashboard')
                ->clickLink('Storico ordini') 
                ->pause(1000)
                ->screenshot('debug1');

                $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
                    $browser->assertSee('Paracetamolo')
                            ->assertSee('Analgesico')
                            ->assertSee('2');
                
                $browser->screenshot('debug2');
                //$browser->dump();
            });
        
        });


}
}
