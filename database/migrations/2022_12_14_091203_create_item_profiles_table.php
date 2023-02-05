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
            $table->id();
            $table->string('transaction_no');
            $table->integer('inventory_number');
            $table->string('classification');
            $table->string('year');
            $table->string('title');
            $table->string('image')->nullable();
            $table->double('depreciation');
            $table->longText('notes')->nullable();
            $table->longText('description');
            $table->foreignId('inventoried_by')->constrained('users');
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
