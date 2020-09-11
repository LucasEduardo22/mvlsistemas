<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = ['nome', 'sigla', 'descricao'];

    public function grupo(){
        return $this->belongsTo(Departamento::class);
    }
}
