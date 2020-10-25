<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTamanhoRequest extends FormRequest
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
            'nome' => "required|min:2|max:150|unique:tamanhos,nome,{$id},id",
            'sigla' => "required|min:1|max:10|unique:tamanhos,sigla,{$id},id",
            'tipo' => "required",
            'descricao' => "nullable|min:3|max:150",
        ];
    }
}
