<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('sales_type')->unsigned();//0=funaral 1=normal sale

          $table->decimal('service_charge',7,2);
          $table->decimal('advance',7,2);
          $table->double('discount',5,3);
          $table->integer('user_id')->unsigned();
          $table->integer('customer_id')->length(10)->unsigned();
          $table->integer('days');
          $table->timestamps();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quotations');
    }
}
