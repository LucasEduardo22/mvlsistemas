<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubGrupo extends Model
{
    protected $table = "sub_grupos";
    protected $fillable = ['nome', 'grupo_id', 'sigla', 'descricao'];

    public function grupo(){
        return $this->hasOne(Grupo::class, 'id', 'grupo_id');
    }
    public function produtos(){
        return $this->belongsTo(Produto::class);
    }
}
