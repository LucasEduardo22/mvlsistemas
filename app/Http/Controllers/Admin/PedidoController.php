<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    protected $dadosCliente;

    public function __construct(Cliente $cliente)
    {
        $this->dadosCliente = $cliente;
    }
    public function createPedido()
    {
        $clientes = $this->dadosCliente->paginate(5);
        return view('admin.pedido.create', compact("clientes"));
    }
}
