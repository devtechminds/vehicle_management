<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGateEntryOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_entry_outs', function (Blueprint $table) {
            $table->id();
            $table->Integer('manifesto_entry_id');
            $table->Integer('gate_entry_id_in');
            $table->Integer('weigh_bridges_id');
            $table->Integer('consignment_details_id');
            $table->string('gate_entry_no');
            $table->Integer('field_supervisor_entry_out_id');
            $table->Integer('release_approval_finacial_officer_entries_id');
            $table->string('initiated_by');
            $table->string('interchange_no');
            $table->string('time_in');
            $table->string('destination');
            $table->string('shipping_line');
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
        Schema::dropIfExists('gate_entry_outs');
    }
}
