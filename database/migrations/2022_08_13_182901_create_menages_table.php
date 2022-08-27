<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menages', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->integer('nbr');
            $table->bigInteger('localite_id')->unsigned();
            $table->bigInteger('projet_id')->unsigned();
            //$table->timestamps();
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->foreign('localite_id')->references('id')->on('localites')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menages');
    }
}
