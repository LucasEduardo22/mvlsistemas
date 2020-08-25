<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePerfil;
use App\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    private $dadosPerfil;

    public function __construct(Perfil $perfil)
    {
        $this->dadosPerfil = $perfil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfils = $this->dadosPerfil->paginate();

        return view('configuracao.perfil.index', compact('perfils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuracao.perfil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePerfil $request)
    {
        $this->dadosPerfil->create($request->all());

        return redirect()->route('perfil.index')->with('success', 'Perfil cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perfil = $this->dadosPerfil->find($id);

        return view('configuracao.perfil.show', compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfil = $this->dadosPerfil->find($id);

        return view('configuracao.perfil.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePerfil $request, $id)
    {
        $perfil = $this->dadosPerfil->find($id);
        if(!$perfil){
            return redirect()->back();
        }

        $perfil->update($request->all());

        return redirect()->route('perfil.index')->with('success', 'Dados alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfil = $this->dadosPerfil->find($id);

        if(empty($perfil)){
            return redirect()
            ->back()
            ->with('error', 'Existe usuário vinculado a esse perfil, portando não pode deletar');
        }
        $perfil->delete();
        return redirect()
            ->route('perfil.index')
            ->with('message', 'Resgistro deletado com sucesso');
    }
}
