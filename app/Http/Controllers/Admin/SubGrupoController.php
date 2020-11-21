<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSubGrupoRequest;
use App\Models\Grupo;
use App\Models\SubGrupo;
use Illuminate\Http\Request;

class SubGrupoController extends Controller
{
    protected $dadosSubGrupo;
    protected $dadosGrupo;

    public function __construct(SubGrupo $subGrupo, Grupo $grupo)
    {
        $this->dadosSubGrupo = $subGrupo;
        $this->dadosGrupo = $grupo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subGrupos = $this->dadosSubGrupo->simplePaginate();

        return view('admin.estoque.sub-grupo.index', compact('subGrupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = $this->dadosGrupo->get();
        return view('admin.estoque.sub-grupo.create', compact('grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateSubGrupoRequest $request)
    {
        $this->dadosSubGrupo->create($request->all());
        return redirect()->route('sub-grupo.index')->with('success', 'SubGrupo cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subGrupo = $this->dadosSubGrupo->find($id);

        if(!$subGrupo){
            return redirect()->back();
        }

        return view('admin.estoque.sub-grupo.show', compact('subGrupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subGrupo = $this->dadosSubGrupo->find($id);
        $grupos = $this->dadosGrupo->get();
        if(!$subGrupo){
            return redirect()->back();
        }

        return view('admin.estoque.sub-grupo.edit', compact('subGrupo', "grupos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateSubGrupoRequest $request, $id)
    {
        $subGrupo = $this->dadosSubGrupo->find($id);

        if(!$subGrupo){
            return redirect()->back();
        }

        $subGrupo->update($request->all());
        return redirect()->route('sub-grupo.index')->with('success', 'Dados atualizado com sucesso..');
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
