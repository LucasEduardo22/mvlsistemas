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
            "nome" => "required|string|min:3|max:150|unique:produtos,nome,{$id},id",
            "tamanho_id" => "required|numeric",
            "tipoproduto_id" => "required|numeric",
            "unidade_id" => "required|numeric",
            "codigo_referencia" => "required|string|min:3|max:150",
            "categoria_id" => "required",
        ];
    }
}
