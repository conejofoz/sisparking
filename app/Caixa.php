<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{

    protected $fillable = ['descricao', 'tipo_id', 'status'];

    
}
