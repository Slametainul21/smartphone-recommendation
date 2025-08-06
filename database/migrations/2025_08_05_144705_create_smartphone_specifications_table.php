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
        Schema::create('smartphone_specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smartphone_id');
            $table->unsignedBigInteger('specification_id');
            $table->decimal('value', 8, 2); // Nilai spesifikasi (sudah dinormalisasi 0.00 - 1.00)
            $table->timestamps();
            
            $table->foreign('smartphone_id')->references('id')->on('smartphones')->onDelete('cascade');
            $table->foreign('specification_id')->references('id')->on('specifications')->onDelete('cascade');
            
            $table->unique(['smartphone_id', 'specification_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smartphone_specifications');
    }
};
