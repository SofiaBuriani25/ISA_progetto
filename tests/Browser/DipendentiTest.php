<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DipendentiTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'giuseppe@live.it') 
                    ->type('password', 'qwerty123') 
                    ->click('button', ['text' => 'Log in'])  
                    ->assertPathIs('/dipendente_home') // Verifico che l'utente sia reindirizzato alla pagina di dashboard
                    ->assertSee('Elenco dei prodotti disponibili'); 

        });
    }

    public function testSearchLorastan(): void
    {
    $this->browse(function (Browser $browser) {
        $browser->visit('/dipendente_home')
            ->type('#search', 'losartan') 
            ->pause(1000);
           
            $browser->within('table.min-w-full tbody tr:not([style*="display: none"]', function ($browser) {
                $browser->assertSee('Losartan');
            });
    });

    }

    public function testVenditaLosartan3unita(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                ->type('#search', 'losartan') 
                ->pause(1000);
                //->screenshot('debug1');

            $browser->within('table.min-w-full tbody tr:not([style*="display: none"])', function ($browser) {
                $browser->select('quantita', 3)
                        ->click('button', ['text' => 'Vendi'])  // Fai clic sul pulsante "Prenota"
                        ->pause(1000);
            });
    
            $browser->assertSee('Prodotto Venduto!'); 

            //$browser->screenshot('debug2');
            //$browser->dump();

    });

    }

    public function testConfermaPagamentoCliente(): void
    {   
    $this->browse(function (Browser $browser) {
        $browser->visit('/dipendente_home')
            ->clickLink('Prenotazioni dei Clienti') 
            ->pause(1000);
        
        
        $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
            $browser->click('.add-button')
                    ->pause(1000)
                    ->screenshot('debug2');
                    
        });
        $browser->assertSee('Prodotto pagato!');  
    });

    }

    public function testConfermaNoPagamentoCliente(): void
    {

        
    $this->browse(function (Browser $browser) {
        $browser->visit('/dipendente_home')
            ->clickLink('Prenotazioni dei Clienti') 
            ->pause(1000);
        
        
        $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
            $browser->click('.delete-button')
                    ->pause(1000)
                    ->screenshot('debug3');
                    
        });
        $browser->assertSee('Prodotto ritornato al magazzino.'); 
        
    });

    }

    public function testVenditaLo(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                ->type('#search', 'losartan') 
                ->pause(1000);
                //->screenshot('debug1');

            $browser->within('table.min-w-full tbody tr:not([style*="display: none"])', function ($browser) {
                $browser->select('quantita', 3)
                        ->click('button', ['text' => 'Vendi'])  // Fai clic sul pulsante "Prenota"
                        ->pause(1000);
            });
    
            $browser->assertSee('Prodotto Venduto!'); 

            //$browser->screenshot('debug2');
            //$browser->dump();

    });

    }
}
