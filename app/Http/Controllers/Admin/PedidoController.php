<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Estoque;
use App\Models\FormaPagamento;
use App\Models\ItemPedido;
use App\Models\MateriaPrima;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Status;
use App\Models\TabelaPreco;
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
    protected $dadosMateriaPrimas;

    public function __construct(
        Pedido $pedido,
        Cliente $cliente,
        FormaPagamento $formaPagamento,
        Estoque $estoque,
        Produto $produto,
        Tamanho $tamanho,
        TamanhoProduto $tamanhoProduto,
        MateriaPrima $materiaPrima
    ) {
        $this->dadosPedido = $pedido;
        $this->dadosCliente = $cliente;
        $this->dadosFormaPagamento = $formaPagamento;
        $this->dadosProduto = $produto;
        $this->dadosTamanhoProduto = $tamanhoProduto;
        $this->dadosTamanho = $tamanho;
        $this->dadosEstoque = $estoque;
        $this->dadosMateriaPrimas = $materiaPrima;
    }

    public function index()
    {
        $pedidos = $this->dadosPedido->orderBy('id', 'desc')->simplePaginate(5);

        return view('admin.pedido.index', compact("pedidos"));
    }

    public function createPedido()
    {

        $clientes = $this->dadosCliente->orderBy('nome', 'asc')->get();
        $tamanhos = $this->dadosTamanho;
        $formaPagamentos =  $this->dadosFormaPagamento->orderBy('nome', 'asc')->get();
        $tabelaPrecos = TabelaPreco::orderBy('nome', 'asc')->get();
        $tecidos = $this->dadosMateriaPrimas->where("tipo_produto_id", 2)->get();
        $estoques =  $this->dadosEstoque->orderBy('id', 'desc')->get();

        return view('admin.pedido.create', compact("clientes", "formaPagamentos", "tamanhos", "estoques", "tabelaPrecos", "tecidos"));
    }

    public function storePedido(Request $request)
    {
        $count = 0;
        $user = auth()->user()->id;

        $clientes["cliente_id"] = $request->cliente_id;
        $clientes["forma_pagamento_id"] = $request->forma_pagamento_id;
        $clientes["tipo_venda"] = $request->tipo_pedido_id;
        $clientes["user_id"] = $user;
        $clientes["condicao"] = $request->condicao;
        $clientes["tabela_preco_id"] = $request->tabela_preco_id;

        $tecido = [];

        //Verifica qual botão foi selecionado
        if ($request->status_id == 2) {
            $clientes["status_id"] = Status::ORDENPRODUCAO;
        } elseif ($request->status_id == 1) {
            $clientes["status_id"] = Status::PENDENTE;
        } else {
            //$clientes["status_id"] = Status::CANCELADO;
            return redirect()->route('pedido.index')->with('success', "Pedido cancelado com sucesso");
        }
        // dd($clientes, $request->all());
        //Salvar dados na tabela pedido.
        $pedido = $this->dadosPedido->create($clientes);
        if (!empty($request->tokenProduto)) {
            for ($i = 0; $i < count($request->tokenProduto); $i++) {
                $count++;
                $token = $request->tokenProduto[$i];

                $detalhes = $request->session()->get($token);
                //dd($detalhes);
                $produto = $this->dadosProduto->where('modelo', $detalhes['modelo'])->first();
                if (!empty($produto->estoque)) {

                    $estoque_id = $produto->estoque->id;

                    $detalhes['valor_serigrafia'] = str_replace(['.'], '', $detalhes['valor_serigrafia']);
                    $detalhes['valor_serigrafia'] = str_replace([','], '.', $detalhes['valor_serigrafia']);
                    $itemPedidos["pedido_id"] = $pedido->id;
                    $itemPedidos["estoque_id"] = $estoque_id;
                    $itemPedidos["frente"] = $detalhes['frente'];
                    $itemPedidos["costa"] = $detalhes['costa'];
                    $itemPedidos["valor_serigrafia"] = $detalhes['valor_serigrafia'];
                    $itemPedidos["manga_direita"] = $detalhes['manga_direita'];
                    $itemPedidos["manga_esquerda"] = $detalhes['manga_esquerda'];
                    $itemPedidos["tipo_tamano"] = $detalhes['tipo'];
                    //dd($detalhes['valorSemtamanho']);
                    if ($detalhes['tipo'] == "N") {
                        $itemPedidos["valor_unitario"] = str_replace([','], '.', $detalhes['valorSemtamanho']);
                        $itemPedidos["quantidade"] = $detalhes['quantidadeSemtamanho'];
                    }

                    // Salva os tecido na tabela tecido
                    $tecido_id1 = $this->dadosMateriaPrimas->where("sigla", $detalhes['nome_principal'])->first();
                    $tecido_id2 = $this->dadosMateriaPrimas->where("sigla", $detalhes['nome_secundario'])->first();
                    $tecido_id3 = $this->dadosMateriaPrimas->where("sigla", $detalhes['nome_terciario'])->first();

                    if (!empty($tecido_id1) && $detalhes['nome_principal'] != null) {
                        $tecido[] = $tecido_id1->id;
                    }

                    if (!empty($tecido_id2) && $detalhes['nome_secundario'] != null) {
                        $tecido[] = $tecido_id2->id;
                    }

                    if (!empty($tecido_id3) && $detalhes['nome_terciario'] != null) {
                        $tecido[] = $tecido_id3->id;
                    }


                    //Salva os dados na tabela Item.
                    $itensPedidos = ItemPedido::create($itemPedidos);
                    if ($detalhes['nome_principal'] != null || $detalhes['nome_secundario'] != null || $detalhes['nome_terciario'] != null) {
                        $itensPedidos->tecidos()->attach($tecido);
                    }


                    if ($detalhes['tipo'] != "N") {
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
                            $novoF = new tamanhoItensPedidos;
                            $novoF->item_pedido_id = $itensPedidos->id;
                            $novoF->tamanho_produto_id = $tamanhoProduto->id;
                            $novoF->valor_unitario = $detalhesTamanhoF["valortamanho"] != 0 ? $detalhesTamanhoF["valortamanho"] : null;;
                            $novoF->quantidade = $detalhesTamanhoF["quatidadetamanho"] != 0 ? $detalhesTamanhoF["quatidadetamanho"] : null;
                            $novoF->save();
                        }
                    }
                } else {
                    return redirect()->back();
                }
            }
            return redirect()->route('pedido.index')->with('success', "Pedido atualizado com sucesso..");
        } else {
            return redirect()->back();
        }
    }


    public function editPedido($id)
    {
        $pedido = $this->dadosPedido->find($id);
        $clientes = $this->dadosCliente->orderBy('nome', 'asc')->get();
        $tamanhos = $this->dadosTamanho;
        $tabelaPrecos = TabelaPreco::orderBy('nome', 'asc')->get();
        $tecidos = $this->dadosMateriaPrimas->where("tipo_produto_id", 2)->get();
        $formaPagamentos =  $this->dadosFormaPagamento->orderBy('nome', 'asc')->get();

        $estoques =  $this->dadosEstoque->get();

        return view('admin.pedido.edit', compact("clientes", "formaPagamentos", "tamanhos", "estoques", "pedido", "tabelaPrecos", "tecidos"));
    }

    public function updatePedido(Request  $request, $id)
    {

        $pedido = $this->dadosPedido->find($id);
        $count = 0;
        $user = auth()->user()->id;
        $clientes["cliente_id"] = $request->cliente_id;
        $clientes["forma_pagamento_id"] = $request->forma_pagamento_id;
        $clientes["tipo_venda"] = $request->tipo_pedido_id;
        $clientes["user_id"] = $user;
        $clientes["condicao"] = $request->condicao;
        $clientes["tabela_preco_id"] = $request->tabela_preco_id;
        $tecido = [];
        //Verifica qual botão foi selecionado
        if ($request->status_id == 2) {
            $clientes["status_id"] = Status::ORDENPRODUCAO;
        } elseif ($request->status_id == 1) {
            $clientes["status_id"] = Status::PENDENTE;
        } else {
            $clientes["status_id"] = Status::CANCELADO;
            return redirect()->route('pedido.index')->with('success', "Pedido cancelado com sucesso");
        }

        // dd($clientes, $request->all());
        //Salvar dados na tabela pedido.
        $pedido->update($clientes);
        $deletaItem = $request->deletaProduto;
        $itemProduto = $request->itemProduto;

        foreach ($deletaItem as $key => $value) {
            if ($value == "S") {
                $itemPedido = ItemPedido::find($itemProduto[$key]);
                $itemPedido->delete();
            }
        }

        if (!empty($request->tokenProduto)) {
            for ($i = 0; $i < count($request->tokenProduto); $i++) {
                $count++;
                $token = $request->tokenProduto[$i];
                $tecidos_id = [];
                $detalhes = $request->session()->get($token);
                //dd($detalhes);
                if (!empty($detalhes)) {
                    $produto = $this->dadosProduto->where('modelo', $detalhes['modelo'])->first();
                    if (!empty($produto->estoque)) {

                        $estoque_id = $produto->estoque->id;
                        $detalhes['valor_serigrafia'] = str_replace(['.'], '', $detalhes['valor_serigrafia']);
                        $detalhes['valor_serigrafia'] = str_replace([','], '.', $detalhes['valor_serigrafia']);
                        $itemPedidos["pedido_id"] = $pedido->id;
                        $itemPedidos["estoque_id"] = $estoque_id;
                        $itemPedidos["frente"] = $detalhes['frente'];
                        $itemPedidos["costa"] = $detalhes['costa'];
                        $itemPedidos["valor_serigrafia"] = $detalhes['valor_serigrafia'];
                        $itemPedidos["manga_direita"] = $detalhes['manga_direita'];
                        $itemPedidos["manga_esquerda"] = $detalhes['manga_esquerda'];
                        $itemPedidos["tipo_tamano"] = $detalhes['tipo'];
                        //dd($detalhes['valorSemtamanho']);
                        if ($detalhes['tipo'] == "N") {
                            $itemPedidos["valor_unitario"] = str_replace([','], '.', $detalhes['valorSemtamanho']);
                            $itemPedidos["quantidade"] = $detalhes['quantidadeSemtamanho'];
                        }

                        // Salva os tecido na tabela tecido
                        $tecido_id1 = $this->dadosMateriaPrimas->where("sigla", $detalhes['nome_principal'])->first();
                        $tecido_id2 = $this->dadosMateriaPrimas->where("sigla", $detalhes['nome_secundario'])->first();
                        $tecido_id3 = $this->dadosMateriaPrimas->where("sigla", $detalhes['nome_terciario'])->first();

                        if (!empty($tecido_id1) && $detalhes['nome_principal'] != null) {
                            $tecido[] = $tecido_id1->id;
                        }

                        if (!empty($tecido_id2) && $detalhes['nome_secundario'] != null) {
                            $tecido[] = $tecido_id2->id;
                        }

                        if (!empty($tecido_id3) && $detalhes['nome_terciario'] != null) {
                            $tecido[] = $tecido_id3->id;
                        }


                        $itensPedido_id = ItemPedido::where('pedido_id', $pedido->id)->where('estoque_id', $estoque_id)->first();

                        if (!empty($itensPedido_id)) {
                            //Salva os dados na tabela Item.
                            $itensPedido_id->update($itemPedidos);
                            $itensPedidos = $itensPedido_id;
                            $itensPedidos->tecidos()->detach();

                            if (!empty($itensPedido_id->tecidos)) {
                                foreach ($itensPedidos->tecidos as $key => $value) {
                                    $tecidos_id[] = $value->nome;
                                }
                            }
                            if ($detalhes['tecido_principal'] != null || $detalhes['tecido_secundario'] != null || $detalhes['tecido_terciario'] != null) {
                                $itensPedidos->tecidos()->attach($tecido);
                            }
                        } else {
                            //Salva os dados na tabela Item.
                            $itensPedidos = ItemPedido::create($itemPedidos);

                            if ($detalhes['tecido_principal'] != null || $detalhes['tecido_secundario'] != null || $detalhes['tecido_terciario'] != null) {
                                $itensPedidos->tecidos()->attach($tecido);
                            }
                        }

                        if ($detalhes['tipo'] != "N") {
                            // Tamanho masclino
                            foreach ($request->tamanhoM as $c => $tamanho_idM) {
                                $detalhesTamanho = $detalhes["tamanhoM"][$c];
                                $tamanhoProduto = TamanhoProduto::Where('tamanho_id', $tamanho_idM)->where('estoque_id', $produto->estoque->id)->first();
                                $novoM = tamanhoItensPedidos::where('item_pedido_id', $itensPedidos->id)->where('tamanho_produto_id', $tamanhoProduto->id)->first();

                                if (empty($novoM)) {
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
                                $novoF = tamanhoItensPedidos::where('item_pedido_id', $itensPedidos->id)->where('tamanho_produto_id', $tamanhoProduto->id)->first();

                                if (empty($novoF)) {
                                    $novoF = new tamanhoItensPedidos;
                                }

                                $novoF->item_pedido_id = $itensPedidos->id;
                                $novoF->tamanho_produto_id = $tamanhoProduto->id;
                                $novoF->valor_unitario = $detalhesTamanhoF["valortamanho"] != 0 ? $detalhesTamanhoF["valortamanho"] : null;;
                                $novoF->quantidade = $detalhesTamanhoF["quatidadetamanho"] != 0 ? $detalhesTamanhoF["quatidadetamanho"] : null;
                                $novoF->save();
                            }
                        }
                    } else {
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


    public function searchCliente(Request $request)
    {
        $request->merge([
            'filtrar' => str_replace(['.', '/', '-'], '', $request->filtrar),
        ]);
        $filtrar = $request->filtrar;

        $cliente = $this->dadosCliente->where("id", $filtrar)
            ->orWhere('cpf_cnpj', $filtrar)->first();

        if (!empty($cliente)) {
            $cliente['success'] = true;
        } else {
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
        $dados['forma_pagamento_id'] = $request->forma_pagamento_id;
        $dados['tabela_preco_id'] = $request->tabela_preco_id;

        if ($dados['forma_pagamento_id'] == 0) {
            $produto['success'] = false;
            $produto['message'] = "Necessário informar a forma de pagamento";
            return response()->json($produto);
        } elseif ($dados["tabela_preco_id"] == 0) {
            $produto['success'] = false;
            $produto['message'] = "Necessário informar a tabela de preço";
            return response()->json($produto);
        } else {
            // Verifica o tipo de pedido, se for venda cadastrar na base:
            if ($request->tipo_pedido == "O" || $request->pedido_id != null) {
                if (!empty($filtro)) {
                    $produto = $this->dadosProduto->where('id', $filtro)
                        ->orWhere('modelo', $filtro)->first();

                    if (!empty($produto)) {
                        $subGrupo = $produto->subGrupo;
                        $produto["sub_grupo"] = $subGrupo->nome;

                        if (!empty($produto->estoque)) {
                            $dados['estoque_id'] = $produto->estoque->id;
                            $produto["success"] = true;
                            /* if ($request->tipo_pedido == "V") {
                                $itensPedidos = ItemPedido::create($dados);
                                $produto["itemPedidos_id"] = $itensPedidos->id;
                            } */
                            return response()->json($produto);
                        } else {
                            $produto['success'] = false;
                            $produto['message'] = "Produto indicado não se encontra em estoque.";
                            return response()->json($produto);
                        }
                    } else {
                        $produto['success'] = false;
                        $produto['message'] = "Produto não encontrado";
                        return response()->json($produto);
                    }
                }
            } else {
                $produto['success'] = false;
                $produto['message'] = "Necessário informar o cliente.";
                return response()->json($produto);
            }
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

        $token = $request->token;
        $modelo = $request->modelo;
        //dd($request->modelo);


        if ($token != null) {
            $itemPedido = ItemPedido::find($token);
            $detalhes = [];
            $tamanhoM = [];
            $tamanhoF = [];
            $detalhes['message'] = "detalhes adicionado.";
            if (!$itemPedido) {
                $produto = $this->dadosProduto->where('modelo', $modelo)->first();
                $estoque_id = $produto->estoque->id;

                //dd($itemPedido);
                $detalhes = $request->session()->get($token);
                $detalhes['semTamanhosPreco'] = $produto->estoque->preco_venda;
                $detalhes['tamanhosPreco'] = TamanhoProduto::where('estoque_id', $estoque_id)->get();
                $detalhes['valor_tecido_principal'] = $produto->estoque->valor_tecido_principal;
                $detalhes['valor_tecido_secundario'] = $produto->estoque->valor_tecido_secundario;
                $detalhes['valor_tecido_terciario'] = $produto->estoque->valor_tecido_terciario;
                $detalhes['success'] = true;
                return response()->json($detalhes);
            } else {
                $produto = $this->dadosProduto->where('modelo', $modelo)->first();
                $estoque_id = $produto->estoque->id;
                // Lista os detalhes que foram salvo na Base de dados.
                $tecido = [];
                foreach ($itemPedido->tecidos as $key => $value) {
                    $tecido[] = $value->sigla;
                }
                $detalhes['success'] = true;
                $detalhes['modelo'] = $itemPedido->estoque->produto->modelo;
                $detalhes['nome_principal'] = count($tecido) >= 1 ? $tecido[0] : null;
                $detalhes['nome_secundario'] = count($tecido) >= 2 ? $tecido[1] : null;
                $detalhes['nome_terciario'] = count($tecido) >= 3 ? $tecido[2] : null;
                $detalhes['valor_tecido_principal'] = $produto->estoque->valor_tecido_principal;
                $detalhes['valor_tecido_secundario'] = $produto->estoque->valor_tecido_secundario;
                $detalhes['valor_tecido_terciario'] = $produto->estoque->valor_tecido_terciario;
                $detalhes['quantidadeSemtamanho'] = $itemPedido->quantidade;
                $detalhes['valorSemtamanho'] = number_format($itemPedido->valor_unitario, 2, '.', '');
                $detalhes['frente'] = $itemPedido->frente;
                $detalhes['costa'] = $itemPedido->costa;
                $detalhes['valor_serigrafia'] = number_format($itemPedido->valor_serigrafia, 2, ',', '');
                $detalhes['manga_direita'] = $itemPedido->manga_direita;
                $detalhes['manga_esquerda'] = $itemPedido->manga_esquerda;
                $detalhes['tipo'] = $itemPedido->tipo_tamano;


                if ($itemPedido->tipo_tamano != "N") {
                    $produto = $this->dadosProduto->where('modelo', $modelo)->first();
                    $estoque_id = $produto->estoque->id;
                    $detalhes['tamanhosPreco'] = TamanhoProduto::where('estoque_id', $estoque_id)->get();
                    $detalhes['semTamanhosPreco'] = $produto->estoque->preco_venda;
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
        } else {
            $produto = $this->dadosProduto->where('modelo', $modelo)->first();
            $estoque_id = $produto->estoque->id;
            $detalhes['success'] = true;
            $detalhes['semTamanhosPreco'] = $produto->estoque->preco_venda;
            $detalhes['valor_tecido_principal'] = $produto->estoque->valor_tecido_principal;
            $detalhes['valor_tecido_secundario'] = $produto->estoque->valor_tecido_secundario;
            $detalhes['valor_tecido_terciario'] = $produto->estoque->valor_tecido_terciario;
            $detalhes['tamanhosPreco'] = TamanhoProduto::where('estoque_id', $estoque_id)->get();
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

    public function tabelaPreco(Request $request)
    {
        $dados['tabela_preco_id'] = $request->tabela_preco_id;

        if ($dados["tabela_preco_id"] == 0) {
            $tabela['success'] = false;
            $tabela['message'] = "Necessário informar a tabela de preço";
            return response()->json($tabela);
        } else {
            $tabelaPreco_id = TabelaPreco::find($dados['tabela_preco_id']);
            $tabela['tabelaPreco_id'] = $tabelaPreco_id->ganho;
            $tabela['success'] = true;
            return response()->json($tabela);
        }
    }
}
