<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrimaFornecedor extends Model
{
    use HasFactory;
    protected $fillable = ['materia_prima_id', 'fornecedor_id' ,'detalhes', "observacao"];
}
