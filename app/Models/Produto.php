<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ["modelo", "nome_produto", "categoria_id", "tipo_produto_id", "status_id", "descricao"];
    
    public function categoria(){
        return $this->belongsTo(Categoria::class, );
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
