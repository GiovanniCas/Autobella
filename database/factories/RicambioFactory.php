<?php

namespace Database\Factories;

use Database\Factories\RicambioFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RicambioFactory extends Factory
{
  
    public function definition()
    {
        return [
            'categoria_id' => 1,
            'fornitore_id' => 1,
            'nome' => fake()->name(),
            'codice_pezzo' => fake()->name(),
            'descrizione' => fake()->name(),
            'prezzo' => 54,
        ];
    }
}
