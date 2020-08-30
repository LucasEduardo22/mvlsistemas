<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome', 'sigla', 'descricao'];
}
