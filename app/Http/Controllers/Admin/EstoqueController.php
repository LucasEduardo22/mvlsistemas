<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEstoqueRequest;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Tamanho;
use App\Models\Unidade;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    private $dadosProduto, $dadosEstoque, $dadosTamanho, $dadosUnidade;

    public function __construct(Produto $produto, Estoque $estoque, Tamanho $tamanho, Unidade $unidade)
    {
        $this->dadosProduto = $produto;
        $this->dadosEstoque = $estoque;
        $this->dadosTamanho = $tamanho;
        $this->dadosUnidade = $unidade;
    }

    public function index()
    {
        $estoques = $this->dadosEstoque->paginate();

        return view('admin.estoque.index', compact('estoques'));
    }

    public function create($id)
    {
        $produto = $this->dadosProduto->find($id);
        $tamanhos = $this->dadosTamanho->all();
        $unidades = $this->dadosUnidade->all();
        if(!$produto){
            return redirect()->back();
        }
        return view('admin.estoque.create', compact('produto', 'tamanhos', 'unidades'));
    }

    public function store(StoreUpdateEstoqueRequest $request, $id)
    {
        $produto = $this->dadosProduto->find($id);
        $dados = $request->all();
        $dados['produto_id'] = $produto->id;
        $dados['estoque_atual'] = $request->estoque_inicial;
        $dados['status_id'] = 1;
        if(!$produto){
            return redirect()->back();
        }
        $this->dadosEstoque->create($dados);
        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso..');
    }

    public function edit($id)
    {
        $estoque = $this->dadosEstoque->find($id);
        $produto = $estoque->produto;
        $tamanhos = $this->dadosTamanho->all();
        $unidades = $this->dadosUnidade->all();
        if(!$estoque){
            return redirect()->back();
        }
        return view('admin.estoque.edit', compact('estoque', 'produto', 'tamanhos', 'unidades'));
    }
    public function update(StoreUpdateEstoqueRequest $request, $id)
    {
        $estoque = $this->dadosEstoque->find($id);
        $dados = $request->all();
        $dados['es$estoque_id'] = $estoque->id;
        $dados['estoque_atual'] = $request->estoque_inicial;
        $dados['status_id'] = 1;
        if(!$estoque){
            return redirect()->back();
        }

        $estoque->update($dados);
        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso..');
    }
}
