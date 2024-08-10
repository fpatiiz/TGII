<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = ['nome', 'descricao', 'preco', 'quantidade'];


    public function scopeMaisVendidos($query)

    {

        return $query->orderBy('produtos.id', 'desc')

        ->limit(5);

    }

    public function vendas()
{
    return $this->hasMany(Venda::class);
}

public function scopeWithFornecedor($query)
{
    return $query->join('fornecedores', 'produtos.fornecedor_id', '=', 'fornecedores.id');
}
}
