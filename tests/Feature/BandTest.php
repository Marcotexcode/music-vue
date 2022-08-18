<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Band;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BandTest extends TestCase
{
    use RefreshDatabase;

    public function test_utente_che_non_ha_una_band_può_creare_band()
    {
        Storage::fake('test_immagine');

        $utente = User::factory()->create([
            'hasBand' => User::NON_HA_UNA_BAND,
        ]);

        $file = UploadedFile::fake()->image('avatar.jpeg');

        $response = $this->actingAs($utente)->post("/band/salva", [
            'nameBand' => 'rockin',
            'phoneBand' => '32455654',
            'image' => $file,
        ]);

        $this->assertDatabaseHas('band', [
            'name_band' => 'rockin',
            'phone_band' => '32455654',
            'user_id' => $utente->id,
            'image_path' => 'immagine_band/' . $file->hashName(),
        ]);
    }

    public function test_utente_che_ha_già_una_band_non_può_crearne_un_altra()
    {
        Storage::fake('test_immagine');

        $utente = User::factory()->create([
            'hasBand' => User::HA_UNA_BAND,
        ]);

        $file = UploadedFile::fake()->image('avatar.jpeg');

        $response = $this->actingAs($utente)->post("/band/salva", [
            'nameBand' => 'rockin',
            'phoneBand' => '32455654',
            'image' => $file,
        ]);

        $this->assertDatabaseMissing('band', [
            'name_band' => 'rockin',
            'phone_band' => '32455654',
            'user_id' => $utente->id,
            'image_path' => 'immagine_band/' . $file->hashName(),
        ]);
    }


    public function test_utente_può_modificare_band()
    {
        Storage::fake('test_immagine');

        $utente = User::factory()->create([
            'hasBand' => User::HA_UNA_BAND,
        ]);

        $file = UploadedFile::fake()->image('avatar.jpeg');

        $recordBand = Band::factory()->create([
            'name_band' => 'Pippo Band',
            'phone_band' => '4335654',
            'user_id' => $utente->id,
            'image_path' => 'immagine_band/' . $file->hashName(),
        ]);

        $response = $this->actingAs($utente)->post("/band/aggiorna", [
            'img_vecchia' => 'immagine_band/' . $file->hashName(),
            'idBand' => $recordBand->id,
            'name_band' => 'Pluto Band',
            'phone_band' => '4335654',
            'user_id' => $utente->id,
            'image_path' => $file,
        ]);

        $this->assertDatabaseHas('band', [
            'id' => $recordBand->id,
            'name_band' => 'Pluto Band',
            'phone_band' => '4335654',
            'user_id' => $utente->id,
        ]);
    }

    // Creare un test che modifica la band e un test che modifica l'immagine e asserire
    // anche che una volta modificata l'immagine quella vecchia venga cancellata
}
