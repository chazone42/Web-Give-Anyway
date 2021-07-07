<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepformWithdraw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_withdraw', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('stepforms_id');
            $table->string('reason');
            $table->integer('img_id');
            $table->text('des');
            $table->integer('withdraw_id');
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
        Schema::dropIfExists('sf_withdraw');
    }
}
