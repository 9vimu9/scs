<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumnsforitemtable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('items', function (Blueprint $table) {
        $table->integer('stock_amount')->length(10)->nullable()->unsigned();
        $table->integer('current_amount')->length(10)->nullable()->unsigned();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('items', function (Blueprint $table) {
        $table->integer('stock_amount')->length(10)->nullable()->unsigned();
        $table->integer('current_amount')->length(10)->nullable()->unsigned();
      });
    }
}
