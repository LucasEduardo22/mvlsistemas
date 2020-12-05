<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTabelaPrecoRequest extends FormRequest
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
            'nome' => "required|min:3|max:150|unique:forma_pagamentos,nome,{$id},id",
            'ganho' => "required|min:1|max:10",
            'descricao' => "nullable|min:1|max:150",
        ];
    }
}
