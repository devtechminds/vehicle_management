<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestoEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_entries', function (Blueprint $table) {
            $table->id('id');
            $table->text('ref_no');
            $table->date('date');
            $table->Integer('consignment_type');
            $table->Integer('cargo_type');
            $table->String('cargo_reference_no');
            $table->String('ecd_name');
            $table->String('delivery_note_no');
            $table->String('no_container');
            $table->String('booking_no');
            $table->Integer('customer_name');
            $table->Integer('cf_agent');
            $table->Integer('consignment_wgt')->default('0');
            $table->Integer('no_package')->default('0');
            $table->String('interchange_no')->nullable();
            $table->String('destination')->nullable();
            $table->String('shipping_line')->nullable();
            $table->Integer('created_by');
            $table->Integer('updated_by');
            $table->tinyInteger('status')->default('0');
            $table->String('gate_pass_no')->nullable();
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
        Schema::dropIfExists('manifesto_entries');
    }
}
