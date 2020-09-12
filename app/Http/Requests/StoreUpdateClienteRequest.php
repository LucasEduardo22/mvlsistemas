<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3);
        return [
            "nome" => "required|min:3|max:150",
            "razao_social" => "required|min:3|max:150",
            "cpf_cnpj" => "required|unique:clientes,nome,{$id},id",
            "ie" => "required|unique:clientes,nome,{$id},id",
            "telefone" => "required",
            "celular" => "required",
            "contato_principal" => "required",
            "classificacao" => "nullable|min:3|max:150",
            "email" => "required|email|min:3|max:150", 
            "endereco" => "required|min:3|max:255",
            "bairro" => "required|min:3|max:50",
            "cidade" => "required|min:3|max:50",
            "estado" => "required|min:3|max:50",
            "cep" => "required|max:9",
            "numero" => "required",
            "complemento" => "nullable|min:3|max:50",
        ];
    }
}
