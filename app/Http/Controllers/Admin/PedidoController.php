<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    protected $dadosCliente;

    public function createPedido()
    {
        return view('admin.pedido.create');
    }
}
