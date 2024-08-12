<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'itemable_id', 'itemable_type', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
    public function itemable()
    {
        return $this->morphTo();
    }
}
