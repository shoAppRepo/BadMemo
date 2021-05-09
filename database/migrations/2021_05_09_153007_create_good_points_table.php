<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goodPoints', function (Blueprint $table) {
            $table->integer('practice_id')->unsigned();
            $table->integer('user_id');
            $table->increments('good_point_id');
            $table->string('title');
            $table->text('content');
            $table->timestamps();

            //外部キー
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('practice_id')->references('practice_id')->on('practices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goodPoints');
    }
}
