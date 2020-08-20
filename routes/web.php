<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */
//ENDEREÇO
Route::post('/home/estado/search', 'EnderecoController@searchEstado')->name('endereco.estado.search');
Route::post('/home/cidade/search', 'EnderecoController@searchCidade')->name('endereco.cidade.search');
Route::post('/home/bairro/search', 'EnderecoController@searchBairro')->name('endereco.bairro.search');
Route::post('/home/endereco/search', 'EnderecoController@search')->name('endereco.search');

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    /* //ENDEREÇO
    Route::post('/home/estado/search', 'EnderecoController@searchEstado')->name('endereco.estado.search');
    Route::post('/home/cidade/search', 'EnderecoController@searchCidade')->name('endereco.cidade.search');
    Route::post('/home/bairro/search', 'EnderecoController@searchBairro')->name('endereco.bairro.search');
    Route::post('/home/endereco/search', 'EnderecoController@search')->name('endereco.search'); */

    //Rotas do Cliente
    Route::get('/home/cliente', 'ClienteController@index')->name('cliente.index');
    Route::get('/home/cliente/create', 'ClienteController@create')->name('cliente.create');
    Route::post('/home/cliente/store', 'ClienteController@store')->name('cliente.store');
    Route::get('/home/cliente/{id}/edit', 'ClienteController@edit')->name('cliente.edit');
    Route::put('/home/cliente/{id}/update', 'ClienteController@update')->name('cliente.update');
    Route::any('/home/cliente/search', 'ClienteController@search')->name('cliente.search');

    //Rotas do Produto
    Route::get('/home/produto', 'ProdutoController@index')->name('produto.index');
    Route::get('/home/produto/create', 'ProdutoController@create')->name('produto.create');
    Route::post('/home/produto/store', 'ProdutoController@store')->name('produto.store');
    Route::get('/home/produto/{id}/edit', 'ProdutoController@edit')->name('produto.edit');
    Route::put('/home/produto/{id}/update', 'ProdutoController@update')->name('produto.update');
    Route::any('/home/produto/search', 'ProdutoController@search')->name('produto.search');
    Route::get('/home/produto/{id}/show', 'ProdutoController@show')->name('produto.show');
    Route::delete('/home/produto/{id}', 'ProdutoController@destroy')->name('produto.destroy');

    //Rotas da Ficha Tecníca
    Route::get('/home/produto/{id}/fichatecnica/create', 'ProdutoController@createFichaTecnica')->name('produto.fichatecnica.create');
    Route::post('/home/produto/{id}/fichatecnica/store', 'ProdutoController@storeFichaTecnica')->name('produto.fichatecnica.store');
    Route::get('/home/produto/{id}/fichatecnica/edit', 'ProdutoController@editFichaTecnica')->name('produto.fichatecnica.edit');
    Route::put('/home/produto/{id}/fichatecnica/update', 'ProdutoController@updateFichaTecnica')->name('produto.fichatecnica.update');
    
    //Rotas de Funcionário
    Route::get('/home/fornecedor', 'FornecedorController@index')->name('fornecedor.index');
    Route::get('/home/fornecedor/create', 'FornecedorController@create')->name('fornecedor.create');
    Route::post('/home/fornecedor/store', 'FornecedorController@store')->name('fornecedor.store');
    Route::get('/home/fornecedor/{id}/edit', 'FornecedorController@edit')->name('fornecedor.edit');
    Route::put('/home/fornecedor/{id}/update', 'FornecedorController@update')->name('fornecedor.update');

});