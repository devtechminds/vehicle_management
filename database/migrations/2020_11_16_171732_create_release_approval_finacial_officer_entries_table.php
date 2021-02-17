<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleaseApprovalFinacialOfficerEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('release_approval_finacial_officer_entries', function (Blueprint $table) {
            $table->id();
            $table->Integer('manifesto_entry_id');
            $table->Integer('gate_entry_id');
            $table->Integer('weigh_bridges_id');
            $table->Integer('consignment_details_id');
            $table->Integer('field_supervisor_entry_out_id');
            $table->string('cfs_release_no');
            $table->string('invoice_no');
            $table->string('cfa_release_date');
            $table->date('invoice_date');
            $table->date('cfs_release_date');
            $table->date('cfs_release_exp_date');
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
        Schema::dropIfExists('release_approval_finacial_officer_entries');
    }
}
