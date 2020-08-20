<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    protected  $fillable = [
        'produto_id', 'descricao', 'aviamento', 'observacao',
    ];
}
