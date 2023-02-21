<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serial_numbers', function (Blueprint $table) {
            $table->id('id');
            $table->integer('reference_no');
            $table->string('serial_no')->unique();
            $table->string('condition');
            $table->string('color');
            $table->string('location');
            $table->string('price');
            $table->string('warranty')->nullable();
            $table->string('supplier')->nullable();
            $table->string('date');
            $table->string('address');
            $table->string('contact_no');
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
        Schema::dropIfExists('serial_numbers');
    }
};
