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
        Schema::create('rams', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description')->nullable();
            $table->integer('count_of_modules');

            $table
                ->foreignId('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('memory_capacity_id')
                ->references('id')
                ->on('memory_capacities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('memory_type_id')
                ->references('id')
                ->on('memory_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('category_id')
                ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('rams');
    }
};
