<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuTimeTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lu_time_trackings', function (Blueprint $table) {
            $table->id();
            $table->Integer('lu_gate_entry_id');
            $table->boolean('in_or_out')->nullable();
            $table->boolean('old_status')->nullable();
            $table->boolean('new_status')->nullable();
            $table->String('new_status_time')->nullable();
            $table->Integer('time_diff')->nullable();;
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
        Schema::dropIfExists('lu_time_trackings');
    }
}
