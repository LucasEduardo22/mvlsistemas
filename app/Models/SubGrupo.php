<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubGrupo extends Model
{
    protected $fillable = ['nome', 'grupo_id', 'sigla', 'descricao'];

    public function produtos(){
        return $this->belongsTo(Produto::class);
    }
}
