<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemLoanissuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_loanissue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->integer('item_id');
            $table->integer('loanissue_id');
            $table->date('return_date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_loanissues');
    }
}
