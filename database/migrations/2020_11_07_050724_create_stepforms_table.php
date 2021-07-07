<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stepforms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('projectname');
            $table->string('detail');
            $table->string('object');
            $table->string('sum');
            $table->string('total');
            $table->date('startat');
            $table->date('endat');
            $table->string('tel');
            $table->string('email');
            $table->string('cate');
            $table->string('namebank');
            $table->string('numberbank');
            $table->string('bank');
            $table->string('branch');
            $table->integer('status');
            $table->integer('user_id');
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
        Schema::dropIfExists('stepforms');
    }
}
