<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//delete  FROM `migrations` WHERE migration=
        Schema::create('item_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->decimal('unit_price',7,2);
            $table->integer('item_id')->length(10)->unsigned();
            $table->integer('order_id')->length(10)->unsigned();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['order_id', 'item_id'], 'composite_index');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_orders');
    }
}
