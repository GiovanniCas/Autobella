<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Fornitore;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FornitoriTest extends TestCase
{
    use  RefreshDatabase;

    public function test_pagina_lista_fornitori()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $fornitore = Fornitore::factory()->create();
        $fornitore2 = Fornitore::factory()->create();
        
        $response = $this->actingAs($user)->get(route('listaFornitori'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route('listaFornitori'));
        $response->assertStatus(403);

    }

    public function test_pagina_aggiungi_nuovo_fornitore()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);

        $response = $this->actingAs($user)->get(route('aggiungiFornitore'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route('aggiungiFornitore'));
        $response->assertStatus(403);
    }

    public function test_aggiungi_nuovo_fornitore()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);

        $response = $this->actingAs($user)->post(route('aggiungiNuovoFornitore') , [
            'ragione_sociale' => 'Mimmo',
            'indirizzo' => 'ciaciao 42',
            'comune' => 'atri',
            'cap' => '08765',
            'provincia' => 'teramo',
            'partita_iva' => 'JKAJGSD783FW8',
        ]);

        $this->assertdatabaseHas('fornitori' , [
            'ragione_sociale' => 'Mimmo',
            'indirizzo' => 'ciaciao 42', 
        ]);

        $response = $this->actingAs($user)->get(route('listaFornitori'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->post(route('aggiungiNuovoFornitore'));
        $response->assertStatus(403);
    }

    public function test_pagina_modifica_fornitore()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $fornitore = Fornitore::factory()->create();

        $response = $this->actingAs($user)->get(route('vistaModificaFornitore' , $fornitore->id));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route('vistaModificaFornitore' , $fornitore->id));
        $response->assertStatus(403);
    }

    public function test_modifica_fornitore()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $fornitore = Fornitore::factory()->create();
        

        $response = $this->actingAs($user)->put(route('modificaFornitore' , $fornitore->id) , [
            'ragione_sociale' => 'Mimmo',
            'indirizzo' => 'ciaciao 42',
            'comune' => 'atri',
            'cap' => '08765',
            'provincia' => 'teramo',
            'partita_iva' => 'JKAJGSD783FW8',
        ]);
        $this->assertdatabaseHas('fornitori' , [
            'ragione_sociale' => 'Mimmo',
            'indirizzo' => 'ciaciao 42', 
        ]);

        $response = $this->actingAs($user)->get(route('listaFornitori'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->put(route('modificaFornitore' , $fornitore->id));
        $response->assertStatus(403);
    }

    public function test_elimina_fornitore()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $fornitore = Fornitore::factory()->create();   
        $fornitore2 = Fornitore::factory()->create();   
        
        $response = $this->actingAs($user)->delete(route('eliminaFornitore' , $fornitore->id));
        $this->assertdatabaseMissing('fornitori' , [
            'id' => $fornitore->id, 
        ]);
        $response = $this->actingAs($user)->get(route('listaFornitori'));
        $response->assertStatus(200);

    
        $response = $this->actingAs($user2)->delete(route('eliminaFornitore' , $fornitore2->id));
        $response->assertStatus(403);

    }


}
