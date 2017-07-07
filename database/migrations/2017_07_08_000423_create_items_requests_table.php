<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('items_reportrequest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requested_amount');
            $table->integer('amount_in_store');
            $table->integer('item_id')->length(10)->unsigned();
            $table->integer('reportrequest_id')->length(10)->unsigned();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('reportrequest_id')->references('id')->on('reportrequests')->onDelete('cascade');
            $table->unique(['reportrequest_id', 'item_id'],"composite item_requests");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items_requests');
    }
}
