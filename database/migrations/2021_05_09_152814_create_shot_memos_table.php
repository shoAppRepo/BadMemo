<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShotMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shotMemos', function (Blueprint $table) {
            $table->increments('shot_memo_id');
            $table->integer('user_id');
            $table->integer('shot_id');
            $table->string('title');
            $table->text('content');
            $table->string('status');
            $table->timestamps();

            //外部キー
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
        Schema::dropIfExists('shotMemos');
    }
}
