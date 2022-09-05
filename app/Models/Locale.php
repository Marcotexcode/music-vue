<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    use HasFactory;

    protected $table = 'locale';

    protected $fillable = [
        'nome',
        'indirizzo',
        'provincia',
        'cap',
        'regione',
        'telefono',
        'tipo',
        'band_id',
    ];
}
