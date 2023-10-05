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
    public function testBasicExample(): void
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

    public function testSearchAspirina(): void
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
}
