<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Band;

class LocaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $band = Band::factory()->create();

        return [
            'nome' => $this->faker->name(),
            'indirizzo' => $this->faker->secondaryAddress(),
            'provincia' => $this->faker->cityPrefix(),
            'cap' => $this->faker->postcode(),
            'regione' => $this->faker->state(),
            'telefono' => $this->faker->e164PhoneNumber(),
            'tipo' => 'pub',
            'band_id' => $band->id,
        ];
    }
}
