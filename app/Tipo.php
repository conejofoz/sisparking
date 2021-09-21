<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $fillable = ['descricao'];
    //protected $rules = ['descricao'=>'required|min:4'];
}
