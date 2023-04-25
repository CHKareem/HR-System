<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullName')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('fatherName')->nullable();
            $table->string('motherName')->nullable();
            $table->string('birthAndPlace')->nullable();
            $table->string('nationalNumber')->unique('nationalNumber')->nullable();
            $table->string('degree')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('mobile')->nullable();
            $table->date('startDate')->nullable();
            $table->string('address')->nullable();
            // $table->integer('department_id')->unsigned()->nullable();
            // $table->integer('center_id')->unsigned()->nullable();
            $table->date('quitDate')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('vacationCount')->unsigned()->default(0);
            $table->time('hourlyLate', 2)->default('00:00:00.00');
            $table->time('hourlyVac', 2)->default('00:00:00.00');
            $table->integer('noPaymentCount')->unsigned()->default(0);
            $table->integer('healthCount')->unsigned()->default(0);
            $table->integer('workingYears')->unsigned()->default(0);
            $table->tinyInteger('isActive')->unsigned()->default(1);
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
        Schema::dropIfExists('employees');
    }
}
