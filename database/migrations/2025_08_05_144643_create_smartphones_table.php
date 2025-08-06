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
        Schema::create('smartphones', function (Blueprint $table) {
            $table->id();
            $table->string('brand'); // Samsung, Xiaomi, dll
            $table->string('model'); // Galaxy A26, Redmi Note 14, dll
            $table->string('full_name'); // Samsung Galaxy A26 5G
            $table->unsignedBigInteger('category_id');
            $table->decimal('price_min', 12, 0); // Harga minimum
            $table->decimal('price_max', 12, 0); // Harga maximum
            $table->integer('ram'); // dalam GB
            $table->integer('storage'); // dalam GB
            $table->integer('battery'); // dalam mAh
            $table->integer('camera'); // dalam MP
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smartphones');
    }
};
