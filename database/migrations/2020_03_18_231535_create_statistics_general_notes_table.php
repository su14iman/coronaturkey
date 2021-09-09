<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsGeneralNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics_general_notes', function (Blueprint $table) {
//            $table->id();
            $table->increments('id');

            $table->unsignedInteger('StatisticsGeneralID');
            $table->unsignedInteger('anotherID');
            $table->longText('Note');

            $table->timestamps();

            $table->foreign('anotherID')
                ->references('id')
                ->on('users');

            $table->foreign('StatisticsGeneralID')
                ->references('id')
                ->on('statistics_generals')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics_general_notes');
    }
}
