<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = 
        [
            [
                'descrizione' => 'Motore',
              
            ],

            [
                'descrizione' => 'Interni',
                
            ],

            [
                'descrizione' => 'Autoradio',
                
            ]
        ];

        foreach($categorie as $categoria){
            DB::table('categorie')->insert([
                'descrizione' => $categoria['descrizione'],
                
            ]);
        }
    }
}
