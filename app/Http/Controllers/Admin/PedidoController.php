<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\FormaPagamento;
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

    public function __construct(Pedido $pedido, Cliente $cliente, FormaPagamento $formaPagamento, Produto $produto, Tamanho $tamanho, TamanhoProduto $tamanhoProduto)
    {
        $this->dadosPedido = $pedido;
        $this->dadosCliente = $cliente;
        $this->dadosFormaPagamento = $formaPagamento;
        $this->dadosProduto = $produto;
        $this->dadosTamanhoProduto = $tamanhoProduto;
        $this->dadosTamanho = $tamanho;
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
        $produtos =  $this->dadosProduto->paginate(10);
         
        return view('admin.pedido.create', compact("clientes", "formaPagamentos", "tamanhos", "produtos"));
    }

    public function adicionarProduto(Request $request)
    {
        $dados = $request->filtrar;
        if(!empty($dados)){ 
            $produto = $this->dadosProduto->where('id', $dados)
                        ->orWhere('modelo', $dados)->first();
            if(!empty($produto)){
                $subGrupo = $produto->subGrupo->nome;
                if(!empty($produto->estoque)){ 
                    $tamanhoProduto = $this->dadosTamanhoProduto->where('estoque_id', $produto->estoque->id)->get();
                    return response()->json([$produto, $subGrupo, $tamanhoProduto]);
                }else{
                    return response()->json([$produto,$subGrupo]);
                }
            }
            
        }
    }
}
