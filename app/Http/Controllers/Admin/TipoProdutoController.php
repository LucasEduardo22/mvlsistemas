<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTipoProdutoRequest;
use App\Models\TipoProduto;
use Illuminate\Http\Request;

class TipoProdutoController extends Controller
{
    protected $dadosTipoProduto;

    public function __construct(TipoProduto $tipoProduto)
    {
        $this->dadosTipoProduto = $tipoProduto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoProdutos = $this->dadosTipoProduto->simplePaginate();

        return view('admin.estoque.tipoProduto.index', compact('tipoProdutos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estoque.tipoProduto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTipoProdutoRequest $request)
    {
        $this->dadosTipoProduto->create($request->all());
        return redirect()->route('tipo-produto.index')->with('success', 'TipoProduto cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoProduto = $this->dadosTipoProduto->find($id);

        if(!$tipoProduto){
            return redirect()->back();
        }

        return view('admin.estoque.tipoProduto.show', compact('tipoProduto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoProduto = $this->dadosTipoProduto->find($id);

        if(!$tipoProduto){
            return redirect()->back();
        }

        return view('admin.estoque.tipoProduto.edit', compact('tipoProduto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTipoProdutoRequest $request, $id)
    {
        $tipoProduto = $this->dadosTipoProduto->find($id);

        if(!$tipoProduto){
            return redirect()->back();
        }

        $tipoProduto->update($request->all());
        return redirect()->route('tipo-produto.index')->with('success', 'Dados atualizado com sucesso..');
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
