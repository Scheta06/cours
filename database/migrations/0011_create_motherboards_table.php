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
        Schema::create('motherboards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();

            $table
                ->foreignId('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('chipset_id')
                ->references('id')
                ->on('chipsets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('memory_type_id')
                ->references('id')
                ->on('memory_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('form_id')
                ->references('id')
                ->on('forms')
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
        Schema::dropIfExists('motherboards');
    }
};
