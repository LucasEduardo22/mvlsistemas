<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "status";
    protected $fillable = ['nome', 'descricao'];

    const ATIVO = 1;
    const PENDENTE = 2;
}
