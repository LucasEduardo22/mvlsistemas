<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Estoque;
use App\Models\FormaPagamento;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Status;
use App\Models\Tamanho;
use App\Models\tamanhoItensPedidos;
use App\Models\TamanhoProduto;
use App\Models\Tecido;
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
    protected $dadosTecido;

    public function __construct(Pedido $pedido, Cliente $cliente, FormaPagamento $formaPagamento, Estoque $estoque, Produto $produto, Tamanho $tamanho, Tecido $tecido, TamanhoProduto $tamanhoProduto)
    {
        $this->dadosPedido = $pedido;
        $this->dadosCliente = $cliente;
        $this->dadosFormaPagamento = $formaPagamento;
        $this->dadosProduto = $produto;
        $this->dadosTamanhoProduto = $tamanhoProduto;
        $this->dadosTamanho = $tamanho;
        $this->dadosTecido = $tecido;
        $this->dadosEstoque = $estoque;
    }

    public function index(){
        $pedidos = $this->dadosPedido->orderBy('id', 'desc')->simplePaginate(5);

        return view('admin.pedido.index', compact("pedidos"));
    }

    public function createPedido()
    {

        $clientes = $this->dadosCliente->orderBy('nome', 'asc')->get();
        $tamanhos = $this->dadosTamanho;
        $formaPagamentos =  $this->dadosFormaPagamento->orderBy('nome', 'asc')->get();
        $estoques =  $this->dadosEstoque->orderBy('id', 'desc')->get();

        return view('admin.pedido.create', compact("clientes", "formaPagamentos", "tamanhos", "estoques"));
    }

    public function storePedido(Request $request)
    {
        $count = 0;
        $user = auth()->user()->id;
        
        $clientes["cliente_id"] = $request->cliente_id;
        $clientes["forma_pagamento_id"] = $request->forma_pagamento;
        $clientes["tipo_venda"] = $request->tipo_pedido_id;
        $clientes["user_id"] = $user;
        
        //Verifica qual botão foi selecionado
        if ($request->status_id == 2) {
            $clientes["status_id"] = Status::ORDENPRODUCAO;
        }elseif($request->status_id == 1){
            $clientes["status_id"] = Status::PENDENTE;
        }else{
            //$clientes["status_id"] = Status::CANCELADO;
            return redirect()->route('pedido.index')->with('success', "Pedido cancelado com sucesso");
        }
       // dd($clientes, $request->all());
        //Salvar dados na tabela pedido.
        $pedido = $this->dadosPedido->create($clientes); 
        if(!empty($request->tokenProduto)){
            for ($i=0; $i < count($request->tokenProduto); $i++){
                $count ++;
                $token = $request->tokenProduto[$i];
                
                $detalhes = $request->session()->get($token);   
               //dd($detalhes);
               $produto = $this->dadosProduto->where('modelo', $detalhes['modelo'])->first();
                if(!empty($produto->estoque)){   

                    $estoque_id = $produto->estoque->id;
                    
                    $itemPedidos["pedido_id"] = $pedido->id;
                    $itemPedidos["estoque_id"] = $estoque_id;
                    $itemPedidos["cor_principal"] = $detalhes['cor_principal'];
                    $itemPedidos["cor_secundaria"] = $detalhes['cor_secundaria'];
                    $itemPedidos["cor_terciaria"] = $detalhes['cor_terciaria'];
                    $itemPedidos["frente"] = $detalhes['frente'];
                    $itemPedidos["costa"] = $detalhes['costa'];
                    $itemPedidos["manga_direita"] = $detalhes['manga_direita'];
                    $itemPedidos["manga_esquerda"] = $detalhes['manga_esquerda'];
                    $itemPedidos["tipo_tamano"] = $detalhes['tipo'];
                    //dd($detalhes['valorSemtamanho']);
                   if($detalhes['tipo'] == "N"){
                        $itemPedidos["valor_unitario"] = str_replace([','], '.', $detalhes['valorSemtamanho']);
                        $itemPedidos["quantidade"] = $detalhes['quantidadeSemtamanho'];
                    }

                    // Salva os tecido na tabela tecido
                    $tecido_id1 = $this->dadosTecido->where("nome", $detalhes['tecido_principal'])->first();
                    $tecido_id2 = $this->dadosTecido->where("nome", $detalhes['tecido_secundario'])->first();
                    $tecido_id3 = $this->dadosTecido->where("nome", $detalhes['tecido_terciario'])->first();
                    
                    if(empty($tecido_id1) && $detalhes['tecido_principal'] != null){
                        $tecido1 = $this->dadosTecido->create(["nome" => $detalhes['tecido_principal']]);
                        $tecido[] = $tecido1->id;
                    }else{
                        if ($detalhes['tecido_principal'] != null) {
                            $tecido[] = $tecido_id1->id;
                        }
                    }

                    if(empty($tecido_id2) && $detalhes['tecido_secundario'] != null){
                        $tecido2 = $this->dadosTecido->create(["nome" => $detalhes['tecido_secundario']]);
                        $tecido[] = $tecido2->id;
                    }else{
                        if ($detalhes['tecido_secundario'] != null) {
                            $tecido[] = $tecido_id2->id;
                        }
                        
                    }

                    if(empty($tecido_id3) && $detalhes['tecido_terciario'] != null){
                        $tecido3 = $this->dadosTecido->create(["nome" => $detalhes['tecido_terciario']]);
                        $tecido[] = $tecido3->id;
                    }else{
                        if ($detalhes['tecido_terciario'] != null) {
                            $tecido[] = $tecido_id3->id;
                        }
                    }

                    
                    //Salva os dados na tabela Item.
                    $itensPedidos = ItemPedido::create($itemPedidos);
                    if ($detalhes['tecido_principal'] != null || $detalhes['tecido_secundario'] != null || $detalhes['tecido_terciario'] != null){
                        $itensPedidos->tecidos()->attach($tecido);
                    }
                   

                    if($detalhes['tipo'] != "N"){
                        // Tamanho masclino
                        foreach ($request->tamanhoM as $c => $tamanho_idM) {
                            $detalhesTamanho = $detalhes["tamanhoM"][$c];
                            $tamanhoProduto = TamanhoProduto::Where('tamanho_id', $tamanho_idM)->where('estoque_id', $produto->estoque->id)->first();
                            $novoM = new tamanhoItensPedidos;
                            $novoM->item_pedido_id = $itensPedidos->id;
                            $novoM->tamanho_produto_id = $tamanhoProduto->id;
                            $novoM->valor_unitario = $detalhesTamanho["valortamanho"] != 0 ? $detalhesTamanho["valortamanho"] : null;
                            $novoM->quantidade = $detalhesTamanho["quatidadetamanho"] != 0 ? $detalhesTamanho["quatidadetamanho"] : null;
                            $novoM->save();
                        }
                        //Feminino
                        foreach ($request->tamanhoF as $c => $tamanho_idF) {
                            $tamanhoProduto = TamanhoProduto::Where('tamanho_id', $tamanho_idF)->where('estoque_id', $produto->estoque->id)->first();
                            $detalhesTamanhoF = $detalhes["tamanhoF"][$c];
                            $novoF= new tamanhoItensPedidos;
                            $novoF->item_pedido_id = $itensPedidos->id;
                            $novoF->tamanho_produto_id = $tamanhoProduto->id;
                            $novoF->valor_unitario = $detalhesTamanhoF["valortamanho"] != 0 ? $detalhesTamanhoF["valortamanho"] : null;;
                            $novoF->quantidade = $detalhesTamanhoF["quatidadetamanho"] != 0 ? $detalhesTamanhoF["quatidadetamanho"] : null;
                            $novoF->save();
                        }
                        
                    }
                }else{
                    return redirect()->back();
                } 
                
            }
            return redirect()->route('pedido.index')->with('success', "Pedido atualizado com sucesso..");
        }else{
            return redirect()->back();
        }
    }
    

    public function editPedido($id)
    {
        $pedido = $this->dadosPedido->find($id);
        $clientes = $this->dadosCliente->orderBy('nome', 'asc')->get();
        $tamanhos = $this->dadosTamanho;
        $formaPagamentos =  $this->dadosFormaPagamento->orderBy('nome', 'asc')->get();

        $estoques =  $this->dadosEstoque->get();

        return view('admin.pedido.edit', compact("clientes", "formaPagamentos", "tamanhos", "estoques", "pedido"));
    }

    public function updatePedido(Request  $request, $id)
    {
        
        $pedido = $this->dadosPedido->find($id);
        $count = 0;
        $user = auth()->user()->id;
        
        $clientes["cliente_id"] = $request->cliente_id;
        $clientes["forma_pagamento_id"] = $request->forma_pagamento;
        $clientes["tipo_venda"] = $request->tipo_pedido_id;
        $clientes["user_id"] = $user;
        
        //Verifica qual botão foi selecionado
        if ($request->status_id == 2) {
            $clientes["status_id"] = Status::ORDENPRODUCAO;
        }elseif($request->status_id == 1){
            $clientes["status_id"] = Status::PENDENTE;
        }else{
            $clientes["status_id"] = Status::CANCELADO;
            return redirect()->route('pedido.index')->with('success', "Pedido cancelado com sucesso");
        }

       // dd($clientes, $request->all());
        //Salvar dados na tabela pedido.
        $pedido->update($clientes); 
        $deletaItem = $request->deletaProduto;
        $itemProduto = $request->itemProduto;

        foreach ($deletaItem as $key => $value) {
            if($value == "S"){
                $itemPedido = ItemPedido::find($itemProduto[$key]);
                $itemPedido->delete();
            }
        }

        if(!empty($request->tokenProduto)){
            for ($i=0; $i < count($request->tokenProduto); $i++){
                $count ++;
                $token = $request->tokenProduto[$i];
                $tecidos_id = [];
                $detalhes = $request->session()->get($token);   
               //dd($detalhes);
               if(!empty($detalhes)){
                    $produto = $this->dadosProduto->where('modelo', $detalhes['modelo'])->first();
                   if(!empty($produto->estoque)){   
   
                       $estoque_id = $produto->estoque->id;
                       
                       $itemPedidos["pedido_id"] = $pedido->id;
                       $itemPedidos["estoque_id"] = $estoque_id;
                       $itemPedidos["cor_principal"] = $detalhes['cor_principal'];
                       $itemPedidos["cor_secundaria"] = $detalhes['cor_secundaria'];
                       $itemPedidos["cor_terciaria"] = $detalhes['cor_terciaria'];
                       $itemPedidos["frente"] = $detalhes['frente'];
                       $itemPedidos["costa"] = $detalhes['costa'];
                       $itemPedidos["manga_direita"] = $detalhes['manga_direita'];
                       $itemPedidos["manga_esquerda"] = $detalhes['manga_esquerda'];
                       $itemPedidos["tipo_tamano"] = $detalhes['tipo'];
                       //dd($detalhes['valorSemtamanho']);
                      if($detalhes['tipo'] == "N"){
                           $itemPedidos["valor_unitario"] = str_replace([','], '.', $detalhes['valorSemtamanho']);
                           $itemPedidos["quantidade"] = $detalhes['quantidadeSemtamanho'];
                       }
   
                       // Salva os tecido na tabela tecido
                       $tecido_id1 = $this->dadosTecido->where("nome", $detalhes['tecido_principal'])->first();
                       $tecido_id2 = $this->dadosTecido->where("nome", $detalhes['tecido_secundario'])->first();
                       $tecido_id3 = $this->dadosTecido->where("nome", $detalhes['tecido_terciario'])->first();
                       
                       $itensPedido_id = ItemPedido::where('pedido_id',$pedido->id)->where('estoque_id', $estoque_id)->first();
                       
                       if(!empty($itensPedido_id)){
                           //Salva os dados na tabela Item.
                           $itensPedido_id->update($itemPedidos);
                           $itensPedidos = $itensPedido_id;
                         
                           if(!empty($itensPedido_id->tecidos)){
                                foreach ($itensPedidos->tecidos as $key => $value) {
                                    $tecidos_id[] = $value->nome;
                                }
                           }
                           
                       }else{
                           //Salva os dados na tabela Item.
                           $itensPedidos = ItemPedido::create($itemPedidos);
                       }
   
                       if(empty($tecido_id1) && $detalhes['tecido_principal'] != null){
                           $tecido1 = $this->dadosTecido->create(["nome" => $detalhes['tecido_principal']]);
                           $tecido[] = $tecido1->id;
                       }else{
                           if ($detalhes['tecido_principal'] != null) {
                               $tecido_id1->update(["nome" => $detalhes['tecido_principal']]);
                               $tecido[] = $tecido_id1->id;
                               if(count($tecidos_id) >= 1 && !empty($tecidos_id[1])){
                                   $detalhes['tecido_principal'] = null;
                               }
                           }
                       }
                       
                       if(empty($tecido_id2) && $detalhes['tecido_secundario'] != null){
                           $tecido2 = $this->dadosTecido->create(["nome" => $detalhes['tecido_secundario']]);
                           $tecido[] = $tecido2->id;
                       }else{
                           if ($detalhes['tecido_secundario'] != null) {
                               $tecido_id2->update(["nome" => $detalhes['tecido_secundario']]);
                               $tecido[] = $tecido_id2->id;
                               if(count($tecidos_id) >= 2 && !empty($tecidos_id[2])){
                                   $detalhes['tecido_secundario'] = null;
                               }
                           }
                           
                       }
                       
                       if(empty($tecido_id3) && $detalhes['tecido_terciario'] != null){
                           $tecido3 = $this->dadosTecido->create(["nome" => $detalhes['tecido_terciario']]);
                           $tecido[] = $tecido3->id;
                       }else{
                           if ($detalhes['tecido_terciario'] != null) {
                               $tecido_id3->update(["nome" => $detalhes['tecido_terciario']]);
                               $tecido[] = $tecido_id3->id;
                               if(count($tecidos_id) >=3 && !empty($tecidos_id[3])){
                                   $detalhes['tecido_terciario'] = null;
                               }
                           }
                       }
                       
                       if ($detalhes['tecido_principal'] != null || $detalhes['tecido_secundario'] != null || $detalhes['tecido_terciario'] != null){
                            $itensPedidos->tecidos()->attach($tecido);
                       }
                      
                       if($detalhes['tipo'] != "N"){
                           // Tamanho masclino
                           foreach ($request->tamanhoM as $c => $tamanho_idM) {
                               $detalhesTamanho = $detalhes["tamanhoM"][$c];
                               $tamanhoProduto = TamanhoProduto::Where('tamanho_id', $tamanho_idM)->where('estoque_id', $produto->estoque->id)->first();
                               $novoM = tamanhoItensPedidos::where('item_pedido_id',$itensPedidos->id)->where('tamanho_produto_id', $tamanhoProduto->id)->first();
   
                               if(empty($novoM)){
                                   $novoM = new tamanhoItensPedidos;
                               }

                               $novoM->item_pedido_id = $itensPedidos->id;
                               $novoM->tamanho_produto_id = $tamanhoProduto->id;
                               $novoM->valor_unitario = $detalhesTamanho["valortamanho"] != 0 ? $detalhesTamanho["valortamanho"] : null;
                               $novoM->quantidade = $detalhesTamanho["quatidadetamanho"] != 0 ? $detalhesTamanho["quatidadetamanho"] : null;
                               $novoM->save();
                           }
                           //Feminino
                           foreach ($request->tamanhoF as $c => $tamanho_idF) {
                               $tamanhoProduto = TamanhoProduto::Where('tamanho_id', $tamanho_idF)->where('estoque_id', $produto->estoque->id)->first();
                               $detalhesTamanhoF = $detalhes["tamanhoF"][$c];
                               $novoF = tamanhoItensPedidos::where('item_pedido_id',$itensPedidos->id)->where('tamanho_produto_id', $tamanhoProduto->id)->first();
                              
                               if(empty($novoF)){
                                   $novoF = new tamanhoItensPedidos;
                               }
   
                               $novoF->item_pedido_id = $itensPedidos->id;
                               $novoF->tamanho_produto_id = $tamanhoProduto->id;
                               $novoF->valor_unitario = $detalhesTamanhoF["valortamanho"] != 0 ? $detalhesTamanhoF["valortamanho"] : null;;
                               $novoF->quantidade = $detalhesTamanhoF["quatidadetamanho"] != 0 ? $detalhesTamanhoF["quatidadetamanho"] : null;
                               $novoF->save();
                           }
                           
                       }
                   }else{
                       return redirect()->back();
                   } 
                }
                
            }
            return redirect()->route('pedido.index')->with('success', "Pedido atualizado com sucesso..");
        }
    }

    public function showPedido($id)
    {
        $pedido = $this->dadosPedido->find($id);
        $empresa = Empresa::first();
        
        return view('admin.pedido.show', compact("pedido", "empresa"));
    }

    
    public function searchCliente(Request $request){
        $request->merge([
            'filtrar' => str_replace(['.', '/','-'], '', $request->filtrar),
        ]);
        $filtrar = $request->filtrar;

        $cliente = $this->dadosCliente->where("id",$filtrar)
                    ->orWhere('cpf_cnpj', $filtrar)->first();
        
        if(!empty($cliente)){
            $cliente['success'] = true;


        }else{
            $cliente['success'] = false;
            $cliente['message'] = "Cliente não encontrado";
        }
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
                }else{
                    $produto['success'] = false;
                    $produto['message'] = "Produto não encontrado";
                    return response()->json($produto);
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
        $dados['success'] = true;
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
        $itemPedido = ItemPedido::find($token);
        $detalhes = [];
        $tamanhoM = [];
        $tamanhoF = [];
        $detalhes['message'] = "detalhes adicionado.";
        if(!$itemPedido){
            //dd($itemPedido);
            $detalhes = $request->session()->get($token);    
            $detalhes['success'] = true;
            return response()->json($detalhes);
        }else{
            // Lista os detalhes que foram salvo na Base de dados.
            $tecido = [];
            foreach ($itemPedido->tecidos as $key => $value) {
                $tecido[] = $value->nome;
            }
            $detalhes['success'] = true;
            $detalhes['modelo'] = $itemPedido->estoque->produto->modelo;
            $detalhes['cor_principal'] = $itemPedido->cor_principal;
            $detalhes['cor_secundaria'] = $itemPedido->cor_secundaria;
            $detalhes['cor_terciaria'] = $itemPedido->cor_terciaria;
            $detalhes['tecido_principal'] = count($tecido) >= 1 ? $tecido[0] : null;
            $detalhes['tecido_secundario'] = count($tecido) >= 2 ? $tecido[1] : null;
            $detalhes['tecido_terciario'] = count($tecido) >= 3 ? $tecido[2] : null;
            $detalhes['quantidadeSemtamanho'] = $itemPedido->quantidade;
            $detalhes['valorSemtamanho'] =number_format($itemPedido->valor_unitario, 2, '.', '');
            $detalhes['frente'] = $itemPedido->frente;
            $detalhes['costa'] = $itemPedido->costa;
            $detalhes['manga_direita'] = $itemPedido->manga_direita;
            $detalhes['manga_esquerda'] = $itemPedido->manga_esquerda;
            $detalhes['tipo'] = $itemPedido->tipo_tamano;

           

            if($itemPedido->tipo_tamano != "N"){
                // Tamanho masclino
                foreach ($request->tamanhoM as $c => $tamanho_idM) {
                    $tamanhoProduto = TamanhoProduto::Where('tamanho_id', $tamanho_idM)->where('estoque_id', $itemPedido->estoque->id)->first();
                    $itensPedidosTamanho = tamanhoItensPedidos::where('tamanho_produto_id', $tamanhoProduto->id)->where('item_pedido_id', $itemPedido->id)->first();
                    $tamanhoM[] = ['quatidadetamanho' => $itensPedidosTamanho->quantidade ?? 0, 'valortamanho' => number_format($itensPedidosTamanho->valor_unitario, 2, '.', '') ?? 0];
                }

                // Tamanho Feminino
                foreach ($request->tamanhoF as $c => $tamanho_idF) {
                    $tamanhoProduto = TamanhoProduto::Where('tamanho_id', $tamanho_idF)->where('estoque_id', $itemPedido->estoque->id)->first();
                    $itensPedidosTamanho = tamanhoItensPedidos::where('tamanho_produto_id', $tamanhoProduto->id)->where('item_pedido_id', $itemPedido->id)->first();
                    $tamanhoF[] = ['quatidadetamanho' => $itensPedidosTamanho->quantidade ?? 0, 'valortamanho' => number_format($itensPedidosTamanho->valor_unitario, 2, '.', '') ?? 0];
                }
                $detalhes['tamanhoM'] = $tamanhoM;
                $detalhes['tamanhoF'] = $tamanhoF;
            }
            return response()->json($detalhes);
        }
        

       
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
