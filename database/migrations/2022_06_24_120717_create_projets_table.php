<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 100);
            $table->string('code', 100);
            //$table->string('description',300);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('bayeur_id')->unsigned();
            //$table->foreign('bayeur_id')->references('id')->on('bayeurs')->onDelete('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projets');
    }
}
