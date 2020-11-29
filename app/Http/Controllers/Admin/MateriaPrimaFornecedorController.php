<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use App\Models\MateriaPrima;
use App\Models\MateriaPrimaFornecedor;
use Illuminate\Http\Request;

class MateriaPrimaFornecedorController extends Controller
{
    private $dadosMateriaPrima, $dadosFornecedor, $dadosMateriaPrimaFornecedor;

    public function __construct(MateriaPrima $materiaPrima, Fornecedor $fornecedor, MateriaPrimaFornecedor $materiaPrimaFornecedor)
    {
        $this->dadosMateriaPrima = $materiaPrima;
        $this->dadosFornecedor = $fornecedor;
        $this->dadosMateriaPrimaFornecedor = $materiaPrimaFornecedor;
    }

    public function create($id)
    {
        $materiaPrima = $this->dadosMateriaPrima->find($id);
        $fornecedors = $this->dadosFornecedor->get();
        return view('admin.estoque.materia-prima.fornecedor.create', compact('materiaPrima', 'fornecedors'));
    }

    public function edit($id)
    {
        $materiaPrima = $this->dadosMateriaPrima->find($id);
        $fornecedors = $this->dadosFornecedor->get();

        return view('admin.estoque.materia-prima.fornecedor.create', compact('materiaPrima', 'fornecedors'));

    }
    
    public function store(Request $request, $id)
    {
        $materiaPrima = $this->dadosMateriaPrima->find($id);

        if(!empty($request)){

            foreach ($request->fornecedor_id as $i => $value) {

                $valor_compra = str_replace([','], '.', $request->valor_compra[$i]);

                $novo = $this->dadosMateriaPrimaFornecedor->where("materia_prima_id", $materiaPrima->id)
                    ->where("fornecedor_id", $value)->first();
                if(!$novo){
                    $novo = new MateriaPrimaFornecedor;
                    $novo->materia_prima_id = $materiaPrima->id;
                    $novo->fornecedor_id = $value;
                }
                $novo->valor_compra =  !empty($valor_compra) ?  $valor_compra : null;
                $novo->observacao = $request->observacao[$i];
                $novo->save(); 
            }

            return redirect()
                ->route('materia-prima.index')
                ->with('success', 'Categoria adicionada com sucesso');
        }else{
            return redirect()->back()->with('error', 'Deve selecionar pelo uma categoria');;
        }
    }

    public function delete(Request $request)
    {
        $materiaPrima =  $this->dadosMateriaPrimaFornecedor->find($request->id);

        
        if(!$materiaPrima){
            $detalhes['message'] = "deu erro.";
            $detalhes['success'] = false;
        }else{
            $materiaPrima->delete();
            $detalhes['message'] = "deletato com sucesso.";
            $detalhes['success'] = true;
        }

       
        

        return response()->json($detalhes);
    }
}
