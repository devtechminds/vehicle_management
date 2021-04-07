<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuCommodityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lu_commodity_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->Integer('lu_gate_entry_id');
            $table->Integer('material');
            $table->Integer('uom')->nullable();
            $table->Integer('commodity_quantity')->nullable();
            $table->decimal('total_weight', 16, 6)->nullable();
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('lu_commodity_details');
    }
}
