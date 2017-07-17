<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('interest_id1');
            $table->foreign('interest_id1')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('interest_id2');
            $table->foreign('interest_id2')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('interest_id3');
            $table->foreign('interest_id3')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('interest_id4');
            $table->foreign('interest_id4')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('interest_id5');
            $table->foreign('interest_id5')->references('id')->on('categories')->onDelete('cascade');

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
