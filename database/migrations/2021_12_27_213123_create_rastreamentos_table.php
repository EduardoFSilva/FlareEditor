<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRastreamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rastreamento', function (Blueprint $table) {
            $table->id();
            $table->string("nomeEmpresa");
            $table->string("site",511);
            $table->string("telefone");
            $table->string("email");
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
        Schema::dropIfExists('rastreamento');
    }
}
