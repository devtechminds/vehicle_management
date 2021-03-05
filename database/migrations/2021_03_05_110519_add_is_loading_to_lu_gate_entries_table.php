<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsLoadingToLuGateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lu_gate_entries', function (Blueprint $table) {
            $table->boolean('is_loading')->default('0');
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
            $table->dropColumn('is_loading');
        });
    }
}
