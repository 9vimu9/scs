<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_type')->unsigned();//0=funaral 1=normal sale
            $table->string('description');
            $table->date('date');
            $table->date('deliver_date');
            $table->date('return_date');
            $table->decimal('service_charge',7,2);
            $table->decimal('advance',7,2);
            $table->double('discount',5,3);
            $table->integer('status')->unsigned(); //0=not_delivered 1=delivered
            $table->integer('user_id')->unsigned();
            $table->integer('quotation_id')->unsigned();
            $table->integer('customer_id')->length(10)->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales');
    }
}
