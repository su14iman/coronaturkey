<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsCityesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics_cityes', function (Blueprint $table) {
//            $table->id();
            $table->increments('id');

            $table->mediumText('CityeName');
            $table->integer('Confirmed')->nullable();
            $table->integer('Deaths')->nullable();
            $table->integer('Recovered')->nullable();
            $table->integer('Active')->nullable();

            $table->unsignedInteger('lastEditroID');
            $table->timestamps();

            $table->foreign('lastEditroID')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics_cityes');
    }
}
