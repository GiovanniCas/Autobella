<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Testata;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use App\Models\RicambioOrdinato;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarrelloTest extends TestCase
{
    use RefreshDatabase;
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
            'nome_ricambio' => $ricambio->nome,
            'codice_ricambio' => $ricambio->codice_pezzo,
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
}
