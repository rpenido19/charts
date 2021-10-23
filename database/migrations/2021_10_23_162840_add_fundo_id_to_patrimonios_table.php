<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFundoIdToPatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            $table->unsignedBigInteger('fundo_id');
            $table->foreign('fundo_id')->references('id')->on('fundos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            //
        });
    }
}
