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
                    ->type('password', 'qwerty1234') 
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
                    ->pause(1000);
                    
                    
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
                    ->pause(1000);
                    
                    
        });
        $browser->assertSee('Prodotto ritornato al magazzino.'); 
        
    });

    }

    public function testProdottoDaOrdinare(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                    ->clickLink('Prodotti da Ordinare')  
                    ->type('#search', 'voltaren') 
                    ->pause(1000);
                    

            $browser->within('table.min-w-full tbody tr:not([style*="display: none"])', function ($browser) {
                $browser->type('input[name="quantita"]', '2')
                        ->click('button', ['text' => 'Aggiungi Disponibilità'])  // Fai clic sul pulsante "Prenota"
                        ->pause(1000);
            });
    
            $browser->assertSee('Prodotto aggiunto con successo.'); 
    });

    }

    public function testProdottoDaOrdinareInStorico(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                ->clickLink('Storico Ordini') 
                ->pause(1000);
               

                $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
                    $browser->assertSee('Voltaren')
                            ->assertSee('2');
                
            });
        
        });

    }

    
    public function testAggiungiProdotto(): void
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/dipendente_home');
        
        $browser->type('name', 'Augmentin') 
                    ->type('tipo', 'Antibiotico') 
                    ->type('scadenza', '31/12/2023') 
                    ->type('disponibilita', '25') 
                    ->type('prezzo', '14,50') 
                    ->type('descrizione', 'Antibiotico generico')
                    ->press('Aggiungi prodotto')
                    ->screenshot('debug5')
                    ->pause(1000)
                    ->assertSee('Prodotto aggiunto alla lista con successo.');
            
        
    });
}



    public function testModificaProfiloDip(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                    ->click('.user-name')
                    ->pause(1000)
                    ->clickLink('Profilo');
            
            $browser->type('#name', 'Peps')  //cambio Nome
                    ->press('Salva')
                    ->pause(1000)
                    ->assertSee('Salvato.');
                    
                    
    });
    }

    public function testModificaPassword_dip(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                    ->click('.user-name')
                    ->pause(1000)
                    ->clickLink('Profilo');
            
            $browser->type('#current_password', 'qwerty1234')  //cambio Nome
                    ->type('#password', 'qwerty1234')
                    ->type('#password_confirmation', 'qwerty1234')
                    ->press('Salva Password')
                    ->screenshot('debug1')
                    ->pause(1000)
                    ->assertSee('Password Salvata.');
                    

    });
    }

    public function testLogoutDip(): void
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/dipendente_home')
                ->click('.user-name')
                ->pause(1000)
                ->clickLink('Log Out')
                ->assertPathIs('/')
                ->assertSee('Log in');
        
     
            
        
    });
}

// MODIFICARE IL NUMERO MINIMO DI MEDICINE PER ANDARE AFINIRE NELLA TABELLA PRODOTTI DA ORDINARE
// RICORDARSI SE SI CAMBIA PASSWORD ALLA FINE NON FUNZIONA PIU NULLA




}
