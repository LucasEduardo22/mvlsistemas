<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSubGrupoRequest extends FormRequest
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
            'nome' => "required|min:3|max:150|unique:sub_grupos,nome,{$id},id",
            'sigla' => "required|min:2|max:10|unique:sub_grupos,sigla,{$id},id",
            'grupo_id' => "required",
            'descricao' => "nullable|min:3|max:150",
        ];
    }
}
