<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatrinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latrines', function (Blueprint $table) {
            $table->id();
            $table->enum('type_bloc',[2,4]);
            $table->tinyInteger('nbr_bloc');
            $table->enum('etat_bloc',['Separé','Non Separé']);

            $table->integer('infrastructure_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('latrines');
    }
}
