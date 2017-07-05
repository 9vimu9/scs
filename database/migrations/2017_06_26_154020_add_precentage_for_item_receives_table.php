<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrecentageForItemReceivesTable extends Migration
{
     public function up()
    {
        Schema::table('item_receives', function (Blueprint $table) {
             $table->decimal('precentage',3,2)->unsigned(); // add this line
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_receives', function (Blueprint $table) {
              $table->decimal('precentage',3,2)->unsigned(); // add this line
           
        });
    }
}
