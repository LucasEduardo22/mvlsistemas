<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    protected $fillable = ['aviamento_id', 'produto_id' ,'detalhes', "observacao"];

    public function produtosAviamento(){
        return $this->hasOne(Aviamento::class, 'id', 'aviamento_id');
    }
    public function aviamentoProdutos(){
        return $this->hasMany(Aviamento::class);
    }
}
