<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();

            $table->foreign('topic_id')->references('id')->on('topics');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topic_votes');
    }
}
