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
            "custo_atual" => str_replace(['.'], '', $request->custo_atual),
            "custo_atual" => str_replace([','],'.', $request->custo_atual),
            "preco_venda" => str_replace(['.'], '', $request->preco_venda),
            "preco_venda" => str_replace([','], '.', $request->preco_venda),
        ]);

        $produto = $this->dadosProduto->find($id);
        $dados = $request->all();
        
        $dados['produto_id'] = $produto->id;
        $dados['preco_venda'] = $request->preco_venda != '' ?? null;
        $dados['custo_atual'] = $request->custo_atual != '' ?? null;
        $dados['estoque_atual'] = $request->estoque_inicial;
        $dados['status_id'] = 1;

        if(!$produto){
            return redirect()->back();
        }
        $estoque = $this->dadosEstoque->create($dados);
        if(!empty($request->preco_venda1)){
            foreach ($request->tamanho as $i => $value) {
               // $preco_custo = str_replace([','], '.', $request->preco_custo[$i]);
                $preco_venda = str_replace([','], '.', $request->preco_venda1[$i]);
               // $quantidade = str_replace([','], '.', $request->quantidade[$i]);
    
                $tamanhoProduto = new TamanhoProduto;
                $tamanhoProduto->estoque_id = $estoque->id;
                $tamanhoProduto->tamanho_id = $value;
              //  $tamanhoProduto->preco_custo = !empty($preco_custo) ? $preco_custo : null;
                $tamanhoProduto->preco_venda = !empty($preco_venda) ? $preco_venda : null;
                //$tamanhoProduto->quantidade = !empty($quantidade) ? $quantidade : null;
                $tamanhoProduto->save();
            }
        }
        
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
        return view('admin.estoque.edit', compact('estoque', 'produto', 'unidades', 'tamanhos'));
    }
    public function update(StoreUpdateEstoqueRequest $request, $id)
    {
        
        $request->merge([
            "custo_atual" => str_replace(['.'], '', $request->custo_atual),
            "custo_atual" => str_replace([','],'.', $request->custo_atual),
            "preco_venda" => str_replace(['.'], '', $request->preco_venda),
            "preco_venda" => str_replace([','], '.', $request->preco_venda),
        ]);
        
        $estoque = $this->dadosEstoque->find($id);
        $dados = $request->all();
        //$dados['estoque_id'] = $estoque->id;
        $dados['estoque_atual'] = $request->estoque_inicial;
        $dados['preco_venda'] = $request->preco_venda != '' ?? null;
        $dados['custo_atual'] = $request->custo_atual != '' ?? null;
        $dados['status_id'] = 1;
        if(!$estoque){
            return redirect()->back();
        }

        $estoque->update($dados);
        if(!empty($request->preco_venda1)){
            foreach ($request->tamanho as $i => $value) {
               // $preco_custo = str_replace([','], '.', $request->preco_custo[$i]);
                $preco_venda = str_replace([','], '.', $request->preco_venda1[$i]);
               // $quantidade = str_replace([','], '.', $request->quantidade[$i]);
            
                $tamanhoProduto = TamanhoProduto::Where('tamanho_id', $value)->where('estoque_id', $estoque->id)->first();
                if(!$tamanhoProduto){
                    $tamanhoProduto = new TamanhoProduto;
                }
                $tamanhoProduto->estoque_id = $estoque->id;
                $tamanhoProduto->tamanho_id = $value;
             //   $tamanhoProduto->preco_custo = !empty($preco_custo) ? $preco_custo : null;
                $tamanhoProduto->preco_venda = !empty($preco_venda) ? $preco_venda : null;
             //   $tamanhoProduto->quantidade = !empty($quantidade) ? $quantidade : null;
                $tamanhoProduto->save();
            }
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
