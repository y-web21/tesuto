<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("article_id")->nullable();
            $table->string("session_id");
            $table->unsignedInteger('user_id')->nullable();
            $table->string("ip");
            $table->string("agent");
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
        Schema::dropIfExists('view_logs');
    }
}
