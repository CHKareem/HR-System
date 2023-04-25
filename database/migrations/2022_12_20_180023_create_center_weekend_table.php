<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterWeekendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_weekend', function (Blueprint $table) {
            $table->integer('center_id')->unsigned()->index();
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');
            $table->integer('weekend_id')->unsigned()->index();
            $table->foreign('weekend_id')->references('id')->on('weekends')->onDelete('cascade');
            $table->primary(['center_id', 'weekend_id']);
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
        Schema::dropIfExists('center_weekend');
    }
}
