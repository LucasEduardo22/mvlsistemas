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
    Route::get('/', 'HomeController@index')->name('home');

    //subGrupo
    Route::resource('/home/sub-grupo', 'Admin\SubGrupoController');

    //subGrupo
    Route::resource('/home/tipo-produto', 'Admin\TipoProdutoController');

    //status
    Route::resource('/home/status', 'Admin\StatusController');

    //tamanho
    Route::resource('/home/tamanho', 'Admin\TamanhoController');

    //unidade
    Route::resource('/home/unidade', 'Admin\UnidadeController');

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
});
Route::get('{name?}', 'JoshController@showView');
