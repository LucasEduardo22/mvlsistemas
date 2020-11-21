<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateAviamentoRequest;
use App\Models\Aviamento;
use Illuminate\Http\Request;

class AviamentoController extends Controller
{
    protected $dadosAviamento;

    public function __construct(Aviamento $aviamento)
    {
        $this->dadosAviamento = $aviamento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aviamentos = $this->dadosAviamento->simplePaginate();

        return view('admin.estoque.aviamento.index', compact('aviamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estoque.aviamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateAviamentoRequest $request)
    {
        $this->dadosAviamento->create($request->all());
        return redirect()->route('aviamento.index')->with('success', 'Aviamento cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aviamento = $this->dadosAviamento->find($id);

        if(!$aviamento){
            return redirect()->back();
        }

        return view('admin.estoque.aviamento.show', compact('aviamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aviamento = $this->dadosAviamento->find($id);

        if(!$aviamento){
            return redirect()->back();
        }

        return view('admin.estoque.aviamento.edit', compact('aviamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateAviamentoRequest $request, $id)
    {
        $aviamento = $this->dadosAviamento->find($id);

        if(!$aviamento){
            return redirect()->back();
        }

        $aviamento->update($request->all());
        return redirect()->route('aviamento.index')->with('success', 'Dados atualizado com sucesso..');
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
