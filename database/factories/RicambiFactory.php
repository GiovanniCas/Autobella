<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RicambiFactory extends Factory
{
  
    public function definition()
    {
        return [
            'categoria_id' => 1,
            'fornitore_id' => 1,
            'name' => fake()->name(),
            'codice_pezzo' => fake()->name(),
            'descrizione' => fake()->name(),
            'prezzo' => '$ 54.00',
        ];
    }
}
