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
            $table->string('purchase_price');
            $table->string('inventory_number');
            $table->string('type');
            $table->string('serial_number')->unique();
            $table->string('classification');
            $table->string('lifespan');
            $table->string('department');
            $table->string('year');
            $table->string('title');
            $table->string('condition');
            $table->string('image')->nullable();
            $table->double('depreciation');
            $table->longText('notes');
            $table->longText('description');


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
