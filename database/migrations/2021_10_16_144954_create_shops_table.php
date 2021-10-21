<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable(false);
            $table->unsignedBigInteger('game');
            $table->string('domain')->nullable(false);
            $table->string('ip')->nullable(false);
            $table->integer('port')->nullable(false);
            $table->string('rcon_password')->nullable(true);
            $table->boolean('active')->default(true);
            $table->integer('percent')->default(3);
            $table->timestamps();
        });

        Schema::table('shops', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('game')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
