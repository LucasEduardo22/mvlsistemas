<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $fillable = [
        'pedido_id', 'estoque_id', 'valor_unitario', 'valor_total', 
        'quantidade', "cor_principal", 'cor_secundaria', 'cor_terciaria',
        'frente', 'costa', 'manga_direita', 'manga_esquerda', 'tipo_tamano'
    ];
}
