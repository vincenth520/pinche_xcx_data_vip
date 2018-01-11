<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->timestamp('leave_time');
            $table->string('departure');
            $table->string('destination');
            $table->tinyInteger('gender');
            $table->string('name');
            $table->string('phone');
            $table->text('remark')->nullable();
            $table->tinyInteger('surplus');
            $table->tinyInteger('type');
            $table->string('vehicle')->default('')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('see')->default(0);
            $table->string('price')->default('')->nullable();
            $table->tinyInteger('goods')->default(0);
            $table->string('departureTopSet')->default('')->nullable();
            $table->string('destinationTopSet')->default('')->nullable();
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
        Schema::dropIfExists('infos');
    }
}
