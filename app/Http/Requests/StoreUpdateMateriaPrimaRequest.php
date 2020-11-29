<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateMateriaPrimaRequest extends FormRequest
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
            "nome" => "required|min:3|max:150|unique:materia_primas,nome,{$id},id", 
            "tipo_produto_id" =>"required", 
            "unidade_id" =>"required", 
            "estoque_inicial" =>"required", 
            "estoque_minimo" =>"nullable", 
            "preco_compra" =>"required", 
            "marge_venda" =>"required", 
            "sigla" =>"nullable", 
            "composicao" =>"nullable|min:3|max:150", 
            "core_id" =>"nullable", 
            'descricao' => "nullable|min:3|max:1000",
        ];
    }
}
