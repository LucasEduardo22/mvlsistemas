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
            for ($i=0; $i < count($request->aviamento_id); $i++) { 
                $novo = new FichaTecnica;
                $novo->aviamento_id = $request->aviamento_id[$i];
                $novo->produto_id = $produto->id;
                if($request->detalhes[$i] != null){
                    $novo->detalhes = $request->detalhes[$i];
                }
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
        $fichaTecnica = $this->dadosFichaTecnica->find($id);

        if(!$fichaTecnica){
            return redirect()->back();
        }

        return view('admin.estoque.ficha-tecnica.edit', compact('fichaTecnica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateFichaTecnicaRequest $request, $id)
    {
        $fichaTecnica = $this->dadosFichaTecnica->find($id);

        if(!$fichaTecnica){
            return redirect()->back();
        }

        $fichaTecnica->update($request->all());
        return redirect()->route('ficha-tecnica.index')->with('success', 'Dados atualizado com sucesso..');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
