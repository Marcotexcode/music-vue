<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Band;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BandTest extends TestCase
{
    use DatabaseTransactions;

    public function test_utente_che_non_ha_una_band_può_creare_band()
    {
        Storage::fake('test_immagine');

        $utente = User::factory()->create([
            'hasBand' => User::NON_HA_UNA_BAND,
        ]);

        $file = UploadedFile::fake()->image('avatar.jpeg');

        $response = $this->actingAs($utente)->post(route('band.salva'), [
            'nameBand'  => 'rockin',
            'phoneBand' => '32455654',
            'image'     => $file,
        ]);

        $this->assertDatabaseHas('band', [
            'name_band'     => 'rockin',
            'phone_band'    => '32455654',
            'user_id'       => $utente->id,
            'image_path'    => 'immagine_band/' . $file->hashName(),
        ]);
    }

    public function test_utente_che_ha_già_una_band_non_può_creare_un_altra_band()
    {
        Storage::fake('test_immagine');

        $utente = User::factory()->create([
            'hasBand' => User::HA_UNA_BAND,
        ]);

        $file = UploadedFile::fake()->image('avatar.jpeg');

        $response = $this->actingAs($utente)->post(route('band.salva'), [
            'nameBand'  => 'rockin',
            'phoneBand' => '32455654',
            'image'     => $file,
        ]);

        $this->assertDatabaseMissing('band', [
            'name_band' => 'rockin',
            'phone_band'=> '32455654',
            'user_id'   => $utente->id,
            'image_path'=> 'immagine_band/' . $file->hashName(),
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
            'phone_band'=> '4335654',
            'user_id'   => $utente->id,
            'image_path'=> 'immagine_band/' . $file->hashName(),
        ]);

        $response = $this->actingAs($utente)->post("/band/aggiorna", [
            'img_vecchia'   => 'immagine_band/' . $file->hashName(),
            'idBand'        => $recordBand->id,
            'name_band'     => 'Pluto Band',
            'phone_band'    => '4335654',
            'user_id'       => $utente->id,
            'image_path'    => $file,
        ]);

        $this->assertDatabaseHas('band', [
            'id'        => $recordBand->id,
            'name_band' => 'Pluto Band',
            'phone_band'=> '4335654',
            'user_id'   => $utente->id,
        ]);
    }

    public function test_a_immagine_modificata_quella_vecchia_viene_eliminata()
    {
        Storage::fake('test_immagine');

        $utente = User::factory()->create([
            'hasBand' => User::HA_UNA_BAND,
        ]);

        $immagineVecchia = UploadedFile::fake()->image('vecchia.jpeg');

        $immagineNuova = UploadedFile::fake()->image('nuova.jpeg');

        $recordBand = Band::factory()->create([
            'name_band' => 'Pippo Band',
            'phone_band'=> '4335654',
            'user_id'   => $utente->id,
            'image_path'=> $immagineVecchia,
        ]);

        $response = $this->actingAs($utente)->post("/band/aggiorna", [
            'img_vecchia'   => UploadedFile::fake()->image('vecchia.jpeg'),
            'idBand'        => $recordBand->id,
            'name_band'     => 'Pluto Band',
            'phone_band'    => '4335654',
            'user_id'       => $utente->id,
            'image_path'    => $immagineNuova,
        ]);

        Storage::disk('test_immagine')->assertExists("immagine_band/{$immagineNuova->hashName()}");
        Storage::disk('test_immagine')->assertMissing("immagine_band/{$immagineVecchia->hashName()}");
    }
}
