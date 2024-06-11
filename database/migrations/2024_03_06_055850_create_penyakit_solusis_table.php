<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyakitSolusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyakit_solusi', function (Blueprint $table) {
            $table->increments('id_penyakit_solusi', 4);
            $table->text('definisi');
            $table->text('solusi');
            $table->integer('id_penyakit')->unsigned();;
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
        Schema::dropIfExists('penyakit_solusi');
    }
}
