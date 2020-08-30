<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTamanhoRequest;
use App\Models\Tamanho;
use Illuminate\Http\Request;

class TamanhoController extends Controller
{
    protected $dadosTamanho;

    public function __construct(Tamanho $tamanho)
    {
        $this->dadosTamanho = $tamanho;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tamanhos = $this->dadosTamanho->paginate();

        return view('admin.estoque.tamanho.index', compact('tamanhos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estoque.tamanho.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTamanhoRequest $request)
    {
        $this->dadosTamanho->create($request->all());
        return redirect()->route('tamanho.index')->with('success', 'Tamanho cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tamanho = $this->dadosTamanho->find($id);

        if(!$tamanho){
            return redirect()->back();
        }

        return view('admin.estoque.tamanho.show', compact('tamanho'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tamanho = $this->dadosTamanho->find($id);

        if(!$tamanho){
            return redirect()->back();
        }

        return view('admin.estoque.tamanho.edit', compact('tamanho'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTamanhoRequest $request, $id)
    {
        $tamanho = $this->dadosTamanho->find($id);

        if(!$tamanho){
            return redirect()->back();
        }

        $tamanho->update($request->all());
        return redirect()->route('tamanho.index')->with('success', 'Dados atualizado com sucesso..');
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
