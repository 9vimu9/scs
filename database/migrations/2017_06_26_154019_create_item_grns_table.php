<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemgrnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_grns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->integer('item_id')->length(10)->unsigned();
            $table->integer('grn_id')->length(10)->unsigned();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('grn_id')->references('id')->on('grns')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['grn_id', 'item_id'],"composite 2");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_grns');
    }
}
