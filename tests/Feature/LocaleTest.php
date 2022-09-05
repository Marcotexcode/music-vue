<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Band;

class LocaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_aggiunta_locale()
    {
        $utente = User::factory()->create([
            'hasBand' => User::HA_UNA_BAND,
        ]);

        $band = Band::factory()->create([ 'user_id' => $utente->id ]);

        $response = $this->actingAs($utente)->post(route('locale.salva'), [
            'nome' => 'Mamiwata',
            'indirizzo' => 'via delle caserme',
            'provincia' => 'Pescara',
            'cap' => '43225',
            'regione' => 'Abruzzo',
            'telefono' => '342554432',
            'tipo' => 'Pub',
            'band_id' => $band->id,
        ]);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('locale', [
            'nome' => 'Mamiwata',
            'indirizzo' => 'via delle caserme',
            'provincia' => 'Pescara',
            'cap' => '43225',
            'regione' => 'Abruzzo',
            'telefono' => '342554432',
            'tipo' => 'Pub',
            'band_id' => $band->id,
        ]);
    }

    public function test_validazione_aggiunta_locale()
    {
        $utente = User::factory()->create([
            'hasBand' => User::HA_UNA_BAND,
        ]);

        $band = Band::factory()->create([ 'user_id' => $utente->id ]);

        $response = $this->actingAs($utente)->post(route('locale.salva'), [
            'nome' => 'Mamiwata',
            'indirizzo' => '',
            'provincia' => '',
            'cap' => '43225',
            'regione' => 'Abruzzo',
            'telefono' => '342554432',
            'tipo' => 'Pub',
            'band_id' => $band->id,
        ]);

        $response->assertSessionHasErrors();
    }
}
