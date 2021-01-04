<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFichaTecnicaRequest;
use App\Models\MateriaPrima;
use App\Models\FichaTecnica;
use App\Models\Produto;
use Illuminate\Http\Request;

class FichaTecnicaController extends Controller
{
    protected $dadosFichaTecnica;
    protected $dadosProduto;
    protected $dadosMateriaPrimas;

    public function __construct(FichaTecnica $fichaTecnica, Produto $produto, MateriaPrima $materiaPrima)
    {
        $this->dadosFichaTecnica = $fichaTecnica;
        $this->dadosProduto = $produto;
        $this->dadosMateriaPrimas = $materiaPrima;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fichaTecnicas = $this->dadosFichaTecnica->simplePaginate();

        return view('admin.estoque.ficha-tecnica.index', compact('fichaTecnicas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $produto = $this->dadosProduto->find($id);
        $materiaPrimas= $this->dadosMateriaPrimas->simplePaginate(25);
        return view('admin.estoque.produto.ficha-tecnica.create', compact('produto', "materiaPrimas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $produto = $this->dadosProduto->find($id);
     
        if(!empty($request) && !empty($request->materiaPrima)){
            $dados = [];
            $detalhes = [];
            $quantidade = [];
            
            foreach ($request->materiaPrima as $i => $value) {
                foreach ($request->materia_prima_id as $c => $ave){
                    if($ave == $value){
                        $dados[] = $value;
                        $quantidade[]= $request->quantidade[$i];
                        $detalhes[]= $request->detalhes[$i];
                    }
                }
            }
            foreach ($dados as $id => $item) {
                $novo = new FichaTecnica;
                $novo->materia_prima_id = $item;
                $novo->produto_id = $produto->id;
                $novo->quantidade = $quantidade[$id];
                $novo->detalhes = $detalhes[$id];
                $novo->save(); 
            }
            if($request->botao != 1){
                return redirect()
                    ->route('produto.index')
                    ->with('success', 'Dados adicionado com sucesso');
            }else{
                if (empty($produto->estoque)) {
                    return redirect()->route('estoque.create', $produto->id);
                } else {
                    return redirect()->route('estoque.EDIT', $produto->estoque->id);
                }
            }

        }else{
            return redirect()->back()->with('error', 'Deve selecionar pelo uma categoria');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fichaTecnica = $this->dadosFichaTecnica->find($id);

        if(!$fichaTecnica){
            return redirect()->back();
        }

        return view('admin.estoque.ficha-tecnica.show', compact('fichaTecnica'));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = $this->dadosProduto->find($id);
        $materiaPrimas= $this->dadosMateriaPrimas->where("tipo_produto_id", 1)->simplePaginate(25);
        return view('admin.estoque.produto.ficha-tecnica.edit', compact('produto', "materiaPrimas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = $this->dadosProduto->find($id);
        $materiaPrimas = $this->dadosFichaTecnica->where('produto_id', $produto->id)->get();

        if($materiaPrimas->count() != 0){
            foreach($materiaPrimas as $materiaPrima){
                if(empty($materiaPrima) || !empty($request->materia_prima_id)){
                    
                    $dados = [];
                    $detalhes = [];
                    $quantidade = [];
                    
                    foreach ($request->materiaPrima as $i => $value) {
                        foreach ($request->materia_prima_id as $c => $ave){
                            if($ave == $value){
                                $dados[] = $value;
                                $quantidade[]= $request->quantidade[$i];
                                $detalhes[]= $request->detalhes[$i];
                            }
                        }
                    }
                    foreach ($dados as $id => $item) {

                        $novo = new FichaTecnica;
                        $novo->materia_prima_id = $item;
                        $novo->produto_id = $produto->id;
                        $novo->quantidade = $quantidade[$id];
                        $novo->detalhes = $detalhes[$id];
                        $novo->save(); 
                    }

                    for ($i=0; $i < count($request->Ave_id); $i++) { 
                        $dados = $materiaPrima->find($request->Ave_id[$i]);
                        if($request->detalhe[$i] != null || $request->quantidadeT[$i] != null){
                            $dados->quantidade = $request->quantidadeT[$i];
                            $dados->detalhes = $request->detalhe[$i];
                        }
                        $dados->save();
                    }
                    
                }else{
                    for ($i=0; $i < count($request->Ave_id); $i++) { 
                        $dados = $materiaPrima->find($request->Ave_id[$i]);
                        if($request->detalhe[$i] != null || $request->quantidadeT[$i] != null){
                            $dados->quantidade = $request->quantidadeT[$i];
                            $dados->detalhes = $request->detalhe[$i];
                        }
                        $dados->save();
                    }
                }
                if($request->botao != 1){
                    return redirect()
                        ->route('produto.index')
                        ->with('success', 'Dados adicionado com sucesso');
                }else{
                    if (empty($produto->estoque)) {
                        return redirect()->route('estoque.create', $produto->id);
                    } else {
                        return redirect()->route('estoque.edit', $produto->estoque->id);
                    }
                }
            }
        }else{
            if(!empty($request)){
                $dados = [];
                $detalhes = [];
                $quantidade = [];
                
                foreach ($request->materiaPrima as $i => $value) {
                    foreach ($request->materia_prima_id as $c => $ave){
                        if($ave == $value){
                            $dados[] = $value;
                            $quantidade[]= $request->quantidade[$i];
                            $detalhes[]= $request->detalhes[$i];
                        }
                    }
                }
                foreach ($dados as $id => $item) {

                    $novo = new FichaTecnica;
                    $novo->materia_prima_id = $item;
                    $novo->produto_id = $produto->id;
                    $novo->quantidade = $quantidade[$id];
                    $novo->detalhes = $detalhes[$id];
                    $novo->save(); 
                }
            }

            if($request->botao != 1){
                return redirect()
                    ->route('produto.index')
                    ->with('success', 'Dados adicionado com sucesso');
            }else{
                return redirect()->route('estoque.create', $produto->id);
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $produto_id)
    {
        $materiaPrima = $this->dadosFichaTecnica->find($id);
        $produto = $this->dadosProduto->find($produto_id);
        if(!$materiaPrima){
            return redirect()->back();
        }
        $materiaPrima->delete();

        return redirect()
                ->route('produto.show', $produto->id)
                ->with('success', 'MateriaPrima deletado com sucesso');

    }
}
