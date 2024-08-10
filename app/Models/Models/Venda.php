<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';
    protected $fillable = ['user_id', 'produto_id', 'valor_total', 'quantidade_vendida'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}