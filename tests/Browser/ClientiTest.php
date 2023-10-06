<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ClientiTest extends DuskTestCase
{

    //Test per vedere se il cliente riesce ad accedere alla sua Dashboard
    public function testDashboardCliente(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'filippo@gmail.com') 
                    ->type('password', 'qwerty123') 
                    ->click('button', ['text' => 'Log in'])  
                    ->assertPathIs('/dashboard') // Verifico che l'utente sia reindirizzato alla pagina di dashboard
                    ->assertSee('Elenco dei prodotti disponibili'); 

        });
        
    }

    //Test per cercare paracetamolo nella barra di ricerca
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

    // Test per aggiungere 2 unità di paracetamolo dopo la ricerca
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

    // Test per vedere se il numero precedentemente prenotato compare nella pagina
    // Storico ordini
    public function testAggiuntoParacetamoloInStorico(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Dashboard')
                ->clickLink('Storico ordini') 
                ->pause(1000);
               

                $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
                    $browser->assertSee('Paracetamolo')
                            ->assertSee('Analgesico')
                            ->assertSee('2');
                
            });
        
        });

    }


    // test per prenotare una visita nel caso sia possibile, altrimenti
    // viene annullata una visista precedentemente prenotata
    public function testAggiungiEliminaVisita(): void
        {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Dashboard')
                ->clickLink('Prenota visita') 
                ->pause(1000);
            
            $numeroVisiteDisponibili = intval($browser->text('#numero-visite-disponibili'));
            
            if ($numeroVisiteDisponibili === 0) {
                $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
                    $browser->click('button', ['text' => 'X']);

            });
            $browser->assertSee('Visita eliminata con successo!'); 
            }else {
                $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
                    $browser->click('button', ['text' => 'Prenota'])
                            ->assertSee('Visita prenotata!'); 
            });
            }

        });

        }
}