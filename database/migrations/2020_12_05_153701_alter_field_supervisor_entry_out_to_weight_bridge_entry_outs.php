<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldSupervisorEntryOutToWeightBridgeEntryOuts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weight_bridge_entry_outs', function (Blueprint $table) {
            $table->Integer('weight_bridge_entry_outs_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weight_bridge_entry_outs', function (Blueprint $table) {
            //
        });
    }
}
