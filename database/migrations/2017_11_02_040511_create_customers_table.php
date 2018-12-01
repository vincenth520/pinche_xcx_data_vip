<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatarUrl')->default('');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('gender')->default('');
            $table->string('language')->default('');
            $table->string('nickName')->default('');
            $table->string('openId')->default('');
            $table->string('province')->nullable();
            $table->string('county')->nullable();
            $table->string('phone')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('name')->nullable();
            $table->integer('driver')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('customers');
    }
}
