<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cliente_id");
            $table->unsignedBigInteger("produto_id");
            $table->unsignedBigInteger("servico_id");
            $table->unsignedBigInteger("remessa_id");
            $table->integer("quantidade");
            $table->foreign("cliente_id")->references('id')->on("cliente");
            $table->foreign("produto_id")->references('id')->on("produto");
            $table->foreign("servico_id")->references('id')->on("servico");
            $table->foreign("remessa_id")->references('id')->on("remessa");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
