<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ["modelo", "nome_produto", "sub_grupo_id", "tipo_produto_id", "status_id", "descricao", "image", "aviamento", "observacao"];
    
    public function subGrupo(){
        return $this->belongsTo(SubGrupo::class, );
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
