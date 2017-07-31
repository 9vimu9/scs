<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_prices', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('item_id')->length(7)->unsigned();
          $table->decimal('price',7,2);
          $table->integer('user_id')->unsigned(); // add this line
          $table->timestamps();
          $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('change_prices');
    }
}
