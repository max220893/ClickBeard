<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barbeiros_especialidades', function (Blueprint $table) {
            $table->bigInteger('especialidade_int')->unsigned();
            $table->foreign('especialidade_int')->references('id')->on('especialidades');
            $table->bigInteger('barbeiro_id')->unsigned();
            $table->foreign('barbeiro_id')->references('id')->on('barbeiros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barbeiros_especialidades');
    }
};
