<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProdutoRequest;
use App\Models\MateriaPrima;
use App\Models\SubGrupo;
use App\Models\Produto;
use App\Models\Tamanho;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProdutoController extends Controller
{
    private $dadosProduto, $dadosSubGrupo, $dadosMateriaPrima;

    public function __construct(Produto $produto, SubGrupo $subGrupo, MateriaPrima $materiaPrima)
    {
        $this->dadosProduto = $produto;
        $this->dadosSubGrupo = $subGrupo;
        $this->dadosMateriaPrima = $materiaPrima;
    }

    public function index()
    {
        $produtos = $this->dadosProduto->simplePaginate();

        return view('admin.estoque.produto.index', compact('produtos'));
    }

    public function create()
    {
        $subGrupos = $this->dadosSubGrupo->get();
        $materiaPrimas = $this->dadosMateriaPrima->simplePaginate(4);
        return view('admin.estoque.produto.create', compact('subGrupos', 'materiaPrimas'));
    }
    public function store(StoreUpdateProdutoRequest $request)
    {
        $data = $request->all();
        $data['valor_costura'] = str_replace([','],'.', $request->valor_costura);
        $data['status_id'] = 1; //padrão ativo 

        if($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("/produtos");
        } 
        $produto = $this->dadosProduto->create($data);
        if($request->botao != 1){
            return redirect()->route('produto.index')->with('success', 'Produto cadastrada com sucesso..');
        }else{
            return redirect()->route('produto.materia-prima.create', $produto->id);
        }
    }

    public function show($id){
        $produto = $this->dadosProduto->find($id);

        if(!$produto){
            return redirect()->back();
        }

        return view('admin.estoque.produto.show', compact('produto'));
    }

    public function edit($id)
    {
        $produto = $this->dadosProduto->find($id);
        $subGrupos = $this->dadosSubGrupo->get();
        return view('admin.estoque.produto.edit', compact('produto', 'subGrupos'));
    }

    public function update(StoreUpdateProdutoRequest $request, $id)
    {
        $produto = $this->dadosProduto->find($id);
        $data = $request->all();

        $data['valor_costura'] = str_replace([','],'.', $request->valor_costura);

        if(!$produto){
            return redirect()->back();
        }
        if($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("/produtos");
        } 
        $data['status_id'] = 1; //padrão ativo 

        $produto->update($data);
        if($request->botao != 1){
            return redirect()->route('produto.index')->with('success', 'Produto cadastrada com sucesso..');
        }else{
            return redirect()->route('produto.materia-prima.edit', $produto->id);
        }
    }
    public function search(Request $request){
    
        $produtos = $this->dadosProduto->search($request->filtrar);
        $filtros = $request->except('_token');
        return view('admin.estoque.produto.index', compact('produtos', 'filtros'));
    }
}
