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
        Schema::create('items_replaces', function (Blueprint $table) {
            $table->id('id');
            $table->integer('reference_no');
            $table->string('serial_no')->unique();
            $table->string('description')->nullable();
            $table->double('cost')->default(0);
            $table->string('remarks');
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
        Schema::dropIfExists('items_replaces');
    }
};
