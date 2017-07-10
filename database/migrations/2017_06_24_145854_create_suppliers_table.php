<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
              $table->increments('id');
              $table->string('name');
              $table->string('address');
              $table->string('tel');
             $table->string('email'); // add this line
             $table->integer('cat_id')->unsigned(); // add this line
             $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade');
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
        Schema::drop('suppliers');
    }
}
