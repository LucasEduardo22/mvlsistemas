<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEstoqueRequest;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Tamanho;
use App\Models\TamanhoProduto;
use App\Models\Unidade;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    private $dadosProduto, $dadosEstoque, $dadosTamanho, $dadosUnidade, $dadosTamanhoProduto;

    public function __construct(Produto $produto, Estoque $estoque, Tamanho $tamanho, Unidade $unidade, TamanhoProduto $tamanhoProduto)
    {
        $this->dadosProduto = $produto;
        $this->dadosEstoque = $estoque;
        $this->dadosTamanho = $tamanho;
        $this->dadosUnidade = $unidade;
        $this->dadosTamanhoProduto = $tamanhoProduto;
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
        $request->merge([
            "preco_compra" => str_replace(['.'], '', $request->preco_compra),
            "preco_compra" => str_replace([','],'.', $request->preco_compra),
            "preco_venda" => str_replace(['.'], '', $request->preco_venda),
            "preco_venda" => str_replace([','], '.', $request->preco_venda),
        ]);
       // dd($request->all());
        $produto = $this->dadosProduto->find($id);
        $dados = $request->all();
        $dados['produto_id'] = $produto->id;
        $dados['estoque_atual'] = $request->estoque_inicial;
        $dados['status_id'] = 1;

        
        if(!$produto){
            return redirect()->back();
        }
        $estoque = $this->dadosEstoque->create($dados);
        for ($i = 0; $i < count($request->tamanho); $i++) {

            $tamanhoProduto = new TamanhoProduto;
            $tamanhoProduto->estoque_id = $estoque->id;
            $tamanhoProduto->tamanho_id = $request->tamanho[$i];
            $tamanhoProduto->preco_custo = str_replace([','], '.', $request->preco_custo[$i]);
            $tamanhoProduto->preco_venda = str_replace([','], '.', $request->preco_venda1[$i]);
            $tamanhoProduto->quantidade = str_replace([','], '.', $request->quantidade[$i]);
            $tamanhoProduto->save();
        }
        
        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso..');
    }

    public function edit($id)
    {
        $estoque = $this->dadosEstoque->find($id);
        $produto = $estoque->produto;
        $tamanhos = $this->dadosTamanho->all();
        /* $tamanhoProdutos = $this->dadosTamanhoProduto->where('estoque_id', $estoque->id)->get(); */
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
        for ($i = 0; $i < count($request->tamanho); $i++) {

            $tamanhoProduto = TamanhoProduto::Where('tamanho_id', $request->tamanho[$i])->first();
            //dd($tamanhoProduto);
            $tamanhoProduto->estoque_id = $estoque->id;
            $tamanhoProduto->tamanho_id = $request->tamanho[$i];
            $tamanhoProduto->preco_custo = str_replace([','], '.', $request->preco_custo[$i]);
            $tamanhoProduto->preco_venda = str_replace([','], '.', $request->preco_venda1[$i]);
            $tamanhoProduto->quantidade = str_replace([','], '.', $request->quantidade[$i]);
            $tamanhoProduto->save();
        }
        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso..');
    }

    public function show($id){
        $estoque = $this->dadosEstoque->find($id);
        $tamanhos = $this->dadosTamanho->all();
        //$tamanhos = $this->dadosTamanho->where('estoqy');
        if(!$estoque){
            return redirect()->back();
        }
        return view('admin.estoque.show', compact('estoque', 'tamanhos'));
    }
}
