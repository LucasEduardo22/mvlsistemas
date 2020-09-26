<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFichaTecnicaRequest;
use App\Models\Aviamento;
use App\Models\FichaTecnica;
use App\Models\Produto;
use Illuminate\Http\Request;

class FichaTecnicaController extends Controller
{
    protected $dadosFichaTecnica;
    protected $dadosProduto;
    protected $dadosAviamentos;

    public function __construct(FichaTecnica $fichaTecnica, Produto $produto, Aviamento $aviamento)
    {
        $this->dadosFichaTecnica = $fichaTecnica;
        $this->dadosProduto = $produto;
        $this->dadosAviamentos = $aviamento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fichaTecnicas = $this->dadosFichaTecnica->paginate();

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
        $aviamentos= $this->dadosAviamentos->paginate(25);
        return view('admin.estoque.produto.ficha-tecnica.create', compact('produto', "aviamentos"));
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
     
        if(!empty($request)){
            $dados = [];
            $detalhes = [];
            
            foreach ($request->aviamento as $i => $value) {
                foreach ($request->aviamento_id as $c => $ave){
                    if($ave == $value){
                        $dados[] = $value;
                        $detalhes[]= $request->detalhes[$i];
                    }
                }
            }
            foreach ($dados as $id => $item) {
                $novo = new FichaTecnica;
                $novo->aviamento_id = $item;
                $novo->produto_id = $produto->id;
                $novo->detalhes = $detalhes[$id];
                $novo->save(); 
            }
            return redirect()
                ->route('produto.index')
                ->with('success', 'Categoria adicionada com sucesso');
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
        $aviamentos= $this->dadosAviamentos->paginate(25);
        return view('admin.estoque.produto.ficha-tecnica.edit', compact('produto', "aviamentos"));
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
        $aviamentos = $this->dadosFichaTecnica->where('produto_id', $produto->id)->get();

        if($aviamentos->count() != 0){
            foreach($aviamentos as $aviamento){
                if(empty($aviamento) || !empty($request->aviamento_id)){
                    
                    $dados = [];
                    $detalhes = [];
                    
                    foreach ($request->aviamento as $i => $value) {
                        foreach ($request->aviamento_id as $c => $ave){
                            if($ave == $value){
                                $dados[] = $value;
                                $detalhes[]= $request->detalhes[$i];
                            }
                        }
                    }
                    foreach ($dados as $id => $item) {

                        $novo = new FichaTecnica;
                        $novo->aviamento_id = $item;
                        $novo->produto_id = $produto->id;
                        $novo->detalhes = $detalhes[$id];
                        $novo->save(); 
                    }

                    for ($i=0; $i < count($request->Ave_id); $i++) { 
                        $dados = $aviamento->find($request->Ave_id[$i]);
                        
                        if($request->detalhe[$i] != null){
                            $dados->detalhes = $request->detalhe[$i];
                        }
                        $dados->save();
                    }
                    
                }else{
                    for ($i=0; $i < count($request->Ave_id); $i++) { 
                        $dados = $aviamento->find($request->Ave_id[$i]);
                        
                        if($request->detalhe[$i] != null){
                            $dados->detalhes = $request->detalhe[$i];
                        }
                        $dados->save();
                    }
                }
                return redirect()
                        ->route('produto.index')
                        ->with('success', 'Dados adicionado com sucesso');
            }
        }else{
            if(!empty($request)){
                $dados = [];
                $detalhes = [];
                
                foreach ($request->aviamento as $i => $value) {
                    foreach ($request->aviamento_id as $c => $ave){
                        if($ave == $value){
                            $dados[] = $value;
                            $detalhes[]= $request->detalhes[$i];
                        }
                    }
                }
                foreach ($dados as $id => $item) {
                    $novo = new FichaTecnica;
                    $novo->aviamento_id = $item;
                    $novo->produto_id = $produto->id;
                    $novo->detalhes = $detalhes[$id];
                    $novo->save(); 
                }
            }
            return redirect()
                ->route('produto.index')
                ->with('success', 'Dados adicionado com sucesso');
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
        $aviamento = $this->dadosFichaTecnica->find($id);
        $produto = $this->dadosProduto->find($produto_id);
        if(!$aviamento){
            return redirect()->back();
        }
        $aviamento->delete();

        return redirect()
                ->route('produto.show', $produto->id)
                ->with('success', 'Aviamento deletado com sucesso');

    }
}
