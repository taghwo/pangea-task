<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebHookNotificationsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_hook_notifications_logs', function (Blueprint $table) {
            $table->id();
            $table->longText('logs')->nullable();
            $table->longText('data')->nullable();
            $table->longText('url')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('attempt')->default(1);
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
        Schema::dropIfExists('web_hook_notifications_logs');
    }
}
