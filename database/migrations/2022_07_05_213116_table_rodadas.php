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
        Schema::create('rodadas', function (Blueprint $table) {
            $table->id();
            $table->integer('pontuacao_jogador_1');
            $table->integer('pontuacao_jogador_2');
            $table->integer('pontuacao_jogador_3')->nullable();
            $table->integer('pontuacao_jogador_4')->nullable();
            $table->date('data_rodada')->nullable();

            $table->unsignedBigInteger('id_partida');
            $table->foreign('id_partida')->references('id')->on('partidas');

            $table->unsignedBigInteger('id_jogador_1');
            $table->foreign('id_jogador_1')->references('id')->on('users');

            $table->unsignedBigInteger('id_jogador_2');
            $table->foreign('id_jogador_2')->references('id')->on('users');

            $table->unsignedBigInteger('id_jogador_3')->nullable();
            $table->foreign('id_jogador_3')->references('id')->on('users');

            $table->unsignedBigInteger('id_jogador_4')->nullable();
            $table->foreign('id_jogador_4')->references('id')->on('users');
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
        Schema::disableForeignKeyConstraints();
        Schema::drop('rodadas');
        Schema::enableForeignKeyConstraints();
    }
};
