<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateMateriaPrimaRequest;
use App\Models\Cores;
use App\Models\MateriaPrima;
use App\Models\TipoProduto;
use App\Models\Unidade;
use Illuminate\Http\Request;

class MateriaPrimaController extends Controller
{
    private $dadosMateriaPrima, $dadosTipoProduto,  $dadosUnidade, $dadosCor;

    public function __construct(MateriaPrima $materiaPrima, TipoProduto $tipoProduto, Unidade $unidade, Cores $cores)
    {
        $this->dadosMateriaPrima = $materiaPrima;
        $this->dadosTipoProduto = $tipoProduto;
        $this->dadosUnidade = $unidade;
        $this->dadosCor = $cores;
    }

    public function index()
    {
        $materiaPrimas = $this->dadosMateriaPrima->simplePaginate();
        return view('admin.estoque.materia-prima.index', compact('materiaPrimas'));
    }

    public function create()
    {
        $materiaPrimas = $this->dadosMateriaPrima->simplePaginate();
        $tipoProdutos = $this->dadosTipoProduto->get();
        $unidades = $this->dadosUnidade->get();
        $cores = $this->dadosCor->get();
        return view('admin.estoque.materia-prima.create', compact('materiaPrimas', 'tipoProdutos', 'unidades', 'cores'));
    }

    public function show($id){
        $materiaPrima = $this->dadosMateriaPrima->find($id);

        if(!$materiaPrima){
            return redirect()->back();
        }

        return view('admin.estoque.materia-prima.show', compact('materiaPrima'));
    }

    public function edit($id)
    {
        $materiaPrima = $this->dadosMateriaPrima->find($id);
        $tipoProdutos = $this->dadosTipoProduto->get();
        return view('admin.estoque.materia-prima.edit', compact('materiaPrima', 'tipoProdutos'));
    }

    public function update(StoreUpdateMateriaPrimaRequest $request, $id)
    {
        $materiaPrima = $this->dadosMateriaPrima->find($id);

        if(!$materiaPrima){
            return redirect()->back();
        }
        $data = $request->all();
        
        $data['status_id'] = 1; //padrão ativo 

        $materiaPrima->update($data);
     
        return redirect()->route('materia-prima.index')->with('success', 'MateriaPrima cadastrada com sucesso..');
     
    }
}
