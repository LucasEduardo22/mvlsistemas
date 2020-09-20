<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aviamento extends Model
{
    protected $fillable = ['nome', 'departamento_id', 'sigla', 'descricao'];

    
}
