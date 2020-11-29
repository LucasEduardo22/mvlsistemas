<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ["modelo", "nome_produto", "sub_grupo_id", "tipo_produto_id", "status_id", "descricao", "image", "aviamento", "observacao"];

    public function search($filtro = null){
        $result = $this->where('modelo', $filtro )
                ->orWhere('nome_produto', 'LIKE', "%{$filtro}%")->simplePaginate(15);
        return $result;
    }
    
    public function subGrupo(){
        return $this->belongsTo(SubGrupo::class, );
    }

    public function tipoProduto(){
        return $this->belongsTo(TipoProduto::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function materiaPrimas(){
        return $this->hasMany(FichaTecnica::class);
    }

    public function estoque(){
        return $this->hasOne(Estoque::class);
    }

   
}