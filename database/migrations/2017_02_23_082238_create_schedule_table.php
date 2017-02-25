<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("train_id");
            $table->string("name");
            $table->string('from_address');
            $table->string('to_address');
            $table->dateTime("from_datetime");
            $table->dateTime("to_datetime");
            $table->float("distance");
            $table->integer("seats");
            $table->string("note")->nullable();
            $table->timestamps('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedules');
    }
}
