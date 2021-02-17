<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterConsignmentDetailsToTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consignment_details', function (Blueprint $table) {
            $table->String('seal_s_no2')->nullable();
            $table->Integer('qty')->nullable();
            $table->String('lot_no')->nullable();
            $table->String('location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consignment_details', function (Blueprint $table) {
            $table->dropColumn('seal_s_no2');
            $table->dropColumn('qty');
            $table->dropColumn('lot_no');
            $table->dropColumn('location');

        });
    }
}
