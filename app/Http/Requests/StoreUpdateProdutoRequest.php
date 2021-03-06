<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProdutoRequest extends FormRequest
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
            "modelo" => "required|min:3|max:50|unique:produtos,modelo,{$id},id", 
            "nome_produto" => "required|min:3|max:150|unique:produtos,nome_produto,{$id},id", 
            "sub_grupo_id" =>"required|numeric", 
            "valor_costura" =>"required", 
            "image" =>"nullable",
            'descricao' => "nullable|min:3|max:1000",
            'aviamento' => "nullable|min:3|max:1000",
            'observacao' => "nullable|min:3|max:1000",
        ];
    }
}
