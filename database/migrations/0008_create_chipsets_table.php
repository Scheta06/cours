<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chipsets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['AMD', 'Intel']);

            $table->foreignId('socket_id')
                ->references('id')
                ->on('sockets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chipsets');
    }
};
