<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanIssueReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loanissuereturns', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            
            $table->integer('loanissue_id')->length(10)->unsigned();
            $table->timestamps();
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
        Schema::drop('loan_issue_returns');
    }
}
