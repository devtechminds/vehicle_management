<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_entries', function (Blueprint $table) {
            $table->id('id');
            $table->Integer('manifesto_entry_id');
            $table->Integer('consignment_details_id');
            $table->String('gate_entry_no');
            $table->String('initiated_by');
            $table->String('interchange_no');
            $table->String('time_in');
            $table->String('destination');
            $table->String('shipping_line');
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
        Schema::dropIfExists('gate_entries');
    }
}
