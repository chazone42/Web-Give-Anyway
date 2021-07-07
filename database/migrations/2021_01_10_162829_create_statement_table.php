<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statement', function (Blueprint $table) {
            $table->id();
            $table->integer('stepforms_id');
            $table->string('accountNumber');
            $table->string('date');
            $table->decimal('sum');
            $table->string('currency');
            $table->integer('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statement');
    }
}
