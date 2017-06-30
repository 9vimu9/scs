<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemLoanIssueReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_loanissuereturn', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('amount');
            $table->integer('rejected');
               
           $table->integer('item_id')->length(10)->unsigned();
            $table->integer('loanissuereturn_id')->length(10)->unsigned();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('loanissuereturn_id')->references('id')->on('loanissuereturns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_loan_issue_returns');
    }
}
