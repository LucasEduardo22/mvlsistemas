<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome','tamanho_id','unidade_id','tipoproduto_id','codigo_referencia','categoria_id', 'status_id'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function fichaTecnica(){
        return $this->hasOne(FichaTecnica::class);
    }

    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }

    public function tamanho(){
        return $this->belongsTo(Tamanho::class);
    }

    public function tipoProduto(){
        return $this->belongsTo(TipoProduto::class, 'tipoproduto_id', 'id');
    }

    public function search($filtro = null){
        $result = $this->where('id', $filtro )
                ->orWhere('nome', 'LIKE', "%{$filtro}%")->paginate(10);
        return $result;
    }

}
