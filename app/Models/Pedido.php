<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id', 'forma_pagamento_id', 'tipo_venda', 'user_id', 'status_id'];

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function itensPedido(){
        return $this->hasMany(ItemPedido::class);
    }

    public function vendedor(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user(){
        return $this->hasOne(User::class, "id", 'user_id');
    }

    public function formaPagamento(){
        return $this->hasOne(FormaPagamento::class, "id", 'forma_pagamento_id');
    }

}
