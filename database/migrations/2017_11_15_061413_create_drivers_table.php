<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->tinyInteger('gender');
            $table->string('idnumber');
            $table->string('province');
            $table->string('city');
            $table->string('county');
            $table->date('firstgetdate');
            $table->string('platenumber');
            $table->string('vehicle');
            $table->string('color');
            $table->string('owner');
            $table->date('cargetdate');
            $table->string('driverlicense');
            $table->string('drivinglicense');
            $table->string('idcard1');
            $table->string('idcard2');
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
        Schema::dropIfExists('drivers');
    }
}
