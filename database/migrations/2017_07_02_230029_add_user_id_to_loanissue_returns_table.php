<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToLoanissueReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('loanissuereturns', function (Blueprint $table) {
             $table->integer('user_id')->unsigned(); // add this line
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loanissuereturns', function (Blueprint $table) {
             $table->integer('user_id')->unsigned(); // add this line
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}