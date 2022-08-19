<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designation', 100);
            $table->string('code', 100);
            //$table->string('description',300);
            $table->integer('projet_id')->unsigned();
            //$table->enum('type', ['Partiel', 'Complet']);
            //$table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->double('montant');
            $table->enum('avancement', ['Lancement','Planification','Exécution','Suivi','Clture']);
            $table->integer('intervenant_id')->unsigned();
           // $table->foreign('intervenant_id')->references('id')->on('intervenants')->onDelete('cascade');
            
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
        Schema::dropIfExists('interventions');
    }
}
