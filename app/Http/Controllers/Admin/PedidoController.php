<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Estoque;
use App\Models\FormaPagamento;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Tamanho;
use App\Models\TamanhoProduto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    protected $dadosPedido;
    protected $dadosCliente;
    protected $dadosProduto;
    protected $dadosFormaPagamento;
    protected $dadosTamanhoProduto;
    protected $dadosTamanho;
    protected $dadosEstoque;

    public function __construct(Pedido $pedido, Cliente $cliente, FormaPagamento $formaPagamento, Estoque $estoque, Produto $produto, Tamanho $tamanho, TamanhoProduto $tamanhoProduto)
    {
        $this->dadosPedido = $pedido;
        $this->dadosCliente = $cliente;
        $this->dadosFormaPagamento = $formaPagamento;
        $this->dadosProduto = $produto;
        $this->dadosTamanhoProduto = $tamanhoProduto;
        $this->dadosTamanho = $tamanho;
        $this->dadosEstoque = $estoque;
    }

    public function index(){
        $pedidos = $this->dadosPedido->paginate(5);

        return view('admin.pedido.index', compact("pedidos"));
    }

    public function createPedido()
    {

        $clientes = $this->dadosCliente->paginate(5);
        $tamanhos = $this->dadosTamanho;
        $formaPagamentos =  $this->dadosFormaPagamento->all();
        $estoques =  $this->dadosEstoque->paginate(10);

        return view('admin.pedido.create', compact("clientes", "formaPagamentos", "tamanhos", "estoques"));
    }

    public function storePedido(Request $request)
    {
        dd($request->all());
    }
    
    public function searchCliente(Request $request){
        $request->merge([
            'filtrar' => str_replace(['.', '/','-'], '', $request->filtrar),
        ]);
        $filtrar = $request->filtrar;

        $cliente = $this->dadosCliente->where("id",$filtrar)
                    ->orWhere('cpf_cnpj', $filtrar)->first();
        
        $dados['tipo_venda'] = $request->tipo_pedido;
        $dados['forma_pagamento_id'] = $request->forma_pagamento_id == 0 ? null : $request->forma_pagamento_id;
        $dados['cliente_id'] = $cliente->id;
        $dados['user_id'] = Auth()->user()->id;
        $dados['status_id'] = 1; //padrão ativo 
        /* if($cliente){
            if(!empty($request->codigo)){
                $pedido = $this->dadosPedido->find($request->codigo);
                $pedido->update($dados);
                $cliente["codigo"] = $pedido->id;
            }else{
                $pedido = $this->dadosPedido->create($dados);
                $cliente["codigo"] = $pedido->id;
            }
        }  */
        return response()->json($cliente);
    }

    public function adicionarProduto(Request $request)
    {
        $filtro = $request->filtrar;
        $dados['tipo_venda'] = $request->tipo_pedido;
        $dados['pedido_id'] = $request->pedido_id;
        // Verifica o tipo de pedido, se for venda cadastrar na base:
        if ($request->tipo_pedido == "O" || $request->pedido_id != null) {
            if(!empty($filtro)){ 
                $produto = $this->dadosProduto->where('id', $filtro)
                            ->orWhere('modelo', $filtro)->first();
                if(!empty($produto)){
                    $subGrupo = $produto->subGrupo;
                    $produto["sub_grupo"] = $subGrupo->nome;
    
                    if(!empty($produto->estoque)){ 
                        //$tamanhoProduto = $this->dadosTamanhoProduto->where('estoque_id', $produto->estoque->id)->get();
    
                        $dados['estoque_id'] = $produto->estoque->id;
                        $produto["success"] = true;
                        /* if ($request->tipo_pedido == "V") {
                            $itensPedidos = ItemPedido::create($dados);
                            $produto["itemPedidos_id"] = $itensPedidos->id;
                        } */
                        return response()->json($produto);
                    }else{
                        $produto['success'] = false;
                        $produto['message'] = "Produto indicado não se encontra em estoque.";
                        return response()->json($produto);
                    }
                }
            }
        }else{
            $produto['success'] = false;
            $produto['message'] = "Necessário informar o cliente.";
            return response()->json($produto);
        }


        
    }

    public function detalhesProduto(Request $request)
    {
        //guarda detalhe do produto;
        $token = $request->token;
        $dados = $request->all();
        $request->session()->put($token, $dados);    
        
        $produto['success'] = true;
        $produto['message'] = "detalhes adicionado.";
        return response()->json($produto);
    }

    public function recuperarDetalhesProduto(Request $request)
    {
        //dd($request->all());
        //guarda detalhe do produto;
        $token = $request->token;

        $detalhes = $request->session()->get($token);    
        //dd($detalhes);
        // Deletando uma sessão específica:
        //$request->session()->forget($token);

        $detalhes['success'] = true;
        $detalhes['message'] = "detalhes adicionado.";

        return response()->json($detalhes);
    }

    public function deletaDetalhesProduto(Request $request)
    {
        $token = $request->token;
        $detalhes = $request->session()->get($token);    

        // Deletando uma sessão específica:
        $request->session()->forget($token);

        $detalhes['success'] = true;
        $detalhes['message'] = "deletato com sucesso.";

        return response()->json($detalhes);
    }
}
