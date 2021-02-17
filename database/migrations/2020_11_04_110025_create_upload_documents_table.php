<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_documents', function (Blueprint $table) {
            $table->id();
            $table->Integer('manifesto_entry_id');
            $table->Integer('gate_entry_id');
            $table->Integer('weigh_bridges_id');
            $table->Integer('consignment_details_id');
            $table->string('field_supervisor_name');
            $table->string('container_physical_status');
            $table->string('location');
            $table->date('field_supervisor_entry_date');
            $table->Integer('no_of_package');
            $table->string('file_upload');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('upload_documents');
    }
}
