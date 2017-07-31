<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnitpricTotalUserIdColumnsForQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('quotation_items', function($table) {
        $table->decimal('unit_price',7,2);
        $table->decimal('total',7,2);
        $table->integer('user_id')->length(5)->unsigned();
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
      Schema::table('quotation_items', function($table) {
        $table->decimal('unit_price',7,2);
        $table->decimal('total',7,2);
        $table->integer('user_id')->length(5)->unsigned();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
      });

    }
}
