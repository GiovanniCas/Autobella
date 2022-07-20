<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Marca;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VettureTest extends TestCase
{
    use RefreshDatabase;

    public function test_pagina_marche()
    {
        $response = $this->get(route('vistaMarche'));

        $response->assertStatus(200);
    }

    public function test_pagina_aggiungi_marca()
    {
        $user = User::factory()->create(['ruolo' => 1]);
        $user2 = User::factory()->create(['ruolo' => 2]);
        
        $response = $this->actingAs($user)->get(route('vistaAggiungiMarca'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route('vistaAggiungiMarca'));
        $response->assertStatus(403);

    }

    public function test_aggiungi_marca()
    {
        $user = User::factory()->create(['ruolo' => 1]);
        $user2 = User::factory()->create(['ruolo' => 2]);
      
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $response = $this->actingAs($user)->post(route("aggiungiMarca") ,
        [
            'nome' => "Paoletto",
            'img' =>  $file,
        ]);

        $this->assertDatabaseHas('marche' , [
            'nome' => 'Paoletto',
        ]);

        $response = $this->actingAs($user)->get(route('vistaMarche'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->post(route("aggiungiMarca") ,
        [
            'nome' => "Paoletto",
            'img' =>  $file,
        ]);
        $response->assertStatus(403);
      
    }

    public function test_pagina_modifica_marca()
    {
        $user = User::factory()->create(['ruolo' => 1]);
        $user2 = User::factory()->create(['ruolo' => 2]);
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $marca = Marca::factory()->create(['img' =>  $file]);
        $marca2 = Marca::factory()->create(['img' =>  $file]);

        $response = $this->actingAs($user)->get(route('vistaModificaMarca' , $marca->id));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route("vistaModificaMarca" , $marca2->id));
        $response->assertStatus(403);

    }

    public function test_modifica_marca()
    {
        $user = User::factory()->create(['ruolo' => 1]);
        $user2 = User::factory()->create(['ruolo' => 2]);
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $marca = Marca::factory()->create(['img' =>  $file]);
        $marca2 = Marca::factory()->create(['img' =>  $file]);
        
        $response = $this->actingAs($user)->put(route('modificaMarca', $marca->id) , 
        [
            'nome' => "Massimo",
            
        ]);
        
        
        $this->assertDatabaseHas('marche' , 
        [
            'id' => $marca->id,
            'nome' => "Massimo",
        ]);

    }


    public function test_elimina_marca()
    {

    }



}
