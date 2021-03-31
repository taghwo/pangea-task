<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_subscribers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete("set null");
            $table->unsignedBigInteger('subscriber_id')->nullable();
            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete("set null");
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
        Schema::dropIfExists('topic_subscribers');
    }
}
