<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategorieTest extends TestCase
{
    use RefreshDatabase;

    public function test_vista_pagina_categoria()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->get(route('vistaCategorie'));
        $response->assertStatus(200);
    }

    public function test_vista_pagina_aggiungi_categoria()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);   
        
        $response = $this->actingAs($user)->get(route('vistaAggiungiCategoria'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route('vistaAggiungiCategoria'));
        $response->assertStatus(403);
    }

    public function test_aggiungi_categoria()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]); 
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');  
        
        $response = $this->actingAs($user)->post(route('aggiungiCategoria') , [
            'descrizione' => 'Wooaw',
            'img' => $file,
        ]);
        $this->assertDatabasehas('categorie' , [
            'descrizione' => 'Wooaw',            
        ]);
        $response = $this->get(route('vistaCategorie'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->post(route('aggiungiCategoria'));
        $response->assertStatus(403);
    }

    public function test_vista_pagina_modifica_categoria()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $categoria = Categoria::factory()->create();
        
        $response = $this->actingAs($user)->get(route('vistaModificaCategoria' , $categoria->id));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->get(route('vistaModificaCategoria' , $categoria->id));
        $response->assertStatus(403);
    }

    public function test_modifica_categoria()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]); 
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg'); 
        $categoria = Categoria::factory()->create();
        
        $response = $this->actingAs($user)->put(route('modificaCategoria' , $categoria->id) , [
            'descrizione' => 'Wooaw',
            'img' => $file,
        ]);
        $this->assertDatabasehas('categorie' , [
            'descrizione' => 'Wooaw',            
        ]);
        $response = $this->get(route('vistaCategorie'));
        $response->assertStatus(200);

        $response = $this->actingAs($user2)->put(route('modificaCategoria' , $categoria->id));
        $response->assertStatus(403);
    }

    public function test_elimina_categoria()
    {
        $user = User::factory()->create();     
        $user2 = User::factory()->create(['ruolo' => 2]);
        $categoria = Categoria::factory()->create();
        $categoria2 = Categoria::factory()->create();

        $response = $this->actingAs($user)->delete(route('eliminaCategoria' , $categoria->id));
        $this->assertDatabaseMissing('categorie' , [
            'id' => $categoria->id,            
        ]);
        $response = $this->get(route('vistaCategorie'));
        $response->assertStatus(200);


        $response = $this->actingAs($user2)->delete(route('eliminaCategoria' , $categoria2->id));
        $response->assertStatus(403);

    }
}
