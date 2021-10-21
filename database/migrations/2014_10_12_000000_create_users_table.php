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
            $table->string('fullname')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->float('balance')->default("0.00");
            $table->string('email')->unique();
            $table->string('recoveryCode')->nullable()->unique();
            $table->boolean('verified')->default(0);
            $table->boolean('twofactor')->default(0);
            $table->string('twofactorCode')->nullable();
            $table->timestamp('twofactorCodeTime')->nullable();
            $table->boolean('logs')->default(1);
            $table->boolean('smtp_unusual_activity')->default(0);
            $table->boolean('smtp_new_browser')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('admin')->default(0);
            $table->boolean('support')->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
