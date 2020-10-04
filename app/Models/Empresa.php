<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = 
                    [
                        "nome", "razao_social", "cpf_cnpj", "ie", "telefone", 
                        "celular", "contato_principal", "classificacao", "email", 
                        "endereco", "bairro", "cidade", "estado", "cep", "numero", 
                        "complemento", "image",
                    ];
}
