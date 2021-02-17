<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsignmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignment_details', function (Blueprint $table) {
            $table->id('id');
            $table->Integer('manifesto_entry_id');
            $table->String('report_no');
            $table->date('carry_in_date');
            $table->String('container_no')->nullable();
            $table->Integer('size')->nullable();
            $table->String('seal_s_no1')->nullable();
            $table->Integer('commodity');
            $table->Integer('material');
            $table->Integer('uom')->nullable();
            $table->Integer('declared_wgt')->nullable();
            $table->String('truck_no')->nullable();
            $table->String('trailer_no')->nullable();
            $table->String('driver_name')->nullable();
            $table->String('driver_lic_no')->nullable();
            $table->String('driver_ph_no')->nullable();
            $table->String('chasis_no')->nullable();
            $table->String('transporter')->nullable();
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
        Schema::dropIfExists('consignment_details');
    }
}
