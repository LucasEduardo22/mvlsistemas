<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id', 'forma_pagamento_id', 'tipo_venda', 'user_id', 'status_id'];
}
