<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Marca;
use App\Models\Modello;
use App\Models\Ricambio;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FiltriTest extends TestCase
{
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
}
