<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Band;
use App\Models\User;

class BandFactory extends Factory
{
    protected $model = Band::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $utente = User::factory()->create([
            'hasBand' => User::HA_UNA_BAND,
        ]);

        Storage::fake('test_immagine');

        return [
            'name_band' => $this->faker->name(),
            'phone_band' => $this->faker->PhoneNumber(),
            'user_id' => $utente->id,
            'image_path' => UploadedFile::fake()->image('avatar.jpeg'),
        ];
    }
}
