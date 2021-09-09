<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
//            $table->id();
            $table->increments('id');
            $table->unsignedInteger('anotherID');
            $table->unsignedInteger('NewstypeID');
            $table->mediumText('Title');
            $table->longText('Description');
            $table->text('Text');
            $table->boolean('PublishStatus');
            $table->timestamps();


            $table->foreign('anotherID')
                ->references('id')
                ->on('users');

            $table->foreign('NewstypeID')
                ->references('id')
                ->on('news_types')
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
        Schema::dropIfExists('news');
    }
}
