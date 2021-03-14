<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToLuGateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lu_gate_entries', function (Blueprint $table) {
            $table->boolean('out_process_status')->default('0');
            $table->String('time_out');
            $table->Integer('authorized_by');
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
            $table->dropColumn('out_process_status');
            $table->dropColumn('time_out');
            $table->dropColumn('authorized_by');
        });
    }
}
