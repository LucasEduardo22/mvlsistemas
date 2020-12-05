<?php

use App\Http\Livewire\MateriaPrimaFornecedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
include('web_builder.php');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/home/grade', function () {
        return view('admin.grade.index');
    })->name('grade');

// GUI crud builder routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home/grade', function () {
        return view('admin.grade.index');
    })->name('grade');
    Route::get('/', 'HomeController@index')->name('home');


    //Empresas
    Route::resource('/home/empresa', 'Empresa\EmpresaController');

    //Departamento
    Route::resource('/home/departamento', 'Admin\DepartamentoController');

    //Forma de Pagamento
    Route::resource('/home/forma-pagamento', 'Admin\FormaPagamentoController');

    //Tabela de preço
    Route::resource('/home/tabela-preco', 'Admin\TabelaPrecoController');

    //Grupo
    Route::resource('/home/grupo', 'Admin\GrupoController');

    //Sub Grupo
    Route::resource('/home/sub-grupo', 'Admin\SubGrupoController');

    //status
    Route::resource('/home/status', 'Admin\StatusController');

    //tamanho
    Route::resource('/home/tamanho', 'Admin\TamanhoController');

    //unidade
    Route::resource('/home/unidade', 'Admin\UnidadeController');

    //Cliente
    Route::any('/home/cliente/search', 'Admin\ClienteController@search')->name("cliente.search");
    Route::resource('/home/cliente', 'Admin\ClienteController');

    //Fornecedor
    Route::any('/home/fornecedor/search', 'Admin\FornecedorController@search')->name("fornecedor.search");
    Route::resource('/home/fornecedor', 'Admin\FornecedorController');

    //Ficha Tecnica 
    Route::get('/home/produto/{id}/create-materia-prima', 'Admin\FichaTecnicaController@create')->name('produto.materia-prima.create');
    Route::post('/home/produto/{id}/store-materia-prima', 'Admin\FichaTecnicaController@store')->name('produto.materia-prima.estoque.store');
    Route::get('/home/produto/{id}/edit-materia-prima', 'Admin\FichaTecnicaController@edit')->name('produto.materia-prima.edit');
    Route::put('/home/produto/{id}/update-materia-prima', 'Admin\FichaTecnicaController@update')->name('produto.materia-prima.estoque.update');
    Route::delete('/home/produto/{id}/{produto_id}/delete-materia-prima', 'Admin\FichaTecnicaController@destroy')->name('produto.materia-prima.estoque.destroy');

    //Materia Prima
    Route::get("/home/materia-prima/index", 'Admin\MateriaPrimaController@index')->name('materia-prima.index');
    Route::get("/home/materia-prima/create", 'Admin\MateriaPrimaController@create')->name('materia-prima.create');
    Route::post('/home/materia-prima/store', 'Admin\MateriaPrimaController@store')->name('materia-prima.store');
    Route::get('/home/materia-prima/{id}/edit', 'Admin\MateriaPrimaController@edit')->name('materia-prima.edit');
    Route::put('/home/materia-prima/{id}/update', 'Admin\MateriaPrimaController@update')->name('materia-prima.update');
    Route::get('/home/materia-prima/{id}/show', 'Admin\MateriaPrimaController@show')->name('materia-prima.show');
    Route::any('/home/materia-prima/search', 'Admin\MateriaPrimaController@search')->name("materia-prima.search");

    //Materia Prima - Fornecedor
    Route::get("home/materia-prima/{id}/fornecedor/create", "Admin\MateriaPrimaFornecedorController@create")->name('materia-prima.fornecedor.create');
    Route::get("home/materia-prima/{id}/fornecedor/edit", "Admin\MateriaPrimaFornecedorController@edit")->name('materia-prima.fornecedor.edit');
    Route::post("home/materia-prima/{id}/store", "Admin\MateriaPrimaFornecedorController@store")->name('materia-prima.fornecedor.store');
    Route::post("home/materia-prima/delete", "Admin\MateriaPrimaFornecedorController@delete")->name('materia-prima.fornecedor.delete');

    //Rotas de Produto
    Route::get('/home/produto/index', 'Admin\ProdutoController@index')->name('produto.index');
    Route::get('/home/produto/create', 'Admin\ProdutoController@create')->name('produto.create');
    Route::post('/home/produto/store', 'Admin\ProdutoController@store')->name('produto.store');
    Route::get('/home/produto/{id}/edit', 'Admin\ProdutoController@edit')->name('produto.edit');
    Route::put('/home/produto/{id}/update', 'Admin\ProdutoController@update')->name('produto.update');
    Route::get('/home/produto/{id}/show', 'Admin\ProdutoController@show')->name('produto.show');
    Route::any('/home/produto/search', 'Admin\ProdutoController@search')->name("produto.search");

    //Rotas de Estoque
    Route::get('/home/estoque/index', 'Admin\EstoqueController@index')->name('estoque.index');
    Route::get('/home/estoque/{id}/create', 'Admin\EstoqueController@create')->name('estoque.create');
    Route::post('/home/estoque/{id}/store', 'Admin\EstoqueController@store')->name('estoque.store');
    Route::get('/home/estoque/{id}/edit', 'Admin\EstoqueController@edit')->name('estoque.edit');
    Route::put('/home/estoque/{id}/update', 'Admin\EstoqueController@update')->name('estoque.update');
    Route::get('/home/estoque/{id}/show', 'Admin\EstoqueController@show')->name('estoque.show');

    //Rotoas de usuário 
    Route::get('/home/usuario/index', 'Admin\UsuarioController@indexUsuario')->name('usuario.index');
    Route::get('/home/usuario/create', 'Admin\UsuarioController@createUsuario')->name('usuario.create');
    Route::post('/home/usuario/store', 'Admin\UsuarioController@storeUsuario')->name('usuario.store');
    Route::get('/home/usuario/{id}/edit', 'Admin\UsuarioController@editUsuario')->name('usuario.edit');
    Route::put('/home/usuario/{id}/update', 'Admin\UsuarioController@updateUsuario')->name('usuario.update');
    Route::get('/home/usuario/{id}/show', 'Admin\UsuarioController@showUsuario')->name('usuario.show');
    Route::any('/home/usuario/search', 'Admin\UsuarioController@search')->name('usuario.search');

    //RECUPERA SENHA
    Route::get('/home/usuario/edit-senha', 'Admin\UsuarioController@editSenha')->name('usuario.edit.senha');
    Route::put('/home/usuario/update-senha', 'Admin\UsuarioController@updateSenha')->name('usuario.update.senha');

    //ROTAS PEDIDOS
    Route::get('/home/pedido/index', 'Admin\PedidoController@index')->name('pedido.index');
    Route::any('/pedido/search-pedido', 'Admin\PedidoController@searchCliente')->name('pedido.search');
    Route::get('/home/pedido/create', 'Admin\PedidoController@createPedido')->name('pedido.create');
    Route::post('/home/pedido/store', 'Admin\PedidoController@storePedido')->name('pedido.store');
    Route::get('/home/pedido/{id}/editar', 'Admin\PedidoController@editPedido')->name('pedido.edit');
    Route::post('/home/pedido/{id}/update', 'Admin\PedidoController@updatePedido')->name('pedido.update');
    Route::get('/home/pedido/{id}/show', 'Admin\PedidoController@showPedido')->name('pedido.show');
    Route::any('/cliente/adicionar-cliente', 'Admin\PedidoController@searchCliente')->name('pedido.cliente.searchPedido'); 
    Route::post('/home/pedido/adicionar-poduto', 'Admin\PedidoController@adicionarProduto')->name('pedido.produto');
    Route::post('/home/pedido/adicionar-poduto-detalhes', 'Admin\PedidoController@detalhesProduto')->name('detalhes.produto');
    Route::post('/home/pedido/adicionar-poduto-recuperar-detalhes', 'Admin\PedidoController@recuperarDetalhesProduto')->name('recuperar.detalhes.produto');
    Route::post('/home/pedido/alterar-tabela-preco', 'Admin\PedidoController@tabelaPreco')->name('recuperar.tabela.preco');
    Route::post('/home/pedido/adicionar-poduto-deleta-detalhes', 'Admin\PedidoController@deletaDetalhesProduto')->name('deleta.detalhes.produto');

    //ROTAS DE ENDEREÇOS FICAR POR ULTIMO.
    Route::post('/estado/search', 'Admin\EnderecoController@searchEstado')->name('endereco.estado.search');
    Route::post('/cidade/search', 'Admin\EnderecoController@searchCidade')->name('endereco.cidade.search');
    Route::post('/bairro/search', 'Admin\EnderecoController@searchBairro')->name('endereco.bairro.search');
    Route::post('/endereco/search', 'Admin\EnderecoController@search')->name('endereco.search');

});
Route::get('{name?}', 'JoshController@showView');
/* Route::post('/home/pedido/adicionar-poduto', 'Admin\PedidoController@adicionarProduto')->name('pedido.produto'); */
