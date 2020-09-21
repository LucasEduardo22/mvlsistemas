<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    protected $fillable = ['aviamento_id', 'produto_id' ,'detalhes', "observacao"];
}
