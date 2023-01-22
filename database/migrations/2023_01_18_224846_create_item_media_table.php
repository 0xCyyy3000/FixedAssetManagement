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
        Schema::create('item_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('item_profiles');
            $table->string('media1')->nullable();
            $table->string('media2')->nullable();
            $table->string('media3')->nullable();
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
        Schema::dropIfExists('item_media');
    }
};
