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
        Schema::create('item_loanissues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->date('return_date');
            
            $table->integer('item_id')->length(10)->unsigned();
            $table->integer('loanissue_id')->length(10)->unsigned();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('loanissue_id')->references('id')->on('loanissues')->onDelete('cascade');
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
