<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_images', function (Blueprint $table) {
//            $table->id();
            $table->increments('id');
            $table->unsignedInteger('anotherID');
            $table->unsignedInteger('newsID');

            $table->text('imageURL');
            $table->boolean('position');


            $table->timestamps();

            $table->foreign('anotherID')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('newsID')
                ->references('id')
                ->on('news')
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
        Schema::dropIfExists('news_images');
    }
}
