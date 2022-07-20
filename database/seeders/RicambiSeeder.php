<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RicambiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ricambi = 
        [
            [
                'categoria_id' => '1',
                'fornitore_id' => '2',
                'codice_pezzo' => '4h8p',
                'descrizione' => 'prodotto buono',
                'prezzo' => 90.5,
                'nome'=> 'pippo',
            ],

            [
                'categoria_id' => '2',
                'fornitore_id' => '3',
                'codice_pezzo' => '44er',
                'descrizione' => 'prodotto buono',
                'prezzo' => 8,
                'nome'=> 'pluto',
            ],

            [
                'categoria_id' => '3',
                'fornitore_id' => '1',
                'codice_pezzo' => '986t',
                'descrizione' => 'prodotto buono',
                'prezzo' => 45,
                'nome'=> 'paperino',
            ]
        ];

        foreach($ricambi as $ricambio){
            DB::table('ricambi')->insert([
                'categoria_id' => $ricambio['categoria_id'],
                'fornitore_id' => $ricambio['fornitore_id'],
                'codice_pezzo' => $ricambio['codice_pezzo'],
                'descrizione' => $ricambio['descrizione'],
                'prezzo' => $ricambio['prezzo'],
            ]);
        }
    }
}
