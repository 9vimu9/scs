<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loanissues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->date('issue_date');
            $table->integer('user_id')->unsigned(); // add this line
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->integer('officer_id')->length(10)->unsigned();
            $table->timestamps();
            $table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('loan_issues');
    }
}
