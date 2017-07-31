<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHutItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hut_items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('item_id')->length(10)->unsigned();
          $table->integer('hut_id')->length(10)->unsigned();
          $table->integer('amount');
          $table->timestamps();
          $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('hut_id')->references('id')->on('huts')->onDelete('cascade')->onUpdate('cascade');
          $table->unique(['hut_id', 'item_id'],"composite hut_items");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hut_items');
    }
}
