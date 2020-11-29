<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrimaFornecedor extends Model
{
    use HasFactory;
    protected $fillable = ['materia_prima_id', 'fornecedor_id' ,'detalhes', "observacao"];

    public function fornecedorMateriaPrima(){
        return $this->hasMany(MateriaPrima::class, 'id', 'materia_prima_id');
    }
    public function materiaPrimaFornecedor(){
        return $this->hasOne(Fornecedor::class, "id", 'fornecedor_id');
    }
}
