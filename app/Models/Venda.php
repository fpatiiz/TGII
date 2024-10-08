<?php

// app/Models/Venda.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Venda extends Model
{
    protected $table = 'vendas';
    protected $fillable = ['data_venda', 'user_id', 'produto_id', 'valor_total', 'quantidade_vendida'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}