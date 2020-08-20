<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Fornecedor;
use App\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cliente = Cliente::all();
        $produto = Produto::all();
        $fornecedor = Fornecedor::all();
        return view('home', compact('cliente','produto','fornecedor'));
    }
}