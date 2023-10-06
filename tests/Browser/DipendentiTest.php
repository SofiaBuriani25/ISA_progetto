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

    public function testSearchIbuprofene(): void
    {
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
            ->clickLink('Dashboard')
            ->type('#search', 'ibuprofene') 
            ->pause(1000);
           
        $browser->within('table.min-w-full tbody tr:not([style*="display: none"]', function ($browser) {
            $browser->assertSee('Ibuprofene');
        });

    });

    }
}
