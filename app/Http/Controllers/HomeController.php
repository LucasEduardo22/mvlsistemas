<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Cliente $cliente, Produto $produto, Fornecedor $fornecedor)
    {
        $this->dadosCliente = $cliente;
        $this->dadosProduto = $produto;
        $this->dadosFornecedor = $fornecedor;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cliente = $this->dadosCliente->get();
        $produto = $this->dadosProduto->get();
        $fornecedor = $this->dadosFornecedor->get();
        $user = Auth::user();
        
        if ($user->status_id != Status::PENDENTE) {
            return view('admin.home.index', compact("cliente" , "produto", "fornecedor"));
        } else {
            return redirect()->route('usuario.edit.senha');
        }
        
        
    }
}
