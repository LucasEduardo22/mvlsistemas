<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ["modelo", "nome_produto", "grupo_id", "tipo_produto_id", "status_id", "descricao"];
    
    public function grupo(){
        return $this->belongsTo(Grupo::class, );
    }

    public function tipoProduto(){
        return $this->belongsTo(TipoProduto::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function estoque(){
        return $this->hasOne(Estoque::class);
    }
}
