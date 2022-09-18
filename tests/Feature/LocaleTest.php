<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Evento;
use App\Models\Locale;
use App\Models\Band;
use Tests\TestCase;

class LocaleTest extends TestCase
{
    use DatabaseTransactions;

    public function test_aggiunta_locale()
    {
        $utente = User::factory()->create([ 'hasBand' => User::HA_UNA_BAND ]);

        $band = Band::factory()->create();

        $datiLocale = [
            'nome'      => 'Mamiwata',
            'indirizzo' => 'Via delle caserme',
            'provincia' => 'PE',
            'cap'       => '34223',
            'regione'   => 'Abruzzo',
            'telefono'  => '34566543',
            'tipo'      => 'Pub',
            'band_id'   => $band->id,
        ];

        $response = $this->actingAs($utente)->post(route('locale.salva-modifica'),  $datiLocale );

        $this->assertDatabaseHas('locale', $datiLocale );
    }

    public function test_aggiorna_locale()
    {
        $utente = User::factory()->create([ 'hasBand' => User::HA_UNA_BAND ]);
        $band = Band::factory()->create();
        $locale = Locale::factory()->create([
            'nome'      => 'Mamiwata',
            'indirizzo' => 'Via delle caserme',
            'provincia' => 'PE',
            'cap'       => '34223',
            'regione'   => 'Abruzzo',
            'telefono'  => '34566543',
            'tipo'      => 'Pub',
            'band_id'   => $band->id,
        ]);

        $datiLocaleAggiornato = [
            'idLocale'  => $locale->id,
            'nome'      => 'Nuovo Locale',
            'indirizzo' => 'Nuovo indirizzo',
            'provincia' => 'MI',
            'cap'       => '4355',
            'regione'   => 'Milano',
            'telefono'  => '6577890',
            'tipo'      => 'Ristorante',
            'band_id'   => $band->id,
        ];

        $response = $this->actingAs($utente)->post(route('locale.salva-modifica'), $datiLocaleAggiornato );

        unset($datiLocaleAggiornato['idLocale']);

        $datiLocaleAggiornato['id'] = $locale->id;

        $this->assertDatabaseHas('locale', $datiLocaleAggiornato );
    }

    public function test_se_il_locale_non_fà_parte_di_un_evento_si_può_eliminare()
    {
        $utente = User::factory()->create([ 'hasBand' => User::HA_UNA_BAND ]);
        $band = Band::factory()->create();
        $locale = Locale::factory()->create();

        $response = $this->actingAs($utente)->delete(route('locale.elimina'), [ 'idLocale' => $locale->id] );

        $this->assertDatabaseMissing('locale', [ 'id' => $locale->id ]);
    }

    public function test_se_il_locale_fà_parte_di_un_evento_non_si_può_eliminare()
    {
        $utente = User::factory()->create([ 'hasBand' => User::HA_UNA_BAND ]);
        $band = Band::factory()->create();
        $locale = Locale::factory()->create();
        $evento = Evento::factory()->create([ 'locale_id' => $locale->id ]);

        $response = $this->actingAs($utente)->delete(route('locale.elimina'), [ 'idLocale' => $locale->id] );

        $this->assertDatabaseHas('locale', [ 'id' => $locale->id ]);
    }

    public function test_il_locale_creato_da_quella_band_può_essere_solo_di_quella_band()
    {
        $utente1 = User::factory()->create([
            'hasBand' => User::HA_UNA_BAND
        ]);

        $utente2 = User::factory()->create([
            'hasBand' => User::HA_UNA_BAND
        ]);

        $band1 = Band::factory()->create([
            'user_id' => $utente1->id
        ]);

        $band2 = Band::factory()->create([
            'user_id' => $utente2->id
        ]);

        $locale = Locale::factory()->create([
            'band_id'   => $band1->id,
            'nome'      => 'Nome_Locale_Da_Testare'
        ]);

        $response = $this->actingAs($utente1)->get(route('locale.lista'));

        $response->assertSee('Nome_Locale_Da_Testare');

        $response = $this->actingAs($utente2)->get(route('locale.lista'));

        $response->assertDontSee('Nome_Locale_Da_Testare');
    }

}
