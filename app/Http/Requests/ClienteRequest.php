<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
        return [
            'nome_cliente' => 'required|string|min:3|max:150',
            'razao_social' => 'required|string|min:3|max:150',
            'email' => 'required|string|min:3|max:150',
            'nome_responsavel' => 'required|string|min:3|max:150',
            'cnpj' => 'required|string|size:18',
            'telefone' => 'required|string|size:15',
            'cep' => 'required|string|size:9',
            'inscricao_estadual' => 'nullable|string|size:12',
            'estado' => 'required|string|max:50',
            'cidade' => 'required|string|max:50',
            'bairro' => 'required|string|max:50',
            'endereco' => 'required|string|max:255',
            'numero' => 'required',
            'complemento' => 'nullable|string|max:50',
            'classificacao' => 'nullable|string|min:3|max:150'
        ];
    }
}
