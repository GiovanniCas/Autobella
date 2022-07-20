<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FornitoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ragione_sociale' => fake()->name(),
            'indirizzo' => fake()->name(),
            'comune' => fake()->name(),
            'cap' => fake()->name(),
            'provincia' => fake()->name(),
            'partita_iva' => 'POUYG56RTR454323S',
        ];
    }
}
