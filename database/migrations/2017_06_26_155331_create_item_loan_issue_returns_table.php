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
            $table->integer('item_id'); 
            $table->integer('loanissuereturn_id');
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
        Schema::drop('item_loan_issue_returns');
    }
}
