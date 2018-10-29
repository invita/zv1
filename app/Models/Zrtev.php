<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Zrtev
 *
 * @property int $ID
 * @property string $PRIIMEK
 * @mixin \Eloquent
 */
class Zrtev extends Model
{
    protected $table = 'ZRT1_GLAVNA_TABELA';
    protected $fillable = [
        'ID',
        'PRIIMEK',
        'PRIIMEK2',
        'IME',
        'STARSI',
        'ROJSTVO',
        'KRAJ_ROJSTVA',
        'ZUPNIJA',
        'BIVALISCE',
        'OBCINA',
        'DEZELA',
        'DOMOVINSKA',
        'STAN',
        'VPOKLIC',
        'SMRT',
        'KRAJ_SMRTI',
        'VZROK',
        'POKOP',
        'CIN',
        'ENOTA',
        'OSTALO',
        'VIRI',
        'IZVOR',
        'OPOMBE',
    ];

}
