<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Band;
use App\Models\Locale;
use App\Models\Evento;


class EventoTest extends TestCase
{
    use DatabaseTransactions;

    public function  test_aggiungi_evento()
    {
        $utente = User::factory()->create([ 'hasBand' => 1 ]);

        $band = Band::factory()->create([ 'user_id' => $utente->id ]);

        $locale = Locale::factory()->create([ 'band_id' => $band->id ]);

        $response = $this->actingAs($utente)->post(route('evento.salva'), [
            'nomeEvento'=> 'Evento Test',
            'idBand'    => $band->id,
            'dataEvento'=> '2022-08-30',
            'idEvento'  => null,
            'oraEvento' => '12:12',
            'compenso'  => '12',
            'locale'    => $locale->id,
        ]);

        $this->assertDatabaseHas('eventi', [
            'nome_evento'   => 'Evento Test',
            'data_evento'   => '2022-08-30',
            'ora'           => '12:12',
            'compenso'      => '12',
            'band_id'       => $band->id,
            'locale_id'     => $locale->id,
        ]);
    }

    public function  test_modifica_evento()
    {
        $utente = User::factory()->create([ 'hasBand' => 1 ]);

        $band = Band::factory()->create([ 'user_id' => $utente->id ]);

        $locale = Locale::factory()->create([ 'band_id' => $band->id ]);

        $evento = Evento::factory()->create([
            'nome_evento'   => 'Evento Test',
            'data_evento'   => '2022-08-30',
            'ora'           => '12:12',
            'compenso'      => '12',
            'band_id'       => $band->id,
            'locale_id'     => $locale->id,
        ]);


        $response = $this->actingAs($utente)->post(route('evento.salva'), [
            'nomeEvento'    => 'Evento Aggiornato Test',
            'idBand'        => $band->id,
            'dataEvento'    => '2022-08-30',
            'idEvento'      => $evento->id,
            'oraEvento'     => '12:12',
            'compenso'      => '12',
            'locale'        => $locale->id,
        ]);

        $this->assertDatabaseHas('eventi', [
            'nome_evento'   => 'Evento Aggiornato Test',
            'data_evento'   => '2022-08-30',
            'ora'           => '12:12',
            'compenso'      => '12',
            'band_id'       => $band->id,
            'locale_id'     => $locale->id,
        ]);
    }

    public function  test_elimina_evento()
    {
        $utente = User::factory()->create([ 'hasBand' => 1 ]);

        $band = Band::factory()->create([ 'user_id' => $utente->id ]);

        $locale = Locale::factory()->create([ 'band_id' => $band->id ]);

        $evento = Evento::factory()->create([
            'nome_evento'   => 'Evento Test',
            'data_evento'   => '2022-08-30',
            'ora'           => '12:12',
            'compenso'      => '12',
            'band_id'       => $band->id,
            'locale_id'     => $locale->id,
        ]);


        $response = $this->actingAs($utente)->delete(route('evento.elimina'), [
            'id' => $evento->id
        ]);

        $this->assertDatabaseMissing('eventi', [
            'nome_evento'   => 'Evento Aggiornato Test',
            'data_evento'   => '2022-08-30',
            'ora'           => '12:12',
            'compenso'      => '12',
            'band_id'       => $band->id,
            'locale_id'     => $locale->id,
        ]);
    }

    public function test_eliminazione_eventi_di_un_certo_range()
    {
        $utente = User::factory()->create([ 'hasBand' => 1 ]);

        $band = Band::factory()->create([ 'user_id' => $utente->id ]);

        $locale = Locale::factory()->create([ 'band_id' => $band->id ]);

        $evento1 = Evento::factory()->create([
            'data_evento'   => '2022-08-02',
            'band_id'       => $band->id,
            'locale_id'     => $locale->id,
        ]);

        $evento2 = Evento::factory()->create([
            'data_evento'   => '2022-08-03',
            'band_id'       => $band->id,
            'locale_id'     => $locale->id,
        ]);

        $evento3 = Evento::factory()->create([
            'data_evento'   => '2022-08-10',
            'band_id'       => $band->id,
            'locale_id'     => $locale->id,
        ]);

        $response = $this->actingAs($utente)->post(route('evento.filtro'), [
            "da"    => '2022-08-01',
            "a"     => '2022-08-07'
        ]);

        $this->assertDatabaseMissing('eventi', [
            'id' => $evento1->id
        ]);

        $this->assertDatabaseMissing('eventi', [
            'id' => $evento2->id
        ]);

        $this->assertDatabaseHas('eventi', [
           'id' => $evento3->id
        ]);
    }
}
