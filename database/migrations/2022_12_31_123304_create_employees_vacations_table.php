<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_vacations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedInteger('vacation_id');
            $table->foreign('vacation_id')->references('id')->on('vacations');
            $table->date('vacationDate');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('vacationtypes');
            $table->string('duration');
            $table->string('reason');
            $table->tinyInteger('isAuthor')->nullable();
            $table->Integer('discount')->nullable();
            $table->integer('isCheck')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_vacations');
    }
}
