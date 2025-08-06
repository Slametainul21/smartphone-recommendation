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
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Kamera, Baterai, Performa, Desain, dll
            $table->string('type'); // performance, camera, battery, design, connectivity
            $table->decimal('weight', 3, 2)->default(1.00); // Bobot untuk algoritma (0.00 - 1.00)
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};
