<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/modelo/search',
        '/estado/search',
        '/cidade/search', 
        '/bairro/search',
        '/endereco/search',
        '/cliente/search-pedido',
        '/home/pedido/adicionar-poduto',
        'api/*',
    ];
}
