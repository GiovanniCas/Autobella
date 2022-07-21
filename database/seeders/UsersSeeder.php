<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =  
        [
            [
                'nome' => 'Giovanni',
                'cognome' => 'Castagna',
                'email' => 'giovanni@giovanni.it',
                'ruolo' => 1,
                'password' => Hash::make('password'),
                
            ]
        ];

        foreach($users as $user){
            DB::table('users')->insert([
                'name' => $user['nome'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);
        }
    }
}
