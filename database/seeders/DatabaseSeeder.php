<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $fornitori = 
        [
            [
                'ragione_sociale' => 'Mimmo S.p.A',
                'indirizzo' => 'via dei pini 32',
                'comune' => 'Pescara',
                'cap' => '65125',
                'provincia' => 'Pescara',
                'partita_iva' => 'PQW34RTCD65RR',
            ],

            [
                'ragione_sociale' => 'Fazzoletti S.p.A',
                'indirizzo' => 'via appia 123',
                'comune' => 'Roma',
                'cap' => '60133',
                'provincia' => 'Roma',
                'partita_iva' => 'FZZ34RTCD65RT'
            ],

            [
                'ragione_sociale' => 'Jhonny S.p.A',
                'indirizzo' => 'via firenze 12',
                'comune' => 'Atri',
                'cap' => '64032',
                'provincia' => 'Teramo',
                'partita_iva' => 'JHN34RTCD65RV'
            ]
        ];

        foreach($fornitori as $fornitore){
            DB::table('fornitori')->insert([
                'ragione_sociale' => $fornitore['ragione_sociale'],
                'indirizzo' => $fornitore['indirizzo'],
                'comune' => $fornitore['comune'],
                'cap' => $fornitore['cap'],
                'provincia' => $fornitore['provincia'],
                'partita_iva' => $fornitore['partita_iva'],
            ]);
        }

    }
}
