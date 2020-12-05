<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTabelaPrecoRequest;
use App\Models\Pedido;
use App\Models\TabelaPreco;
use Illuminate\Http\Request;

class TabelaPrecoController extends Controller
{
    protected $dadosTabelaPreco, $dadosPedido;

    public function __construct(TabelaPreco $tabelaPreco, Pedido $pedido)
    {
        $this->dadosTabelaPreco = $tabelaPreco;
        $this->dadosPedido = $pedido;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabelaPrecos = $this->dadosTabelaPreco->orderBy('id', 'desc')->simplePaginate();

        return view('admin.tabelaPreco.index', compact('tabelaPrecos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tabelaPreco.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTabelaPrecoRequest $request)
    {
        $this->dadosTabelaPreco->create($request->all());
        return redirect()->route('tabela-preco.index')->with('success', 'TabelaPreco cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tabelaPreco = $this->dadosTabelaPreco->find($id);

        if(!$tabelaPreco){
            return redirect()->back();
        }

        return view('admin.tabelaPreco.show', compact('tabelaPreco'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tabelaPreco = $this->dadosTabelaPreco->find($id);

        if(!$tabelaPreco){
            return redirect()->back();
        }

        return view('admin.tabelaPreco.edit', compact('tabelaPreco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTabelaPrecoRequest $request, $id)
    {
        $tabelaPreco = $this->dadosTabelaPreco->find($id);

        if(!$tabelaPreco){
            return redirect()->back();
        }

        $tabelaPreco->update($request->all());
        return redirect()->route('tabela-preco.index')->with('success', 'Dados atualizado com sucesso..');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tabelaPrecoPedido = $this->dadosPedido->where("tabela_preco_id", $id)->first();

        if(!empty($tabelaPrecoPedido)){
            return redirect()
                ->back()
                ->with('error', 'Existe Planos vinculado a esse perfil, portando não pode deletar');
        }
        $tabelaPreco = $this->dadosTabelaPreco->find($id);
        $tabelaPreco->delete();
        return redirect()
            ->route('tabela-preco.index')
            ->with('message', 'Resgistro deletado com sucesso');
    }
}
