<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Evento;
use App\Models\Band;
use App\Models\Locale;


class LocandinaTest extends TestCase
{
    use RefreshDatabase;

    public function test_filtro_data()
    {
        $utente = User::factory()->create([ 'hasBand' => User::HA_UNA_BAND ]);

        $band = Band::factory()->create([ 'user_id' => $utente->id ]);

        $locale = Locale::factory()->create([ 'band_id' => $band->id ]);

        $evento = Evento::factory()->create([
            'nome_evento' => 'Nome evento da testare',
            'data_evento' => '2022-08-30',
            'band_id' => $band->id,
            'locale_id' => $locale->id,
        ]);

        $response = $this->actingAs($utente)->post('locandina/filtro', [
            'dataEvento' => '2022-08-30',
        ]);

        $response = $this->get(route('locandina.lista'))
                    ->assertSee('Nome evento da testare')
                    ->assertOk();
    }

    public function test_filtro_ora()
    {
        $utente = User::factory()->create([ 'hasBand' => User::HA_UNA_BAND ]);

        $band = Band::factory()->create([ 'user_id' => $utente->id ]);

        $locale = Locale::factory()->create([ 'band_id' => $band->id ]);

        $evento = Evento::factory()->create([
            'nome_evento' => 'Nome evento da testare',
            'ora' => '14:36:00',
            'band_id' => $band->id,
            'locale_id' => $locale->id,
        ]);

        $response = $this->actingAs($utente)->post('locandina/filtro', [
            'ora' => '14:36:00',
        ]);

        $response = $this->get(route('locandina.lista'))
                    ->assertSee('Nome evento da testare')
                    ->assertOk();
    }
}
