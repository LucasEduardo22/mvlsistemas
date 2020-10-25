<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = 
                    [
                        "nome", "razao_social", "cpf_cnpj", "ie", "telefone", 
                        "celular", "contato_principal", "classificacao", "email", 
                        "endereco", "bairro", "cidade", "estado", "cep", "numero", 
                        "complemento",
                    ];

    public function search($filtro = null){
        $result = $this->where('id', $filtro )
                ->orWhere('nome', 'LIKE', "%{$filtro}%")->paginate(15);

        return $result;
    }

   
}
