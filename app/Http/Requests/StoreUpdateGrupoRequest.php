<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateGrupoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'nome' => "required|min:3|max:150|unique:subGrupos,nome,{$id},id",
            'sigla' => "required|min:2|max:10|unique:subGrupos,sigla,{$id},id",
            'departamento_id' => "required",
            'descricao' => "nullable|min:3|max:150",
        ];
    }
}