<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome_cliente', 'razao_social', 'email', 'nome_responsavel', 'cnpj', 'telefone', 'cep', 
        'inscricao_estadual', 'estado', 'cidade', 'bairro', 'endereco', 'numero', 'complemento', 
        'classificacao', 'status_id'
    ];

    public function search($filtro = null){
        $result = $this->where('id', $filtro )
                ->orWhere('nome_cliente', 'LIKE', "%{$filtro}%")->paginate(10);
        return $result;
    }
}
