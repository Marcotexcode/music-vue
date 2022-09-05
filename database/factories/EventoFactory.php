<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Locale;


class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $locale = Locale::factory()->create();

        return [
            'nome_evento' => $this->faker->name(),
            'data_evento' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'ora' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'compenso' => $this->faker->numberBetween($min = 100, $max = 500),
            'band_id' => $locale->band_id,
            'locale_id' => $locale->id,
        ];
    }
}
