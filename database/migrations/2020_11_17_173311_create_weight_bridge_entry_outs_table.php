<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightBridgeEntryOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_bridge_entry_outs', function (Blueprint $table) {
            $table->id();
            $table->Integer('manifesto_entry_id');
            $table->Integer('gate_entry_out_id');
            $table->Integer('consignment_details_id');
            $table->Integer('finacial_officer_entry_id');
            $table->Text('wb_ticket_no');
            $table->Integer('wb_gross_wt')->nullable();
            $table->Integer('container_tare_wt')->nullable();
            $table->Integer('wb_tare_wt')->nullable();
            $table->Integer('wb_net_wt')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->Integer('created_by');
            $table->Integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_bridge_entry_outs');
    }
}
