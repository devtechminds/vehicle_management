<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCfsExtendedExpDateToReleaseApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('release_approval_finacial_officer_entries', function (Blueprint $table) {
            $table->date('cfs_extended_exp_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('release_approval_finacial_officer_entries', function (Blueprint $table) {
            Schema::dropIfExists('cfs_extended_exp_date');
        });
    }
}
