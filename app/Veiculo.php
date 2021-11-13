<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = ['placa', 'modelo', 'marca', 'color', 'tipo_id'];

    protected $table = 'veiculos';
}
