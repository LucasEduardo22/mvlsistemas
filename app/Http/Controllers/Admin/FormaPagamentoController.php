<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFormaPagamentoRequest;
use App\Models\FormaPagamento;
use Illuminate\Http\Request;

class FormaPagamentoController extends Controller
{
    protected $dadosFormaPagamento;

    public function __construct(FormaPagamento $formaPagamento)
    {
        $this->dadosFormaPagamento = $formaPagamento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formaPagamentos = $this->dadosFormaPagamento->simplePaginate();

        return view('admin.formaPagamento.index', compact('formaPagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.formaPagamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateFormaPagamentoRequest $request)
    {
        $this->dadosFormaPagamento->create($request->all());
        return redirect()->route('forma-pagamento.index')->with('success', 'FormaPagamento cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formaPagamento = $this->dadosFormaPagamento->find($id);

        if(!$formaPagamento){
            return redirect()->back();
        }

        return view('admin.formaPagamento.show', compact('formaPagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formaPagamento = $this->dadosFormaPagamento->find($id);

        if(!$formaPagamento){
            return redirect()->back();
        }

        return view('admin.formaPagamento.edit', compact('formaPagamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateFormaPagamentoRequest $request, $id)
    {
        $formaPagamento = $this->dadosFormaPagamento->find($id);

        if(!$formaPagamento){
            return redirect()->back();
        }

        $formaPagamento->update($request->all());
        return redirect()->route('forma-pagamento.index')->with('success', 'Dados atualizado com sucesso..');
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
