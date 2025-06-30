<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description')->nullable();

            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('processor_id')->references('id')->on('processors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('motherboard_id')->references('id')->on('motherboards')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('cooler_id')->references('id')->on('coolers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ram_id')->references('id')->on('rams')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('storage_id')->references('id')->on('storages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('videocard_id')->references('id')->on('videocards')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('psu_id')->references('id')->on('psus')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('chassis_id')->references('id')->on('chassis')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
