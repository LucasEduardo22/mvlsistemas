<?php

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

// GUI crud builder routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home/grade', function () {
        return view('admin.grade.index');
    })->name('grade');
    Route::get('/', 'HomeController@index')->name('home');

    //Aviamentos
    Route::resource('/home/aviamento', 'Admin\AviamentoController');

    //Departamento
    Route::resource('/home/departamento', 'Admin\DepartamentoController');

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
    Route::get('/home/produto/{id}/create-aviamento', 'Admin\FichaTecnicaController@create')->name('produto.aviamento.create');
    Route::post('/home/produto/{id}/store-aviamento', 'Admin\FichaTecnicaController@store')->name('produto.aviamento.estoque.store');

    // Rotas de Produto
    Route::get('/home/produto/index', 'Admin\ProdutoController@index')->name('produto.index');
    Route::get('/home/produto/create', 'Admin\ProdutoController@create')->name('produto.create');
    Route::post('/home/produto/store', 'Admin\ProdutoController@store')->name('produto.store');
    Route::get('/home/produto/{id}/edit', 'Admin\ProdutoController@edit')->name('produto.edit');
    Route::put('/home/produto/{id}/update', 'Admin\ProdutoController@update')->name('produto.update');
    // Rotas de Estoque
    Route::get('/home/estoque/index', 'Admin\EstoqueController@index')->name('estoque.index');
    Route::get('/home/estoque/{id}/create', 'Admin\EstoqueController@create')->name('estoque.create');
    Route::post('/home/estoque/{id}/store', 'Admin\EstoqueController@store')->name('estoque.store');
    Route::get('/home/estoque/{id}/edit', 'Admin\EstoqueController@edit')->name('estoque.edit');
    Route::put('/home/estoque/{id}/update', 'Admin\EstoqueController@update')->name('estoque.update');
    Route::get('/home/estoque/{id}/show', 'Admin\EstoqueController@show')->name('estoque.show');

    Route::post('/estado/search', 'Admin\EnderecoController@searchEstado')->name('endereco.estado.search');
    Route::post('/cidade/search', 'Admin\EnderecoController@searchCidade')->name('endereco.cidade.search');
    Route::post('/bairro/search', 'Admin\EnderecoController@searchBairro')->name('endereco.bairro.search');
    Route::post('/endereco/search', 'Admin\EnderecoController@search')->name('endereco.search');
});
Route::get('{name?}', 'JoshController@showView');
