<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_views', function (Blueprint $table) {
//            $table->id();
            $table->increments('id');

            $table->unsignedInteger('newsID');
            $table->ipAddress('IP');
            $table->mediumText('Country');


            $table->timestamps();

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
        Schema::dropIfExists('news_views');
    }
}
