<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEstoqueRequest extends FormRequest
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
            "estoque_inicial" => "required", 
            "estoque_minimo" => "required", 
            'preco_venda' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'preco_compra' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            "unidade_id" =>"required|numeric", 
            "tamanho_id" =>"required|numeric",
            'cor' => "required|min:3|max:50",
        ];
    }
}
