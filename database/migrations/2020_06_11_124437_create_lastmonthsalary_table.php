<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastmonthsalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lastmonthsalary', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employ_id');
            $table->integer('advanced_salary_id');
            $table->string('salary_month');
            $table->string('remaining_salary');
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
        Schema::dropIfExists('lastmonthsalary');
    }
}
