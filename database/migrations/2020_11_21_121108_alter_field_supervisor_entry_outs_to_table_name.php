<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldSupervisorEntryOutsToTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('field_supervisor_entry_outs', function (Blueprint $table) {
            $table->Integer('area_id')->nullable();
            $table->String('bin_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('field_supervisor_entry_outs', function (Blueprint $table) {
            //
        });
    }
}
