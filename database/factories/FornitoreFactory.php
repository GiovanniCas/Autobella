<?php

namespace Database\Factories;

use Database\Factories\FornitoreFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FornitoreFactory extends Factory
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
            'partita_iva' => fake()->name(),
        ];
    }
}
