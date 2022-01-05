<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemessasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remessa', function (Blueprint $table) {
            $table->id();
            $table->string("codigoRastreamento");
            $table->string("tipoRemessa");
            $table->string("linkRastreamento",511);
            $table->dateTime('dataDeEntrega');
            $table->string('progressoRastreamento');
            $table->unsignedBigInteger("rastreamento_id");
            $table->foreign("rastreamento_id")->references('id')->on("rastreamento");
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
        Schema::dropIfExists('remessa');
    }
}
