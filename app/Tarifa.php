<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $fillable = [
        'tempo',
        'descricao',
        'custo',
        'tipo_id',
        'hierarquia'
    ];

    protected $table = 'tarifas';
}
