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

    public function store(StoreUpdateMateriaPrimaRequest $request)
    {
        $request->merge([
            "preco_compra" => str_replace(['.'], '', $request->preco_compra),
            "preco_compra" => str_replace([','],'.', $request->preco_compra),
            "estoque_inicial" => str_replace([','],'.', $request->estoque_inicial),
        ]);
        $dados = $request->all();
        
        $dados['status_id'] = 1; //padrão ativo 
        $dados['preco_compra'] =  $dados['preco_compra'] != '' ? $dados['preco_compra'] : null;
        $dados['estoque_atual'] =  $dados["estoque_inicial"] != '' ? $dados["estoque_inicial"] : null;
        $materiaPrima = $this->dadosMateriaPrima->create($dados);
        
        if($request->botao != 1){
            return redirect()->route('materia-prima.index')->with('success', 'MateriaPrima cadastrada com sucesso..');
        }else{
            return redirect()->route('materia-prima.fornecedor.create', $materiaPrima->id);
        }

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
        $unidades = $this->dadosUnidade->get();
        $cores = $this->dadosCor->get();
        return view('admin.estoque.materia-prima.edit', compact('materiaPrima', 'tipoProdutos', 'unidades', 'cores'));
    }

    public function update(StoreUpdateMateriaPrimaRequest $request, $id)
    {
        $materiaPrima = $this->dadosMateriaPrima->find($id);
        $request->merge([
            "preco_compra" => str_replace(['.'], '', $request->preco_compra),
            "preco_compra" => str_replace([','],'.', $request->preco_compra),
            "estoque_inicial" => str_replace([','],'.', $request->estoque_inicial),
        ]);

        if(!$materiaPrima){
            return redirect()->back();
        }
        $dados = $request->all();
        $dados['status_id'] = 1; //padrão ativo 
        $dados['preco_compra'] =  $dados['preco_compra'] != '' ? $dados['preco_compra'] : null;
        $dados['estoque_atual'] =  $dados["estoque_inicial"] != '' ? $dados["estoque_inicial"] : null;
        $materiaPrima->update($dados);

        if($request->botao != 1){
            return redirect()->route('materia-prima.index')->with('success', 'MateriaPrima cadastrada com sucesso..');
        }else{
            return redirect()->route('materia-prima.fornecedor.edit', $materiaPrima->id);
        }
    }
}
