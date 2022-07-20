<?php

namespace Database\Factories;

use App\Models\Marche;
use Database\Factories\MarcaFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MarcaFactory extends Factory
{
    

    public function definition()
    {
        return [
            'nome' => fake()->name(),
        ];
    }
}
