<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use App\Cliente;

class ClienteController extends Controller
{
    private $repositorio;

    public function __construct(Cliente $cliente){
        $this->repositorio = $cliente;
    }

    public function index(){
        $clientes = Cliente::paginate(10);
        return view('cliente.index', compact('clientes'));
    }

    public function create(){
        
        return view('cliente.create');
    }

    public function store(ClienteRequest $request){
        $cliente = $this->repositorio->where('cnpj', $request->cpnj)
                        ->orWhere('email', $request->email)->get();

        $ie = $this->repositorio->where('inscricao_estadual', $request->inscricao_estadual);
        if ($cliente->count() != 0) {
            return redirect()
                ->back()
                ->with('error', 'Já existe um cliente cadastrado no sistema com esse CNPJ ou E-mail');
        } else {
            if (!empty($ie) && $ie->count() != 0) {
                return redirect()
                    ->back()
                    ->with('error', 'Já existe um cliente cadastrado no sistema com esse IE');
            } else {
                $request->merge([
                    'cnpj' => str_replace(['.', '/','-'], '', $request->cnpj),
                    'cep' => str_replace(['-'], '', $request->cep),
                    'inscricao_estadual' => str_replace(['-'], '', $request->inscricao_estadual),
                    'telefone' => str_replace(['(', ')', ' ','-'], '', $request->telefone),
                ]);

                $dados = $request->all();
                $dados['status_id'] = "1";
                $this->repositorio->create($dados);
                return redirect()
                    ->route('cliente.index')
                    ->with('success', 'Cliente cadastrado com sucesso');
            }
        }        
    }

    public function edit($id){
        $cliente = $this->repositorio->find($id);
        return view('cliente.edit', compact('cliente'));
    }
    public function update(Request $request, $id){
        $request->merge([
            'cnpj' => str_replace(['.', '/','-'], '', $request->cnpj),
            'cep' => str_replace(['-'], '', $request->cep),
            'inscricao_estadual' => str_replace(['.', '-'], '', $request->inscricao_estadual),
            'telefone' => str_replace(['(', ')', ' ','-'], '', $request->telefone),
        ]);

        $dados = $request->all();

        $cliente = $this->repositorio->find($id);
        $cliente->update($dados);
        return redirect()
            ->route('cliente.index')
            ->with('success', 'Cliente atualizado com sucesso');
    }

    public function search(Request $request){
    
        $clientes = $this->repositorio->search($request->filtrar);
        $filtros = $request->except('_token');
        return view('cliente.index', compact('clientes', 'filtros'));
    }

}
