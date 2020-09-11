<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDepartamentoRequest;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    protected $dadosDepartamento;

    public function __construct(Departamento $departamento)
    {
        $this->dadosDepartamento = $departamento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = $this->dadosDepartamento->paginate();

        return view('admin.estoque.departamento.index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estoque.departamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateDepartamentoRequest $request)
    {
        $this->dadosDepartamento->create($request->all());
        return redirect()->route('departamento.index')->with('success', 'Departamento cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departamento = $this->dadosDepartamento->find($id);

        if(!$departamento){
            return redirect()->back();
        }

        return view('admin.estoque.departamento.show', compact('departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departamento = $this->dadosDepartamento->find($id);

        if(!$departamento){
            return redirect()->back();
        }

        return view('admin.estoque.departamento.edit', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateDepartamentoRequest $request, $id)
    {
        $departamento = $this->dadosDepartamento->find($id);

        if(!$departamento){
            return redirect()->back();
        }

        $departamento->update($request->all());
        return redirect()->route('departamento.index')->with('success', 'Dados atualizado com sucesso..');
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
