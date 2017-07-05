<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_receives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->integer('rejected');
            $table->integer('item_id')->length(10)->unsigned();
            $table->integer('receive_id')->length(10)->unsigned();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('receive_id')->references('id')->on('receives')->onDelete('cascade');
            $table->unique(['receive_id', 'item_id'],"composite 2");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_receives');
    }
}
