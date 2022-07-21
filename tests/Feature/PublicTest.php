<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Marca;
use App\Models\Modello;
use App\Models\Testata;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use App\Models\RicambioOrdinato;
use Illuminate\Support\Facades\DB;
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

    public function test_filtri()
    {     
        $response = $this->post(route('cercaRicambiCompatibili') , [
            'cercaModello' => 'serie1',
            'cercaAnnoProduzione' => '2022',
            'cercaRicambio' => 'pluto',
            'cercaMarca' => 'bmw',
        ]);

        $response->assertSessionHas('cercaModello');
        $response->assertSessionHas('cercaAnnoProduzione');
        $response->assertSessionHas('cercaRicambio');
        $response->assertSessionHas('cercaMarca');

        

        $marca = Marca::factory()->create(['nome' => 'bmw']);
        $modello = Modello::factory()->create([
            'nome' => 'serie1' ,
            'marca_id' => $marca->id,
            'anno_produzione' => '2022'
        ]);
        $modello2 = Modello::factory()->create([
            'nome' => 'x1' ,
            'marca_id' => $marca->id,
            'anno_produzione' => '2022'
        ]);
        $categoria = Categoria::factory()->create();
        $fornitore = Fornitore::factory()->create(); 
        $ricambio = Ricambio::factory()->create([
            'categoria_id' => $categoria->id,
            'fornitore_id' => $fornitore->id,
            'nome' => 'volante',
        ]);
        $ricambio2 = Ricambio::factory()->create([
            'categoria_id' => $categoria->id,
            'fornitore_id' => $fornitore->id,
            'nome' => 'pluto',
        ]);
        // $modelli_compatibili = Modello::factory()
        //     ->hasAttached(
        //         Ricambio::factory()->count(3),
        //         ['active' => true]
        //     )
        //     ->create();

        $modello_compatibili = DB::table('modello_ricambio')->insert([
            'modello_id' => $modello->id,
            'ricambio_id' => $ricambio2->id,
        ]);
        $modello_compatibili2 = DB::table('modello_ricambio')->insert([
            'modello_id' => $modello2->id,
            'ricambio_id' => $ricambio2->id,
        ]);
 
        $response = $this->get(route('vistaRicambi'));
        $response->assertStatus(200);
    }

    public function test_vista_pagina_carrello()
    {
        $fornitore = Fornitore::factory()->create();
        $categoria = Categoria::factory()->create();
        $ricambio = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]);
        $ordine = Testata::factory()->create();
        session()->put('testata_id' , $ordine->id);
        $ricambioOrdinato = RicambioOrdinato::factory()->create([
            'ricambio_id' => $ricambio->id,
            'testata_id' => $ordine->id,
            'quantita' => 2,
            'prezzo_unitario' => 90,
        ]);

        $response = $this->get(route('carrello'));
        $response->assertStatus(200);

    }

    
    public function test_aggiungi_al_carrello()
    {
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
        $ordine = Testata::factory()->create();
        
        $response = $this->post(route('aggiungiAlCarrello') ,  [
            'quantita' => [ $ricambio->id => 4, $ricambio2->id => 0 , $ricambio3->id => 2],
        ]);
        
        $response->assertSessionHas('testata_id');
        $this->assertDatabaseHas('ricambi_ordinati' , 
        [ 
           'testata_id' => session('testata_id')
        ]);
        $response = $this->get(route('vistaRicambi'));
        $response->assertStatus(200);
    }

    public function test_modifica_quantita_nel_carrello()
    {
        session()->flush();
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

        $response = $this->post(route('aggiungiAlCarrello') ,  [
            'quantita' => [ $ricambio->id => 4, $ricambio2->id => 1 ],
        ]);
        $response = $this->get(route('carrello'));
        $response->assertStatus(200);

        $response = $this->put(route('modificaQuantitaDesiderate') ,  [
            'quantita' => [ $ricambio2->id => 3],
        ]);

        $this->assertdatabaseHas('ricambi_ordinati' , [
            'ricambio_id' => $ricambio2->id,
            'quantita' => 3,
        ]);

    }

    public function test_pagina_conferma_oridine()
    {
        $response = $this->get(route('ordine'));
        $response->assertStatus(200);

    }

    
    public function test_conferma_oridine()
    {
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
            'testata_id' => session('testata_id'),
            'quantita' => 4,
            'prezzo_unitario' => 23, 
        ]);
        $ricambioOrdinato2 =  RicambioOrdinato::factory()->create([
            'ricambio_id' => $ricambio2->id,
            'testata_id' => session('testata_id'),
            'quantita' => 2,
            'prezzo_unitario' => 57, 
        ]);

        $response = $this->post(route('confermaOrdine') , [
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
   
}
