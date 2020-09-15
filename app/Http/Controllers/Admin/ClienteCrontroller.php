<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteCrontroller extends Controller
{
    protected $dadosCliente;

    public function __construct(Cliente $cliente)
    {
        $this->dadosCliente = $cliente;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = $this->dadosCliente->paginate();

        return view('admin.cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClienteRequest $request)
    {
        $request->merge([
            'cpf_cnpj' => str_replace(['.', '/','-'], '', $request->cpf_cnpj),
            'cep' => str_replace(['-'], '', $request->cep),
            //'ie' => str_replace(['.', '-'], '', $request->ie),
            'telefone' => str_replace(['(', ')', ' ','-'], '', $request->telefone),
            'celular' => str_replace(['(', ')', ' ','-'], '', $request->celular),
        ]);
        $this->dadosCliente->create($request->all());
        return redirect()->route('cliente.index')->with('success', 'Cliente cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->dadosCliente->find($id);

        if(!$cliente){
            return redirect()->back();
        }

        return view('admin.cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = $this->dadosCliente->find($id);

        if(!$cliente){
            return redirect()->back();
        }

        return view('admin.cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateClienteRequest $request, $id)
    {
        $request->merge([
            'cpf_cnpj' => str_replace(['.', '/','-'], '', $request->cpf_cnpj),
            'cep' => str_replace(['-'], '', $request->cep),
            //'ie' => str_replace(['.', '-'], '', $request->ie),
            'telefone' => str_replace(['(', ')', ' ','-'], '', $request->telefone),
            'celular' => str_replace(['(', ')', ' ','-'], '', $request->celular),
        ]);
        $cliente = $this->dadosCliente->find($id);

        if(!$cliente){
            return redirect()->back();
        }

        $cliente->update($request->all());
        return redirect()->route('cliente.index')->with('success', 'Dados atualizado com sucesso..');
    }

    public function search(Request $request){
    
        $clientes = $this->dadosCliente->search($request->filtrar);
        $filtros = $request->except('_token');
        return view('admin.cliente.index', compact('clientes', 'filtros'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
