<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{ 
    const ADMIN = 1;

    protected $fillable = ['nome', 'descricao'];
}
