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
          $table->decimal('unit_price',7,2);
          $table->decimal('total',10,2);
          $table->integer('user_id')->length(5)->unsigned();
          $table->timestamps();
          $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade')->onUpdate('cascade');
          $table->unique(['quotation_id', 'item_id'], 'composite_index4');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
