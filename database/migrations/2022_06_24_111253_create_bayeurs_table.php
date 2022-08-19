<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayeurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('code', 100);
            $table->string('tel', 100);
            //$table->string('email', 100);
            $table->string('adresse', 100);
            //$table->string('...', 100);
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
        Schema::dropIfExists('bayeurs');
    }
}
