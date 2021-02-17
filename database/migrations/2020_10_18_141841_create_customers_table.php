<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_code');
            $table->string('customer_name')->nullable();
            $table->BigInteger('tin_no')->nullable();
            $table->string('vrn_no')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('place')->nullable();
            $table->Integer('pincode')->nullable();
            $table->Text('address')->nullable();
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('customers');
    }
}
