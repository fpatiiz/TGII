<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCartTables extends Migration
{
    public function up()
    {
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cart_items');
    }

    public function down()
    {
        // Se você precisar restaurar as tabelas, adicione o código aqui
    }
}
