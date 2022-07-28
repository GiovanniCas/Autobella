<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Testata;
use Tests\Feature\OrdiniTest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdiniTest extends TestCase
{
    use RefreshDatabase;

    public function test_vista_pagina_lista_ordini()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $ordine = Testata::factory()->create([
            'name'=> 'Pippo',
            'cognome'=> 'Baudo',
            'citta'=> 'ciao',
            'indirizzo'=> ' via ciao 32',
            'cap'=> '12345',
            'email'=> 'ciao@ciao.it',
            'totale'=> 123,
            'stato' => 1,
        ]);
        $ordine2 = Testata::factory()->create([
            'name'=> 'Pippo',
            'cognome'=> 'Baudo',
            'citta'=> 'ciao',
            'indirizzo'=> ' via ciao 32',
            'cap'=> '12345',
            'email'=> 'ciao@ciao.it',
            'totale'=> 123,
            'stato' => 2,
        ]);
        $ordine3 = Testata::factory()->create();
        
        
        $response = $this->actingAs($user)->get(route('listaOrdini'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route('listaOrdini'));
        $response->assertStatus(403);
    }


    public function test_spedizione_avvenuta()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $ordine = Testata::factory()->create([
            'name'=> 'Pippo',
            'cognome'=> 'Baudo',
            'citta'=> 'ciao',
            'indirizzo'=> ' via ciao 32',
            'cap'=> '12345',
            'email'=> 'ciao@ciao.it',
            'totale'=> 123,
            'stato' => 1,
        ]);

        $response = $this->actingAs($user)->put(route('ordineSpedito' , $ordine->id));
        $this->assertDatabaseHas('testata_ordini' , [
            'id' => $ordine->id,
            'stato' => 2,
        ]);
        $response = $this->actingAs($user)->get(route('listaOrdini'));
        $response->assertStatus(200);


        $response = $this->actingAs($user2)->put(route('ordineSpedito' , $ordine->id));
        $response->assertStatus(403);

    }

   
}
