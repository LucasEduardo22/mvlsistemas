<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProdutoRequest;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Tamanho;
use App\Models\TipoProduto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $dadosProduto, $dadosCategoria, $dadosTipoProduto;

    public function __construct(Produto $produto, Categoria $categoria, TipoProduto $tipoProduto)
    {
        $this->dadosProduto = $produto;
        $this->dadosCategoria = $categoria;
        $this->dadosTipoProduto = $tipoProduto;
    }

    public function index()
    {
        $produtos = $this->dadosProduto->paginate();

        return view('admin.estoque.produto.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = $this->dadosCategoria->get();
        $tipoProdutos = $this->dadosTipoProduto->get();
        return view('admin.estoque.produto.create', compact('categorias', 'tipoProdutos'));
    }

    public function store(StoreUpdateProdutoRequest $request)
    {
        $data = $request->all();
        $data['status_id'] = 1; //padrão ativo 
        /* if($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("empresas/{$empresa->uuid}/produtos");
        } */
        $produto = $this->dadosProduto->create($data);
        if($request->botao != 1){
            return redirect()->route('produto.index')->with('success', 'Produto cadastrada com sucesso..');
        }else{
            return redirect()->route('estoque.create', $produto->id);
        }
    }

    public function edit($id)
    {
        $produto = $this->dadosProduto->find($id);
        $categorias = $this->dadosCategoria->get();
        $tipoProdutos = $this->dadosTipoProduto->get();
        return view('admin.estoque.produto.edit', compact('produto', 'categorias', 'tipoProdutos'));
    }

    public function update(StoreUpdateProdutoRequest $request, $id)
    {
        $produto = $this->dadosProduto->find($id);

        if(!$produto){
            return redirect()->back();
        }
        $data = $request->all();
        $data['status_id'] = 1; //padrão ativo 

        $produto->update($data);
        if($request->botao != 1){
            return redirect()->route('produto.index')->with('success', 'Produto cadastrada com sucesso..');
        }else{
            
            if(!$produto->estoque){
                return redirect()->route('estoque.create', $produto->id);
            }
            return redirect()->route('estoque.edit', $produto->id);
        }
    }
}
