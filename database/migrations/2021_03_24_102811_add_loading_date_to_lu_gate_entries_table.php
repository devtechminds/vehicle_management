<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoadingDateToLuGateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lu_gate_entries', function (Blueprint $table) {
            $table->dateTime('loading_date')->nullable();
            $table->dateTime('vehicle_exit_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lu_gate_entries', function (Blueprint $table) {
            $table->dropColumn('loading_date');
            $table->dropColumn('vehicle_exit_date');
        });
    }
}
