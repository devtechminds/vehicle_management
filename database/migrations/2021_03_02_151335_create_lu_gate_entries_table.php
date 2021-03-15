<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuGateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lu_gate_entries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->text('ref_no');
            $table->date('date');
            $table->Integer('customer_name');
            $table->Integer('commodity');
            $table->Integer('transporter');
            $table->String('truck_no')->nullable();
            $table->String('trailer_no')->nullable();
            $table->String('dn_no')->nullable();
            $table->Integer('dn_qty')->nullable();
            $table->String('bl_no')->nullable();
            $table->Integer('bl_qty')->nullable();
            $table->Integer('quantity')->nullable();
            $table->decimal('metric_ton', 8, 5)->nullable();
            $table->String('driver_name')->nullable();
            $table->String('driver_lic_no')->nullable();
            $table->String('driver_ph_no')->nullable();
            $table->String('interchange_no')->nullable();
            $table->String('destination')->nullable();
            $table->String('container_no')->nullable();
            $table->String('shipping_line')->nullable();
            $table->String('tra_seal_no')->nullable();
            $table->String('gate_pass_no')->nullable();
            $table->String('time_in');
            $table->boolean('status')->default('1');
            $table->Integer('created_by');
            $table->Integer('updated_by');
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
        Schema::dropIfExists('lu_gate_entries');
    }
}
