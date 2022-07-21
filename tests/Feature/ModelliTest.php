<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Marca;
use App\Models\Modello;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelliTest extends TestCase
{
    use RefreshDatabase;

    public function test_pagina_modelli()
    {
        $marca = Marca::factory()->create();
        $modello = Modello::factory()->create(['marca_id' => $marca->id ]);
        $modello2 = Modello::factory()->create(['marca_id' => $marca->id ]);
        $categoria = Categoria::factory()->create();
        $fornitore = Fornitore::factory()->create();

        $ricambio = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]);
        $ricambio2 = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]);
        
        $pivot = DB::table('modello_ricambio')->insert([
            'modello_id' => $modello->id,
            'ricambio_id' => $ricambio->id,
        ]);
        $pivot2 = DB::table('modello_ricambio')->insert([
            'modello_id' => $modello->id,
            'ricambio_id' => $ricambio2->id,
        ]);
        
        $response = $this->get(route('vistaModelli'));
        $response->assertStatus(200);
    }

    public function test_pagina_aggiungi_nuovo_modello()
    {
        $user = User::factory()->create();
        
        $user2 = User::factory()->create(['ruolo' => 2]);
        $marca = Marca::factory()->create();

        $response = $this->actingAs($user)->get(route('vistaAggiungiModello'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route('vistaAggiungiModello'));
        $response->assertStatus(403);
    }

    public function test_aggiungi_modello()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $marca = Marca::factory()->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->post(route('aggiungiModello') ,[
            'marca_id' => $marca->id,
            'nome' => 'Franco',
            'anno_produzione' => '2018',
            
            'img' => $file,
        ]);
        $this->assertDatabaseHas('modelli' , [
            
            'nome' => 'Franco',
            'anno_produzione' => '2018',
        ]);

        $response = $this->actingAs($user2)->post(route('aggiungiModello'));
        $response->assertStatus(403);
    }
    
    public function test_pagina_modifica_modello()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $marca = Marca::factory()->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $modello = Modello::factory()->create(['marca_id' => $marca->id]);
        
        $response = $this->actingAs($user)->get(route('vistaModificaModello' , $modello->id));
        $response->assertStatus(200);
        
        $response = $this->actingAs($user2)->get(route('vistaModificaModello' ,  $modello->id));
        $response->assertStatus(403);
       
    }

    public function test_modifica_modello()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $marca = Marca::factory()->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $modello = Modello::factory()->create(['marca_id' => $marca->id]);

        $response = $this->actingAs($user)->put(route('modificaModello' , $modello->id), [
            'nome' => 'Mariano',
            'marca_id' => $marca->id,
            'anno_produzione' => '2022',
            'img' => $file,
        ]);

        $this->assertDatabaseHas('modelli' , [
            'nome' => 'Mariano',
            'marca_id' => $marca->id,
        ]);
        $response = $this->get(route('vistaModelli'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->put(route('modificaModello' , $modello->id));
        $response->assertStatus(403);
    }  

    public function test_elimina_modello()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $marca = Marca::factory()->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $modello = Modello::factory()->create(['marca_id' => $marca->id]);  
        $modello2 = Modello::factory()->create(['marca_id' => $marca->id]);  
        
        $response = $this->actingAs($user)->delete(route('eliminaModello' , $modello->id));
        $this->assertDatabaseMissing('modelli' , [
            'id' => $modello->id,
        ]);
        $response = $this->get(route('vistaModelli'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->delete(route('eliminaModello' , $modello2->id));
        $response->assertStatus(403);

    }
}    
