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
        Schema::create('repair_requests', function (Blueprint $table) {
            $table->id('purchase_id');
            $table->string('entity');
            $table->string('fund_cluster');
            $table->string('date');
            $table->string('office_sec');
            $table->double('transaction_no');
            $table->string('appendix_no');
            $table->string('purpose');
            $table->string('item');
            $table->string('description');
            $table->integer('qty');
            $table->double('unit');
            $table->string('price');
            $table->double('total');
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
        Schema::dropIfExists('repair_requests');
    }
};
