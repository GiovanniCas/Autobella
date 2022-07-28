<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Marca;
use App\Models\Modello;
use App\Models\Testata;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use App\Models\RicambioOrdinato;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome()
    {
        $marca = Marca::factory()->create();
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);

    }

    
    public function test_pagina_conferma_ordine()
    {
        $response = $this->get(route('ordine'));
        $response->assertStatus(200);

    }

    
    public function test_conferma_ordine()
    {
        $user = User::factory()->create(['ruolo' => 2]);
        
        $fornitore = Fornitore::factory()->create();
        $categoria = Categoria::factory()->create();
        $ricambio = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]);
        $ricambio2 = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]);
        $testata = Testata::factory()->create();
        session()->put('testata_id' , $testata->id);
        
        $ricambioOrdinato =  RicambioOrdinato::factory()->create([
            'ricambio_id' => $ricambio->id,
            'nome_ricambio' => $ricambio->nome,
            'codice_ricambio' => $ricambio->codice_pezzo,
            'testata_id' => session('testata_id'),
            'quantita' => 4,
            'prezzo_unitario' => 23, 
        ]);
        $ricambioOrdinato2 =  RicambioOrdinato::factory()->create([
            'ricambio_id' => $ricambio2->id,
            'nome_ricambio' => $ricambio2->nome,
            'codice_ricambio' => $ricambio2->codice_pezzo,
            'testata_id' => session('testata_id'),
            'quantita' => 2,
            'prezzo_unitario' => 57, 
        ]);

        //utente registrato
        $response = $this->actingAs($user)->post(route('confermaOrdine') , [
            'nome' => 'Giovanni',
            'cognome' => 'Castagna',
            'citta' => 'Atri',
            'indirizzo' => 'via vietata',
            'cap' => '64032',
            'email' => 'ciao@ciaone.it',
        ]);

        $this->assertdatabaseHas('testata_ordini' , [
            
            'name' => 'Giovanni',
            'cognome' => 'Castagna',
            'citta' => 'Atri',
            'indirizzo' => 'via vietata',
            'cap' => '64032',
            'email' => 'ciao@ciaone.it',
        ]);
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);

        //utente non registrato
        $response = $this->post(route('confermaOrdine') , [
            'nome' => 'Paolo',
            'cognome' => 'Castagna',
            'citta' => 'Pescara',
            'indirizzo' => 'via vietata',
            'cap' => '64032',
            'email' => 'ciao@ciaone.it',
        ]);
        $this->assertdatabaseHas('testata_ordini' , [

            'name' => 'Paolo',
            'cognome' => 'Castagna',
            'citta' => 'Pescara',
            'indirizzo' => 'via vietata',
            'cap' => '64032',
            'email' => 'ciao@ciaone.it',
        ]);
        
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        
    }

    public function test_vista_dettaglio_ricambio()
    {
        $marca = Marca::factory()->create();
        $modello = Modello::factory()->create(['marca_id' => $marca->id]);
        $fornitore = Fornitore::factory()->create();
        $categoria = Categoria::factory()->create();
        $ricambio = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]); 
        $modello_compatibili = DB::table('modello_ricambio')->insert([
            'modello_id' => $modello->id,
            'ricambio_id' => $ricambio->id,
        ]);
        $modello_compatibili2 = DB::table('modello_ricambio')->insert([
            'modello_id' => $modello->id,
            'ricambio_id' => $ricambio->id,
        ]);
        
        $response = $this->get(route('vistaDettaglio' , $ricambio));
        $response->assertStatus(200);
        $response->assertSessionHas('visti_di_recente');

        $ricambio2 = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]); 

        $response = $this->get(route('vistaDettaglio' , $ricambio2));
        $response->assertStatus(200);

        $ricambio3 = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]); 

        $response = $this->get(route('vistaDettaglio' , $ricambio3));
        $response->assertStatus(200);
      
    }
   
    public function test_storico_ordini()
    {
        $user = User::factory()->create(['ruolo' => User::UTENTE_NORMALE]);
        $user2 = User::factory()->create();
        
        $fornitore = Fornitore::factory()->create();
        $categoria = Categoria::factory()->create();
        $ricambio = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]);
        $ricambio2 = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]);
        $ricambio3 = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]);
        $testata = Testata::factory()->create();
        session()->put('testata_id' , $testata->id);
        $testata2 = Testata::factory()->create();

        
        $ricambioOrdinato =  RicambioOrdinato::factory()->create([
            'ricambio_id' => $ricambio->id,
            'nome_ricambio' => $ricambio->nome,
            'codice_ricambio' => $ricambio->codice_pezzo,
            'testata_id' => session('testata_id'),
            'quantita' => 4,
            'prezzo_unitario' => 23, 
        ]);
        $ricambioOrdinato2 =  RicambioOrdinato::factory()->create([
            'ricambio_id' => $ricambio2->id,
            'nome_ricambio' => $ricambio2->nome,
            'codice_ricambio' => $ricambio2->codice_pezzo,
            'testata_id' => session('testata_id'),
            'quantita' => 2,
            'prezzo_unitario' => 57, 
        ]);
        $ricambioOrdinato3 =  RicambioOrdinato::factory()->create([
            'ricambio_id' => $ricambio3->id,
            'nome_ricambio' => $ricambio3->nome,
            'codice_ricambio' => $ricambio3->codice_pezzo,
            'testata_id' => $testata2->id,
            'quantita' => 10,
            'prezzo_unitario' => 40, 
        ]);
        $response = $this->actingAs($user)->post(route('confermaOrdine') , [
            'nome' => 'Giovanni',
            'cognome' => 'Castagna',
            'citta' => 'Atri',
            'indirizzo' => 'via vietata',
            'cap' => '64032',
            'email' => 'ciao@ciaone.it',
        ]);

        $response = $this->actingAs($user)->get(route('storicoOrdini'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route('storicoOrdini'));
        $response->assertStatus(403);

    }
}
