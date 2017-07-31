<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('amount');
          $table->integer('item_id')->length(10)->unsigned();
          $table->integer('return_id')->length(10)->unsigned();
          $table->timestamps();
          $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('return_id')->references('id')->on('returns')->onDelete('cascade')->onUpdate('cascade');
          $table->unique(['return_id', 'item_id'], 'composite_index5');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('return_items');
    }
}
