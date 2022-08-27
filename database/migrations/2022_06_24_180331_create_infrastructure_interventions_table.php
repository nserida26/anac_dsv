<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfrastructureInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infrastructure_interventions', function (Blueprint $table) {
            $table->id();

            $table->date('date_intervention');

            $table->bigInteger('infrastructure_id')->unsigned();
            $table->foreign('infrastructure_id')->references('id')->on('infrastructures')->onDelete('cascade');
            
            $table->bigInteger('intervention_id')->unsigned();
            $table->foreign('intervention_id')->references('id')->on('interventions')->onDelete('cascade');
            
            ///$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infrastructure_interventions');
    }
}
