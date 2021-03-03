<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuWeightBridgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lu_weight_bridges', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->Integer('lu_gate_entry_id');
            $table->Text('wb_ticket_no');
            $table->Integer('wb_gross_wt')->nullable();
            $table->Integer('container_tare_wt')->nullable();
            $table->Integer('wb_tare_wt')->nullable();
            $table->Integer('wb_net_wt')->nullable();
            $table->String('loaded_by')->nullable();
            $table->String('name')->nullable();
            $table->Integer('location')->nullable();
            $table->Integer('quantity_loaded')->nullable();
            $table->Integer('quantity_short')->nullable();
            $table->Integer('kgs')->nullable();
            $table->boolean('status')->default('0');
            $table->Integer('created_by');
            $table->Integer('updated_by');
            $table->String('time_in');
            $table->softDeletes();
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
        Schema::dropIfExists('lu_weight_bridges');
    }
}
