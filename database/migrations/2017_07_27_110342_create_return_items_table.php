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
        Schema::create('returning_items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('amount');
          $table->integer('sale_item_id')->length(10)->unsigned();
          $table->integer('returning_id')->length(10)->unsigned();
          $table->timestamps();
          $table->foreign('sale_item_id')->references('id')->on('sale_items')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('returning_id')->references('id')->on('returnings')->onDelete('cascade')->onUpdate('cascade');
          $table->unique(['returning_id', 'sale_item_id'], 'composite_index9');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('returning_items');
    }
}
