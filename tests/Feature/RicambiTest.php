<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Marca;
use App\Models\Modello;
use App\Models\Immagine;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RicambiTest extends TestCase
{
    use RefreshDatabase;

    public function test_vista_pagina_ricambi()
    {   
        
        $marca = Marca::factory()->create();
        $modello = Modello::factory()->create(['marca_id' => $marca->id ]);
        $modello2 = Modello::factory()->create(['marca_id' => $marca->id ]);
        $categoria = Categoria::factory()->create();
        $fornitore = Fornitore::factory()->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $file2 = UploadedFile::fake()->image('avenger.jpg');
        $ricambio = Ricambio::factory()->create([
            'categoria_id' => $categoria->id,
            'fornitore_id' => $fornitore->id,
        ]);

        $immagine1 = Immagine::factory()->create([
            'ricambio_id' => $ricambio->id,
            'nome' => $file,
        ]);

        $ricambio2 = Ricambio::factory()->create([
            'categoria_id' => $categoria->id,
            'fornitore_id' => $fornitore->id,
            
        ]);

        $immagine2 = Immagine::factory()->create([
            'ricambio_id' => $ricambio2->id,
            'nome' => $file2,
        ]);

        $pivot = DB::table('modello_ricambio')->insert([
            'modello_id' => $modello->id,
            'ricambio_id' => $ricambio->id,
        ]);
        $pivot2 = DB::table('modello_ricambio')->insert([
            'modello_id' => $modello->id,
            'ricambio_id' => $ricambio2->id,
        ]);
        
        $response = $this->get(route('vistaRicambi'));
        $response->assertStatus(200);
    }

    public function test_vista_pagina_aggiungi_nuovo_ricambio()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $marca = Marca::factory()->create();
        $modello = Modello::factory()->create(['marca_id' => $marca->id ]);
        $fornitore = Fornitore::factory()->create();
        $categoria = Categoria::factory()->create();

        $response= $this->actingAs($user)->get(route('vistaAggiungiRicambi'));
        $response->assertStatus(200);

        $response= $this->actingAs($user2)->get(route('vistaAggiungiRicambi'));
        $response->assertStatus(403);

    }

    public function test_aggiungi_nuovo_ricambio()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $marca = Marca::factory()->create();
        $modello = Modello::factory()->create(['marca_id' => $marca->id ]);
        $modello2 = Modello::factory()->create(['marca_id' => $marca->id ]);
        $fornitore = Fornitore::factory()->create();
        $categoria = Categoria::factory()->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $file2 = UploadedFile::fake()->image('avenger.jpg');

        $response = $this->actingAs($user)->post(route('aggiungiRicambi'), [
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
            'codice_pezzo' => '34RT5Y',
            'descrizione' => 'Bellissimo',
            'prezzo' => 55,
            'nome' => 'Giovanni', 
            'immagini' => [$file , $file2], 
            'modelli_id' => [$modello->id , $modello2->id ]
        ]);
        $this->assertDatabaseHas('ricambi' , [
            'descrizione' => 'Bellissimo',
            'prezzo' => 55,
            'nome' => 'Giovanni', 
        ]);

        $response= $this->actingAs($user)->get(route('vistaRicambi'));
        $response->assertStatus(200);


        $response= $this->actingAs($user2)->post(route('aggiungiRicambi'));
        $response->assertStatus(403);

    }

    public function test_vista_pagina_modifica_ricambio()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $fornitore = Fornitore::factory()->create();
        $categoria = Categoria::factory()->create();
        $ricambio = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
        ]);

        $response= $this->actingAs($user)->get(route('vistaModificaRicambio' , $ricambio->id));
        $response->assertStatus(200);

        $response= $this->actingAs($user2)->get(route('vistaModificaRicambio' , $ricambio->id));
        $response->assertStatus(403);
    }

    
    public function test_modifica_ricambio()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $fornitore = Fornitore::factory()->create();
        $categoria = Categoria::factory()->create();
        $ricambio = Ricambio::factory()->create([
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
            'codice_pezzo' => '34RT5Y',
            'descrizione' => 'Bellissimo',
            'prezzo' => 55,
            'nome' => 'Giovanni',
        ]);

        $response= $this->actingAs($user)->put(route('modificaRicambio' , $ricambio->id),[
            'fornitore_id' => $fornitore->id,
            'categoria_id' => $categoria->id,
            'codice_pezzo' => '34RT5Y',
            'descrizione' => 'Bellissimo',
            'prezzo' => 55,
            'nome' => 'Pluto',
        ]);
        $this->assertDatabaseHas('ricambi' , [
            'nome' => 'Pluto',
        ]);

        $response = $this->actingAs($user)->get(route('vistaRicambi'));
        $response->assertStatus(200);

        $response= $this->actingAs($user2)->put(route('modificaRicambio' , $ricambio->id));
        $response->assertStatus(403);
    }

    public function test_elimina_ricambio()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
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

        $response= $this->actingAs($user)->delete(route('eliminaRicambio' , $ricambio->id));
        $this->assertDatabaseMissing('ricambi' , [
            'id' => $ricambio->id,
        ]);

        $response = $this->actingAs($user)->get(route('vistaRicambi'));
        $response->assertStatus(200);

        $response= $this->actingAs($user2)->delete(route('eliminaRicambio' , $ricambio2->id));
        $response->assertStatus(403);
    }

}
