<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateGrupoRequest;
use App\Models\Departamento;
use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    protected $dadosGrupo;
    protected $dadosDepartamento;

    public function __construct(Grupo $grupo, Departamento $departamento)
    {
        $this->dadosGrupo = $grupo;
        $this->dadosDepartamento = $departamento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = $this->dadosGrupo->simplePaginate();

        return view('admin.estoque.grupo.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = $this->dadosDepartamento->get();
        return view('admin.estoque.grupo.create', compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateGrupoRequest $request)
    {
        $this->dadosGrupo->create($request->all());
        return redirect()->route('grupo.index')->with('success', 'Grupo cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = $this->dadosGrupo->find($id);

        if(!$grupo){
            return redirect()->back();
        }

        return view('admin.estoque.grupo.show', compact('grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupo = $this->dadosGrupo->find($id);
        $departamentos = $this->dadosDepartamento->get();
        if(!$grupo){
            return redirect()->back();
        }

        return view('admin.estoque.grupo.edit', compact('grupo', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateGrupoRequest $request, $id)
    {
        $grupo = $this->dadosGrupo->find($id);

        if(!$grupo){
            return redirect()->back();
        }

        $grupo->update($request->all());
        return redirect()->route('grupo.index')->with('success', 'Dados atualizado com sucesso..');
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
