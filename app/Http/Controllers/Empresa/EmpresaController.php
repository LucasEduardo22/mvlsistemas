<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEmpresaRequest;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    protected $dadosEmpresa;

    public function __construct(Empresa $empresa)
    {
        $this->dadosEmpresa = $empresa;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = $this->dadosEmpresa->first();
        return view('admin.empresa.index', compact('empresa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateEmpresaRequest $request)
    {
        $request->merge([
            'cpf_cnpj' => str_replace(['.', '/','-'], '', $request->cpf_cnpj),
            'cep' => str_replace(['-'], '', $request->cep),
            //'ie' => str_replace(['.', '-'], '', $request->ie),
            'telefone' => str_replace(['(', ')', ' ','-'], '', $request->telefone),
            'celular' => str_replace(['(', ')', ' ','-'], '', $request->celular),
        ]);
        $data = $request->all();
        if($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("/empresas");
        } 
        //dd($data);
        $this->dadosEmpresa->create($data);
        return redirect()->route('empresa.index')->with('success', 'Empresa cadastrada com sucesso..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = $this->dadosEmpresa->find($id);

        if(!$empresa){
            return redirect()->back();
        }

        return view('admin.empresa.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = $this->dadosEmpresa->find($id);

        if(!$empresa){
            return redirect()->back();
        }

        return view('admin.empresa.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateEmpresaRequest $request, $id)
    {
        $request->merge([
            'cpf_cnpj' => str_replace(['.', '/','-'], '', $request->cpf_cnpj),
            'cep' => str_replace(['-'], '', $request->cep),
            //'ie' => str_replace(['.', '-'], '', $request->ie),
            'telefone' => str_replace(['(', ')', ' ','-'], '', $request->telefone),
            'celular' => str_replace(['(', ')', ' ','-'], '', $request->celular),
        ]);
        $empresa = $this->dadosEmpresa->find($id);

        if(!$empresa){
            return redirect()->back();
        }

        $empresa->update($request->all());
        return redirect()->route('empresa.index')->with('success', 'Dados atualizado com sucesso..');
    }

    public function search(Request $request){
    
        $empresas = $this->dadosEmpresa->search($request->filtrar);
        $filtros = $request->except('_token');
        return view('admin.empresa.index', compact('empresas', 'filtros'));
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
