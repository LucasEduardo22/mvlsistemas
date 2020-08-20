<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateProdutoRequest;
use App\Produto;
use App\Tamanho;
use App\Categoria;
use App\TipoProduto;
use App\Unidade;

class ProdutoController extends Controller
{
    private $dadosProduto;
    
    public function __construct(Produto $produto)
    {
        $this->dadosProduto = $produto;
    }

    public function index(){
        $produtos = Produto::paginate(10);
        return view('produto.index', compact('produtos'));
    }

    public function create(){
        $tamanhos = Tamanho::all();
        $categorias = Categoria::all();
        $tipoprodutos = TipoProduto::all();
        $unidades = Unidade::all();

        return view('produto.create', compact('tamanhos','categorias','tipoprodutos','unidades'));

        
    }

    public function store(StoreUpdateProdutoRequest $request){
        $dados = $request->all();
        $dados['status_id'] = 1;
        $produto = $this->dadosProduto->create($dados);
        
        return redirect()->route('produto.fichatecnica.create', $produto->id);    
    }

    public function edit($id){
        $produto = $this->dadosProduto->find($id);
        $tamanhos = Tamanho::all();
        $categorias = Categoria::all();
        $tipoprodutos = TipoProduto::all();
        $unidades = Unidade::all();

      
        return view('produto.edit', compact('tamanhos','categorias','tipoprodutos','unidades', 'produto'));
    }

    public function update(StoreUpdateProdutoRequest $request, $id){

        $produto = $this->dadosProduto->find($id);
        if(empty($produto)){
            return redirect()->back();
        }
        $produto->update($request->all());

        if ($request->botao0 == "0") {
            return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso!');
        } else {
            return redirect()->route('produto.fichatecnica.edit', $produto->id);
        }
        
       
        
    }
    
    public function search(Request $request){
        
        $produtos = $this->dadosProduto->search($request->filtrar);
        $filtros = $request->except('_token');
        return view('produto.index', compact('produtos', 'filtros'));
    }

    public function createFichaTecnica($id){
        $produto = $this->dadosProduto->find($id);
        return view('produto.fichatecnica.createfichatecnica', compact("produto"));

        
    }

    public function storeFichaTecnica(Request $request, $id){
        $fichaTecnica =  $this->dadosProduto->with('fichaTecnica')->find($id);
        $dados = $request->all();
        $dados['produto_id'] = $fichaTecnica->id;
        $fichaTecnica->fichaTecnica()->create($dados);

        return redirect()->route('produto.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function editFichaTecnica($id){
        $produto = $this->dadosProduto->find($id);
        return view('produto.fichatecnica.editfichatecnica', compact("produto"));
    }
    public function updateFichaTecnica(Request $request, $id){
        $fichaTecnica =  $this->dadosProduto->with('fichaTecnica')->find($id);

        $dados = $request->except(['_method', '_token', 'image']);
        $dados['produto_id'] = $fichaTecnica->id;
        if($fichaTecnica->fichaTecnica()->count() > 0){
            $fichaTecnica->fichaTecnica()->update($dados);
        }else{
            $fichaTecnica->fichaTecnica()->create($dados);
        }

        return redirect()->route('produto.index')->with('success', 'Produto Editado com sucesso');
    }

    public function show($id){
        $produto = $this->dadosProduto->find($id);

        return view('produto.show', compact('produto'));
    }

    public function destroy($id){
        $produto = $this->dadosProduto->find($id);

        return view('produto.destroy', compact('produto'));
    }
 


}
