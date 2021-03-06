<?php

namespace Database\Factories;

use Database\Factories\ModelloFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ModelloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'marca_id' => 1,
            'nome' => fake()->name(),
            'anno_produzione' => '2017'
        ];
    }
}
