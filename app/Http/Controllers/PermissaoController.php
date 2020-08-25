<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePermissao;
use App\Permissao;
use Illuminate\Http\Request;

class PermissaoController extends Controller
{
    private $dadosPermissao;

    public function __construct(Permissao $permissao)
    {
        $this->dadosPermissao = $permissao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissaos = $this->dadosPermissao->paginate();

        return view('configuracao.permissao.index', compact('permissaos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuracao.permissao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermissao $request)
    {
        $this->dadosPermissao->create($request->all());

        return redirect()->route('permissao.index')->with('success', 'Permissao cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissao = $this->dadosPermissao->find($id);

        return view('configuracao.permissao.show', compact('permissao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissao = $this->dadosPermissao->find($id);

        return view('configuracao.permissao.edit', compact('permissao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePermissao $request, $id)
    {
        $permissao = $this->dadosPermissao->find($id);
        if(!$permissao){
            return redirect()->back();
        }

        $permissao->update($request->all());

        return redirect()->route('permissao.index')->with('success', 'Dados alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permissao = $this->dadosPermissao->find($id);

        if(empty($permissao)){
            return redirect()
            ->back()
            ->with('error', 'Existe Perfil vinculado a essa permissao, portando não pode deletar');
        }
        $permissao->delete();
        return redirect()
            ->route('permissao.index')
            ->with('message', 'Resgistro deletado com sucesso');
    }
}
