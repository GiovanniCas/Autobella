<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RicambiOrdinatiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ricambio_id' => 1,
            'testata_id' => 1,
            'quantita' => 2,
            'prezzo_unitario' => '$ 44.00'
        ];
    }
}
