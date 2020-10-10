<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\FormaPagamento;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    protected $dadosCliente;
    protected $dadosFormaPagamento;

    public function __construct(Cliente $cliente, FormaPagamento $formaPagamento)
    {
        $this->dadosCliente = $cliente;
        $this->dadoFormaPagamento = $formaPagamento;
    }
    public function createPedido()
    {
        $clientes = $this->dadosCliente->paginate(5);
        $formaPagamentos =  $this->dadoFormaPagamento->all();
        return view('admin.pedido.create', compact("clientes", "formaPagamentos"));
    }
}
