<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_notifications', function (Blueprint $table) {
//            $table->id();
            $table->increments('id');

            $table->boolean('type');

            $table->unsignedInteger('anotherID');
            $table->unsignedInteger('newsID')->nullable();

            $table->mediumText('Title')->nullable();
            $table->longText('Description')->nullable();
            $table->boolean('PublishStatus');

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
        Schema::dropIfExists('news_notifications');
    }
}
