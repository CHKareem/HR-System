<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('employees', function($table) {

        // $table->foreign('center_id')
        // ->references('id')->on('centers')
        // ->onUpdate('cascade')
        // ->onDelete('cascade');

        // $table->foreign('department_id')
        // ->references('id')->on('departments')
        // ->onUpdate('cascade')
        // ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    //     Schema::table('employees', function (Blueprint $table) {
    //         $table->dropForeign('center_id');
    //         $table->dropForeign('department_id');
    //     });
    }
}
