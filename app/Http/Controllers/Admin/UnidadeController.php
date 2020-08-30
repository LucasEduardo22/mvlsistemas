<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUnidadeRequest;
use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    protected $dadosUnidade;

    public function __construct(Unidade $unidade)
    {
        $this->dadosUnidade = $unidade;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = $this->dadosUnidade->paginate();

        return view('admin.estoque.unidade.index', compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estoque.unidade.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUnidadeRequest $request)
    {
        $this->dadosUnidade->create($request->all());
        return redirect()->route('unidade.index')->with('success', 'Unidade cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidade = $this->dadosUnidade->find($id);

        if(!$unidade){
            return redirect()->back();
        }

        return view('admin.estoque.unidade.show', compact('unidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidade = $this->dadosUnidade->find($id);

        if(!$unidade){
            return redirect()->back();
        }

        return view('admin.estoque.unidade.edit', compact('unidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUnidadeRequest $request, $id)
    {
        $unidade = $this->dadosUnidade->find($id);

        if(!$unidade){
            return redirect()->back();
        }

        $unidade->update($request->all());
        return redirect()->route('unidade.index')->with('success', 'Dados atualizado com sucesso..');
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
