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
        Schema::create('replace_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester')->constrained('users');
            $table->string('transaction_no');
            $table->string('office_section');
            $table->string('fund_cluster');
            $table->double('amount');
            $table->string('status');
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
        Schema::dropIfExists('replace_requests');
    }
};
