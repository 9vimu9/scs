<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTable extends Migration
{
    public function up()
    {//delete  FROM `migrations` WHERE migration=
        Schema::create('meta', function (Blueprint $table) {
            $table->increments('id');

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
        Schema::drop('meta');
    }
}
