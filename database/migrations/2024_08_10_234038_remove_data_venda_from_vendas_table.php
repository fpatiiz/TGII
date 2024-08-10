<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDataVendaFromVendasTable extends Migration

{

    public function up()

    {

        Schema::table('vendas', function (Blueprint $table) {

            $table->dropColumn('data_venda');

        });

    }


    public function down()

    {

        Schema::table('vendas', function (Blueprint $table) {

            $table->timestamp('data_venda');

        });

    }

}