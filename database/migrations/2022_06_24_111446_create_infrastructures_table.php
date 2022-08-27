<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfrastructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infrastructures', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 100);
            $table->date('date_construction');
            $table->bigInteger('effectif');
            $table->enum('etat', ['Fonctionnel', 'Non Fonctionnel']);
            $table->double('altitude');
            $table->double('longitude');
            $table->bigInteger('localite_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            //$table->integer('latrine_id')->unsigned();
            $table->string('source_eau', 100);
            
            $table->foreign('localite_id')->references('id')->on('localites')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('type_infrastructures')->onDelete('cascade');
            
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
        Schema::dropIfExists('infrastructures');
    }
}
