<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class DipendentiTest extends DuskTestCase
{
    // Test Login
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

    // Test di ricerca di un prodotto
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

    // Test vendita di una certa quantita di prodotto losartan
    public function testVenditaLosartan3unita(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                ->type('#search', 'losartan') 
                ->pause(1000);

            $browser->within('table.min-w-full tbody tr:not([style*="display: none"])', function ($browser) {
                $browser->select('quantita', 3)
                        ->click('button', ['text' => 'Vendi']) 
                        ->pause(1000);
            });
    
            $browser->assertSee('Prodotto Venduto!'); 

            //$browser->screenshot('debug2');
            //$browser->dump();

    });

    }

    // Test che conferma l'avvenuto pagamento del cliente nella pagina "Prenotazione die Clienti"
    // andando a cliccare nella corrispettiva riga della prenotazione il pulsante verde.
    public function testConfermaPagamentoCliente(): void
    {   
    $this->browse(function (Browser $browser) {
        $browser->visit('/dipendente_home')
            ->clickLink('Prenotazioni dei Clienti') 
            ->pause(500);
        
        
        $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
            $browser->click('.add-button')
                    ->pause(1000);
                    
        });
        $browser->assertSee('Prodotto pagato!');  
    });

    }

     // Test che conferma il non pagamento del cliente nella pagina "Prenotazione die Clienti"
    // andando a cliccare nella corrispettiva riga della prenotazione il pulsante rosso.
    public function testConfermaNoPagamentoCliente(): void
    {
    $this->browse(function (Browser $browser) {
        $browser->visit('/dipendente_home')
            ->clickLink('Prenotazioni dei Clienti') 
            ->pause(500);
        
        $browser->within('table.min-w-full tbody tr:first-child', function ($browser) {
            $browser->click('.delete-button')
                    ->pause(1000);
                    
        });
        $browser->assertSee('Prodotto ritornato al magazzino.'); 
        
    });

    }

    // Test che aggiunge 2 quantità di prodotto voltaren al magazzino
    public function testProdottoDaOrdinare(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                    ->clickLink('Prodotti da Ordinare')  
                    ->type('#search', 'voltaren') 
                    ->pause(1000);
                    
            $browser->within('table.min-w-full tbody tr:not([style*="display: none"])', function ($browser) {
                $browser->type('input[name="quantita"]', '2')
                        ->click('button', ['text' => 'Aggiungi Disponibilità'])  
                        ->pause(1000);
            });
    
            $browser->assertSee('Prodotto aggiunto con successo.'); 
    });

    }

    // Test che verifica l'avvenuto ordine andando a controllare la prima voce nella tabella storico ordine dei dipendenti
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

    // Test di aggiunta di un prodotto con alcuni campi casuali
    public function testAggiungiProdotto(): void
    {
    $this->browse(function (Browser $browser) {
        $name = Str::random(10);
        $tipo = Str::random(10);
        $disponibilita = rand(1, 100);

        $browser->visit('/login')
                ->type('email', 'giuseppe@live.it') 
                ->type('password', 'qwerty1234') 
                ->click('button', ['text' => 'Log in']); 

        $browser->visit('/dipendente_home');
        
        $browser->type('name', $name) 
                    ->type('tipo', $tipo) 
                    ->type('scadenza', '31/12/2023') 
                    ->type('disponibilita', $disponibilita) 
                    ->type('prezzo', '14,50') 
                    ->type('descrizione', 'Antibiotico generico')
                    ->press('#bottone2')
                    ->pause(1000)
                    ->assertSee('Prodotto aggiunto alla lista con successo.');
      
    });
    }

    // Test per modificare il nome del profilo del dipendente
    public function testModificaProfiloDip(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                    ->click('.user-name')
                    ->pause(1000)
                    ->clickLink('Profilo');
            
            $browser->type('#name', 'Peps')  //cambio Nome
                    ->press('#bottone')
                    ->pause(1000)
                    ->assertSee('Salvato.');
                    
    });
    }

    // Test che modifica la password del dipendente
    public function testModificaPassword_dip(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dipendente_home')
                    ->click('.user-name')
                    ->pause(500)
                    ->clickLink('Profilo');
            
            $browser->type('#current_password', 'qwerty1234')  //cambio Nome
                    ->type('#password', 'qwerty1234')
                    ->type('#password_confirmation', 'qwerty1234')
                    ->press('#bottone2')
                    ->screenshot('debug1')
                    ->pause(1000)
                    ->assertSee('Password Salvata.');

    });
    }

    // Test di Logout
    public function testLogoutDip(): void
    {
    $this->browse(function (Browser $browser) {
        $browser->visit('/dipendente_home')
                ->click('.user-name')
                ->pause(1000)
                ->clickLink('Log Out')
                ->assertPathIs('/')
                ->assertSee('Login');
        
    });
    }

    // Test che aggiunge una visista con alcuni campi casuali
    public function testAggiungiVisita(): void
    {
        $this->browse(function (Browser $browser) {
            $tipo = Str::random(10);
            $prezzo = rand(1, 100);

            $browser->visit('/login')
                    ->type('email', 'giuseppe@live.it') 
                    ->type('password', 'qwerty1234') 
                    ->click('button', ['text' => 'Log in']); 

            $browser->visit('/dipendente_home')
                    ->clickLink('Visite') 
                    ->pause(500);
            
            $browser->type('tipologia', $tipo); 
            $browser->script("document.querySelector('input[name=\"dataVisita\"]').value = '2023-02-12T09:10'");
            $browser->type('medico', 'Dr. Verdi') 
                    ->type('prezzo', $prezzo) 
                    ->press('#bottone')
                    ->pause(1000)
                    ->assertSee('Visita aggiunta alla lista con successo.');
                    $browser->screenshot('debug2');
                
            
        });
    }


// MODIFICARE IL NUMERO MINIMO DI MEDICINE PER ANDARE AFINIRE NELLA TABELLA PRODOTTI DA ORDINARE
// RICORDARSI SE SI CAMBIA PASSWORD ALLA FINE NON FUNZIONA PIU NULLA




}
