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
        Schema::create('item_profiles', function (Blueprint $table) {
            $table->id('transaction_number');
            $table->string('purchase_date');
            $table->string('purchase_price')->nullable();
            $table->string('inventory_number')->nullable();
            $table->string('type')->nullable();
            $table->double('salvage_value')->nullable();
            $table->string('serial_number')->unique()->nullable();
            $table->string('classification')->nullable();
            $table->string('lifespan')->nullable();
            $table->string('department')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('annual_operating_cost')->nullable();
            $table->string('year')->nullable();
            $table->double('replacement_value')->nullable();
            $table->string('title')->nullable();
            $table->double('trade_in_value')->nullable();
            $table->string('body')->nullable();
            $table->double('present_value')->nullable();
            $table->longText('comments')->nullable();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('item_profiles');
    }
};
