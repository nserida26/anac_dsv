<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('role', ['Representant','Coordinateur','Agent']);
            $table->enum('statu', ['Active','Désactivé']);
            $table->rememberToken();
            //$table->timestamps();
            /*
            $table->string('country')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['M', 'F'])->default('M');
            $table->string('image')->nullable();
            $table->boolean('admin')->default(0);
            $table->rememberToken();
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
