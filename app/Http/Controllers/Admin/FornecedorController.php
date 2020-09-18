<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFornecedorRequest;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    protected $dadosFornecedor;

    public function __construct(Fornecedor $fornecedor)
    {
        $this->dadosFornecedor = $fornecedor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fornecedors = $this->dadosFornecedor->paginate();

        return view('admin.fornecedor.index', compact('fornecedors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fornecedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateFornecedorRequest $request)
    {
        $request->merge([
            'cpf_cnpj' => str_replace(['.', '/','-'], '', $request->cpf_cnpj),
            'cep' => str_replace(['-'], '', $request->cep),
            //'ie' => str_replace(['.', '-'], '', $request->ie),
            'telefone' => str_replace(['(', ')', ' ','-'], '', $request->telefone),
            'celular' => str_replace(['(', ')', ' ','-'], '', $request->celular),
        ]);
        $data = $request->all();
        $data['status_id'] = 1; //padrão ativo 
        $this->dadosFornecedor->create($data);
        return redirect()->route('fornecedor.index')->with('success', 'Fornecedor cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fornecedor = $this->dadosFornecedor->find($id);

        if(!$fornecedor){
            return redirect()->back();
        }

        return view('admin.fornecedor.show', compact('fornecedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fornecedor = $this->dadosFornecedor->find($id);

        if(!$fornecedor){
            return redirect()->back();
        }

        return view('admin.fornecedor.edit', compact('fornecedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateFornecedorRequest $request, $id)
    {
        $request->merge([
            'cpf_cnpj' => str_replace(['.', '/','-'], '', $request->cpf_cnpj),
            'cep' => str_replace(['-'], '', $request->cep),
            //'ie' => str_replace(['.', '-'], '', $request->ie),
            'telefone' => str_replace(['(', ')', ' ','-'], '', $request->telefone),
            'celular' => str_replace(['(', ')', ' ','-'], '', $request->celular),
        ]);

        $fornecedor = $this->dadosFornecedor->find($id);

        if(!$fornecedor){
            return redirect()->back();
        }
        $data = $request->all();
        $data['status_id'] = 1; //padrão ativo 
        $fornecedor->update($data);
        return redirect()->route('fornecedor.index')->with('success', 'Dados atualizado com sucesso..');
    }

    public function search(Request $request){
    
        $fornecedors = $this->dadosFornecedor->search($request->filtrar);
        $filtros = $request->except('_token');
        return view('admin.fornecedor.index', compact('fornecedors', 'filtros'));
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
