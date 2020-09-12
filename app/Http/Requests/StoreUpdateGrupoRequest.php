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
            'nome' => "required|min:3|max:150|unique:grupos,nome,{$id},id",
            'sigla' => "required|min:2|max:10|unique:grupos,sigla,{$id},id",
            'departamento_id' => "required",
            'descricao' => "nullable|min:3|max:150",
        ];
    }
}
