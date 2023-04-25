<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterHolidayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_holiday', function (Blueprint $table) {
            $table->integer('center_id')->unsigned()->index();
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');
            $table->integer('holiday_id')->unsigned()->index();
            $table->foreign('holiday_id')->references('id')->on('holidays')->onDelete('cascade');
            $table->primary(['center_id', 'holiday_id']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // $table->id();
            // $table->unsignedInteger('center_id');
            // $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');
            // $table->unsignedInteger('holiday_id');
            // $table->foreign('holiday_id')->references('id')->on('holidays')->onDelete('cascade');
            // $table->timestamp('created_at')->useCurrent();
            // $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('center_holiday');
    }
}
