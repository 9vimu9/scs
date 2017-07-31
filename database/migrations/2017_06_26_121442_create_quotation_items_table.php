<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('amount');
          $table->integer('item_id')->length(10)->unsigned();
          $table->integer('quotation_id')->length(10)->unsigned();
          $table->timestamps();
          $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade')->onUpdate('cascade');
          $table->unique(['quotation_id', 'item_id'], 'composite_index4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quotation_items');
    }
}
