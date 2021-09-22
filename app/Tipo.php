<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{

    //use HasFactory;

    protected $fillable = ['descricao'];
    //protected $rules = ['descricao'=>'required|min:4'];
}
