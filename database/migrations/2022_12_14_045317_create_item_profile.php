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
        Schema::create('item_profile', function (Blueprint $table) {
            $table->id('transaction_number');
            $table->string('purchase_date');
            $table->string('purchase_price');
            $table->string('inventory_number');
            $table->string('type');
            $table->double('salvage_value');
            $table->string('serial_number')->unique();
            $table->string('classification');
            $table->string('lifespan');
            $table->string('department');
            $table->integer('quantity');
            $table->double('annual_operating_cost');
            $table->string('year');
            $table->double('replacement_value');
            $table->string('title');
            $table->double('trade_in_value');
            $table->string('body');
            $table->double('present_value');
            $table->longText('comments');
            $table->longText('notes');
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
        Schema::dropIfExists('item_profile');
    }
};
