<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventi';

    protected $fillable = [
        'nome_evento',
        'data_evento',
        'band_id',
        'ora',
        'compenso',
    ];

}
