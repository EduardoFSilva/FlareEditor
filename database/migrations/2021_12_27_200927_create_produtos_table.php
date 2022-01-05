<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->string("descricao");
            $table->double("preco",8,2);
            $table->string("link",511);
            $table->unsignedBigInteger("vendedor_id");
            $table->foreign("vendedor_id")->references('id')->on("vendedor");
            $table->unsignedBigInteger("servico_id");
            $table->foreign("servico_id")->references('id')->on("servico");
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
        Schema::dropIfExists('produto');
    }
}
