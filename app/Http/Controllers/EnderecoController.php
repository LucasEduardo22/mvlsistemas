<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function searchEstado(Request $request){
        $request->merge([
            'cep' => str_replace(['-'], '', $request->cep)
        ]);
        $cep = $request->cep;
    
        $estados = Estado::whereHas('cidade', function($query) use ($cep){
            $query->whereHas('bairro', function($query) use ($cep){
                $query->whereHas('endereco', function($query) use ($cep){
                    $query->where('cep', '=', $cep);
                });
            });
        })->first();
        return response()->json($estados);
    }
}
