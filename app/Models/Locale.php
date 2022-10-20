<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    use HasFactory;

    protected $table = 'locale';

    /**
	 * @inheritDoc
	 *
	 * @var array
	 */
	protected $guarded = [];
}
