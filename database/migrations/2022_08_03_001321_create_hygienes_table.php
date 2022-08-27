<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHygienesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hygienes', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Alimentaire', 'Corporelle','Hospitaliére','Autres']);
            $table->bigInteger('effectif');
            $table->string('description');
            $table->bigInteger('intervenant_id')->unsigned();
            $table->bigInteger('projet_id')->unsigned();
            $table->foreign('intervenant_id')->references('id')->on('intervenants')->onDelete('cascade');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
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
        Schema::dropIfExists('hygienes');
    }
}
