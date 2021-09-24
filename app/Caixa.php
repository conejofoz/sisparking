<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    protected $table = 'caixas';

    protected $fillable = ['valor', 'tipo', 'descricao', 'comprovante', 'user_id'];
}
