<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('prefix');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('company');
            $table->string('idcard');
            $table->string('housenum');
            $table->string('road');
            $table->string('district');
            $table->string('country');
            $table->string('province');
            $table->string('postalcode');
            $table->string('tel');
            $table->mediumText('idcardimg')->nullabble();
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
        Schema::dropIfExists('enrolls');
    }
}

