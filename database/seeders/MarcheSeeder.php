<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MarcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marche = 
        [
            [
                'nome' => 'Audi',
            ],

            [
                'nome' => 'BMW',
            ],

            [
                'nome' => 'Mercedes',
            ]
        ];

        foreach($marche as $marca){
            DB::table('marche')->insert([
                'nome' => $marca['nome'],
               
            ]);
        }
    }
}
