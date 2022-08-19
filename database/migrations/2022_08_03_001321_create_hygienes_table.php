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
            $table->enum('type', ['T1', 'T2']);
            $table->bigInteger('effectif');
            $table->string('description');
            $table->integer('intervenant_id');
            $table->integer('projet_id');
            
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
