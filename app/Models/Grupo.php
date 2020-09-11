<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = ['nome', 'departamento_id', 'sigla', 'descricao'];


    public function departamento(){
        return $this->hasMany(Departamento::class);
    }

    public function subGrupo(){
        return $this->belongsTo(SubGrupo::class);
    }
}
