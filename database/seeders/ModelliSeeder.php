<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModelliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelli = 
        [
            [
                'marca_id' => '1',
                'nome' => 'Q5',
                'anno_produzione' => '2000',
                'anno_ritiro' => '2021',                
            ],

            [
                'marca_id' => '2',
                'nome' => 'Serie 1',
                'anno_produzione' => '1997',
                'anno_ritiro' => '2015',
            ],

            [
                'marca_id' => '3',
                'nome' => 'Classe A',
                'anno_produzione' => '2022',
                'anno_ritiro' => null,
            ]
        ];

        foreach($modelli as $modello){
            DB::table('modelli')->insert([
                'marca_id' => $modello['marca_id'],
                'nome' => $modello['nome'],
                'anno_produzione' => $modello['anno_produzione'],
                'anno_ritiro' => $modello['anno_ritiro'],
            ]);
        }
    }
}
